<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class handle_order_create_webhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $webhook_data;
	protected $shop;
	
	public function __construct($webhook_data,$shop)
    	{
	    	$this->webhook_data = $webhook_data;
	    	$this->shop = $shop;
    	}

    	public function handle()
    	{
        	$webhook_data = $this->webhook_data;
		$shop = $this->shop;

		$customer = \App\Models\Customer::where('customer_id', $webhook_data['customer']['id'])->first();
		if( ! $customer ){
			return;
		}

                $new_activity = new \App\Models\ActivityLog;
                $new_activity->shop_id = $shop->shop_id;
                $new_activity->msd = $shop->msd;
                $new_activity->customer_id = $webhook_data['customer']['id'] ;
                $new_activity->activity_type = "purchase";
                $new_activity->activity_data = "[]";
                $new_activity->save();

		$order_details = get_orderId_number_date_revenue_and_reward_percentage_entry($webhook_data,$new_activity);	
		elog("order_id,number,date,revenue and reward_percentage if reward applied",$shop->msd,"webhook",$order_details);

                $purchase_activity_state = set_points_for_purchase_and_get_purchase_activity_state_entry($shop,$new_activity,$customer);
		elog("purchase activity state entry",$shop->msd,"webhook",$purchase_activity_state);

		$array = array_merge($order_details,$purchase_activity_state);
		$new_array = [];

		$result = check_if_discount_coupon_applied_or_not($shop->msd,$webhook_data);
                if($result == 1)
                {
			$reward_name_and_code = get_reward_name_and_code_entry($shop,$webhook_data);
			elog("reward_name and code entry",$shop->msd,"webhook",$reward_name_and_code);

			$reward_cost = get_reward_cost_entry($webhook_data,$shop);
			elog("reward_cost entry",$shop->msd,"webhook",$reward_cost);
			
			$new_array = array_merge($reward_name_and_code,$reward_cost);
			
			$merged_array = array_merge($array,$new_array);
			$final = json_encode($merged_array);
                	$new_activity->activity_data = $final;
                	$new_activity->save();

			update_customer_activities_rewards_and_revenue($shop->msd,$webhook_data,$customer);
                	set_reward_used_entry_in_activity_logs($shop,$customer);
		}
		if($new_array == [])
		{
			$final = json_encode($array);
        		$new_activity->activity_data = $final;
        		$new_activity->save();
		}
    	}
}
