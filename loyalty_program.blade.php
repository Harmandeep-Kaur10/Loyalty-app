@extends ('shopconnect::shopify_app')

@section ('content')
<style>
::-webkit-scrollbar-corner
{
     	background: rgba(0,0,0,0.5);
}

* {
       	scrollbar-width: thin;
      	scrollbar-color: var(--scroll-bar-color) var(--scroll-bar-bg-color);
}

*::-webkit-scrollbar {
       	width: 12px;
    	height: 12px;
}

*::-webkit-scrollbar-track {
     	background: var(--scroll-bar-bg-color);
}

*::-webkit-scrollbar-thumb {
      	background-color: var(--scroll-bar-color);
    	border-radius: 20px;
      	border: 3px solid var(--scroll-bar-bg-color);
}

.enabled-way:hover
{
       background-color:whitesmoke;
}

</style>

<!--first div -->
<div style="margin-left:11%;margin-right:11%;">
<!-----------------Ways to earn points card----------------->
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);margin-top:0.5rem;height:auto;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
    <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="margin-bottom:0.5rem;">Ways to earn points</h2>
    <div id="no_activities_enabled" class="Polaris-Box" style="--pc-box-border-color:var(--p-color-border);--pc-box-border-style:solid;--pc-box-border-width:var(--p-border-width-025);border-radius:10px;display:@if($shop->enabled_activities == 0) block; @else none; @endif">
    <div style="background:var(--p-color-border-interactive-subdued);height:auto;width:auto">
    <div class="Polaris-Box" style="--pc-box-padding-block-start-xs:var(--p-space-200);text-align:center;">
	<h2 class="Polaris-Text--root Polaris-Text--headingSm" style="margin-top:1rem;">Ways to earn points</h2>
	<p class="Polaris-Text--root Polaris-Text--bodyMd">Set up ways your customers can earn points</p>
	<button id="default_add_way_to_earn" onclick="add_ways_to_earn_popup()" style="margin-top:1rem;margin-bottom:1.5rem;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
  		<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Add way to earn</span>
	</button>
    </div>
    </div>
    </div>

   @foreach($activities as $activity)
   <div class="Polaris-Box enabled-way" id="{{$activity['handle']}}" onclick="startLoading(); window.location.href='{{my_app_env('APP_URL')}}/edit_activity_page/{{$shop->our_passw_token}}/{{$activity['handle']}}';" style="display:@if($activity['state'] == 1) block; @else none; @endif --pc-box-padding-block-start-xs:var(--p-space-200);--pc-box-padding-block-end-xs:var(--p-space-200);cursor:pointer;">
      <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                <div style="display:flex;">
                <div style="margin-left:0.5rem;margin-right:0.5rem;">
                        <svg style="height:17px;margin-top:0.75rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11.5 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/><path d="M11.5 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/><path d="M11.5 15.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/></svg>
                        <svg style="height:17px;margin-top:0.75rem;margin-left:-15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11.5 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/><path d="M11.5 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/><path d="M11.5 15.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/></svg>
                </div>
                <div>
			<h3 class="Polaris-Text--root Polaris-Text--headingSm Polaris-Text--medium">{{$activity['name']}}</h3>
			@if($activity['handle'] == 'refer_a_friend')
			<p class="Polaris-Text--root Polaris-Text--bodyMd">Referrer reward: {{$activity['referrer_reward']}}% off</p>
                        <p class="Polaris-Text--root Polaris-Text--bodyMd">Friend reward: {{$activity['friend_reward']}}% off</p>
			@else
			<p class="Polaris-Text--root Polaris-Text--bodyMd">Points: {{$activity['points']}}@if($activity['handle'] == 'make_a_purchase' && $activity['type'] == 'Percentage')% of order amount @endif</p>
			@endif
                </div>
                </div>
    </div>
    </div>

    @endforeach

<div id="add_way_to_earn_button_outer_div" style="text-align:end;margin-top:1rem;display:@if($shop->enabled_activities < 4 && $shop->enabled_activities > 0)block; @else none; @endif">
<button id="add_way_to_earn" onclick="add_ways_to_earn_popup()" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
  	<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Add way to earn</span>
