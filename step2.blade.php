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
         <progress id="progress_bar" class="Polaris-ProgressBar__Progress" value="32" max="100">
         </progress>
         <div id="progress_bar_percent" class="Polaris-ProgressBar__Indicator Polaris-ProgressBar__IndicatorAppearActive" style="--pc-progress-bar-duration:500ms;--pc-progress-bar-percent:0.32">
         </div>
        </div>
      </div>
      <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
        <h2 class="Polaris-Text--root Polaris-Text--bodyMd">2/6 Steps: Setup how customers can redeem points</h2>
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
<!-----------------------Setup for redeeming points------------------>
<div id="ways_to_redeem_points" data-portal-id="popover-:r0:" class="p-theme-light Polaris-ThemeProvider--themeContainer" style="display:none;">
  <div class="Polaris-PositionedOverlay Polaris-Popover__PopoverOverlay Polaris-Popover__PopoverOverlay--open" style="right:1.25rem;top:13rem;">
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
                @foreach($shop->rewards as $reward)
                @if($reward['state'] == 0)
                  <li id="{{$reward['handle']}}_popup" class="Polaris-Box" role="presentation">
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

<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);height:auto;margin-top:1rem;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
    <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
         <div style="display:flex;justify-content:space-between;">
      <div><h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">Set how your customers can redeem points </h2><h2 class="Polaris-Text--root Polaris-Text--bodyMd" style="display:inline-block;margin-left:0.5rem;">(You can change this later)</h2></div>
@if($shop->enabled_rewards < 4)
<div>
        <button id="add_ways_to_redeem_points" onclick="add_ways_to_redeem_popup()" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPlain Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
                <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--regular">+ Add way to redeem</span>
        </button>
</div>
@endif
</div>
        @foreach($shop->rewards as $reward)
                @if($reward['handle'] == 'free_shipping')
                <div id="{{$reward['handle']}}" style="display:@if($reward['state'] == 1) block; @else none; @endif">
                        <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                                <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">{{$reward['name']}}</h2>
                        <input id="free_shipping_hidden_input" type="hidden" name="free_shipping_reward" value="@if($reward['state'] == 1) enabled @else disabled @endif">
                        <div class="Polaris-InlineGrid" style="margin-bottom:0.5rem;">
                                <div class="Polaris-BlockStack" style="width:49%;">
                                  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                                    <div class="">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                          <div class="Polaris-Label">
                                                <label id=":R2q6:Label" class="Polaris-Label__Text">Cost</label>
                                          </div>
                                        </div>
                                        <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <input name="free_shipping_reward_cost" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['cost']}}" required>
                                                <div class="Polaris-TextField__Suffix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">points</span>
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
				<hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border);">
                                </div>
                        @elseif($reward['handle'] == 'percentage_off')
                        <div id="{{$reward['handle']}}" style="display:@if($reward['state'] == 1) block; @else none; @endif">
                          <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                        <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">{{$reward['name']}}</h2>
                        <input id="percentage_off_hidden_input" type="hidden" name="percentage_off_reward" value="@if($reward['state'] == 1) enabled @else disabled @endif">
                            <div class="Polaris-InlineGrid" style="display:flex;justify-content:space-between;margin-bottom:0.5rem;">
                                <div class="Polaris-BlockStack" style="width:49%;">
                                  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                                    <div class="">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                          <div class="Polaris-Label">
                                                <label id=":R2q6:Label" class="Polaris-Label__Text">For X amount of points</label>
                                          </div>
                                        </div>
                                        <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <input name="percentage_off_reward_cost" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['cost']}}" required>
                                                <div class="Polaris-TextField__Suffix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">points</span>
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
                                                <span class="Polaris-Text--root Polaris-Text--bodyMd">Customer gets X% discount</span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <input name="percentage_off_value" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{explode('%',$reward['percent'])[0]}}" required>
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
                         @elseif($reward['handle'] == 'amount_off')
			<div id="{{$reward['handle']}}" style="display:@if($reward['state'] == 1) block; @else none; @endif">
			<hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border);margin-bottom:0.5rem;">
                          <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                          <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">{{$reward['name']}}</h2>
                         <input id="amount_off_hidden_input" type="hidden" name="amount_off_reward" value="@if($reward['state'] == 1) enabled @else disabled @endif">
                         <div class="Polaris-InlineGrid" style="display:flex;justify-content:space-between;margin-bottom:0.5rem;">
                                <div class="Polaris-BlockStack" style="width:49%;">
                                  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                                    <div class="">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                          <div class="Polaris-Label">
                                                <label id=":R2q6:Label" class="Polaris-Label__Text">For X amount of points</label>
                                          </div>
                                        </div>
                                        <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <input name="amount_off_reward_cost" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['cost']}}" required>
                                                <div class="Polaris-TextField__Suffix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">points</span>
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
                                                <span class="Polaris-Text--root Polaris-Text--bodyMd">Customer gets {{explode(' ', $shop->currency_format)[0]}} X discount</span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <div class="Polaris-TextField__Prefix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">{{explode(' ', $shop->currency_format)[0]}}</span>
                                                </div>
                                                <input name="amount_off_value" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['amount']}}" required>
                                                <div class="Polaris-TextField__Backdrop">
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                        @else
			<div id="{{$reward['handle']}}" style="display:@if($reward['state'] == 1) block; @else none; @endif">
			<hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border);margin-bottom:0.5rem;">
                          <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
                          <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline-block;">{{$reward['name']}}</h2>
                        <span>Store credit is monetary value given to your customers to spend in your store. Using this reward you can allow customers to convert their earned points into store credit.</span>
                        <input id="convert_points_to_store_credit_hidden_input" type="hidden" name="store_credit_reward" value="@if($reward['state'] == 1) enabled @else disabled @endif">
                        <div class="Polaris-InlineGrid" style="display:flex;justify-content:space-between;margin-bottom:0.5rem;">
                                <div class="Polaris-BlockStack" style="width:49%;">
                                  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                                    <div class="">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                          <div class="Polaris-Label">
                                                <label id=":R2q6:Label" class="Polaris-Label__Text">For X amount of points</label>
                                          </div>
                                        </div>
                                        <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <input name="store_credit_reward_cost" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['points']}}" required>
                                                <div class="Polaris-TextField__Suffix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">points</span>
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
                                                <span class="Polaris-Text--root Polaris-Text--bodyMd">Customer gets {{explode(' ', $shop->currency_format)[0]}} X store credit</span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="Polaris-Connected">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
                                                <div class="Polaris-TextField__Prefix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">{{explode(' ', $shop->currency_format)[0]}}</span>
                                                </div>
                                                <input name="store_credit_reward_amount" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['amount']}}" required>
                                                <div class="Polaris-TextField__Backdrop">
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                              </div>
                           </div>
                         </div>
                        </div>
                        </div>
                        @endif
                         </div>
        @endforeach
    </div>
    </div>
  </div>
