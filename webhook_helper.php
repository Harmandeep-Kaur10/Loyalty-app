<?php

function handle_webhook($shop, $webhook_event, $webhook_data)
{
	if( $webhook_event == "bulk_operations/finish" ){
                \Modules\LoyaltyApp\Jobs\HandleBulkOperationFinishWebhook::dispatch($shop, $webhook_data);
	}

	if( $webhook_event == 'orders/create' )
        {
                \Modules\LoyaltyApp\Jobs\HandleOrderCreateWebhook::dispatch($shop,$webhook_data);
        }

        if( $webhook_event == 'customers/create' )
        {
                \Modules\LoyaltyApp\Jobs\HandleCustomerCreateWebhook::dispatch($shop,$webhook_data);
        }

	if( $webhook_event == 'customers/update' )
        {
                \Modules\LoyaltyApp\Jobs\HandleCustomerUpdateWebhook::dispatch($shop,$webhook_data);
	}

	return;
}

function save_new_customer_in_db($new_customer,$shop)
{
        $customer = new \Modules\LoyaltyApp\Models\Customer;
        $customer->msd = $shop->msd;
        $customer->customer_id=$new_customer['id'];
        $customer->name=$new_customer['first_name'].' '.$new_customer['last_name'];
        $customer->rewards='[]';
	$customer->revenue = 0;

	if($new_customer['email'] == null)
	{
		$customer->email = 0;
	}	
	else
	{
		$customer->email = $new_customer['email'];
	}
	
	$store_credit_info = array("id" => 0 , "currency" => $new_customer['currency']);
	$customer->store_credit_info = json_encode($store_credit_info);

        $customer->save();
        elog("new customer saved",$shop->msd,"Webhook",$customer);

        return $customer;
}

function is_referral_order($shop,$order)
{
	$referral = \Modules\LoyaltyApp\Models\Referral::where('msd',$shop->msd)->where('email', $order['email'])->first();
	if($referral)
	{
		$discount_coupon = check_if_discount_coupon_applied_or_not($shop->msd,$order);
		if($referral->coupon_code == $discount_coupon)
		{
			return true;	
		}	
	}
	return false;
}

function save_referrer_details_in_activity_logs($shop,$order,$coupon_code,$reward_percentage,$customer)
{
      	$new_activity = new \Modules\LoyaltyApp\Models\ActivityLog;
      	$new_activity->shop_id = $shop->id;
       	$new_activity->msd = $shop->msd;
     	$new_activity->activity_type = "referred-".$order['email']." ".$reward_percentage."% off";
     	$new_activity->customer_id = $customer->customer_id;
       	$new_activity->points_changed = 0;
       	$new_activity->current_points = $customer->points;
      	$entry = array("code" => $coupon_code);
      	$new_activity->activity_data = json_encode($entry);
    	$new_activity->save();
}

function get_referrer_reward_percentage($shop)
{
        $app_data = json_decode($shop->app_data,true);
        foreach($app_data['activities'] as $activity)
        {
                if($activity['handle'] == "refer_a_friend")
                {
                        $referrer_reward_percentage = $activity['referrer_reward'];
                }
        }

       return $referrer_reward_percentage;
}

function save_reward_of_referrer_in_customer_rewards($customer, $reward_name, $coupon_code)
{
	$customer_rewards = json_decode($customer->rewards,true);
	
	$entry = array("name"=>$reward_name, "cost"=>"0", "discount_code"=>$coupon_code, "redeemed"=>"false");
	
	array_push($customer_rewards, $entry);
        $final = json_encode($customer_rewards);
        $customer->rewards = $final;

        $total_activities = $customer->activities;
        $customer->activities = $total_activities + 1;
        $customer->save();	
}

function get_orderId_number_date_revenue_and_reward_percentage_entry($order)
{
        $arr =[];
        $entry = array("order_no"=>$order['name'], "order_id"=>$order['id'], "order_date"=>$order['created_at'], "revenue"=>$order['current_total_price']);

        if($order['discount_applications']!=[])
        {
                $reward_percentage_entry = array("reward_percentage"=>$order['discount_applications'][0]['value']);
                $arr = array_merge($entry,$reward_percentage_entry);
        }
        if($arr != [])
        {
                return $arr;
        }
        else
        {
                return $entry;
        }
}

function set_points_for_purchase_and_get_purchase_activity_state_entry($shop,$new_activity,$customer,$order)
{
        $total_points = $customer->points;
        $purchase_activity_state = get_activity_state($shop,"make_a_purchase");
        $purchase_activity_points = get_activity_points($shop,"make_a_purchase");
	$purchase_activity_reward_type = get_purchase_activity_reward_type($shop);

	if($purchase_activity_reward_type == 'Percentage')
	{
		$purchase_activity_points = round(($order['current_total_price']*$purchase_activity_points)/100);
	}
        if($purchase_activity_state == "1")
        {
                $total_activities = $customer->activities + 1;
                $total_points = $total_points + $purchase_activity_points;
		$customer->points = $total_points;

                $customer->activities = $total_activities;

                $new_activity->points_changed = "+".$purchase_activity_points;
                $new_activity->current_points = $total_points;
        }
        else
        {
                $new_activity->current_points = $total_points;
        }
        $customer->save();
        $entry = array("purchase_activity_state"=>$purchase_activity_state);
        elog("points after purchase: $total_points points of customer id: $customer->customer_id", $shop->msd, "Webhook");
        return $entry;
}

function get_purchase_activity_reward_type($shop)
{
	$app_data = json_decode($shop->app_data,true);
	foreach($app_data['activities'] as $activity)
	{
		if($activity['handle'] == 'make_a_purchase')
		{
			return $activity['type'];
		}
	}
}

