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
    	 <progress id="progress_bar" class="Polaris-ProgressBar__Progress" value="80" max="100">
    	 </progress>
    	 <div id="progress_bar_percent" class="Polaris-ProgressBar__Indicator Polaris-ProgressBar__IndicatorAppearActive" style="--pc-progress-bar-duration:500ms;--pc-progress-bar-percent:0.80">
    	 </div>
  	</div>
      </div>
      <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
	<h2 class="Polaris-Text--root Polaris-Text--bodyMd">5/6 Steps: Preview widget on your store</h2>
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


<div class="Polaris-LegacyCard" style="margin-top:1rem;">
  <div class="Polaris-CalloutCard__Container">
    <div class="Polaris-LegacyCard__Section Polaris-LegacyCard__FirstSectionPadding Polaris-LegacyCard__LastSectionPadding">
      <div class="Polaris-CalloutCard">
        <div class="Polaris-CalloutCard__Content">
          <div class="Polaris-CalloutCard__Title">
            <h2 class="Polaris-Text--root Polaris-Text--headingSm">🎉 Hooray! You're All Set!</h2>
          </div>
          <span class="Polaris-Text--root Polaris-Text--bodyMd">
            <div class="Polaris-BlockStack" style="--pc-block-stack-order:column">
              <p>Let's see how it looks on your store. Click the Preview button to check it out in action!</p>
            </div>
          </span>
	  <div class="Polaris-CalloutCard__Buttons">
	    <a style="color:white;text-decoration:none;-webkit-tap-highlight-color: transparent;" href="https://{{$shop->msd}}" target="_blank">
      		<button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button" onclick="logActivity('pressed Preview button on onboarding Step5','{{$shop->msd}}')">
        	  <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Preview</span>
      		</button>
           </a>
          </div>
        </div>
        <img alt="" src="https://cdn.shopify.com/s/assets/admin/checkout/settings-customizecart-705f57c725ac05be5a34ec20c05b94298cb8afd10aac7bd9c7ad02030f48cfa0.svg" class="Polaris-CalloutCard__Image">
        </div>
      </div>
    </div>
  </div>

</form>

<script>
function move_to_next_step()
{
	document.getElementById('next_button_text').innerHTML = "";
	document.getElementById('spinner').style.display = "block";
	let form = document.getElementById('onboarding_form');
	form.action = "{{env('APP_URL')}}/api/save_onboarding_step_details/{{$shop->msd}}/5";
	form.submit();
	startLoading();
}
stopLoading();
</script>
@endsection