</button>
</div>

</div>
</div>
<!-------------------Add ways to earn------------------->
<div data-portal-id="popover-:r0:" id="ways_to_earn_points" class="p-theme-light Polaris-ThemeProvider--themeContainer" style="@if($shop->enabled_activities == 0)position: absolute;right: 27.85rem;top: 11.5rem;width: 10rem; @else position: relative;width: 10rem;left: 40.25rem;bottom: 1rem; @endif display:none;">
  <div class="Polaris-PositionedOverlay Polaris-Popover__PopoverOverlay Polaris-Popover__PopoverOverlay--open">
    <div class="Polaris-Popover" data-polaris-overlay="true">
      <div class="Polaris-Popover__FocusTracker" tabindex="0">
      </div>
      <div class="Polaris-Popover__ContentContainer">
        <div id=":Rq6:" tabindex="-1" class="Polaris-Popover__Content" style="height: auto;">
          <div class="Polaris-Popover__Pane Polaris-Popover__Pane--fixed">
            <div class="Polaris-Popover__Section">
              <div class="Polaris-Box" style="--pc-box-padding-block-start-xs: var(--p-space-200); --pc-box-padding-block-end-xs: var(--p-space-150); --pc-box-padding-inline-start-xs: var(--p-space-300); --pc-box-padding-inline-end-xs: var(--p-space-300);">
                <p style="cursor:default;">Choose way to earn</p>
              </div>
            </div>
          </div>
          <div class="Polaris-Popover__Pane Polaris-Scrollable Polaris-Scrollable--vertical Polaris-Scrollable--horizontal Polaris-Scrollable--scrollbarWidthThin" data-polaris-scrollable="true">
            <div class="Polaris-Box">
              <div class="Polaris-Box" tabindex="-1" style="--pc-box-padding-block-start-xs: var(--p-space-150); --pc-box-padding-block-end-xs: var(--p-space-150); --pc-box-padding-inline-start-xs: var(--p-space-150); --pc-box-padding-inline-end-xs: var(--p-space-150);">
                <ul class="Polaris-BlockStack Polaris-BlockStack--listReset" role="menu" style="--pc-block-stack-order: column; --pc-block-stack-gap-xs: var(--p-space-050);">
                @foreach($activities as $activity)
                @if($activity['state'] == 0)
                  <li class="Polaris-Box" role="presentation">
                    <div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: nowrap; --pc-inline-stack-flex-direction-xs: row;">
                      <button type="button" onclick="enable_activity('{{$activity['handle']}}')" class="Polaris-ActionList__Item Polaris-ActionList--default" role="menuitem">
                        <div class="Polaris-Box" style="--pc-box-width: 100%;">
                          <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: nowrap; --pc-inline-stack-gap-xs: var(--p-space-150); --pc-inline-stack-flex-direction-xs: row;">
                            <span class="Polaris-ActionList__Text">
                              <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--regular">
                                <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--regular">
                                        {{$activity['name']}}
                                </span>
                              </span>
                            </span>
                         </div>
                        </div>
                      </button>
                    </div>
                  </li>
                @endif
                @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="Polaris-Popover__FocusTracker" tabindex="0">
      </div>
    </div>
  </div>
</div>

