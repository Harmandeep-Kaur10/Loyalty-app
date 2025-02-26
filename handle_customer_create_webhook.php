<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class handle_customer_create_webhook implements ShouldQueue
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

    	$customer = \App\Models\Customer::where('customer_id',$webhook_data['id'])->first();
      	if(!$customer)
     	{
		$customer = save_new_customer_in_db($webhook_data,$shop);
		//empty array is given as argument so that inside function if condition with empty customer data gets satisfied
		$new_activity = set_account_created_activity_in_logs_table($shop, $customer->customer_id, "[]");
		set_points_for_account_created($shop,$customer,$new_activity);
     	}
    }
}
