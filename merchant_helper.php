<?php

function save_default_app_data( $shop )
{
	$app_data = json_decode($shop->app_data,true);
	$activities = set_default_points();	
	$app_data['activities'] = $activities;

	$rewards = set_default_costs();
       	$app_data['rewards'] = $rewards;

	$app_data['customization'] = [];
	
	$app_data['onboarding_step'] = array(1 => "not_completed", 2 => "not_completed", 3 => "not_completed", 4 => "not_completed", 5 => "not_completed", 6 => "not_completed");
     	$app_data['app_status'] = "on";

       	$app_data['admin_app_status'] = "on";

	$shop->app_data = json_encode($app_data);
	$shop->save();	
}

function get_total_revenue($shop,$customers)
{
        $total_revenue = 0;
        foreach($customers as $customer)
        {
                $total_revenue = $total_revenue + $customer->revenue;
        }
        return str_replace("amount",$total_revenue,$shop->currency_format);
}

function get_onboarding_step_name($step_number)
{
	$onboarding_steps = array(1 => "Set up for earning points", 2 => "Set up for redeeming points", 3 => "Widget styling", 4 => "Enabling app embed", 5 => "Preview", 6 => "Review");
	return $onboarding_steps[$step_number];
}

function get_total_rewards_claimed($shop,$customers)
{
        $total_rewards_claimed = 0;
        foreach($customers as $customer)
        {
                $decode_rewards = json_decode($customer->rewards,true);
                $total_rewards_claimed = $total_rewards_claimed + count($decode_rewards);
        }
        return $total_rewards_claimed;
}

function get_pending_onboarding_step( $onboarding ){
    foreach ($onboarding as $key => $value) {
        if ($value == "not_completed") {
            return $key;
        }
    }
    return false;
}

function save_customization_in_shop_table($request,$shop)
{
         $changes = array("align"=>$request->alignment, "theme_color"=>$request->theme_color, "widget_text"=>$request->widget_text, "display_type"=>$request->display_type);

	 $app_data = json_decode($shop->app_data,true);
	 $app_data['customization'] = $changes;
	 $shop->app_data = json_encode($app_data);
         $shop->save();
         elog("widget customization saved", $shop->msd, "Merchant",$app_data['customization']);
}

function save_manually_adjusted_points_entry_in_logs_table($shop, $customer_id, $request)
{
	$customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$shop->msd)->where('customer_id',$customer_id)->first(); 
  	$new_activity = new \Modules\LoyaltyApp\Models\ActivityLog;
   	$new_activity->shop_id = $shop->id;
   	$new_activity->msd = $shop->msd;
   	$new_activity->customer_id = $customer_id;
    	$new_activity->activity_type = $request->reason."-manually adjusted";
    	$new_activity->activity_data = "[]";
     	if($request->adjustment_type == 'Credit')
     	{
         	$new_activity->points_changed = "+".$request->amount;
    	}
    	if($request->adjustment_type == 'Debit')
    	{
       		$new_activity->points_changed = "-".$request->amount;
	}

	$new_activity->current_points = $customer->points;	
	$new_activity->save();
	elog("manually adjusted points",$shop->msd,"Merchant",$new_activity);
}

