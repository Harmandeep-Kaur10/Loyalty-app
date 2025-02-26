<?php

namespace Modules\LoyaltyApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MerchantAppSetup extends Controller
{
	public function get_dashboard_view( $our_passw_token )
        {
		$shop = get_shop_by_passw_token($our_passw_token);
		$customers = \Modules\LoyaltyApp\Models\Customer::where('msd', $shop->msd)->get();
		$shop->total_customers = $customers->count();
                $shop->total_revenue = get_total_revenue($shop,$customers);
                $shop->total_rewards_claimed = get_total_rewards_claimed($shop,$customers);
		$app_data = json_decode($shop->app_data,true);
		elog("visited dashboard page view", $shop->msd, "Merchant");
		return view('loyaltyapp::home',compact("shop", "app_data"));
	}

	//public function get_points_earn_setup_view( $our_passw_token, Request $request)
	public function get_points_earn_setup_view( $our_passw_token)
        {
		$shop = get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
		$activities = $app_data['activities'];
		$enabled_activities = count_enabled_activities($activities);
	
		/*$page = 'navigation';
		if($request->page)
		{
			$page = $request->page;
		}
		elog("visited points earn setup view from $page",$shop->msd,"Merchant");
		return view('loyaltyapp::points_earn_setup',compact("shop", "activities", "enabled_activities", "page", "app_data"));*/
		elog("visited points earn setup view",$shop->msd,"Merchant");
                return view('loyaltyapp::points_earn_setup',compact("shop", "activities", "enabled_activities", "app_data"));
        }

	public function enable_or_disable_app_status($our_passw_token)
        {
                $shop = get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
		if($app_data['app_status'] == "on")
		{
                	$app_data['app_status'] = "off";
		}
		else
		{
			$app_data['app_status'] = "on";
		}
                $shop->app_data = json_encode($app_data);
		$shop->save();
		$app_status = $app_data['app_status'];
		elog("turned $app_status app status",$shop->msd,"Merchant");
               	return redirect("/home/$our_passw_token");
        }

        public function handle_update_points_request($our_passw_token, $activity_name, Request $request)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
		$name = str_replace("_", " ", $activity_name);
		//this updates activity name to be shown on storefront
		update_activity_name($shop, $activity_name, $request);
		if($activity_name == 'make_a_purchase')
		{
			update_purchase_activity_points_and_type($shop, $request);
			elog("updated $name activity, name: $request->activity_name, reward type: $request->purchase_reward_type, points: $request->purchase_reward",$shop->msd,"Merchant");
			//elog("updated $activity_name activity from $request->page, reward type: $request->purchase_reward_type, points: $request->purchase_reward",$shop->msd,"Merchant");
		}

