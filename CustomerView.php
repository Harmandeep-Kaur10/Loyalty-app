<?php

namespace Modules\LoyaltyApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerView extends Controller
{
	public function get_js( Request $request )
        {
                $msd = $request->shop;
                $shop = get_shop_by_msd($msd);
                $visit_activity_state = get_activity_state($shop,"visit");

		$app_data = json_decode($shop->app_data,true);

		if($app_data['admin_app_status'] == "on")
		{
			if($app_data['app_status'] == "on")
			{
                               return view("loyaltyapp::frontend",compact('shop', 'app_data', 'visit_activity_state'));
                	}
		}
                return "console.log('truu.')";
        }

        public function set_visit_entry( $our_passw_token,$customer_id )
        {
                $shop = get_shop_by_passw_token($our_passw_token);
                elog("set visit entry in db of customer id: $customer_id", $shop->msd,"Customer");
		set_visit_entry_in_activity_log_and_update_customer_points($shop,$customer_id);
		return response()->json(['status' => 'success']);
        }

	public function convert_points_to_store_credit($msd, $customer_id)
	{
		$shop = get_shop_by_msd($msd);
		$customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$msd)->where('customer_id', $customer_id)->first();
		$store_credit_info = json_decode($customer->store_credit_info,true);
	
		$app_data = json_decode($shop->app_data,true);
		$calculated_store_credit = calculate_store_credit($app_data['rewards'],$customer->points);
		$account_id = my_app_env('STORE_CREDIT').$customer_id;
		
		credit_in_store_credit( $shop, $account_id, $calculated_store_credit, $store_credit_info['currency'], $expire_time = 0);

		save_store_credit_claimed_reward_in_customer_rewards($customer);
		save_points_converted_to_store_credit_entry_in_activity_logs($shop,$customer);

		$customer_points = $customer->points;
		$customer->points = 0;
		if($store_credit_info['id'] == 0)
		{
			update_store_credit_info($shop,$customer);
		}
		$customer->save();
		$amount = str_replace("amount", $calculated_store_credit, $shop->currency_format);
		elog("credited $amount to store credit of customer id: $customer->customer_id",$msd,"Customer");
		return ["res" => 1, "reward_cost" => $customer_points];
	}

        /*public function compare_points_with_reward_cost( $msd, $customer_id, Request $request )
	{
		$shop = get_shop_by_msd($msd);
		$reward = str_replace("_", " ", $request->reward);
                elog("customer id: $customer_id claimed $reward reward", $msd, "Customer");
                $result = compare_customer_points_with_reward_cost( $msd, $customer_id, $request->reward);
                return ["res" => $result];
	}*/

        public function save_claimed_reward( $msd, $customer_id, Request $request )
        {
                $shop = get_shop_by_msd($msd);
                $customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$msd)->where('customer_id', $customer_id)->first();
		$reward_cost = get_reward_cost_and_update_customer_points($shop,$request->reward,$customer);
		$discount_code = generate_url_for_discount_coupon($request->reward,$msd);
                save_claimed_reward_in_customer_rewards($shop, $customer, $request->reward, $discount_code);
		save_claimed_reward_in_activity_logs($customer,$request->reward,$shop,$discount_code);

		$app_data = json_decode($shop->app_data,true);
		$calculated_store_credit = calculate_store_credit($app_data['rewards'],$customer->points);
		$reward_name = str_replace("_", " ", $request->reward);
                elog("customer id: $customer_id successfully claimed $reward_name reward", $msd, "Customer");
                return ["discount_code" => $discount_code, "customer_points" => $customer->points, "reward_cost" => $reward_cost, "calculated_store_credit" => $calculated_store_credit];
        }

	public function get_signup_popup_view( $our_passw_token )
        {
		$shop= get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
		$shop_json = json_decode($shop->shop_json,true);
                elog("signup widget loaded", $shop->msd, "Customer");
                return view("loyaltyapp::signup_popup",compact('shop', 'app_data', 'shop_json'));
        }

        public function get_points_popup_view( $our_passw_token, $customer_id )
        {
                $shop= get_shop_by_passw_token($our_passw_token);
                $customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$shop->msd)->where('customer_id', $customer_id)->first();
                if(!$customer)
                {
			$resp = find_customers_by_customer_ids($shop->msd,$customer_id);
			$customer_data = $resp;

                        $customer = save_customer_in_customers_table($shop,$customer_id,$customer_data);
                        $new_activity = set_account_created_activity_in_logs_table($shop,$customer_id,$customer_data);
                        set_points_for_account_created($shop,$customer,$new_activity);
		}
		$app_data = json_decode($shop->app_data,true);
                $activities = $app_data['activities'];
		$rewards = $app_data['rewards'];
		$calculated_store_credit = calculate_store_credit($rewards,$customer->points);

		$decode_rewards = json_decode($customer->rewards,true);
                $enabled_activities = count_enabled_activities($activities);
                $enabled_rewards = count_enabled_rewards($rewards);
		elog("loyalty widget loaded, customer id: $customer_id", $shop->msd, "Customer");
		return view("loyaltyapp::points_popup",compact('shop', 'app_data', 'customer', 'rewards', 'activities', 'decode_rewards', 'enabled_activities','enabled_rewards','calculated_store_credit'));
	}

	public function get_referred_friend_popup_view($our_passw_token, $customer_id)
	{
		$shop= get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data,true);
		foreach($app_data['activities'] as $activity)
		{
			if($activity['handle'] == "refer_a_friend")
			{
				$friend_reward = $activity['friend_reward'];
			}
		}
		elog("referred friend visited referral link", $shop->msd, "Customer");
		return view("loyaltyapp::referred_friend_popup",compact('shop','app_data','friend_reward','customer_id'));
	}

	public function claim_referred_friend_reward($our_passw_token, Request $request)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
		$customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$shop->msd)->where('email', $request->email)->first();
		$referral = \Modules\LoyaltyApp\Models\Referral::where('msd',$shop->msd)->where('email', $request->email)->first();
		elog("$request->email claimed referral reward",$shop->msd,"Customer");
		if($customer)
		{
			elog("$request->email customer already exists, not eligible for referral program",$shop->msd,"Customer");
			return["res" => "0"];
		}
		
		if($referral)
		{
			elog("$request->email have already claimed $request->friend_reward% off",$shop->msd,"Customer");
			return["res" => "1", "coupon_code" => $referral->coupon_code];
		}

		$coupon_details = create_x_percentage_discount_code($shop->msd,$request->friend_reward);		
		$coupon_code = $coupon_details->price_rule->title;
		save_referred_friend_details_in_referrals_table($shop, $request, $coupon_code);
		elog("$request->email claimed referral reward of $request->friend_reward% off with discount code: $coupon_code",$shop->msd,"Customer");
		return["res" => "1", "coupon_code" => $coupon_code];
	}
}

