<?php

function set_visit_entry_in_activity_log_and_update_customer_points($shop,$customer_id)
{
        $customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$shop->msd)->where('customer_id', $customer_id)->first();
	if($customer)
	{
        	$visit_activity_points = get_activity_points($shop,"visit");

        	$new_activity = new \Modules\LoyaltyApp\Models\ActivityLog;
        	$new_activity->shop_id = $shop->id;
        	$new_activity->msd = $shop->msd;
        	$new_activity->customer_id = $customer_id;
        	$new_activity->activity_type = "visit";
        	$new_activity->points_changed = "+".$visit_activity_points;
		$new_activity->activity_data = "[]";
		$new_activity->current_points = $customer->points + $visit_activity_points;
		$new_activity->save();

		$customer->points += $visit_activity_points;
   		$customer->activities += 1;
       		$customer->save();

		elog("after visit updated points of customer id- $customer_id  : $customer->points points", $shop->msd, "Customer");
	}
}

function calculate_store_credit($rewards,$customer_points)
{
	foreach($rewards as $reward)
     	{
          	if($reward['handle'] == 'convert_points_to_store_credit')
          	{
                     	$amount = $reward['amount'];
                	$points = $reward['points'];
              	}
  	}
  	$amount_for_one_point = $amount/$points;
    	$store_credit = $customer_points*$amount_for_one_point;
   	$calculated_store_credit = number_format($store_credit, 2);
	return $calculated_store_credit;
}

function update_store_credit_info($shop,$customer)
{
	$info = get_customer_info($shop, $customer->customer_id);
	// yaha check kro ki agar koi storeCreditAccounts na ho to kya krna - ggn
  	$string = $info['data']['customer']['storeCreditAccounts']['edges'][0]['node']['id'];
     	preg_match('/(\d+)$/', $string, $matches);
  	$account_id = $matches[1];
   	$store_credit = read_store_credit($shop, $account_id);
     	$currency_code = $store_credit['data']['storeCreditAccount']['balance']['currencyCode'];
    	$store_credit_info = array("id" => $account_id , "currency" => $currency_code);
	$customer->store_credit_info = json_encode($store_credit_info);
}

/*function compare_customer_points_with_reward_cost($msd, $customer_id, $reward_name)
{
        $shop = get_shop_by_msd($msd);
	$customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$msd)->where('customer_id', $customer_id)->first();
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == $reward_name)
		{
			$reward_name = str_replace("_", " ", $reward_name);
                        if($customer->points < $reward['cost'])
                        {
                                elog("customer id: $customer_id does not have enough points to claim $reward_name reward", $msd, "Customer");
                                return 0;
                        }

                        if($customer->points >= $reward['cost'])
                        {
                                elog("customer id: $customer_id have enough points to claim $reward_name reward", $msd, "Customer");
				$customer->points = $customer->points - $reward['cost'];
				$customer->save();
                                return 1;
                        }
		}
        }
}*/

function get_reward_cost_and_update_customer_points($shop,$reward_name,$customer)
{
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == $reward_name)
                {
			$reward_cost = $reward['cost'];
			$customer->points = $customer->points - $reward['cost'];
                       	$customer->save();
		}
        }
        return $reward_cost;
}

function generate_url_for_discount_coupon($reward_name,$msd)
{
	$shop = get_shop_by_msd($msd);
	$app_data = json_decode($shop->app_data,true);

        if($reward_name == 'free_shipping')
        {
                $coupon_details = create_free_shipping_discount_code($msd);
        }
        elseif($reward_name == 'percentage_off')
	{
		foreach($app_data['rewards'] as $reward)
        	{
                	if($reward['handle'] == $reward_name)
                	{
                        	$name = $reward['percent'];
                	}
        	}
                $percent = explode('%',$name)[0];
                $coupon_details = create_x_percentage_discount_code($msd,$percent);
	}
        else
	{
		foreach($app_data['rewards'] as $reward)
        	{
                	if($reward['handle'] == $reward_name)
                	{
                        	$amount = $reward['amount'];
                	}
        	}
                $coupon_details = create_x_amount_discount_code($msd,$amount);
	}
        $discount_code = $coupon_details->price_rule->title;
        return $discount_code;
}

function save_store_credit_claimed_reward_in_customer_rewards($customer)
{
	$customer_rewards = json_decode($customer->rewards,true);
      
	$entry = array("name"=>"Convert points to store credit", "cost"=>$customer->points, "discount_code"=>"", "redeemed"=>"false");
	
	array_push($customer_rewards, $entry);
        $final = json_encode($customer_rewards);
        $customer->rewards = $final;

        $total_activities = $customer->activities;
        $customer->activities = $total_activities + 1;
        $customer->save();
}

function save_points_converted_to_store_credit_entry_in_activity_logs($shop, $customer)
{
	$activity_log = new \Modules\LoyaltyApp\Models\ActivityLog;
        $activity_log->shop_id = $shop->id;
        $activity_log->msd = $shop->msd;
        $activity_log->customer_id = $customer->customer_id;
	$activity_log->activity_type = 'Points converted to store credit';
	$activity_log->points_changed = "-".$customer->points;
       	$activity_log->current_points = 0;
       	$activity_log->activity_data = "[]";
	$activity_log->save();
}

function save_claimed_reward_in_customer_rewards($shop, $customer, $reward_name, $discount_code)
{
	$customer_rewards = json_decode($customer->rewards,true);
	$app_data = json_decode($shop->app_data,true);
	$entry = get_customer_reward_entry($app_data,$reward_name,$discount_code);
        array_push($customer_rewards, $entry);
        $final = json_encode($customer_rewards);
        $customer->rewards = $final;

        $total_activities = $customer->activities;
        $customer->activities = $total_activities + 1;
	$customer->save();
}

