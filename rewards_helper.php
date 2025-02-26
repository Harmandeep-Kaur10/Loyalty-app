<?php

function set_default_costs()
{
	$array = [];
	$free_shipping_reward = array("handle"=>"free_shipping", "name"=>"Free Shipping", "cost"=>"10", "state"=>"0");
        array_push($array, $free_shipping_reward);

        $percentage_off_reward = array("handle"=>"percentage_off", "name"=>"Percentage off", "percent"=>"20% off", "cost"=>"50", "state"=>"1");
        array_push($array, $percentage_off_reward);

        $amount_off_reward = array("handle"=>"amount_off", "name"=>"Amount off", "amount"=>"100", "cost"=>"20", "state"=>"0");
        array_push($array, $amount_off_reward);

	$convert_points_to_store_credit_reward = array("handle"=>"convert_points_to_store_credit", "name"=>"Convert points to store credit", "points"=>"100", "amount"=>"10", "state"=>"0");
        array_push($array, $convert_points_to_store_credit_reward);

	return $array;
}

/*function get_percent_off_reward_name($rewards)
{
        foreach($rewards as $reward)
        {
                if($reward['handle'] == 'percentage_off')
                {
                        $percent_off_reward = $reward['name'];
                }
        }
        return $percent_off_reward;
}

function get_amount_off_reward_name($rewards)
{
        foreach($rewards as $reward)
        {
                if($reward['handle'] == 'amount_off')
                {
                        $amount_off_reward = $reward['amount'];
                }
        }
        return $amount_off_reward;
}*/

function count_enabled_rewards($rewards)
{
        $enabled_rewards = 0;
        foreach($rewards as $reward)
        {
                if($reward['state'] == 1)
                {
                        $enabled_rewards += 1;
                }
        }
        return $enabled_rewards;
}

function update_reward_state($shop, $request)
{
        $updated_rewards = [];
	$app_data = json_decode($shop->app_data,true);

        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == $request->reward_name)
                {
                        if($request->status == "on")
                        {
				$reward['state'] = "1";
                        }
			else
                        {
				$reward['state'] = "0";
			}
                }
                $updated_rewards[] = $reward;
	}
        return $updated_rewards;
}

/*function update_costs($shop, $request)
*{
*       $updated_rewards = [];
*	$app_data = json_decode($shop->app_data,true);
*
*       foreach($app_data['rewards'] as $reward)
*       {
*                if($reward['name'] == $request->reward_name)
*                {
*                        if(str_contains($request->reward_name,'%'))
*                        {
*                                $reward['name'] = $request->off_value."% off";
*				elog("updated $request->reward_name reward to $reward[name]", $shop->msd, "Merchant");
*                        }
*                        if(ctype_digit($request->reward_name))
*                        {
*				$reward['name'] = $request->off_value;
*				$reward_name = str_replace("amount","$request->reward_name","$shop->currency_format");
*				$updated_reward_name = str_replace("amount",$reward['name'],"$shop->currency_format");
*				elog("updated $reward_name off reward to $updated_reward_name off", $shop->msd, "Merchant");
*                        }
*                        $reward['cost'] = $request->reward_cost;
*                }
*                $updated_rewards[] = $reward;
*	}
*	$app_data['rewards'] = $updated_rewards;
*     	$shop->app_data = json_encode($app_data);
*       $shop->save();
}*/

function update_percentage_reward_amount_and_cost($shop,$request)
{
	$updated_rewards = [];
        $app_data = json_decode($shop->app_data,true);

        foreach($app_data['rewards'] as $reward)
        {
          	if($reward['handle'] == 'percentage_off')
             	{
                    	$reward['percent'] = $request->off_value."% off";
             		$reward['cost'] = $request->reward_cost;
            	}
                $updated_rewards[] = $reward;
        }
        $app_data['rewards'] = $updated_rewards;
        $shop->app_data = json_encode($app_data);
        $shop->save();
}

function update_amount_off_reward_cost_and_amount($shop,$request)
{
	$updated_rewards = [];
        $app_data = json_decode($shop->app_data,true);

        foreach($app_data['rewards'] as $reward)
        {
           	if($reward['handle'] == 'amount_off')
           	{
                 	$reward['amount'] = $request->off_value;
           		$reward['cost'] = $request->reward_cost;
            	}
                $updated_rewards[] = $reward;
        }
        $app_data['rewards'] = $updated_rewards;
        $shop->app_data = json_encode($app_data);
        $shop->save();
}

function update_free_shipping_cost($shop,$request)
{
	$updated_rewards = [];
        $app_data = json_decode($shop->app_data,true);

        foreach($app_data['rewards'] as $reward)
	{
		if($reward['handle'] == 'free_shipping')
		{
                        $reward['cost'] = $request->reward_cost;
                }
                $updated_rewards[] = $reward;
        }
        $app_data['rewards'] = $updated_rewards;
        $shop->app_data = json_encode($app_data);
	$shop->save();
}

function update_store_credit_reward($shop,$request)
{
	$app_data = json_decode($shop->app_data,true);

     	$updated_rewards = [];
      	foreach($app_data['rewards'] as $reward)
      	{
    		if($reward['handle'] == "convert_points_to_store_credit")
           	{
                 	//$reward['points'] = $request->off_value;
			//$reward['amount'] = $request->reward_cost;
			$reward['points'] = $request->reward_cost;
			$reward['amount'] = $request->off_value;
      		}
              	$updated_rewards[] = $reward;
     	}
      	$app_data['rewards'] = $updated_rewards;
  	$shop->app_data = json_encode($app_data);
      	$shop->save();
}

function update_reward_name($shop, $request)
{
	$updated_rewards = [];
        $app_data = json_decode($shop->app_data,true);

        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == $request->reward_name)
                {
                        $reward['name'] = $request->updated_reward_name;
                }
                $updated_rewards[] = $reward;
        }
        $app_data['rewards'] = $updated_rewards;
        $shop->app_data = json_encode($app_data);
        $shop->save();
}

function get_free_shipping_reward_cost($shop)
{
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == "free_shipping")
                {
                        $free_shipping_reward_cost = $reward['cost'];
                }
        }
        return $free_shipping_reward_cost;
}

function get_percent_off_reward_cost($shop)
{
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle'] == 'percentage_off')
                {
                        $percent_off_reward_cost = $reward['cost'];
                }
        }
        return $percent_off_reward_cost;
}

function get_amount_off_reward_cost($shop)
{
	$app_data = json_decode($shop->app_data,true);
        foreach($app_data['rewards'] as $reward)
        {
                if($reward['handle']== 'amount_off')
                {
                        $amount_off_reward_cost = $reward['cost'];
                }
        }
        return $amount_off_reward_cost;
}