function check_if_discount_coupon_applied_or_not($msd,$order)
{
	$order_id = $order['id'];
	$customer_id = $order['customer']['id'];
        if($order['discount_codes']!=[])
	{
		$discount_code = $order['discount_codes'][0]['code'];
                elog("reward applied on order: $order_id with discount code: $discount_code by customer id: $customer_id", $msd, "Webhook");
                return $discount_code;
        }
        else
        {
                elog("reward not applied on order: $order_id by customer id: $customer_id", $msd, "Webhook");
                return 0;
        }
}

function get_reward_name_and_code_entry($shop,$order)
{
        $percent = explode('.',$order['discount_applications'][0]['value'])[0];
        if($order['discount_codes'][0]['type'] == 'shipping')
	{
		$reward_name = get_reward_name($shop,'free_shipping');
		//bcz reward name is now customizable
		//$entry = array("reward_name"=>'Free Shipping used', "code"=>$order['discount_codes'][0]['code']);
        }
        if($order['discount_codes'][0]['type'] == 'percentage')
        {
                //$percentage_reward = $percent."% off";
		//$entry = array("reward_name"=>$percentage_reward.' used', "code"=>$order['discount_codes'][0]['code']);
		$reward_name = get_reward_name($shop,'percentage_off');
        }
        if($order['discount_codes'][0]['type'] == 'fixed_amount')
	{
		$reward_name = get_reward_name($shop,'amount_off');
                //$amount_reward = str_replace("amount","$percent","$shop->currency_format")." off";
                //$entry = array("reward_name"=>$amount_reward.' used', "code"=>$order['discount_codes'][0]['code']);
        }
	$entry = array("reward_name"=>$reward_name.' used', "code"=>$order['discount_codes'][0]['code']);
        return $entry;
}

function get_reward_name($shop, $reward_name)
{
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == $reward_name)
                {
                        $reward_name = $reward['name'];
                }
        }
        return $reward_name;
}

function get_reward_cost_entry($order,$shop)
{
        if($order['discount_codes'][0]['type'] == 'shipping')
        {
                $free_shipping_reward_cost = get_free_shipping_reward_cost($shop);
                $reward_cost_entry = array("reward_cost"=>$free_shipping_reward_cost);
        }
        if($order['discount_codes'][0]['type'] == 'percentage')
        {
                $percent_off_reward_cost = get_percent_off_reward_cost($shop);
                $reward_cost_entry = array("reward_cost"=>$percent_off_reward_cost);
        }
        if($order['discount_codes'][0]['type'] == 'fixed_amount')
        {
                $amount_off_reward_cost = get_amount_off_reward_cost($shop);
                $reward_cost_entry = array("reward_cost"=>$amount_off_reward_cost);
        }
        return $reward_cost_entry;
}

function update_customer_activities_rewards_and_revenue($msd,$order,$customer)
{
	$order_id = $order['id'];
        $decoded_customer_rewards = json_decode($customer->rewards,true);

        $total_activities = $customer->activities + 1;
        $customer->activities = $total_activities;

        $final = set_reward_redeemed_state_true_in_customers_table($msd,$decoded_customer_rewards,$order);
        $customer->rewards = $final;

        $total_revenue = $customer->revenue;
        $total_revenue = $total_revenue + $order['current_total_price'];
        $customer->revenue = $total_revenue;

        $customer->save();
        elog("after purchasing order: $order_id updated activities: $total_activities, revenue: $total_revenue of customer id: $customer->customer_id", $msd, "Webhook");
}

function set_reward_redeemed_state_true_in_customers_table($msd,$decoded_customer_rewards,$order)
{
	$customer_id = $order['customer']['id'];
        $update_redeemed_state = array();
        foreach($decoded_customer_rewards as $decoded_reward)
        {
                if($decoded_reward['discount_code'] == $order['discount_codes'][0]['code'])
                {
                        $decoded_reward['redeemed'] = "true";
        		elog("redeemed state of reward updated to true in customers table for customer id: $customer_id", $msd, "Webhook", $decoded_reward);
                }
                array_push($update_redeemed_state, $decoded_reward);
        }
        $final = json_encode($update_redeemed_state);
        return $final;
}

function set_reward_used_entry_in_activity_logs($shop,$customer)
{
        $last_activity_log = \Modules\LoyaltyApp\Models\ActivityLog::where('msd',$shop->msd)->get()->last();
        $arr = json_decode($last_activity_log->activity_data,true);

        $new_activity_log = new \Modules\LoyaltyApp\Models\ActivityLog;
        $new_activity_log->shop_id = $shop->id;
        $new_activity_log->msd = $shop->msd;
        $new_activity_log->customer_id = $customer->customer_id;
        $new_activity_log->activity_type = $arr['reward_name'];
        if($arr['purchase_activity_state'] == "0")
        {
                 $entry = array("order_no" => $arr['order_no'], "order_id"=>$arr['order_id'], "code" => $arr['code'], "order_date" => $arr['order_date'], "purchase_activity_state" => $arr['purchase_activity_state'], "revenue" => $arr['revenue']);
        }
        else
        {
                $entry = array("order_no" => $arr['order_no'], "order_id" => $arr['order_id'], "code" => $arr['code'], "order_date" => $arr['order_date'], "purchase_activity_state" => $arr['purchase_activity_state']);
        }
        $final = json_encode($entry);
        $new_activity_log->activity_data = $final;
        $new_activity_log->current_points = $customer->points;
        $new_activity_log->save();
        elog("saved $arr[reward_name] activity in logs table for customer id: $customer->customer_id", $shop->msd, "Webhook", $new_activity_log);
}

