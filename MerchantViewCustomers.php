<?php

namespace Modules\LoyaltyApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MerchantViewCustomers extends Controller
{
	public function get_customers_table_view( $our_passw_token)
        {
                $shop = get_shop_by_passw_token($our_passw_token);
                $customers = \Modules\LoyaltyApp\Models\Customer::where('msd', $shop->msd)->paginate(15);
                elog("visited customers table view", $shop->msd, "Merchant");
                return view("loyaltyapp::customers_table", compact('customers', 'shop'));
        }

        public function get_customer_history_view($our_passw_token ,Request $request)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
                elog("visited customer history view of customer id: $request->customer_id", $shop->msd, "Merchant");

		$customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$shop->msd)->where('customer_id', $request->customer_id)->first();
		$store_credit_info = json_decode($customer->store_credit_info,true);
		$activity_logs = \Modules\LoyaltyApp\Models\ActivityLog::where('msd',$shop->msd)->where('customer_id',$request->customer_id)->orderBy('id','desc');
		$latest_visit = $activity_logs->first()->created_at;
		$activity_logs = $activity_logs->paginate(50);

                $amount = str_replace("amount",number_format($customer->revenue, 2),$shop->currency_format);

                return view("loyaltyapp::customer_details",compact('shop', 'amount', 'customer','activity_logs','latest_visit','store_credit_info'));
	}

	public function update_customer_points($our_passw_token, $customer_id, Request $request)
	{
		$shop = get_shop_by_passw_token($our_passw_token);
		$customer = \Modules\LoyaltyApp\Models\Customer::where('msd',$shop->msd)->where('customer_id',$customer_id)->first();

		if($request->adjustment_type == "Credit")
		{
			$customer->points += $request->amount;
		}
		if($request->adjustment_type == "Debit")
		{
			$customer->points -= $request->amount;
		}
                $customer->save();	
		save_manually_adjusted_points_entry_in_logs_table($shop, $customer_id, $request);
		elog("done $request->adjustment_type of $request->amount points",$shop->msd,"Merchant",$customer);

		return redirect("/customer_history/$our_passw_token/?customer_id=$customer_id");
	}
}

