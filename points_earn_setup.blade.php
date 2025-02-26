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

#back_button:hover{
        background-color:gainsboro;
}

</style>
<div style="margin-left:11%;margin-right:11%;">
<div style="display:flex;justify-content:space-between;">
{{--@if($page == "onboarding")
<div id="back_button" style="cursor:pointer;border-radius:8px;margin-top:10px;" onClick="BackButtonClick()">
<svg style="height:27px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.5 10a.75.75 0 0 1-.75.75h-9.69l2.72 2.72a.75.75 0 0 1-1.06 1.06l-4-4a.75.75 0 0 1 0-1.06l4-4a.75.75 0 1 1 1.06 1.06l-2.72 2.72h9.69a.75.75 0 0 1 .75.75Z"/></svg>
</div>
@endif--}}
<button id="feature_request_button" onclick='show_feature_request()' class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPlain Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" aria-label="Add variant" type="button"
	{{--@if($page == "onboarding")
                style="margin-top: 0.5rem;"
        @endif--}}>
        <span class="">Want to add ways to earn points?</span>
</button>
</div>
<!--------------------ACTIVITY CARDS------------------------>
@php($i = 1)
@foreach($activities as $activity)
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); margin-bottom: 10px;margin-top:10px;">
        <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:20%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
		<div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
			<div class="Polaris-InlineGrid" style="display:flex;justify-content:space-between;">
				<div style="display:flex;">
				<h2 style="cursor:default;margin-right:20px;" class="Polaris-Text--root Polaris-Text--headingSm">{{$activity['name']}}</h2>
				@if($activity['state'] == 1)
				 <span class="Polaris-Badge Polaris-Badge--toneSuccess" style="width:3.1rem;">
                                        <span class="Polaris-Text--root Polaris-Text--visuallyHidden">Success</span>
                                        <span style="cursor:default;" class="Polaris-Text--root Polaris-Text--bodySm">Active</span>
				</span>
				@endif
				@if($activity['state'] == 0)
				<span class="Polaris-Badge Polaris-Badge--toneWarning" style="width:3.5rem;">
      					<span class="Polaris-Text--root Polaris-Text--visuallyHidden">Warning</span>
      					<span style="cursor:default;" class="Polaris-Text--root Polaris-Text--bodySm">Inactive</span>
				</span>
				@endif
				</div>
				@if($activity['handle'] != "refer_a_friend")
                                <button style="justify-content:end;" onclick='open_edit_popup("{{$activity['handle']}}")' class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPlain Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" aria-label="Add variant" type="button">
                                        <span class="">Edit</span>
				</button>
				@endif
			</div>
			@if($activity['handle'] != "refer_a_friend")
			<p style="cursor:default;" class="Polaris-Text--root Polaris-Text--bodyMd">Points: {{$activity['points']}}@if($activity['handle'] == 'make_a_purchase' && $activity['type'] == 'Percentage')% of order amount @endif</p>
			@endif
                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs:1fr auto">
                                <p style="cursor:default;margin-right:1rem;" class="Polaris-Text--root Polaris-Text--bodyMd">Description: {{$activity['description']}}</p>
                                <div style="height:0px;" class="Polaris-ButtonGroup Polaris-ButtonGroup--variantSegmented" data-buttongroup-variant="segmented">
					<div class="Polaris-ButtonGroup__Item">
						<label class="switch">
							<input id="toggle{{$i}}" onchange="shift_toggle_button('toggle{{$i}}',`{{$activity['handle']}}`)" type="checkbox" @if($activity['state'] == 1) checked @endif >
  							<span class="slider round"></span>
						</label>
                                        </div>
                                </div>
			</div>
			@if($activity['handle'] == 'refer_a_friend' && $activity['state'] == 1)	
			<form method="POST" action="{{my_app_env('APP_URL')}}/api/save_updated_refer_friend_activity_points/{{$shop->our_passw_token}}" onsubmit="startLoading()">
			<div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs:1fr 1fr">	
				<div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-400)">
                    		  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                      		    <div class="">
                        		<div class="Polaris-Labelled__LabelWrapper">
                          		  <div class="Polaris-Label">
                            		  @csrf
                            			<label id=":R2q6:Label" class="Polaris-Label__Text"><strong>Reward for referrer</strong></label>
                          		  </div>
                        		</div>
                        		<div class="Polaris-Connected" style="width:92%;">
                          		  <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
					    <div class="Polaris-TextField">
                                		<input name="referrer_reward" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$activity['referrer_reward']}}" required>
						<div class="Polaris-TextField__Suffix" id=":Rq6:-Suffix">
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

				<div class="">
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
						<div class="Polaris-TextField__Suffix" id=":Rq6:-Suffix">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">%</span>
                                                </div>
                              			<div class="Polaris-TextField__Backdrop">
                              			</div>
                            		    </div>
                          	    </div>
  			         </div>
			      </div>
			</div>
				{{--<!--input name="page" type="hidden" @if($page == "onboarding") value="onboarding" @else value="navigation" @endif-->--}}
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
<!--------------------------EDIT POPUP------------------->
<div data-portal-id="modal-:R5eq6:" id="edit_popup" style="display:none;">
        <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
                <div role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog" style="position:relative;width:430px;left:25%;">
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
                        	<form id="myform" name="update_points" style="margin-bottom:0;" action="" method="POST" onsubmit="startLoading()">
                                <div id="popup_for_visit_and_create_account_activity" class="" style="display:flex;justify-content:space-between;margin-bottom:2%;">
                                        <div class="Polaris-Labelled__LabelWrapper" style="position:relative;left:18px;padding-top:16px">
                                                <label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text">Points</label>
                                        </div>
                                        <div class="Polaris-Connected" style="padding-top:10px;padding-right:15px;">
                                                <div class="Polaris-TextField Polaris-TextField--hasValue">
                                                                <input id="input_field" name="activity_points" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":Rq6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" min="1" value="" required>
                                                                <div class="Polaris-TextField__Backdrop">
                                                                </div>
                                                </div>
                                        </div>
				</div>
				<div id="popup_for_purchase_activity" class="Polaris-InlineGrid" style="margin-bottom:2%;margin-top:1%;">
                                <div class="Polaris-BlockStack" style="margin-left:4%;">
                                  <div class="Polaris-FormLayout__Item Polaris-FormLayout--grouped">
                                    <div class="">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                          <div class="Polaris-Label">
                                          @csrf
                                                <label id=":R2q6:Label" class="Polaris-Label__Text"><strong>Type</strong></label>
                                          </div>
                                        </div>
                                        <div class="Polaris-Select" style="width:89%;">
    					<select id="reward_type" name="purchase_reward_type" onchange="change_purchase_activity_reward_type()" class="Polaris-Select__Input" aria-invalid="false">
      						<option value="Fixed" selected="">Fixed</option>
      						<option value="Percentage">Percentage</option>
					</select>
    					<div class="Polaris-Select__Content" aria-hidden="true">
      						<span id="display_reward_type" class="Polaris-Select__SelectedOption">Fixed</span>
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
				<div class="">
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label">
                                        <label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text">
                                                <span class="Polaris-Text--root Polaris-Text--bodyMd"><strong>Points</strong></span>
                                        </label>
                                    </div>
                                  </div>
                                  <div class="Polaris-Connected" style="width:92%;">
                                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                            <div class="Polaris-TextField">
						<input id="purchase_activity_input" name="purchase_reward" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="" required>
						<div class="Polaris-TextField__Suffix" id="percentage_suffix" style="display:none;">
                                                        <span class="Polaris-Text--root Polaris-Text--bodyMd">%</span>
                                                </div>
                                                <div class="Polaris-TextField__Backdrop">
                                                </div>
                                            </div>
                                        </div>
                                  </div>                                  
                              </div>
			</div>
			<span id="description" style="display:none;margin-left:1rem;margin-bottom:0.5rem;"></span>
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
</form>
        <div class="Polaris-Backdrop">
        </div>
