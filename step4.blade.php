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
    	 <progress id="progress_bar" class="Polaris-ProgressBar__Progress" value="64" max="100">
    	 </progress>
    	 <div id="progress_bar_percent" class="Polaris-ProgressBar__Indicator Polaris-ProgressBar__IndicatorAppearActive" style="--pc-progress-bar-duration:500ms;--pc-progress-bar-percent:0.64">
    	 </div>
  	</div>
      </div>
      <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
	<h2 class="Polaris-Text--root Polaris-Text--bodyMd">4/6 Steps: Enable app embed</h2>
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
<div id="warning" class="Polaris-Banner Polaris-Banner--withinPage" style="display:none;margin-top:1rem;" tabindex="0" role="status" aria-live="polite">
  <div class="Polaris-Box" style="--pc-box-border-radius:var(--p-border-radius-300);--pc-box-padding-block-start-xs:var(--p-space-300);--pc-box-padding-block-end-xs:var(--p-space-300);--pc-box-padding-inline-start-xs:var(--p-space-300);--pc-box-padding-inline-end-xs:var(--p-space-300);--pc-box-width:100%">
    <div class="Polaris-InlineStack" style="--pc-inline-stack-align:space-between;--pc-inline-stack-block-align:center;--pc-inline-stack-wrap:nowrap;--pc-inline-stack-flex-direction-xs:row">
      <div class="Polaris-Box" style="--pc-box-width:100%">
        <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align:center;--pc-inline-stack-wrap:nowrap;--pc-inline-stack-gap-xs:var(--p-space-200);--pc-inline-stack-flex-direction-xs:row">
          <div>
            <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-fill-critical);--pc-box-border-radius:var(--p-border-radius-200);--pc-box-padding-block-start-xs:var(--p-space-100);--pc-box-padding-block-end-xs:var(--p-space-100);--pc-box-padding-inline-start-xs:var(--p-space-100);--pc-box-padding-inline-end-xs:var(--p-space-100)">
              <span class="Polaris-Banner--textCriticalOnBgFill">
              <span class="Polaris-Icon">
                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                  <path d="M10 6a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5a.75.75 0 0 1 .75-.75Z">
                  </path>
                  <path d="M11 13a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z">
                  </path>
                  <path fill-rule="evenodd" d="M11.237 3.177a1.75 1.75 0 0 0-2.474 0l-5.586 5.585a1.75 1.75 0 0 0 0 2.475l5.586 5.586a1.75 1.75 0 0 0 2.474 0l5.586-5.586a1.75 1.75 0 0 0 0-2.475l-5.586-5.585Zm-1.414 1.06a.25.25 0 0 1 .354 0l5.586 5.586a.25.25 0 0 1 0 .354l-5.586 5.585a.25.25 0 0 1-.354 0l-5.586-5.585a.25.25 0 0 1 0-.354l5.586-5.586Z">
                  </path>
                </svg>
              </span>
            </span>
            </div>
          </div>
          <div class="Polaris-Box" style="--pc-box-width:100%">
            <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
              <div>
                <span class="Polaris-Text--root Polaris-Text--bodyMd">
                  <p>Enable app embed to continue</p>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div id="enable_app_embed" class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);margin-top:1rem;height:auto;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
    <div style="display:flex;">
    <div>
    <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="cursor:default;">Enable Loyalty Program app embed</h2>
    <div class="Polaris-Box" style="--pc-box-padding-block-start-xs:var(--p-space-200)">
      <p class="Polaris-Text--root Polaris-Text--bodyMd" style="cursor:default;">Enable the app extension to embed it into your store.</p>
      <p class="Polaris-Text--root Polaris-Text--bodyMd" style="cursor:default;">Enabling app embed won't alter your theme, and no residual code will remain upon uninstallation.</p>
      <p class="Polaris-Text--root Polaris-Text--bodyMd" style="margin-top:0.5rem;margin-bottom:0.5rem;cursor:default;"><b>Note:</b> Please remember to click the save button after enabling the app.</p>
	<a style="color:white;text-decoration:none;-webkit-tap-highlight-color: transparent;" href="https://{{$shop->msd}}/admin/themes/current/editor?context=apps&activateAppId={{my_app_env('THEME_EXTENSION_ID')}}/app" target="_blank">
		<button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconWithText" aria-label="Create shipping label" type="button" onclick="update_enable_app_status()">
              		<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Enable app embed</span>
            	</button>
   	</a>
	<p style="margin-top:0.5rem;cursor:default;" class="Polaris-Text--root Polaris-Text--bodyMd">If you no longer wish to have a loyalty program, you can disable the app embed in the theme editor.</p>
    </div>
    </div>
	<img src="https://i.ibb.co/JtR1DXp/loyalty.gif" style="height:263px;"></img>
  </div>
</div>

</form>

<script>

let enable_app_status = false;

function move_to_next_step()
{
	if(enable_app_status == false)
	{
		document.getElementById('warning').style.display = 'block';
		return;
	}
	document.getElementById('next_button_text').innerHTML = "";
	document.getElementById('spinner').style.display = "block";
	let form = document.getElementById('onboarding_form');
	form.action = "{{env('APP_URL')}}/api/save_onboarding_step_details/{{$shop->msd}}/4";
	form.submit();
	startLoading();
}

function update_enable_app_status()
{
	enable_app_status = true;
	document.getElementById('warning').style.display = 'none';
	logActivity('pressed Enable app embed button on onboarding page','{{$shop->msd}}');
}
stopLoading();
</script>
@endsection

