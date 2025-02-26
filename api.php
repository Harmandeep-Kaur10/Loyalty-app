<?php

use Illuminate\Support\Facades\Route;
use Modules\LoyaltyApp\Http\Controllers\LoyaltyAppController;
use Modules\LoyaltyApp\Http\Controllers\CustomerView;
use Modules\LoyaltyApp\Http\Controllers\MerchantAppSetup;
use Modules\LoyaltyApp\Http\Controllers\MerchantViewCustomers;
use Modules\LoyaltyApp\Http\Controllers\Onboarding;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('loyaltyapp', LoyaltyAppController::class)->names('loyaltyapp');
});

Route::controller(CustomerView::class)->group(function(){

        Route::get("/save_visit_entry/{our_passw_token}/{cust_id}", "set_visit_entry");

       // Route::get("/compare_points_with_reward_cost/{msd}/{customer_id}/", "compare_points_with_reward_cost");

        Route::post("/save_claimed_reward/{msd}/{customer_id}/", "save_claimed_reward");

	Route::get("/convert_points_to_store_credit/{msd}/{customer_id}", "convert_points_to_store_credit");

	Route::get("/claim_referred_friend_reward/{our_passw_token}/", "claim_referred_friend_reward");
});

Route::controller(MerchantViewCustomers::class)->group(function(){

	Route::post("/save_updated_customer_points/{our_passw_token}/{customer_id}","update_customer_points");
});

Route::controller(MerchantAppSetup::class)->group(function(){

        Route::post("/save_updated_points/{our_passw_token}/{activity_name}", "handle_update_points_request");

	Route::post("/save_updated_costs/{our_passw_token}", "handle_update_costs_request");

        Route::post("/store_customization/{our_passw_token}/", "save_customization");
	
	Route::post("/save_updated_store_credit_reward/{our_passw_token}/", "save_updated_store_credit_reward");

	Route::post("/save_updated_refer_friend_activity_points/{our_passw_token}/", "save_updated_refer_friend_activity_rewards");
});

Route::controller(Onboarding::class)->group(function(){

	Route::post('/save_onboarding_step_details/{msd}/{step_number}', 'save_onboarding_step_details');

	Route::post('/notify_on_telegram/{our_passw_token}/{message}/{step_number}', 'send_message_on_telegram');
});