		//refer a friend activity included in this function because of new loyalty program setup
		elseif($activity_name == 'refer_a_friend')
		{
			update_refer_friend_activity($shop, $request);
                	elog("updated $name activity, name: $request->activity_name, referrer reward: $request->referrer_reward% off, friend reward: $request->friend_reward% off","Merchant",$shop->msd);
		}
		else
		{
			update_points($shop, $activity_name, $request);
			elog("updated $name activity, name: $request->activity_name, points: $request->activity_points", $shop->msd, "Merchant");
			//elog("updated $activity_name activity points to $request->activity_points from $request->page", $shop->msd, "Merchant");
		}
		/*if($request->page == "onboarding")
		{
			return redirect("/home/$our_passw_token");
		}
		return redirect("/points_earn_setup/$our_passw_token?page=$request->page");*/
		return redirect("/rewards_setup/$our_passw_token");
		//return redirect("/points_earn_setup/$our_passw_token");
        }

	public function enable_or_disable_activity_state($our_passw_token, $activity_name, Request $request)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
		$app_data['activities'] = update_activity_state($shop, $activity_name, $request);
		$shop->app_data = json_encode($app_data);
		$shop->save();
		$activity_name = str_replace("_", " ", $activity_name);
		elog("turned $request->status $activity_name activity",$shop->msd,"Merchant");
		//elog("turned $request->status $activity_name activity from $request->page",$shop->msd,"Merchant");
		return response()->json(['status' => 'success']);
        }

	public function edit_activity_page($our_passw_token, $activity_name)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
		foreach($app_data['activities'] as $activity)
		{
			if($activity['handle'] == $activity_name)
			{
				$found_activity = $activity;	
			}
		}
		$activity = $found_activity;
		return view('loyaltyapp::edit_activity',compact("shop", "activity"));
	}

	public function save_updated_refer_friend_activity_rewards($our_passw_token, Request $request)
        {
		$shop = get_shop_by_passw_token($our_passw_token);
		update_refer_friend_activity($shop, $request);
		/*elog("updated refer a friend activity rewards from $request->page, referrer reward: $request->referrer_reward% off, friend reward: $request->friend_reward% off","Merchant",$shop->msd);
		return redirect("/points_earn_setup/$our_passw_token?page=$request->page");*/
		elog("updated refer a friend activity rewards, referrer reward: $request->referrer_reward% off, friend reward: $request->friend_reward% off","Merchant",$shop->msd);
               	return redirect("/points_earn_setup/$our_passw_token");
        }

	//public function get_rewards_setup_view( $our_passw_token,Request $request )
	public function get_rewards_setup_view( $our_passw_token )
        {
		$shop = get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
                $rewards = $app_data['rewards'];
		$shop->enabled_rewards = count_enabled_rewards($rewards);

		$activities = $app_data['activities'];
                $shop->enabled_activities = count_enabled_activities($activities);

		/*$page = 'navigation';
		if($request->page)
		{
			$page = $request->page;
		}	
		elog("visited reward setup view from $page",$shop->msd,"Merchant");
		return view('loyaltyapp::rewards_setup',compact("shop", "rewards" , "percent_off_reward", "amount_off_reward", "enabled_rewards","page"));*/
		elog("visited loyalty program view",$shop->msd,"Merchant");
                return view('loyaltyapp::loyalty_program',compact("shop", "rewards", "activities"));
        }

	public function edit_reward_page($our_passw_token, $reward_name)
        {
                $shop = get_shop_by_passw_token($our_passw_token);
                $app_data = json_decode($shop->app_data,true);
                foreach($app_data['rewards'] as $reward)
                {
                        if($reward['handle'] == $reward_name)
                        {
                                $found_reward = $reward;
                        }
                }
                $reward = $found_reward;
                return view('loyaltyapp::edit_reward',compact("shop", "reward"));
        }

        public function handle_update_costs_request($our_passw_token, Request $request)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
		$reward_name = str_replace("_", " ", $request->reward_name);
		//this updates reward name to be shown on storefront
		update_reward_name($shop, $request);
		if($request->reward_name == 'percentage_off')
		{
			update_percentage_reward_amount_and_cost($shop,$request);
			elog("updated $reward_name reward, name: $request->updated_reward_name, amount: $request->off_value% off, cost: $request->reward_cost points", $shop->msd, "Merchant");
		}
		elseif($request->reward_name == 'amount_off')
		{
			update_amount_off_reward_cost_and_amount($shop,$request);
			//$reward_name = str_replace("amount","$request->reward_name","$shop->currency_format").' off';
			$updated_reward_name = str_replace("amount",$request->off_value,"$shop->currency_format");
                       	elog("updated $reward_name reward, name: $request->updated_reward_name, amount: $updated_reward_name off, cost: $request->reward_cost points", $shop->msd, "Merchant");
		}
		//store credit reward included here due to new loyalty program setup
		elseif($request->reward_name == 'convert_points_to_store_credit')
		{
			update_store_credit_reward($shop,$request);
			elog("updated $reward_name reward, name: $request->updated_reward_name, amount: $request->off_value for $request->reward_cost points","Merchant",$shop->msd);
		}
		else
		{
			update_free_shipping_cost($shop,$request);
			elog("updated $reward_name reward, name: $request->updated_reward_name, cost: $request->reward_cost points", $shop->msd, "Merchant");
		}
		/*
		update_costs($shop, $request);
		$reward_name = $request->reward_name;
		if(ctype_digit($request->reward_name))
               	{
                    	$reward_name = str_replace("amount","$reward_name","$shop->currency_format").' off';
		}
		elog("updated $reward_name reward cost to $request->reward_cost points from $request->page", $shop->msd, "Merchant");
		 
		if($request->page == "onboarding")
		{
			return redirect("/home/$our_passw_token");
		}
		return redirect("/rewards_setup/$our_passw_token?page=$request->page");*/
		return redirect("/rewards_setup/$our_passw_token");
        }

	public function enable_or_disable_reward_state($our_passw_token, Request $request)
        {
		$shop = get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
		$app_data['rewards'] = update_reward_state($shop,$request);
		$shop->app_data = json_encode($app_data);
		$shop->save();

		$reward_name = str_replace("_", " ", $request->reward_name);
        	/*if(ctype_digit($reward_name)
        	{
                	$reward_name = str_replace("amount","$reward_name","$shop->currency_format")." off";
		}*/

		//elog("turned $request->status $reward_name reward from $request->page",$shop->msd,"Merchant");
		elog("turned $request->status $reward_name reward",$shop->msd,"Merchant");
		return response()->json(['status' => 'success']);
        }

	/*public function save_updated_store_credit_reward($our_passw_token, Request $request)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
		update_store_credit_reward($shop,$request);
		elog("updated store credit reward, amount: $request->reward_cost for $request->off_value points","Merchant",$shop->msd);
                return redirect("/rewards_setup/$our_passw_token");
	}*/

	//public function get_customize_widget_view( $our_passw_token, Request $request )
	public function get_customize_widget_view( $our_passw_token )
        {
		$shop = get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
		$rewards = $app_data['rewards'];
		$activities = $app_data['activities'];
		$shop->enabled_rewards = count_enabled_rewards($rewards);
		$shop->enabled_activities = count_enabled_activities($activities);
		$shop->calculated_store_credit = calculate_store_credit($rewards,'10');

		/*$page = 'navigation';
		if($request->page)
		{
			$page = $request->page;
		}	
		elog("visited customize widget view from $page",$shop->msd,"Merchant");
		return view('loyaltyapp::customize_widget',compact("shop","app_data", "rewards", "page"));*/
		elog("visited customize widget view",$shop->msd,"Merchant");
                return view('loyaltyapp::customize_widget',compact("shop","app_data", "rewards", "activities"));
        }

	public function save_customization( Request $request,$our_passw_token )
        {
                $shop = get_shop_by_passw_token($our_passw_token);
		save_customization_in_shop_table($request,$shop);
		/*if($request->page == 'onboarding')
		{
			return redirect("/home/$our_passw_token");
		}
		return redirect("/customize_widget/$our_passw_token?page=$request->page");*/
		return redirect("/customize_widget/$our_passw_token");
        }
}