function get_customer_reward_entry($app_data,$reward_name,$discount_code)
{
	foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == $reward_name)
		{
			//reward name can be customized by merchant now so it will be directly stored in db
                        /*if($reward_name == 'percentage_off')
                        {
                                $entry = array("name"=>$reward['percent'], "cost"=>$reward['cost'], "discount_code"=>$discount_code, "redeemed"=>"false");
                        }
                        elseif($reward_name == 'amount_off')
                        {
                                $entry = array("name"=>$reward['amount'], "cost"=>$reward['cost'], "discount_code"=>$discount_code, "redeemed"=>"false");
                        }
                        else
			{*/
                                $entry = array("name"=>$reward['name'], "cost"=>$reward['cost'], "discount_code"=>$discount_code, "redeemed"=>"false");
                        //}
                }
	}
	return $entry;
}

function save_claimed_reward_in_activity_logs($customer,$reward_name,$shop,$discount_code)
{
	$app_data = json_decode($shop->app_data,true);

        $activity_log = new \Modules\LoyaltyApp\Models\ActivityLog;
        $activity_log->shop_id = $shop->id;
        $activity_log->msd = $shop->msd;
	$activity_log->customer_id = $customer->customer_id;

        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == $reward_name)
		{
			//now reward name can be customized by merchant so directly name will be stored here
			/*if($reward_name == 'percentage_off')
			{
				$activity_log->activity_type = $reward['percent'].' claimed';
			}
			elseif($reward_name == 'amount_off')
			{
				$activity_log->activity_type = str_replace("amount",$reward['amount'],$shop->currency_format)." off claimed";
			}
			else
			{*/
				$activity_log->activity_type = $reward['name'].' claimed';
			//}
			$activity_log->points_changed = "-".$reward['cost'];
			$activity_log->current_points = $customer->points;
			$entry = array("code" => $discount_code);
        		$activity_log->activity_data = json_encode($entry);
		}
        }
	$activity_log->save();
}

function save_customer_in_customers_table($shop,$customer_id,$customer_data)
{
        $customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$shop->msd)->where('customer_id',$customer_id)->first();
        if(!$customer)
        {
                $customer = new \Modules\LoyaltyApp\Models\Customer;
                $customer->msd = $shop->msd;
                $customer->rewards='[]';
              	$customer->revenue = 0;
		$customer->points = 0;

                if($customer_data == "[]")
                {
                        $customer->customer_id = $customer_id;
                        $customer->name = '';
                        $customer->email = '';
			$info = get_customer_info($shop, $customer_id);
                }
                else
                {
                        $customer->customer_id=$customer_data->id;
                        $customer->name=$customer_data->first_name.' '.$customer_data->last_name;
                        $customer->email=$customer_data->email;
			$info = get_customer_info($shop, $customer_data->id);
		}
		$currency_code = $info['data']['customer']['amountSpent']['currencyCode'];	
        	if($info['data']['customer']['storeCreditAccounts']['edges'] != [])
        	{
               	 	$string = $info['data']['customer']['storeCreditAccounts']['edges'][0]['node']['id'];
                	preg_match('/(\d+)$/', $string, $matches);
                	$account_id = $matches[1];
                	$store_credit = read_store_credit($shop, $account_id);
                	$currency_code = $store_credit['data']['storeCreditAccount']['balance']['currencyCode'];
                	$store_credit_info = array("id" => $account_id , "currency" => $currency_code);
        	}
        	else
        	{
                	$store_credit_info = array("id" => 0 , "currency" => $currency_code);
        	}
        	$customer->store_credit_info = json_encode($store_credit_info);

                $customer->save();
	}
	elog("customer saved in db",$shop->msd,"Customer",$customer);
        return $customer;
}

function set_account_created_activity_in_logs_table($shop,$customer_id,$customer_data)
{
        $new_activity = new \Modules\LoyaltyApp\Models\ActivityLog;
        $new_activity->shop_id = $shop->id;
        $new_activity->msd = $shop->msd;
        $new_activity->activity_type = "account created";
        $new_activity->activity_data = "[]";

        if($customer_data == "[]")
        {
                $new_activity->customer_id = $customer_id;
        }
        else
        {
                $new_activity->customer_id = $customer_data->id;
        }
        $new_activity->save();
        return $new_activity;
}

function set_points_for_account_created($shop,$customer,$new_activity)
{
        $create_account_activity_state = get_activity_state($shop,"create_an_account");
        $create_account_activity_points = get_activity_points($shop,"create_an_account");

        if($create_account_activity_state == 1)
        {
                $customer->points += $create_account_activity_points;
		$customer->activities = 1; // because this activity will be the first always
		
                elog("assign $create_account_activity_points points for account creation to customer id: $customer->customer_id", $shop->msd, "Customer");
                $new_activity->points_changed = "+".$create_account_activity_points;
		$new_activity->current_points = $customer->points;
        }
        $customer->save();
        $new_activity->save();
}

function save_referred_friend_details_in_referrals_table($shop, $request, $coupon_code)
{
	$referrer = \Modules\LoyaltyApp\Models\Customer::where('msd',$shop->msd)->where('customer_id',$request->customer_id)->first();
	$new_referral = new \Modules\LoyaltyApp\Models\Referral;
	$new_referral->shop_id = $shop->id;
        $new_referral->msd = $shop->msd;
        $new_referral->email = $request->email;
	$new_referral->coupon_code = $coupon_code;
	$new_referral->referred_by = $referrer->email;
	$new_referral->save();
}

