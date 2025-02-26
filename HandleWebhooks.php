<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class HandleWebhooks extends Controller
{
	// handle webhooks
	public function handle_shopify_webhooks( Request $req )
	{
		$msd  = $req->header('msd');
		$shop = \App\Models\Shop::where("msd", $msd)->first();
		$webhook_event = $req->header('webhook-event');
		$webhook_data  = $req->all();

		elog("shopify webhooks event: $webhook_event", $msd, "webhook", $webhook_data);
		$shopify_webhook = handle_shopify_webhook_action( $shop, $webhook_event, $webhook_data);

		return;
	}
}