<!-----------------Ways to redeem points card----------------->
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);margin-top:0.5rem;height:auto;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
    <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="margin-bottom:0.5rem;">Ways to redeem points</h2>
    <div id="no_rewards_enabled" class="Polaris-Box" style="--pc-box-border-color:var(--p-color-border);--pc-box-border-style:solid;--pc-box-border-width:var(--p-border-width-025);border-radius:10px;display:@if($shop->enabled_rewards == 0) block; @else none; @endif">
    <div style="background:var(--p-color-border-interactive-subdued);height:auto;width:auto">
    <div class="Polaris-Box" style="--pc-box-padding-block-start-xs:var(--p-space-200);text-align:center;">
	<h2 class="Polaris-Text--root Polaris-Text--headingSm" style="margin-top:1rem;">Ways to redeem points</h2>
	<p class="Polaris-Text--root Polaris-Text--bodyMd">Set rewards your customers can redeem for points</p>
	<button id="default_add_way_to_redeem" onclick="add_ways_to_redeem_popup()" style="margin-top:1rem;margin-bottom:1.5rem;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
  		<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Add way to redeem</span>
	</button>
    </div>
    </div>
    </div>

   @foreach($rewards as $reward)
    <div class="Polaris-Box enabled-way" id="{{$reward['handle']}}" onclick="startLoading(); window.location.href='{{my_app_env('APP_URL')}}/edit_reward_page/{{$shop->our_passw_token}}/{{$reward['handle']}}';" style="display:@if($reward['state'] == 1) block; @else none; @endif --pc-box-padding-block-start-xs:var(--p-space-200);--pc-box-padding-block-end-xs:var(--p-space-200);cursor:pointer;">
      <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
        <div style="display:flex;justify-content:space-between;">
                <div style="display:flex;">
                <div style="margin-left:0.5rem;margin-right:0.5rem;">
                        <svg style="height:17px;margin-top:0.75rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11.5 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/><path d="M11.5 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/><path d="M11.5 15.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/></svg>
                        <svg style="height:17px;margin-top:0.75rem;margin-left:-15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11.5 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/><path d="M11.5 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/><path d="M11.5 15.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/></svg>
                </div>
                <div>
                        <h3 class="Polaris-Text--root Polaris-Text--headingSm Polaris-Text--medium">{{$reward['name']}}</h3>
                        <p class="Polaris-Text--root Polaris-Text--bodyMd">@if($reward['handle']=='convert_points_to_store_credit'){{ str_replace("amount",$reward['amount'],"$shop->currency_format") }} for {{$reward['points']}} points @else Points: {{$reward['cost']}} @endif</p>
                </div>
                </div>
      </div>
    </div>
    </div>
    @endforeach

<div id="add_way_button_outer_div" style="text-align:end;margin-top:1rem;display:@if($shop->enabled_rewards < 4 && $shop->enabled_rewards > 0)block; @else none; @endif">
<button id="add_way_to_redeem" onclick="add_ways_to_redeem_popup()" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
  	<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Add way to redeem</span>
</button>
</div>

  </div>
</div>

<!-------------------Add ways to redeem------------------->
<div id="ways_to_redeem_points" data-portal-id="popover-:r0:" class="p-theme-light Polaris-ThemeProvider--themeContainer" style="position: relative;width: 13rem;@if($shop->enabled_rewards == 0)left:18.5rem;bottom:16.5rem; @else left: 38rem;bottom:1rem; @endif display:none;">
  <div class="Polaris-PositionedOverlay Polaris-Popover__PopoverOverlay Polaris-Popover__PopoverOverlay--open">
    <div class="Polaris-Popover" data-polaris-overlay="true">
      <div class="Polaris-Popover__FocusTracker" tabindex="0">
      </div>
      <div class="Polaris-Popover__ContentContainer">
        <div id=":Rq6:" tabindex="-1" class="Polaris-Popover__Content" style="height: auto;">
          <div class="Polaris-Popover__Pane Polaris-Popover__Pane--fixed">
            <div class="Polaris-Popover__Section">
              <div class="Polaris-Box" style="--pc-box-padding-block-start-xs: var(--p-space-200); --pc-box-padding-block-end-xs: var(--p-space-150); --pc-box-padding-inline-start-xs: var(--p-space-300); --pc-box-padding-inline-end-xs: var(--p-space-300);">
                <p style="cursor:default;">Choose way to redeem</p>
              </div>
            </div>
          </div>
          <div class="Polaris-Popover__Pane Polaris-Scrollable Polaris-Scrollable--vertical Polaris-Scrollable--horizontal Polaris-Scrollable--scrollbarWidthThin" data-polaris-scrollable="true">
            <div class="Polaris-Box">
              <div class="Polaris-Box" tabindex="-1" style="--pc-box-padding-block-start-xs: var(--p-space-150); --pc-box-padding-block-end-xs: var(--p-space-150); --pc-box-padding-inline-start-xs: var(--p-space-150); --pc-box-padding-inline-end-xs: var(--p-space-150);">
                <ul class="Polaris-BlockStack Polaris-BlockStack--listReset" role="menu" style="--pc-block-stack-order: column; --pc-block-stack-gap-xs: var(--p-space-050);">
                @foreach($rewards as $reward)
                @if($reward['state'] == 0)
                  <li class="Polaris-Box" role="presentation">
                    <div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: nowrap; --pc-inline-stack-flex-direction-xs: row;">
                      <button type="button" onclick="enable_reward('{{$reward['handle']}}')" class="Polaris-ActionList__Item Polaris-ActionList--default" role="menuitem">
                        <div class="Polaris-Box" style="--pc-box-width: 100%;">
                          <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: nowrap; --pc-inline-stack-gap-xs: var(--p-space-150); --pc-inline-stack-flex-direction-xs: row;">
                            <span class="Polaris-ActionList__Text">
                              <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--regular">
                                <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--regular">
                                        {{$reward['name']}}
                                </span>
                              </span>
                            </span>
                         </div>
                        </div>
                      </button>
                    </div>
                  </li>
                @endif
                @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="Polaris-Popover__FocusTracker" tabindex="0">
      </div>
    </div>
  </div>
