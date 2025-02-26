@extends ('shopconnect::onboarding_layout')

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
</style>

<form id="onboarding_form" action="" method="POST">
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);height:8.25rem;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
    <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
      <h1 class="Polaris-Text--root Polaris-Text--headingSm">Get started with Loyalty Program</h1>
      <div style="width:100%;">
        <div class="Polaris-ProgressBar Polaris-ProgressBar--sizeSmall Polaris-ProgressBar--toneHighlight">
         <progress id="progress_bar" class="Polaris-ProgressBar__Progress" value="16" max="100">
         </progress>
         <div id="progress_bar_percent" class="Polaris-ProgressBar__Indicator Polaris-ProgressBar__IndicatorAppearActive" style="--pc-progress-bar-duration:500ms;--pc-progress-bar-percent:0.16">
         </div>
        </div>
      </div>
      <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
       <h2 class="Polaris-Text--root Polaris-Text--bodyMd">1/6 Steps: Setup how customers can earn points</h2>
      </div>
      <div class="Polaris-InlineStack" style="--pc-inline-stack-align:end;--pc-inline-stack-wrap:wrap;--pc-inline-stack-flex-direction-xs:row">
        <div class="Polaris-ButtonGroup">
          <div class="Polaris-ButtonGroup__Item">
            <button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconWithText" aria-label="Create shipping label" type="button" style="width:4rem;" onclick="move_to_next_step()">
              <span id="next_button_text" class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Next</span>
              <span id="spinner" class="Polaris-Spinner Polaris-Spinner--sizeSmall" style="display:none;">
                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" style="height:1rem;"><path d="M7.229 1.173a9.25 9.25 0 1011.655 11.412 1.25 1.25 0 10-2.4-.698 6.75 6.75 0 11-8.506-8.329 1.25 1.25 0 10-.75-2.385z"></path></svg>
              </span>
              <span role="status">
                <span class="Polaris-Text--root Polaris-Text--visuallyHidden">Small spinner example</span>
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-----------------------Set up for earning points-------------------->
<div id="ways_to_earn_points" data-portal-id="popover-:r0:" class="p-theme-light Polaris-ThemeProvider--themeContainer" style="display:none;">
        <div class="Polaris-PositionedOverlay Polaris-Popover__PopoverOverlay Polaris-Popover__PopoverOverlay--open" style="right:1.25rem;top:13rem;">
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
                                  <div class="Polaris-Box" tabindex="-1" style="padding-top:0;--pc-box-padding-block-start-xs: var(--p-space-150); --pc-box-padding-block-end-xs: var(--p-space-150); --pc-box-padding-inline-start-xs: var(--p-space-150); --pc-box-padding-inline-end-xs: var(--p-space-150);">
                                        <ul class="Polaris-BlockStack Polaris-BlockStack--listReset" role="menu" style="--pc-block-stack-order: column; --pc-block-stack-gap-xs: var(--p-space-050);">
                @foreach($shop->activities as $activity)
                  @if($activity['state'] == 0)
                  <li id="{{$activity['handle']}}_popup" class="Polaris-Box" role="presentation">
                    <div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: nowrap; --pc-inline-stack-flex-direction-xs: row;">
                      <button type="button" onclick="enable_activity('{{$activity['handle']}}')" class="Polaris-ActionList__Item Polaris-ActionList--default" role="menuitem">
                        <div class="Polaris-Box" style="--pc-box-width: 100%;">
                          <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: nowrap; --pc-inline-stack-gap-xs: var(--p-space-150); --pc-inline-stack-flex-direction-xs: row;">
                            <span class="Polaris-ActionList__Text">
                              <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--regular">
                                <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--regular">{{$activity['name']}}</span>
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
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);margin-top:1rem;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400);">
    <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
        <div style="display:flex;justify-content:space-between;">
          <div><h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">Set how your customers can earn points </h2><h2 class="Polaris-Text--root Polaris-Text--bodyMd" style="display:inline-block;margin-left:0.5rem;">(You can change this later)</h2></div>
          @if($shop->enabled_activities < 4)
<div>
                <button id="add_ways_to_earn_points" onclick="add_ways_to_earn_popup()" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPlain Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
                        <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--regular">+ Add way to earn</span>
                </button>
