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

.switch {
  position: relative;
  display: inline-block;
  width: 47px;
  height: 21px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 17px;
  width: 17px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #32CD32;
}

input:focus + .slider {
  box-shadow: 0 0 1px #32CD32;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
/*#back_button:hover
{
	background-color:gainsboro;
}*/
</style>

<!--first div -->
<div style="margin-left:11%;margin-right:11%;">

<div style="display:flex;justify-content:space-between;">
{{--@if($page == "dashboard")
<div id="back_button" style="cursor:pointer;border-radius:8px;margin-top:10px;" onClick="BackButtonClick()">
<svg style="height:27px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.5 10a.75.75 0 0 1-.75.75h-9.69l2.72 2.72a.75.75 0 0 1-1.06 1.06l-4-4a.75.75 0 0 1 0-1.06l4-4a.75.75 0 1 1 1.06 1.06l-2.72 2.72h9.69a.75.75 0 0 1 .75.75Z"/></svg>
</div>
@endif--}}
<button id="feature_request_button" onclick='show_feature_request()' class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPlain Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" aria-label="Add variant" type="button"
	{{--@if($page == "dashboard")
		style="margin-top: 0.5rem;"
	@endif--}}
        <span class="">Want to add ways to redeem rewards?</span>
</button>
</div>

<!---------------------REWARDS CARDS------------>
@php($i = 1)
@foreach($rewards as $reward)
<div class="Polaris-ShadowBevel" style="margin-bottom: 10px;margin-top:10px; --pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);">
        <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:15%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
                <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
			<div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs:repeat(3, minmax(0, 1fr)); display:flex;justify-content:space-between;">
				<div style="display:flex;">
                                <h2 style="cursor:default;margin-right:20px;" class="Polaris-Text--root Polaris-Text--headingSm">
                                                {{$reward['name']}}
				</h2>
				@if($reward['state'] == 1)
                                 <span class="Polaris-Badge Polaris-Badge--toneSuccess" style="width:3.1rem;">
                                        <span class="Polaris-Text--root Polaris-Text--visuallyHidden">Success</span>
                                        <span style="cursor:default;" class="Polaris-Text--root Polaris-Text--bodySm">Active</span>
                                </span>
                                @endif
                                @if($reward['state'] == 0)
                                <span class="Polaris-Badge Polaris-Badge--toneWarning" style="width:3.5rem;">
                                        <span class="Polaris-Text--root Polaris-Text--visuallyHidden">Warning</span>
                                        <span style="cursor:default;" class="Polaris-Text--root Polaris-Text--bodySm">Inactive</span>
                                </span>
				@endif
				</div>
				@if($reward['handle'] != 'convert_points_to_store_credit')
                                <button onclick='open_edit_popup("{{$reward['handle']}}")' class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPlain Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" aria-label="Add variant" type="button">
                                        <span class="">Edit</span>
				</button>
				@endif
                        </div>
                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs:1fr auto">
				<p style="cursor:default;width:98%;" class="Polaris-Text--root Polaris-Text--bodyMd">
				@if($reward['handle'] == 'convert_points_to_store_credit')
					Store credit is monetary value given to your customers to spend in your store. Using this reward you can allow customers to convert their earned points into store credit. For eg.- <strong>100 points = {{ str_replace('amount',10,$shop->currency_format) }}</strong><br><br><b>Note: </b>Please follow this simple <a onclick="document.getElementById('setup_guide_button_popup').style.display = 'block';" style="color:blue;cursor:pointer;">setup guide</a> to allow customers to spend their issued store credit.
				@else
					Cost: {{$reward['cost']}} points
				@endif
				</p>
                                <div class="Polaris-ButtonGroup Polaris-ButtonGroup--variantSegmented" style="height:19px;" data-buttongroup-variant="segmented">
					<div class="Polaris-ButtonGroup__Item">
					    <label class="switch">
                                                      	<input id="toggle{{$i}}" onchange="shift_toggle_button('toggle{{$i}}',`{{$reward['handle']}}`)" type="checkbox" @if($reward['state'] == 1) checked @endif>
                                                        <span class="slider round"></span>
					    </label>
                                        </div>
				</div>
			</div>
				@if($reward['handle'] == 'convert_points_to_store_credit' && $reward['state'] == 1)	
			<form method="POST" action="{{my_app_env('APP_URL')}}/api/save_updated_store_credit_reward/{{$shop->our_passw_token}}" onsubmit="startLoading()">
			<div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs:1fr 1fr">	
				<div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-400)">
                    		  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                      		    <div class="">
                        		<div class="Polaris-Labelled__LabelWrapper">
                          		  <div class="Polaris-Label">
                            		  @csrf
                            			<label id=":R2q6:Label" class="Polaris-Label__Text"><strong>Points</strong></label>
                          		  </div>
                        		</div>
                        		<div class="Polaris-Connected" style="width:92%;">
                          		  <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                            		    <div class="Polaris-TextField">
                                		<input name="points" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['points']}}" required>
                              			<div class="Polaris-TextField__Backdrop">
                              			</div>
                            		    </div>
                          		</div>
                        	      </div>
                      		    </div>
                    		  </div>
			       </div>

				<div class="">
  				  <div class="Polaris-Labelled__LabelWrapper">
    				    <div class="Polaris-Label">
      					<label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text">
        					<span class="Polaris-Text--root Polaris-Text--bodyMd"><strong>Amount</strong></span>
      					</label>
    				    </div>
  				  </div>
  				  <div class="Polaris-Connected">
    				    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
      					<div class="Polaris-TextField Polaris-TextField--hasValue">
        				  <div class="Polaris-TextField__Prefix" id=":Rq6:-Prefix">
          					<span class="Polaris-Text--root Polaris-Text--bodyMd">{{ str_replace("amount","","$shop->currency_format") }}</span>
        				  </div>
        				  <input id=":Rq6:" name="amount" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":Rq6:Label :Rq6:-Prefix" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['amount']}}" required>
        				  <div class="Polaris-TextField__Backdrop">
        				  </div>
      					</div>
    				    </div>
  			         </div>
			      </div>
			</div>
				{{--<!--input name="page" type="hidden" @if($page == "dashboard") value="dashboard" @endif-->--}}
			<div style="display:flex;justify-content:end;margin-top:1.6rem;">
			<button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="submit">
  				<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Save changes</span>
			</button>
			</div>
			</form>
			     @endif
		
                </div>
        </div>