</div>

</div>

<!-------------------JAVASCRIPT------------------->
<script>
stopLoading();
function getRequest(url) {
	return fetch(url, {
	method: 'GET',
});
}

let add_ways_to_earn_button = document.getElementById('add_way_to_earn');
let default_add_ways_to_earn_button = document.getElementById('default_add_way_to_earn');
let popover_for_earn_points = document.getElementById('ways_to_earn_points');

function add_ways_to_earn_popup()
{
	if(popover_for_earn_points.style.display == "block")
	{
		popover_for_earn_points.style.display = "none";
	}
	else
	{
		popover_for_earn_points.style.display = "block";
	}
}

document.addEventListener('click', (event) => {
if(add_ways_to_earn_button && !default_add_ways_to_earn_button.contains(event.target) && !add_ways_to_earn_button.contains(event.target) && !popover_for_earn_points.contains(event.target)) {
	popover_for_earn_points.style.display = 'none';
}
});

function enable_activity(activity_name)
{
	startLoading();
	url = "{{my_app_env('APP_URL')}}/enable_or_disable_activity/{{$shop->our_passw_token}}/"+activity_name+"?status=on";
	getRequest(url).then(response => {
	if (response.ok) {
		window.location.href='{{my_app_env('APP_URL')}}/edit_activity_page/{{$shop->our_passw_token}}/'+activity_name;
	}
	});
}

let add_ways_to_redeem_button = document.getElementById('add_way_to_redeem');
let default_add_ways_to_redeem_button = document.getElementById('default_add_way_to_redeem');
let popover_for_redeem_points = document.getElementById('ways_to_redeem_points');

function add_ways_to_redeem_popup()
{
	if(popover_for_redeem_points.style.display == "block")
	{
		popover_for_redeem_points.style.display = "none";
	}
	else
	{
		popover_for_redeem_points.style.display = "block";
	}
}

document.addEventListener('click', (event) => {
if(add_ways_to_redeem_button && !default_add_ways_to_redeem_button.contains(event.target) && !add_ways_to_redeem_button.contains(event.target) && !popover_for_redeem_points.contains(event.target)) {
	popover_for_redeem_points.style.display = 'none';
}
});

function enable_reward(reward_name)
{
	startLoading();
	url = "{{my_app_env('APP_URL')}}/enable_or_disable_reward/{{$shop->our_passw_token}}?reward_name="+reward_name+"&&status=on";
	getRequest(url).then(response => {
	if (response.ok) {
		window.location.href='{{my_app_env('APP_URL')}}/edit_reward_page/{{$shop->our_passw_token}}/'+reward_name;
	}
	});
}


</script>
@endsection

