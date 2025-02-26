@extends ('shopconnect::shopify_app')

@section ('content')

<style>
.back-button:hover
{
        background-color:gainsboro;
}
</style>
<div style="margin-left:5%;margin-right:5%;">
<div style="display:flex;justify-content:space-between;">
<div style="display:flex;">
<div class="back-button" style="cursor:pointer;border-radius:8px;height:25px;width:29px;" onclick="contextualSaveBar.dispatch(ContextualSaveBar.Action.HIDE); startLoading(); window.location.href='{{my_app_env('APP_URL')}}/rewards_setup/{{$shop->our_passw_token}}';">
<svg style="height:24px;padding-left:2px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.5 10a.75.75 0 0 1-.75.75h-9.69l2.72 2.72a.75.75 0 0 1-1.06 1.06l-4-4a.75.75 0 0 1 0-1.06l4-4a.75.75 0 1 1 1.06 1.06l-2.72 2.72h9.69a.75.75 0 0 1 .75.75Z"/></svg>
</div>
<h2 class="Polaris-Text--root Polaris-Text--headingSm" style="cursor:default;width:20rem;font-size: 21px;margin-left:1%;padding-top:2px;">{{$reward['name']}}</h2>
</div>
<button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--toneCritical" onclick = "document.getElementById('confirm_delete').style.display='block';" type="button">
  <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Delete</span>
</button>
</div>

<form id="myform" action="{{env('APP_URL')}}/api/save_updated_costs/{{$shop->our_passw_token}}?reward_name={{$reward['handle']}}" method="POST">

<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);height:auto;margin-top:1rem;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
<div class="">
  <div class="Polaris-Labelled__LabelWrapper">
    <div class="Polaris-Label">
      <label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text">
        <span class="Polaris-Text--root Polaris-Text--bodyMd">Reward title</span>
      </label>
    </div>
  </div>
  <div class="Polaris-Connected">
    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
      <div class="Polaris-TextField Polaris-TextField--hasValue">
        <input id=":Rq6:" name="updated_reward_name" oninput="showContextualSaveBar()" autocomplete="off" class="Polaris-TextField__Input" type="text" aria-labelledby=":Rq6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['name']}}">
        <div class="Polaris-TextField__Backdrop">
        </div>
      </div>
    </div>
  </div>
  <div class="Polaris-Labelled__HelpText" id=":Rq6:HelpText">
    <span class="Polaris-Text--root Polaris-Text--bodyMd Polaris-Text--break Polaris-Text--subdued">Visible on storefront</span>
  </div>
</div>
</div>
</div>


<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);height:auto;margin-top:1rem;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
    <h2 class="Polaris-Text--root Polaris-Text--headingSm">Set reward</h2>

@if($reward['handle'] == 'free_shipping')
<div class="">
<div class="Polaris-Labelled__LabelWrapper">
   <div class="Polaris-Label">
      <label id=":R2q6:Label" class="Polaris-Label__Text">For X points</label>
   </div>
 </div>
  <div class="Polaris-Connected">
    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
      <div class="Polaris-TextField Polaris-TextField--hasValue">
        <input id=":Rq6:" name="reward_cost" oninput="showContextualSaveBar()" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":Rq6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="{{$reward['cost']}}">
	   <div id="suffix" class="Polaris-TextField__Suffix">
                <span class="Polaris-Text--root Polaris-Text--bodyMd">points</span>
        </div>
	  <div class="Polaris-TextField__Backdrop">
        </div>
      </div>
    </div>
  </div>
</div>    
@else
<div style="display:flex;justify-content:space-between;">
<div class="" style="width:49%;">
    	<div class="Polaris-Labelled__LabelWrapper">
             	<div class="Polaris-Label">
                  	<label id=":R2q6:Label" class="Polaris-Label__Text">For X points</label>
             	</div>
   	</div>
      	<div class="Polaris-Connected">
           	<div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
             		<div class="Polaris-TextField">
                		<input name="reward_cost" oninput="showContextualSaveBar()" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="@if($reward['handle'] == 'convert_points_to_store_credit'){{$reward['points']}}@else{{$reward['cost']}}@endif" required>
                             	<div class="Polaris-TextField__Suffix" id=":Rq6:-Suffix">
                             		<span class="Polaris-Text--root Polaris-Text--bodyMd">points</span>
                             	</div>
                           	<div class="Polaris-TextField__Backdrop">
                               	</div>
                   	</div>
          	</div>
     	</div>
