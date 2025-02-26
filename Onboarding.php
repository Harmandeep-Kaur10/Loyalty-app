<?php

namespace Modules\LoyaltyApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Onboarding extends Controller
{
        public function save_onboarding_step_details($msd,$step_number,Request $request)
	{
		$shop = get_shop_by_msd($msd);
		$step_name = get_onboarding_step_name($step_number);
		$app_data = json_decode($shop->app_data,true);
		$onboarding_step = $app_data['onboarding_step'];
		$onboarding_step[$step_number] = "completed";
                $app_data['onboarding_step'] = $onboarding_step;
                $shop->app_data = json_encode($app_data);
		$shop->save();
		if($step_number == 1)
		{
			if($request->create_an_account == 'enabled')
			{
				$request->activity_points = $request->create_account_activity_points;
				update_points($shop, 'create_an_account', $request);	
			}
			if($request->visit == 'enabled')
			{
				$request->activity_points = $request->visit_activity_points;
                                update_points($shop, 'visit', $request);    
			}
			if($request->make_a_purchase == 'enabled')
			{
				update_purchase_activity_points_and_type($shop, $request);
			}
			if($request->refer_a_friend == 'enabled')
			{
				update_refer_friend_activity($shop, $request);
			}
			elog("updated data on onboarding Step1",$shop->msd,"Merchant",$request->request->all());
		}
		if($step_number == 2)
		{
			if($request->free_shipping_reward == 'enabled')
			{
				$request->reward_cost = $request->free_shipping_reward_cost;
				update_free_shipping_cost($shop,$request);
			}
			if($request->percentage_off_reward == 'enabled')
			{
				$request->off_value = $request->percentage_off_value;
				$request->reward_cost = $request->percentage_off_reward_cost;
				update_percentage_reward_amount_and_cost($shop,$request);
			}
			if($request->amount_off_reward == 'enabled')
			{
				$request->off_value = $request->amount_off_value;
				$request->reward_cost = $request->amount_off_reward_cost;
				update_amount_off_reward_cost_and_amount($shop,$request);
			}
			if($request->store_credit_reward == 'enabled')
			{
				$request->points = $request->store_credit_reward_cost;
				$request->amount = $request->store_credit_reward_amount;
				update_store_credit_reward($shop,$request);
			}
			elog("updated data on onboarding Step2",$shop->msd,"Merchant",$request->request->all());
		}
		if($step_number == 3)
		{
			save_customization_in_shop_table($request,$shop);
		}
		elog("completed Step $step_number: $step_name on onboarding page",$shop->msd,"Merchant");

		$app_data = json_decode($shop->app_data,true);
              	$shop->activities = $app_data['activities'];
		$shop->enabled_activities = count_enabled_activities($shop->activities);
		$shop->rewards = $app_data['rewards'];
                $shop->enabled_rewards = count_enabled_rewards($shop->rewards);
                $shop->calculated_store_credit = calculate_store_credit($shop->rewards,'10');
		$step = get_pending_onboarding_step($app_data['onboarding_step']);
           	elog("visited onboarding step$step", $shop->msd, "Merchant");
          	return view('loyaltyapp::onboarding_steps.step'.$step,compact("shop"));
	}

	public function send_message_on_telegram($our_passw_token,$message,$step_number,Request $request)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
		notify_on_telegram($shop,$message);
		elog("clicked $request->button on onboarding step6, $message",$shop->msd,"Merchant");

		if($request->button == 'No')
		{
			return response()->json(['status' => 'no']);
		}
                $step_name = get_onboarding_step_name($step_number);
                $app_data = json_decode($shop->app_data,true);
                $onboarding_step = $app_data['onboarding_step'];
                $onboarding_step[$step_number] = "completed";
                $app_data['onboarding_step'] = $onboarding_step;
                $shop->app_data = json_encode($app_data);
		$shop->save();
		elog("completed Step $step_number: $step_name on onboarding page",$shop->msd,"Merchant");
		return response()->json(['status' => 'yes']);
	}	
}

