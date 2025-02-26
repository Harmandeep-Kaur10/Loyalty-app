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

	.heading
	{
		text-align:left;
                cursor:default;
                color:darkgrey;
                background-color:whitesmoke;
                padding-bottom: 4px;
                font-weight: var(--p-text-heading-sm-font-weight);
                font-size: var(--p-text-heading-sm-font-size);
                line-height: var(--p-text-heading-sm-font-line-height);
                padding-top: 7px;
	}
	.data
	{
		padding-bottom: 4px;
                font-size: var(--p-text-heading-sm-font-size);
                line-height: var(--p-text-heading-sm-font-line-height);
                padding-top: 4px;
		cursor:default;
                text-align:left;
		border-bottom: 1px solid gainsboro;
	}
	#back_button:hover
	{
		background-color:gainsboro;
	}
</style>
<div style="display:flex;margin-left: 11%;margin-right:11%;justify-content:space-between;margin-top: 3%;">
<div style="display:flex;">
<div id="back_button" style="cursor:pointer;height:26px;width:30px;border-radius:8px;" onClick="BackButtonClick()">
<svg style="height:27px;padding-left:2px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.5 10a.75.75 0 0 1-.75.75h-9.69l2.72 2.72a.75.75 0 0 1-1.06 1.06l-4-4a.75.75 0 0 1 0-1.06l4-4a.75.75 0 1 1 1.06 1.06l-2.72 2.72h9.69a.75.75 0 0 1 .75.75Z"/></svg>
</div>
<h2 class="Polaris-Text--root Polaris-Text--headingSm" style="cursor:default;font-size: 22px;margin-left:1%;padding-top:3px;width:20rem;">
      @if($customer->name == " ")
                No Name</h2>
      @else
                {{$customer->name}}</h2>
      @endif
</div>
<div>
@if($store_credit_info['id'] != 0)
<button onclick="show_store_credit_history()" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
        <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Store credit history</span>
</button>
@endif
</div>

<!--button onclick="show_adjust_points_modal()" style="position:absolute;margin-left:65%;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
        <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Adjust points</span>
</button-->

</div>

<!-----------adjust balance modal------------------>
<div data-portal-id="modal-:R5eq6:" id="adjust_points_modal" style="display:none;">
        <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
                <div role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog" style="position:relative;width:470px;left:25%;">
                        <div class="Polaris-Modal-Dialog__Modal">
                                <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-surface-tertiary); --pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-end-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);">
                                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs: 1fr auto; --pc-inline-grid-gap-xs: var(--p-space-400);">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <h2 style="cursor:default;" class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--break" id=":Req6:">Adjust customer points</h2>
                                                </div>
                                                <button onclick="document.getElementById('adjust_points_modal').style.display='none'" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantTertiary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Close" type="button" aria-pressed="false">
                                                        <span class="Polaris-Icon">
                                                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                        <path d="M12.72 13.78a.75.75 0 1 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06l-2.72 2.72-2.72-2.72a.75.75 0 0 0-1.06 1.06l2.72 2.72-2.72 2.72a.75.75 0 1 0 1.06 1.06l2.72-2.72 2.72 2.72Z">
                                                                        </path>
                                                                </svg>
                                                        </span>
                                                </button>
                                        </div>
				</div>
<form method="POST" action="{{my_app_env('APP_URL')}}/api/save_updated_customer_points/{{$shop->our_passw_token}}/{{$customer->customer_id}}" style="margin-bottom:0;" onsubmit="startLoading()">
				<div class="Polaris-Modal__Body Polaris-Scrollable Polaris-Scrollable--vertical Polaris-Scrollable--horizontal">
            <div class="Polaris-Modal-Section">
	      <section class="Polaris-Box builder-elements" style="--pc-box-padding-block-end-xs:var(--p-space-5); --pc-box-padding-block-start-xs:var(--p-space-5); --pc-box-padding-inline-start-xs:var(--p-space-5); --pc-box-padding-inline-end-xs:var(--p-space-5);">
                <div class="Polaris-TextContainer" style="padding:20px;">
			<h2 style="font-size:14px;margin-bottom:2%;font-weight:bold;">Current points: {{$customer->points}}</h2>