</div>
<div class="" style="width:49%;">
  	<div class="Polaris-Labelled__LabelWrapper">
        	<div class="Polaris-Label">
               		<label id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text">
                       		<span class="Polaris-Text--root Polaris-Text--bodyMd">Customer gets X @if($reward['handle'] == 'percentage_off')% @endif @if($reward['handle'] == 'convert_points_to_store_credit')amount @else discount @endif</span>
                        </label>
          	</div>
     	</div>
      	<div class="Polaris-Connected">
    		<div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
              		<div class="Polaris-TextField">
              			@if($reward['handle'] == 'amount_off' || $reward['handle'] == 'convert_points_to_store_credit')
                               		<div class="Polaris-TextField__Prefix" id=":Rq6:-Prefix">
                                           	<span class="Polaris-Text--root Polaris-Text--bodyMd">{{explode(' ', $shop->currency_format)[0]}}</span>
                                      	</div>
                                @endif
                      		<input name="off_value" oninput="showContextualSaveBar()" autocomplete="off" class="Polaris-TextField__Input" type="number" aria-labelledby=":R2q6:Label" aria-invalid="false" data-1p-ignore="true" data-lpignore="true" data-form-type="other" value="@if($reward['handle'] == 'amount_off' || $reward['handle'] == 'convert_points_to_store_credit'){{$reward['amount']}}@else{{explode('%',$reward['percent'])[0]}}@endif" required>
                      		@if($reward['handle'] == 'percentage_off')
                               		<div class="Polaris-TextField__Suffix" id=":Rq6:-Suffix">
                                           	<span class="Polaris-Text--root Polaris-Text--bodyMd">%</span>
                                      	</div>
                               	@endif
                                     	<div class="Polaris-TextField__Backdrop">
                                      	</div>
                     	</div>
             	</div>
  	</div>
</div>
</div>
@endif

</div>
</div>

<button style="display:none;" id="save_all_updates" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="submit">
  <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Save changes</span>
</button>

</form>

<div id="confirm_delete" style="display:none;" data-portal-id="modal-:R5eq6:" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div>
    <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
      <div>
        <div role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog">
          <div class="Polaris-Modal-Dialog__Modal">
            <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-surface-tertiary); --pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-end-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);">
              <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs: 1fr auto; --pc-inline-grid-gap-xs: var(--p-space-400);">
                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                  <h2 class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--break" style="cursor:default;" id=":Req6:">Confirm delete</h2>
                </div>
                <button onclick="document.getElementById('confirm_delete').style.display='none';" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantTertiary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Close" type="button" aria-pressed="false">
                  <span class="Polaris-Button__Icon">
                    <span class="Polaris-Icon">
                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                        <path d="M12.72 13.78a.75.75 0 1 0 1.06-1.06l-2.72-2.72 2.72-2.72a.75.75 0 0 0-1.06-1.06l-2.72 2.72-2.72-2.72a.75.75 0 0 0-1.06 1.06l2.72 2.72-2.72 2.72a.75.75 0 1 0 1.06 1.06l2.72-2.72 2.72 2.72Z">
                        </path>
                      </svg>
                    </span>
                  </span>
                </button>
              </div>
            </div>
            <div class="Polaris-Modal__Body Polaris-Scrollable Polaris-Scrollable--vertical Polaris-Scrollable--horizontal Polaris-Scrollable--scrollbarWidthThin" data-polaris-scrollable="true">
              <div class="Polaris-Modal-Section">
                <section class="Polaris-Box" style="--pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);cursor:default;">Are you sure you want to delete this reward?</section>
              </div>
            </div>
            <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
              <div class="Polaris-Box" style="--pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-start-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400); --pc-box-width: 100%;">
                <div class="Polaris-InlineStack" style="--pc-inline-stack-align: space-between; --pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                  <div class="Polaris-Box">
                  </div>
                  <div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-200); --pc-inline-stack-flex-direction-xs: row;">
                    <button onclick="document.getElementById('confirm_delete').style.display='none';" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
                      <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Cancel</span>
                    </button>
                    <button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--toneCritical" type="button" onclick="disable_reward(`{{$reward['handle']}}`)">
                      <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Delete</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div aria-live="assertive">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="Polaris-Backdrop">
  </div>
</div>
<div data-portal-id="toast-:Rgq6:" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div class="Polaris-Frame-ToastManager" aria-live="assertive">
  </div>
</div>

</div>

<script>

stopLoading();

function disable_reward(reward_name)
{
	startLoading();
	contextualSaveBar.dispatch(ContextualSaveBar.Action.HIDE);
  	url = "{{my_app_env('APP_URL')}}/enable_or_disable_reward/{{$shop->our_passw_token}}?reward_name="+reward_name+"&status=off";
     	getRequest(url).then(response => {
      	if (response.ok) {
                 	location.replace("{{my_app_env('APP_URL')}}/rewards_setup/{{$shop->our_passw_token}}");
   		}
       	});
}

function getRequest(url) {
	return fetch(url, {
	method: 'GET',
});
}

let ContextualSaveBar = actions.ContextualSaveBar;

var contextualSaveBar = ContextualSaveBar.create(app, {
saveAction: {
	disabled: false,
        loading: false,
},
discardAction: {
        disabled: false,
       	loading: false,
      	discardConfirmationModal: true,
},
});

function showContextualSaveBar(){

        contextualSaveBar.dispatch(ContextualSaveBar.Action.SHOW);

        contextualSaveBar.subscribe(ContextualSaveBar.Action.SAVE, function() {
                contextualSaveBar.set({saveAction: {loading: true}});
		document.getElementById('save_all_updates').click();
                contextualSaveBar.dispatch(ContextualSaveBar.Action.HIDE);
        });


        contextualSaveBar.subscribe(ContextualSaveBar.Action.DISCARD, function() {
                contextualSaveBar.set({discardAction: {loading: true}});
                location.reload();
                contextualSaveBar.dispatch(ContextualSaveBar.Action.HIDE);
        });
}

</script>
@endsection

