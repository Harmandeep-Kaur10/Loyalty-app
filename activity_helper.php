<?php

function set_default_points()
{
	$array = [];
        $create_account_activity = array("handle"=>"create_an_account", "name"=>"Create an account", "points"=>"10", "state"=>"0", "description"=>"When a customer creates an account on your store.");
        array_push($array, $create_account_activity);

	$purchase_activity = array("handle"=>"make_a_purchase", "name"=>"Make a purchase", "type"=>"Fixed", "points"=>"50", "state"=>"1", "description"=>"When a customer purchases a product from your store.");
        array_push($array, $purchase_activity);

        $visit_activity = array("handle"=>"visit", "name"=>"Visit", "points"=>"1", "state"=>"0", "description"=>"When a customer visits your store, these points will be given once in a day.");
        array_push($array, $visit_activity);

	$refer_friend = array("handle"=>"refer_a_friend", "name"=>"Refer a friend","referrer_reward"=>"10","friend_reward"=>"10","state"=>"0","description"=>"When a customer refers a friend through referral link, both referrer and friend will get discount coupon. The referrer will get that coupon after his friend places an order. You can adjust the percentage of discount coupon after enabling.");
	array_push($array,$refer_friend);

	return $array;
}

function count_enabled_activities($activities)
{
        $enabled_activities = 0;
        foreach($activities as $activity)
        {
                if($activity['state'] == 1)
                {
                        $enabled_activities += 1;
                }
        }
        return $enabled_activities;
}

function get_activity_points($shop, $activity_name)
{
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['activities'] as $activity)
        {
                if($activity['handle'] == $activity_name)
                {
                        $activity_points = $activity['points'];
                }
        }
        return $activity_points;
}

function get_activity_state($shop,$activity_name)
{
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['activities'] as $activity)
        {
                if($activity['handle'] == $activity_name)
                {
                        $activity_state = $activity['state'];
                }
        }
        return $activity_state;
}

function update_activity_state($shop, $activity_name, $request)
{
        $updated_activities = [];
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['activities'] as $activity)
        {
                if($activity['handle'] == $activity_name)
                {
                        if($request->status == "on")
                        {
				$activity['state'] = "1";
                        }
			else
                        {
				$activity['state'] = "0";
			}
		}
                $updated_activities[] = $activity;
	}
        return $updated_activities;
}

function update_purchase_activity_points_and_type($shop, $request)
{
	$app_data = json_decode($shop->app_data,true);
        $updated_activities = [];

        foreach($app_data['activities'] as $activity)
        {
                if($activity['handle'] == 'make_a_purchase')
                {
                        $activity['type'] = $request->purchase_reward_type;
                      	$activity['points'] = $request->purchase_reward;
                }
                $updated_activities[] = $activity;
        }
        $app_data['activities'] = $updated_activities;
        $shop->app_data = json_encode($app_data);
        $shop->save();
}

function update_points($shop, $activity_name, $request)
{
	$app_data = json_decode($shop->app_data,true);
        $updated_activities = [];

        foreach($app_data['activities'] as $activity)
        {
                if($activity['handle'] == $activity_name)
		{
			$activity['points'] = $request->activity_points;
                }
                $updated_activities[] = $activity;
        }
	$app_data['activities'] = $updated_activities;
	$shop->app_data = json_encode($app_data);
       	$shop->save();
}

function update_refer_friend_activity($shop, $request)
{
	$app_data = json_decode($shop->app_data,true);

	$updated_activities = [];
	foreach($app_data['activities'] as $activity)
	{
		if($activity['handle'] == "refer_a_friend")
		{
			$activity['referrer_reward'] = $request->referrer_reward;
			$activity['friend_reward'] = $request->friend_reward;
		}
		$updated_activities[] = $activity;
	}
	$app_data['activities'] = $updated_activities;
	$shop->app_data = json_encode($app_data);
	$shop->save();
}

function update_activity_name($shop, $activity_name, $request)
{
	$app_data = json_decode($shop->app_data,true);
        $updated_activities = [];

        foreach($app_data['activities'] as $activity)
        {
                if($activity['handle'] == $activity_name)
                {
                        $activity['name'] = $request->activity_name;
                }
                $updated_activities[] = $activity;
        }
        $app_data['activities'] = $updated_activities;
        $shop->app_data = json_encode($app_data);
        $shop->save();
}