<div style="display:flex;">
                  <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-400)">
                    <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                      <div class="">
			<div class="Polaris-Labelled__LabelWrapper">
                          <div class="Polaris-Label">
                            @csrf
                            <label id=":R2q6:Label" class="Polaris-Label__Text">Amount</label>
                          </div>
                        </div>
                        <div class="Polaris-Connected" style="width:92%;">
                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                            <div class="Polaris-TextField">
				<input name="amount" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" placeholder="0.00">
                              <div class="Polaris-TextField__Backdrop">
                              </div>
                            </div>
                          </div>
			</div>
                      </div>
                    </div>
		  </div>

		<div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-400)">
                    <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                      <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                          <div class="Polaris-Label">
                            @csrf
                            <label id=":R2q6:Label" class="Polaris-Label__Text">Choose type</label>
                          </div>
			</div>

			<div class="Polaris-Select" style="width:95%;">
                    	  <select id="type_dropdown" style="font-size:13px;padding-left:11px;" class="Polaris-Select__Input" aria-invalid="false">
                        	<option value="Credit" selected="">Credit</option>
                        	<option value="Debit">Debit</option>
                    	</select>
		    <div class="Polaris-Select__Content" aria-hidden="true">
			<input type="hidden" id="adjustment_type" name="adjustment_type" value="Credit">
                        <span id="type" class="Polaris-Select__SelectedOption">Credit</span>
                        <span class="Polaris-Select__Icon">
                          <span class="Polaris-Icon">
                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                  <path d="M10.884 4.323a1.25 1.25 0 0 0-1.768 0l-2.646 2.647a.75.75 0 0 0 1.06 1.06l2.47-2.47 2.47 2.47a.75.75 0 1 0 1.06-1.06l-2.646-2.647Z">
                                  </path>
                                  <path d="m13.53 13.03-2.646 2.647a1.25 1.25 0 0 1-1.768 0l-2.646-2.647a.75.75 0 0 1 1.06-1.06l2.47 2.47 2.47-2.47a.75.75 0 0 1 1.06 1.06Z">
                                  </path>
                                </svg>
                        </span>
                       </span>
                    </div>
                    <div class="Polaris-Select__Backdrop">
                    </div>
                        </div>
                      </div>
                    </div>
                  </div>