</div>
@php($i++)
@endforeach
</div>
<!-------------------SETUP GUIDE POPUP----------------->
<div data-portal-id="modal-:R5eq6:" id="setup_guide_button_popup" style="display:none;">
        <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
                <div role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog">
                        <div class="Polaris-Modal-Dialog__Modal" style="min-height:28rem;">
                                <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-surface-tertiary); --pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-end-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);">
                                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs: 1fr auto; --pc-inline-grid-gap-xs: var(--p-space-400);">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <h2 style="cursor:default;" class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--break" id=":Req6:">Enable store credit functionality on storefront</h2>
                                                </div>
                                                <button onclick="document.getElementById('setup_guide_button_popup').style.display = 'none';" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantTertiary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Close" type="button" aria-pressed="false">
                                                        <span class="Polaris-Icon">
                                                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                        <path d="M12.72 13.78a.75.75 0 1 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06l-2.72 2.72-2.72-2.72a.75.75 0 0 0-1.06 1.06l2.72 2.72-2.72 2.72a.75.75 0 1 0 1.06 1.06l2.72-2.72 2.72 2.72Z">
                                                                        </path>
                                                                </svg>
                                                        </span>
                                                </button>
                                        </div>
                                </div>
                                <div style="margin-top:2%;">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                                <label style="padding-left:6%;padding-right:4%;" id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text"><b>Note: </b>Click the button below to visit the Customer Accounts page. In the "New Customer Accounts" section, enable Store Credit to allow customers to view and use their store credit.</label>
                                        </div>
                                </div>
                                <br>
				<div style="width:50%;">
                        		<img src="{{my_app_env('APP_URL')}}/store_credit.gif" style="width:125%;position:relative;left:37%;margin-bottom:10%;"></img>
				</div>
				<div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                        <div class="Polaris-Box" style="--pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-start-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400); --pc-box-width: 100%;">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-align: space-between; --pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <div class="Polaris-Box">
                                                        </div>
							<div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-200); --pc-inline-stack-flex-direction-xs: row;">
							<a style="color:white;text-decoration:none;-webkit-tap-highlight-color: transparent;" href="https://admin.shopify.com/store/{{$shop->name}}/settings/customer_accounts" target="_blank">
                                                                <button onclick="logActivity('pressed Go to customer accounts page button on rewards setup page for enabling store credit functionality','{{$shop->msd}}')" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
									<span class="">Go to customer accounts page</span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" style="color:white;height: 19px;padding-left: 4px;padding-bottom: 2px;"><path d="M11.75 3.5a.75.75 0 0 0 0 1.5h2.19l-4.97 4.97a.75.75 0 1 0 1.06 1.06l4.97-4.97v2.19a.75.75 0 0 0 1.5 0v-4a.75.75 0 0 0-.75-.75h-4Z"/><path d="M15 10.967a.75.75 0 0 0-1.5 0v2.783c0 .69-.56 1.25-1.25 1.25h-6c-.69 0-1.25-.56-1.25-1.25v-6c0-.69.56-1.25 1.25-1.25h2.783a.75.75 0 0 0 0-1.5h-2.783a2.75 2.75 0 0 0-2.75 2.75v6a2.75 2.75 0 0 0 2.75 2.75h6a2.75 2.75 0 0 0 2.75-2.75v-2.783Z"/></svg>
								</button>
							</a>
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
<!-------------------EDIT POPUP----------------------->
<div data-portal-id="modal-:R5eq6:" id="edit_popup" style="display:none;">
        <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
                <div style="position:relative;left:25%;width:430px;" role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog">
                        <div class="Polaris-Modal-Dialog__Modal">
                                <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-surface-tertiary); --pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-end-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);">
                                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs: 1fr auto; --pc-inline-grid-gap-xs: var(--p-space-400);">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <h2 id="heading" style="cursor:default;" class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--break" id=":Req6:"></h2>
                                                </div>
                                                <button onclick="close_popup('edit_popup')" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantTertiary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Close" type="button" aria-pressed="false">
                                                        <span class="Polaris-Icon">
                                                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                        <path d="M12.72 13.78a.75.75 0 1 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06l-2.72 2.72-2.72-2.72a.75.75 0 0 0-1.06 1.06l2.72 2.72-2.72 2.72a.75.75 0 1 0 1.06 1.06l2.72-2.72 2.72 2.72Z">
                                                                        </path>
                                                                </svg>
                                                        </span>
                                                </button>
                                        </div>
				</div>

			        <div class="" style="display:grid;grid-template-columns:182px auto">
                                        <div id="upper_label" class="Polaris-Labelled__LabelWrapper" style="display:none;padding-top:20px">
                                                <label id="label" for=":Rq6:" style="position:relative;left:15px;" class="Polaris-Label__Text"></label>
                                        </div>
                                        <div id="cost_label" class="Polaris-Labelled__LabelWrapper" style="position:relative;left:17px;padding-top:19px;width:95px;">
                                                <label for=":Rq6:" class="Polaris-Label__Text">Cost (in Points)</label>
                                        </div>
					<form id="myform" style="height:45px;" name="update_cost" action="" method="POST" onsubmit="startLoading()">
                                        <div id="offInput" class="Polaris-Connected" style="display:none;padding-top:10px;top:-41px;width:200px;left:214px;">
                                                <div class="Polaris-TextField Polaris-TextField--hasValue" style="height:30px;padding-top:2px">
                                                        <input id="offValue" name="off_value" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":Rq6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="" min="1" style="width:300px">
                                                        <div class="Polaris-TextField__Backdrop">
                                                        </div>
                                                </div>
					</div>
                                        <div id="cost_input_field" class="Polaris-Connected" style="justify-content:right;padding-top:14px;padding-right:15px;">
                                                <div class="Polaris-TextField Polaris-TextField--hasValue" style="height:30px;padding-top:2px">
                                                        <input id="input_field" name="reward_cost" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":Rq6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="" min="1" required>
                                                        <div class="Polaris-TextField__Backdrop">
                                                        </div>
                                                </div>
					</div>
                                </div>
                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                        <div class="Polaris-Box" style="--pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-start-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400); --pc-box-width: 100%;">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-align: space-between; --pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <div class="Polaris-Box">
                                                        </div>
                                                        <div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-200); --pc-inline-stack-flex-direction-xs: row;">
                                                                <button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="submit">
                                                                        <span class="">Save Changes</span>
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