</div>
<!------------------FEATURE REQUEST------------------------------>
<div data-portal-id="modal-:R5eq6:" id="feature_request" style="display:none;">
        <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
                <div role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog" style="position:relative;width:510px;left:25%;">
                        <div class="Polaris-Modal-Dialog__Modal">
                                <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-surface-tertiary); --pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-end-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);">
                                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs: 1fr auto; --pc-inline-grid-gap-xs: var(--p-space-400);">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <h2 style="cursor:default;" class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--break" id=":Req6:">Let us know which activity you want to add!</h2>
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
                                                                <textarea autocomplete="off" name="feature_request" class="Polaris-TextField__Input" type="text" rows="4" aria-labelledby=":Rq6:Label" aria-invalid="false" aria-multiline="true" data-1p-ignore="true" data-lpignore="true" data-form-type="other" style="height: 85px;" placeholder="I want to add Visit activity." required=""></textarea>
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


<!-----------------------JAVASCRIPT--------------->
<script>       
	function shift_toggle_button(id,activity_name)
	{
		startLoading();
		if(document.getElementById(id).checked == true)
		{
			//url = "{{my_app_env('APP_URL')}}/enable_or_disable_activity/{{$shop->our_passw_token}}/"+activity_name+"?page=$page&status=on";
			url = "{{my_app_env('APP_URL')}}/enable_or_disable_activity/{{$shop->our_passw_token}}/"+activity_name+"?status=on";
		}
		else
		{
			//url = "{{my_app_env('APP_URL')}}/enable_or_disable_activity/{{$shop->our_passw_token}}/"+activity_name+"?page=$page&status=off";
			url = "{{my_app_env('APP_URL')}}/enable_or_disable_activity/{{$shop->our_passw_token}}/"+activity_name+"?status=off";
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
		logActivity('opened feature request popup for points earn setup','{{$shop->msd}}');
	}

	/*function BackButtonClick()
        {
                startLoading();
                location.replace("{{my_app_env('APP_URL')}}/home/{{$shop->our_passw_token}}");
	}*/

	function change_purchase_activity_reward_type()
	{
		let type = document.getElementById('reward_type').value;
		document.getElementById('display_reward_type').innerHTML = type;
		if(type == 'Percentage')
		{
			document.getElementById('description').innerHTML = "The customer will receive points equal to the specified percentage of the total order amount.";
			document.getElementById('percentage_suffix').style.display = "block";
		}
		else
		{
			document.getElementById('description').innerHTML = "The customer will receive specified points on placing order.";
			document.getElementById('percentage_suffix').style.display = "none";
		}
	}

        function open_edit_popup(activity_name)
        {
                document.getElementById("edit_popup").style.display="block";

		@foreach($activities as $activity)
			@if($activity['handle'] != "refer_a_friend")
                        if(activity_name == "{{$activity['handle']}}")
			{
				@if($activity['handle'] == 'make_a_purchase')
				{
					document.getElementById('input_field').required = false;
					document.getElementById('popup_for_visit_and_create_account_activity').style.display = 'none';
					document.getElementById('popup_for_purchase_activity').style.display = 'flex';
					document.getElementById('purchase_activity_input').value = "{{$activity['points']}}";
					document.getElementById('reward_type').value = "{{$activity['type']}}";
					document.getElementById('display_reward_type').innerHTML = "{{$activity['type']}}";
					document.getElementById('description').style.display = "block";
					if("{{$activity['type']}}" == 'Percentage')
					{
						document.getElementById('description').innerHTML = "The customer will receive points equal to the specified percentage of the total order amount.";	
						document.getElementById('percentage_suffix').style.display = "block";
					}
					else
					{
						document.getElementById('description').innerHTML = "The customer will receive specified points on placing order.";
					}
				}
				@else
				{
					document.getElementById('description').style.display = "none";
					document.getElementById('purchase_activity_input').required = false;
					document.getElementById('popup_for_visit_and_create_account_activity').style.display = 'flex';
                                        document.getElementById('popup_for_purchase_activity').style.display = 'none';
					document.getElementById('input_field').value = "{{$activity['points']}}";
				}
				@endif
				document.getElementById('heading').innerHTML = "{{$activity['name']}}";
				/*if("$page" == "onboarding")
				{
                                	document.getElementById('myform').action = "{{my_app_env('APP_URL')}}/api/save_updated_points/{{$shop->our_passw_token}}/{{$activity['name']}}?page=onboarding";
				}
				else
				{
					document.getElementById('myform').action = "{{my_app_env('APP_URL')}}/api/save_updated_points/{{$shop->our_passw_token}}/{{$activity['name']}}?page=navigation";
				}*/
				document.getElementById('myform').action = "{{my_app_env('APP_URL')}}/api/save_updated_points/{{$shop->our_passw_token}}/{{$activity['handle']}}";
				logActivity(`pressed Edit button for {{$activity['name']}} activity`,'{{$shop->msd}}');
			}
			@endif
		@endforeach
        }

        function close_popup(id)
        {
                document.getElementById(id).style.display="none";
        }

        stopLoading();
</script>
@endsection