</div>


		  <div class="">
  		   <div class="Polaris-Labelled__LabelWrapper">
    		     <div class="Polaris-Label">
      			<label id=":Rq6:Label" for="reason_dropdown" class="Polaris-Label__Text">
        		  <span class="Polaris-Text--root Polaris-Text--bodyMd">Reason</span>
      			</label>
    		     </div>
		  </div>
  		  <div class="Polaris-Select">
    		    <select id="reason_dropdown" style="font-size:13px;padding-left:11px;" class="Polaris-Select__Input" aria-invalid="false">
      			<option value="Refund" selected="">Refund</option>
      			<option value="Compensation">Compensation</option>
      			<option value="Reward">Reward</option>
			<option value="Transfer">Transfer</option>
      			<option value="Employee">Employee</option>
      			<option value="Donation">Donation</option>
			<option value="Return">Return</option>
        		<option value="Other">Other</option>
    		    </select>
		    <div class="Polaris-Select__Content" aria-hidden="true">
			<input type="hidden" id="reason_input" name="reason" value="Refund">
      			<span id="reason" class="Polaris-Select__SelectedOption">Refund</span>
      			<span class="Polaris-Select__Icon">
        		  <span class="Polaris-Icon">
          			<svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
            			  <path d="M10.884 4.323a1.25 1.25 0 0 0-1.768 0l-2.646 2.647a.75.75 0 0 0 1.06 1.06l2.47-2.47 2.47 2.47a.75.75 0 1 0 1.06-1.06l-2.646-2.647Z">
            			  </path>
            			  <path d="m13.53 13.03-2.646 2.647a1.25 1.25 0 0 1-1.768 0l-2.646-2.647a.75.75 0 0 1 1.06-1.06l2.47 2.47 2.47-2.47a.75.75 0 0 1 1.06 1.06Z">
            			  </path>
          			</svg>
        		</span>
      		       </span>
    		    </div>
    		    <div class="Polaris-Select__Backdrop">
    		    </div>
  		  </div>
		</div>
              </section>
            </div>
          </div>
                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                        <div class="Polaris-Box" style="--pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-start-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400); --pc-box-width: 100%;">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-align: space-between; --pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <div class="Polaris-Box">
                                                        </div>
                                                        <div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-200); --pc-inline-stack-flex-direction-xs: row;">
                                                                <button style="min-width:80px;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="submit" onclick="show_spinner()">
									<span id="button_text" class="" style="display:block;">Change</span>
									<span id="spinner" class="Polaris-Button__Spinner" style="display:none;">
                                                                    <span class="Polaris-Spinner Polaris-Spinner--sizeSmall">
                                                                        <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                          <path d="M7.229 1.173a9.25 9.25 0 1011.655 11.412 1.25 1.25 0 10-2.4-.698 6.75 6.75 0 11-8.506-8.329 1.25 1.25 0 10-.75-2.385z"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <span role="status">
                                                                        <span class="Polaris-Text--root Polaris-Text--visuallyHidden">Loading</span>
                                                                    </span>
                                                                  </span>
								</button>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <div class="Polaris-Backdrop">
        </div>
</div>
</form>

<!------------modal ended---------------------------->

<div style="display:flex;margin-left:14.3%;">
	 <p class="Polaris-Text--root Polaris-Text--bodyMd" style="cursor:default;font-size:14px;color:grey">@if($customer->email == 0) email unavailable @else {{$customer->email}} @endif</p>
	<p style="margin-left: 5px;margin-right: 5px;font-size: 19px;color: grey;">&#10625;</p>
	<div style="display:flex;">
		<p class="Polaris-Text--root Polaris-Text--bodyMd" style="padding-right:3px;font-size:14px;color:grey;cursor:default;">Last Visit:</p>
		<p class="Polaris-Text--root Polaris-Text--bodyMd" style="font-size:14px;color:grey;cursor:default;">{{date('d-m-Y',strtotime($latest_visit))}}</p>
  	</div>
</div>

<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); margin-top: 2%;margin-left:11%;margin-right:11%;">
        <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:1%;">

<div style="display: flex; gap:1%;">
                <div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); width: 100%;">
                <div id="total_revenue" onmouseover="display_on_hover('total_revenue_tooltip',this.id)" onmouseout="display_on_hover('total_revenue_tooltip',this.id)" class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:4%;background-color:white;cursor:pointer;-webkit-tap-highlight-color: transparent;">
                        <p style="font-size:13px;cursor:pointer;border-bottom: 2px dotted lightgrey;text-decoration: none;width:89px;"><b>Total Revenue</b></p>
                        <p style="font-size:15px;margin-top: 4px;cursor:pointer;"><b>{{$amount}}</b></p>
                </div>
        </div>
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); width:100%;">
                <div id="current_points" onmouseover="display_on_hover('current_points_tooltip',this.id)" onmouseout="display_on_hover('current_points_tooltip',this.id)" class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:4%;background-color:white;cursor:pointer;-webkit-tap-highlight-color: transparent;">
                        <p style="font-size:13px;cursor:pointer;border-bottom: 2px dotted lightgrey;text-decoration: none;width:75px;"><b>Total Points</b></p>
                        <p style="font-size:15px; margin-top: 4px;cursor:pointer;"><b>{{$customer->points}}</b></p>
                </div>
        </div>
        <div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); width:100%;">
                <div id="rewards_claimed" onmouseover="display_on_hover('rewards_claimed_tooltip',this.id)" onmouseout="display_on_hover('rewards_claimed_tooltip',this.id)" class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:4%;--pc-box-padding-inline-end-xs:var(--p-space-400);background-color:white;cursor:pointer;-webkit-tap-highlight-color: transparent;">
                        <p style="font-size:13px;cursor:pointer;border-bottom: 2px dotted lightgrey;text-decoration: none;width:110px;"><b>Rewards Claimed</b></p>
                        <p style="font-size:15px;margin-top: 4px;cursor:pointer;"><b>{{count(json_decode($customer->rewards))}}</b></p>
                </div>
	</div>
	<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); width:100%;">
                <div id="activities_completed" onmouseover="display_on_hover('activities_completed_tooltip',this.id)" onmouseout="display_on_hover('activities_completed_tooltip',this.id)" class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:4%;--pc-box-padding-inline-end-xs:var(--p-space-400);background-color:white;cursor:pointer;-webkit-tap-highlight-color: transparent;">
                        <p style="font-size:13px;cursor:pointer;border-bottom: 2px dotted lightgrey;text-decoration: none;width:130px;"><b>Activities Completed</b></p>
                        <p style="font-size:15px;margin-top: 4px;cursor:pointer;"><b>{{$customer->activities}}</b></p>
                </div>
	</div>
     </div>
  </div>