<div data-portal-id="modal-:R5eq6:" id="feature_request" style="display:none;">
        <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
                <div role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog" style="position:relative;width:510px;left:25%;">
                        <div class="Polaris-Modal-Dialog__Modal">
                                <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-surface-tertiary); --pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-end-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);">
                                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs: 1fr auto; --pc-inline-grid-gap-xs: var(--p-space-400);">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <h2 style="cursor:default;" class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--break" id=":Req6:">Let us know which reward you want to add!</h2>
                                                </div>
                                                <button onclick="close_popup('feature_request')" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantTertiary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Close" type="button" aria-pressed="false">
                                                        <span class="Polaris-Icon">
                                                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                        <path d="M12.72 13.78a.75.75 0 1 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06l-2.72 2.72-2.72-2.72a.75.75 0 0 0-1.06 1.06l2.72 2.72-2.72 2.72a.75.75 0 1 0 1.06 1.06l2.72-2.72 2.72 2.72Z">
                                                                        </path>
                                                                </svg>
                                                        </span>
                                                </button>
                                        </div>
                                </div>
					<form action="/api/feature_request" method="POST" name="feedback_form" style="margin-bottom:0;" onsubmit="startLoading()">
                                        <div class="Polaris-Connected" style="padding-top:10px;justify-content:center;padding-bottom:10px;">
					<div class="Polaris-Connected" style="width:94%;">
    						<div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
							<div class="Polaris-TextField Polaris-TextField--hasValue Polaris-TextField--multiline">
								<input type="hidden" name="our_passw_token" value="{{$shop->our_passw_token}}">
	 							<textarea autocomplete="off" name="feature_request" class="Polaris-TextField__Input" type="text" rows="4" aria-labelledby=":Rq6:Label" aria-invalid="false" aria-multiline="true" data-1p-ignore="true" data-lpignore="true" data-form-type="other" style="height: 85px;" placeholder="I want to add Free Shipping reward." required=""></textarea>
								<div class="Polaris-TextField__Backdrop">
								</div>
								<div aria-hidden="true" class="Polaris-TextField__Resizer">
									<div class="Polaris-TextField__DummyInput">
	  								<br>
	    								<br>
	      								<br>
									<br>
									</div>
	      							</div>
	   	 					</div>
	  					</div>
					</div>
                                        </div>
                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                        <div class="Polaris-Box" style="--pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-start-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400); --pc-box-width: 100%;">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-align: space-between; --pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <div class="Polaris-Box">
                                                        </div>
                                                        <div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-200); --pc-inline-stack-flex-direction-xs: row;">
                                                                <button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="submit">
                                                                        <span class="">Submit request</span>
                                                                </button>
                                                        </div>
                                                        </form>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <div class="Polaris-Backdrop">
        </div>
