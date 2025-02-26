<?php

namespace Modules\LoyaltyApp\Http\Controllers;

use Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppController extends Controller
{
    public function handle_shop($our_passw_token)
    {
	    	$shop = get_shop_by_passw_token($our_passw_token);
		$app_data = json_decode($shop->app_data);
		if(empty($app_data))
		{
			save_default_app_data( $shop );
			elog("default app data saved",$shop->msd,"Merchant",$shop->app_data);
		}
                $app_data = json_decode($shop->app_data,true);
                $step_number = get_pending_onboarding_step($app_data['onboarding_step']);
                if($step_number)
		{
			$shop->rewards = $app_data['rewards'];
                	$shop->enabled_rewards = count_enabled_rewards($shop->rewards);
                	$shop->calculated_store_credit = calculate_store_credit($shop->rewards,'10');
                	$shop->activities = $app_data['activities'];
                	$shop->enabled_activities = count_enabled_activities($shop->activities);

                        elog("visited onboarding step$step_number", $shop->msd, "Merchant");
                       	return view('loyaltyapp::onboarding_steps.step'.$step_number,compact("shop"));
                }
                return redirect("/home/$our_passw_token");
    }
}