</div>


<div data-portal-id="tooltip-:r0:" id="total_revenue_tooltip" style="display:none;" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div class="Polaris-PositionedOverlay" style="top: 27%; left: 12.6%;">
    <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);height:90px;">
      <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 48.2812px;position:relative;">
        <p class="Polaris-Text--root Polaris-Text--bodyMd"><b>Total Revenue</b></p>
        <span class="Polaris-Text--root Polaris-Text--bodyMd">It includes revenue of all the orders on which customer has applied your rewards.</span>
      </div>
    </div>
  </div>
</div>

<div data-portal-id="tooltip-:r0:" id="current_points_tooltip" style="display:none;" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div class="Polaris-PositionedOverlay" style="top: 27%; left: 31.3%;">
    <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
      <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 48.2812px;position:relative;">
        <p class="Polaris-Text--root Polaris-Text--bodyMd"><b>Total Points</b></p>
        <span class="Polaris-Text--root Polaris-Text--bodyMd">It displays current total points of customer after performing activities such as making a purchase or claiming a reward.</span>
      </div>
    </div>
  </div>
</div>

<div data-portal-id="tooltip-:r0:" id="rewards_claimed_tooltip" style="display:none;" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div class="Polaris-PositionedOverlay" style="top: 27%; left:50%;">
    <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
      <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 48.2812px;position:relative;">
        <p class="Polaris-Text--root Polaris-Text--bodyMd"><b>Rewards Claimed</b></p>
        <span class="Polaris-Text--root Polaris-Text--bodyMd">It displays total number of rewards, such as free shipping, claimed by customer using your app.</span>
      </div>
    </div>
  </div>
</div>

<div data-portal-id="tooltip-:r0:" id="activities_completed_tooltip" style="display:none;" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div class="Polaris-PositionedOverlay" style="top: 27%; left:68.8%;">
    <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
      <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 48.2812px;position:relative;">
        <p class="Polaris-Text--root Polaris-Text--bodyMd"><b>Activities Completed</b></p>
        <span class="Polaris-Text--root Polaris-Text--bodyMd">It displays total number of activities performed by customer such as account creation, making a purchase, visiting your website, claiming or using your reward, etc.</span>
      </div>
    </div>
  </div>
</div>
<!-------------------------History Table--------------------->
<div class="" style=" margin-top: 15px;">
  <div class="Polaris-Page" style="padding-left: 0px;padding-right:0px;margin-left:11%;margin-right:11%;">
    <div class="">
      <div class="Polaris-LegacyCard">
        <div class="">
          <div class="Polaris-DataTable Polaris-DataTable__ShowTotals Polaris-DataTable__ShowTotalsInFooter">
            <div class="Polaris-DataTable__ScrollContainer">
              <table class="Polaris-DataTable__Table">
                <thead style="line-height:0;height:33px;">
                  <tr>
                   <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Date</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Current Points</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Activity</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Points</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Order Id</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Total Paid</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Reward Code</th>
                  </tr>
		</thead>