</div>
</form>

<script>
let add_ways_to_redeem_button = document.getElementById('add_ways_to_redeem_points');
let popover_for_redeem_points = document.getElementById('ways_to_redeem_points');

document.addEventListener('click', (event) => {
  if(add_ways_to_redeem_button && !add_ways_to_redeem_button.contains(event.target) && !popover_for_redeem_points.contains(event.target)) {
    popover_for_redeem_points.style.display = 'none';
  }
});

function move_to_next_step()
{
        document.getElementById('next_button_text').innerHTML = "";
        document.getElementById('spinner').style.display = "block";
        let form = document.getElementById('onboarding_form');
        form.action = "{{env('APP_URL')}}/api/save_onboarding_step_details/{{$shop->msd}}/2";
        form.submit();
        startLoading();
}

function add_ways_to_redeem_popup()
{
        let popup = document.getElementById('ways_to_redeem_points');
        if(popup.style.display == "block")
        {
                popup.style.display = "none";
        }
        else
        {
                popup.style.display = "block";
        }
}

let count_enabled_rewards = {{$shop->enabled_rewards}};

function enable_reward(reward_name)
{
        document.getElementById(reward_name).style.display = 'block';
	document.getElementById(reward_name+"_popup").style.display = 'none';
	document.getElementById(reward_name+"_hidden_input").value = 'enabled';
        popover_for_redeem_points.style.display = 'none';
        url = "{{my_app_env('APP_URL')}}/enable_or_disable_reward/{{$shop->our_passw_token}}?reward_name="+reward_name+"&&status=on";
        getRequest(url);

        count_enabled_rewards++;
        if(count_enabled_rewards == 4)
        {
                add_ways_to_redeem_button.style.display = "none";
        }
}

function getRequest(url) {
        return fetch(url, {
        method: 'GET',
        });
}

stopLoading();
</script>
@endsection