</div>
@endif
</div>
        @foreach($shop->activities as $activity)
                @if($activity['handle'] == 'create_an_account')
                <div id="{{$activity['handle']}}" style="display:@if($activity['state'] == 1) block; @else none; @endif">
                <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                        <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">{{$activity['name']}}</h2>
                        <span>The customer will receive specified points on creating account.</span>
                        <input id="create_an_account_hidden_input" type="hidden" name="create_an_account" value="@if($activity['state'] == 1) enabled @else disabled @endif">
                        <div>
                                <div class="Polaris-Labelled__LabelWrapper">
                                        <label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text"><strong>Points</strong></label>
                                </div>
                                <div class="Polaris-Connected" style="width:49%;">
                                        <div class="Polaris-TextField Polaris-TextField--hasValue" style="width:100%;">
                                                <input name="create_account_activity_points" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":Rq6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" min="1" value="{{$activity['points']}}" required>
                                                <div class="Polaris-TextField__Backdrop">
                                                </div>
                                        </div>
                                </div>
                        </div>
		</div>
		<hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border);margin-top:1rem;">
                </div>
                @elseif($activity['handle'] == 'visit')
		<div id="{{$activity['handle']}}" style="display:@if($activity['state'] == 1) block; @else none; @endif">
		<hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border);margin-top:0.5rem;margin-bottom:0.5rem;">
                <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                        <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">{{$activity['name']}}</h2>
                        <span>{{$activity['description']}}</span>
                        <input id="visit_hidden_input" type="hidden" name="visit" value="@if($activity['state'] == 1) enabled @else disabled @endif">
                        <div>
                                <div class="Polaris-Labelled__LabelWrapper">
                                        <label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text"><strong>Points</strong></label>
                                </div>
                                <div class="Polaris-Connected" style="width:49%;">
                                 <div class="Polaris-TextField Polaris-TextField--hasValue" style="width:100%;">
                                <input name="visit_activity_points" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":Rq6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" min="1" value="{{$activity['points']}}" required>
                                <div class="Polaris-TextField__Backdrop">
                                </div>
                        </div>
                </div>
                </div>
                </div>
                </div>
                @elseif($activity['handle'] == 'make_a_purchase')
                <div id="{{$activity['handle']}}" style="display:@if($activity['state'] == 1) block; @else none; @endif">
                <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                        <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">{{$activity['name']}}</h2>
                        <span id="description">@if($activity['type'] == 'Fixed')The customer will receive specified points on placing order.@else The customer will receive points equal to the specified percentage of the total order amount on placing order. @endif</span>
                <input id="make_a_purchase_hidden_input" type="hidden" name="make_a_purchase" value="@if($activity['state'] == 1) enabled @else disabled @endif">
                            <div class="Polaris-InlineGrid" style="display:flex;justify-content:space-between;">
                                <div class="Polaris-BlockStack" style="width:49%;">
                                  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                                    <div class="">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                          <div class="Polaris-Label">
                                                <label id=":R2q6:Label" class="Polaris-Label__Text"><strong>Type</strong></label>
                                          </div>
                                        </div>
                                        <div class="Polaris-Select">
                                        <select id="reward_type" name="purchase_reward_type" onchange="change_purchase_activity_reward_type()" class="Polaris-Select__Input" aria-invalid="false">
                                                @if($activity['type'] == 'Fixed')
                                                <option value="Fixed" selected="">Fixed</option>
                                                <option value="Percentage">Percentage</option>
                                                @else
                                                <option value="Fixed">Fixed</option>
                                                <option value="Percentage" selected="">Percentage</option>
                                                @endif
                                        </select>
                                        <div class="Polaris-Select__Content" aria-hidden="true">
                                                <span id="display_reward_type" class="Polaris-Select__SelectedOption">@if($activity['type'] == 'Fixed')Fixed @else Percentage @endif</span>
                                                <span class="Polaris-Select__Icon">
                                                        <span class="Polaris-Icon">
                                                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"><path d="M10.884 4.323a1.25 1.25 0 0 0-1.768 0l-2.646 2.647a.75.75 0 0 0 1.06 1.06l2.47-2.47 2.47 2.47a.75.75 0 1 0 1.06-1.06l-2.646-2.647Z"></path><path d="m13.53 13.03-2.646 2.647a1.25 1.25 0 0 1-1.768 0l-2.646-2.647a.75.75 0 0 1 1.06-1.06l2.47 2.47 2.47-2.47a.75.75 0 0 1 1.06 1.06Z"></path></svg>
                                                        </span>
                                                </span>
                                        </div>
                                        <div class="Polaris-Select__Backdrop">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                               </div>
                               <div class="" style="width:49%;">
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label">
                                        <label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text">
                                                <span class="Polaris-Text--root Polaris-Text--bodyMd"><strong>Points</strong></span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <input name="purchase_reward" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$activity['points']}}" required>
                                                <div class="Polaris-TextField__Suffix" id="percentage_suffix" style="@if($activity['type'] == 'Fixed') display:none; @else display:block; @endif">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">%</span>
                                                </div>
                                                <div class="Polaris-TextField__Backdrop">
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                        </div>
                        @else
			<div id="{{$activity['handle']}}" style="display:@if($activity['state'] == 1) block; @else none; @endif">
			<hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border);margin-top:0.5rem;margin-bottom:0.5rem;">
                        <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                                <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">{{$activity['name']}}</h2>
                                <span>When a customer refers a friend through referral link, both referrer and friend will get discount coupon. The referrer will get that coupon after his friend places an order.</span>
                        <input id="refer_a_friend_hidden_input" type="hidden" name="refer_a_friend" value="@if($activity['state'] == 1) enabled @else disabled @endif">
                        <div class="Polaris-InlineGrid" style="display:flex;justify-content:space-between;">
                                <div class="Polaris-BlockStack" style="width:49%;">
                                  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                                    <div class="">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                          <div class="Polaris-Label">
                                                <label id=":R2q6:Label" class="Polaris-Label__Text"><strong>Reward for referrer</strong></label>
                                          </div>
                                        </div>
                                        <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <input name="referrer_reward" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$activity['referrer_reward']}}" required>
                                                <div class="Polaris-TextField__Suffix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">%</span>
                                                </div>
                                                <div class="Polaris-TextField__Backdrop">
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                    </div>
                                  </div>
                               </div>
                               <div class="" style="width:49%;">
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label">
                                        <label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text">
                                                <span class="Polaris-Text--root Polaris-Text--bodyMd"><strong>Reward for friend</strong></span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <input name="friend_reward" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$activity['friend_reward']}}" required>
                                                <div class="Polaris-TextField__Suffix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">%</span>
                                                </div>
                                                <div class="Polaris-TextField__Backdrop">
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                        </div>
                @endif
        @endforeach
    </div>
  </div>