@php($count = 0)
                  @foreach($activity_logs as $activity)
                    @php($order_details = $activity->activity_data)
                    @php($arr = json_decode($order_details,true))
			@if($activity->activity_type == 'account created' && $activity->points_changed > 0 || $activity->activity_type == 'visit' || $activity->activity_type == 'purchase' && $arr['purchase_activity_state'] == "1" || str_contains($activity->activity_type, 'claimed') || str_contains($activity->activity_type, 'used') || $activity->activity_type == 'Points converted to store credit' || str_contains($activity->activity_type, 'referred'))
			@php($count++)
			<tbody style="line-height:0;height:33px;">
                          <tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable">
                            <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">
                                        @if($activity->activity_type == "purchase" || str_contains($activity->activity_type, 'used'))
                                                {{date('d-m-Y',strtotime($arr['order_date']))}}</td>
                                        @else
                                                {{date('d-m-Y',strtotime($activity->created_at))}}</td>
                                        @endif
                            <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">{{$activity->current_points}}</td>
			    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">
			    @if(str_contains($activity->activity_type, 'referred'))
				@php($parts = explode(' ', $activity->activity_type))
				{{$parts[0]}}<br>got {{ trim($parts[1]) }} {{ trim($parts[2]) }}
			    @else
				{{$activity->activity_type}}</td>
			    @endif
                            <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">{{$activity->points_changed}}</td>
                            <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">
                                @if(array_key_exists('purchase_activity_state',$arr))
                                <a href="https://admin.shopify.com/store/{{$shop->name}}/orders/{{$arr['order_id']}}" target="_blank">
                                        {{$arr['order_no']}}</td>
                                </a>
                                @else
                                        -</td>
                                @endif
                            <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">
                                @if($activity->activity_type == "purchase")
                                        {{ str_replace("amount",$arr['revenue'],$shop->currency_format) }}</td>
                                @elseif(str_contains($activity->activity_type, 'used') && array_key_exists('revenue',$arr))
                                        {{ str_replace("amount",$arr['revenue'],$shop->currency_format) }}</td>
                                @else
                                        -</td>
                                @endif
                            <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">
				@if(str_contains($activity->activity_type, 'claimed') || str_contains($activity->activity_type, 'used') || str_contains($activity->activity_type, 'referred'))				
                                        {{$arr['code']}}</td>
                                @else
                                        -</td>
                                @endif
                          </tr>
                        </tbody>
                        @endif
			@endforeach
              @if($customer->activities == 0)
              <tbody>
	       <tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable">
		<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"></td>
                 <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"></td>
                 <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"></td>
                <td style="font-size:14px;text-align:center;border-bottom: 1px solid gainsboro;cursor:default;" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">No History Available</td>
                 <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"></td>
                 <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"></td>
                 <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"></td>
               </tr>
             </tbody>
             @endif
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!---------------pagination-------------------->
@if($count < 9)
<nav id="pagination" aria-label="Pagination" class="Polaris-Pagination" style="display: flex;justify-content: center;position: absolute;padding-bottom: 12px;padding-top: 16px;left: 40%;bottom:0;">
@else
<nav id="pagination" aria-label="Pagination" class="Polaris-Pagination" style="display:flex; justify-content:center;position:relative;padding-top:16px;">
@endif
  <div class="Polaris-ButtonGroup Polaris-ButtonGroup--variantSegmented" data-buttongroup-variant="segmented">
    <div class="Polaris-ButtonGroup__Item">
@if($activity_logs->onFirstPage())
     <a style="cursor:default;"><button id="previousURL" style="pointer-events:none;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Previous" type="button" disabled>