</div>


<!-------------------JAVASCRIPT------------------->
<script>
	function shift_toggle_button(id,reward_name)
        {
                startLoading();
                if(document.getElementById(id).checked == true)
		{
			url = "{{my_app_env('APP_URL')}}/enable_or_disable_reward/{{$shop->our_passw_token}}?reward_name="+reward_name+"&status=on";
                        //url = "{{my_app_env('APP_URL')}}/enable_or_disable_reward/{{$shop->our_passw_token}}?reward_name="+reward_name+"&page=page&status=on";
                }
                else
		{
			url = "{{my_app_env('APP_URL')}}/enable_or_disable_reward/{{$shop->our_passw_token}}?reward_name="+reward_name+"&status=off";
                        //url = "{{my_app_env('APP_URL')}}/enable_or_disable_reward/{{$shop->our_passw_token}}?reward_name="+reward_name+"&page=page&status=off";
                }
        
		getRequest(url).then(response => {
        		if (response.ok) {
            			window.location.reload();
        		} 
		});
	}

        function getRequest(url) {
                return fetch(url, {
                method: 'GET',
                });
        }

	function show_feature_request()
	{
		document.getElementById("feature_request").style.display = "block";
		logActivity('opened feature request popup for rewards setup','{{$shop->msd}}');
	}

	/*function BackButtonClick()
        {
                startLoading();
                location.replace("{{my_app_env('APP_URL')}}/home/{{$shop->our_passw_token}}");
	}*/

        function open_edit_popup(reward_name)
        {
                document.getElementById('edit_popup').style.display="block";
                @foreach($rewards as $reward)
			@if($reward['handle'] != "convert_points_to_store_credit")
			if(reward_name == "{{$reward['handle']}}")
			{
				document.getElementById('input_field').value = "{{$reward['cost']}}";
				document.getElementById('heading').innerHTML = "{{$reward['name']}}";
                                @if($reward['handle'] == 'amount_off')
                                
                                        //document.getElementById('heading').innerHTML = "{{$shop->currency_format}}".replace('amount',`{{$reward['name']}}`)+" off";
					document.getElementById('label').innerHTML = "Amount";
					document.getElementById('offValue').value = "{{$reward['amount']}}";
					document.getElementById('offValue').removeAttribute('max');
                                @endif
                               /* else
                                {
                                        document.getElementById('heading').innerHTML = "{{$reward['name']}}";
				}*/
                                if(reward_name == 'amount_off' || reward_name == 'percentage_off')
                                {
                                        document.getElementById('upper_label').style.display = "block";
                                        document.getElementById('offInput').style.display = "block";
                                        document.getElementById('cost_label').style.cssText = "top:46px;position:relative;right:168px;padding-top:16px;width:95px;";
                                        document.getElementById('cost_input_field').style.cssText = "padding-top:10px;width:200px;left:213px;bottom:36px;";
					document.getElementById('offValue').required = "true";
                                }
                                @if($reward['handle'] == 'percentage_off')
                                
                                        document.getElementById('label').innerHTML = "Percentage";
                                        document.getElementById('offValue').value = "{{explode('%',$reward['percent'])[0]}}";
                                        document.getElementById('offValue').max = "100";
                                @endif
                                if(reward_name =='free_shipping')
                                {
                                        document.getElementById('upper_label').style.display = "none";
                                        document.getElementById('offInput').style.display = "none";
                                        document.getElementById('cost_label').style.cssText = "width:95px;position:relative;left:17px;padding-top:19px;";
					document.getElementById('cost_input_field').style.cssText = "padding-top:14px;padding-right:15px;justify-content:right;";
				}
				/*if("page" == "dashboard")
				{
					document.getElementById('myform').action = "{{my_app_env('APP_URL')}}/api/save_updated_costs/{{$shop->our_passw_token}}?reward_name={{$reward['name']}}&page=dashboard";
				}
				else
				{*/
					document.getElementById('myform').action = "{{my_app_env('APP_URL')}}/api/save_updated_costs/{{$shop->our_passw_token}}?reward_name={{$reward['handle']}}";
				//}
				let name = reward_name.replace(/_/g, ' ');
				logActivity(`pressed Edit button for ${name} reward`,'{{$shop->msd}}');
			}
			@endif
                @endforeach
	}

        function close_popup(id)
        {
                document.getElementById(id).style.display="none";
        }

        /*function submit_form()
        {
                startLoading();
	}*/

        /*function select_btn(btn_id)
        {
                document.getElementById(btn_id).style.backgroundColor = "#D3D3D3";

                if(btn_id.includes("enable"))
                {
                        document.getElementById(btn_id.replace('enable','disable')).style.backgroundColor = "white";
                }

                else
                {
                        document.getElementById(btn_id.replace('disable','enable')).style.backgroundColor = "white";
                }
                popupToast("updated");
	}*/

        stopLoading();
</script>
@endsection