</div>
</form>

<script>
let add_ways_to_earn_button = document.getElementById('add_ways_to_earn_points');
let popover_for_earn_points = document.getElementById('ways_to_earn_points');

document.addEventListener('click', (event) => {
  if (add_ways_to_earn_button && !add_ways_to_earn_button.contains(event.target) && !popover_for_earn_points.contains(event.target)) {
    popover_for_earn_points.style.display = 'none';
  }
});

function move_to_next_step()
{
        document.getElementById('next_button_text').innerHTML = "";
        document.getElementById('spinner').style.display = "block";
        let form = document.getElementById('onboarding_form');
        form.action = "{{env('APP_URL')}}/api/save_onboarding_step_details/{{$shop->msd}}/1";
        form.submit();
        startLoading();
}

function add_ways_to_earn_popup()
{
        let popup = document.getElementById('ways_to_earn_points');
        if(popup.style.display == "block")
        {
                popup.style.display = "none";
        }
        else
        {
                popup.style.display = "block";
        }
}

let count_enabled_activities = {{$shop->enabled_activities}};

function enable_activity(activity_name)
{
        document.getElementById(activity_name).style.display = 'block';
	document.getElementById(activity_name+"_popup").style.display = 'none';
	document.getElementById(activity_name+"_hidden_input").value = 'enabled';	
        popover_for_earn_points.style.display = 'none';
        url = "{{my_app_env('APP_URL')}}/enable_or_disable_activity/{{$shop->our_passw_token}}/"+activity_name+"?status=on";
        getRequest(url);
        
        count_enabled_activities++;
        if(count_enabled_activities == 4)
        {
                add_ways_to_earn_button.style.display = "none";
        }
}

function getRequest(url) {
        return fetch(url, {
        method: 'GET',
        });
}

function change_purchase_activity_reward_type()
{
        let type = document.getElementById('reward_type').value;
        document.getElementById('display_reward_type').innerHTML = type;
        if(type == 'Percentage')
        {
                document.getElementById('description').innerHTML = "The customer will receive points equal to the specified percentage of the total order amount on placing order.";
                document.getElementById('percentage_suffix').style.display = "block";
        }
        else
        {
                document.getElementById('description').innerHTML = "The customer will receive specified points on placing order.";
                document.getElementById('percentage_suffix').style.display = "none";
        }
}

stopLoading();
</script>
@endsection