@else
     <a href="{{$activity_logs->previousPageUrl()}}&customer_id={{$customer->customer_id}}"><button id="previousURL" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Previous" type="button">
@endif
        <span class="Polaris-Button__Icon">
	  <span class="Polaris-Icon">
	    <svg viewBox="0 0 20 20" @if($activity_logs->onFirstPage()) style="fill:lightgrey;" @endif class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
              <path fill-rule="evenodd" d="M11.764 5.204a.75.75 0 0 1 .032 1.06l-3.516 3.736 3.516 3.736a.75.75 0 1 1-1.092 1.028l-4-4.25a.75.75 0 0 1 0-1.028l4-4.25a.75.75 0 0 1 1.06-.032Z">
              </path>
            </svg>
          </span>
        </span>

      </button></a>
    </div>
<div style="padding-right: 15px; padding-left: 15px;cursor:default;"><span> {{$activity_logs->currentPage()}}</span> out of <span>{{$activity_logs->lastPage()}} </span></div>

    <div class="Polaris-ButtonGroup__Item">
@if($activity_logs->onLastPage())
     <a style="cursor:default;"><button id="nextURL" style="pointer-events:none;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Next" type="button" disabled>
@else
     <a href="{{$activity_logs->nextPageUrl()}}&customer_id={{$customer->customer_id}}"><button id="nextURL" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Next" type="button">
@endif
        <span class="Polaris-Button__Icon">
	  <span class="Polaris-Icon">
	    <svg viewBox="0 0 20 20" @if($activity_logs->onLastPage()) style="fill:lightgrey;" @endif class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
              <path fill-rule="evenodd" d="M7.72 14.53a.75.75 0 0 1 0-1.06l3.47-3.47-3.47-3.47a.75.75 0 0 1 1.06-1.06l4 4a.75.75 0 0 1 0 1.06l-4 4a.75.75 0 0 1-1.06 0Z">
              </path>
            </svg>
          </span>
        </span>
      </button></a>
    </div>
  </div>
</nav>

<script>
        function BackButtonClick()
	{
		startLoading();
                location.replace("{{my_app_env('APP_URL')}}/customers/{{$shop->our_passw_token}}");
	}

	function show_store_credit_history()
	{
		window.open(`https://admin.shopify.com/store/{{$shop->name}}/customers/{{$customer->customer_id}}/store_credit_account/{{$store_credit_info['id']}}/transactions?selectedView=all`, '_blank');
                logActivity('pressed Store credit history button on customer details page of customer id {{$customer->customer_id}}','{{$shop->msd}}');
	}

	function display_on_hover(hover_element,div_id)
	{
		if(document.getElementById(hover_element).style.display == "none")
                {
                        document.getElementById(hover_element).style.display = "block";
                }
                else
                {
                        document.getElementById(hover_element).style.display = "none";
                }
		
		if(document.getElementById(div_id).style.backgroundColor == "white")
                {
                        document.getElementById(div_id).style.backgroundColor = "whitesmoke";
                }
                else
                {
                        document.getElementById(div_id).style.backgroundColor = "white";
                }
	}

	function show_adjust_points_modal()
	{
		document.getElementById('adjust_points_modal').style.display = 'block';
	}

	function show_spinner()
	{
		document.getElementById('button_text').style.display = "none";
		document.getElementById('spinner').style.display = "block";
	}

	const reason_dropdown = document.getElementById('reason_dropdown');
	const reason = document.getElementById('reason');
	reason_dropdown.addEventListener('change', function() {
		reason.textContent = reason_dropdown.value;
		document.getElementById("reason_input").value = reason_dropdown.value;
	});

	const type_dropdown = document.getElementById('type_dropdown');
        const type = document.getElementById('type');
        type_dropdown.addEventListener('change', function() {
		type.textContent = type_dropdown.value;
		document.getElementById("adjustment_type").value = type_dropdown.value;
        });

        stopLoading();
</script>
@endsection

