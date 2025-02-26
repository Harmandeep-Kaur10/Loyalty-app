<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class ShopLink extends Controller
{
	public function save_new_install(Request $req)
	{
		elog("new install","0","0",$req->all());
		$shop = \App\Models\Shop::where("shop_id", $req->shop_id)->first();

		if(! $shop)
		{	
			$shop = new \App\Models\Shop();
		}

		$shop->shop_id     = $req->shop_id;
		$shop->name        = $req->name;
		$shop->msd         = $req->msd;
		$shop->our_passw_token = $req->our_passw_token;
		$shop->state       = $req->state;
		$shop->currency_format = $req->currency_format;
		$shop->owner_name  = $req->owner_name;
		$shop->owner_email = $req->owner_email;
		$shop->timezone    = $req->timezone;
		$shop->iana_timezone = $req->iana_timezone;
		$shop->activities = "[]";
		$shop->rewards = "[]";
		$shop->save();

                $msd = $req->msd;

                set_default_points($msd);
                set_default_costs($msd);

		return response()->json(['status' => "Shop Saved"], 200);
	}
}


//nrj - reviewed
