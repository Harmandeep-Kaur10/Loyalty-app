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
    	 <progress id="progress_bar" class="Polaris-ProgressBar__Progress" value="100" max="100">
    	 </progress>
    	 <div id="progress_bar_percent" class="Polaris-ProgressBar__Indicator Polaris-ProgressBar__IndicatorAppearActive" style="--pc-progress-bar-duration:500ms;--pc-progress-bar-percent:1">
    	 </div>
  	</div>
      </div>
      <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-200)">
	<h2 class="Polaris-Text--root Polaris-Text--bodyMd">6/6 Steps: Choose option according to your experience</h2>
      </div>
    </div>
  </div>
</div>

<div id="contact_support" style="display:none;margin-top:1rem;" class="Polaris-Banner Polaris-Banner--withinPage" tabindex="0" role="status" aria-live="polite">
  <div class="Polaris-Box" style="--pc-box-border-radius:var(--p-border-radius-300);--pc-box-padding-block-start-xs:var(--p-space-300);--pc-box-padding-block-end-xs:var(--p-space-300);--pc-box-padding-inline-start-xs:var(--p-space-300);--pc-box-padding-inline-end-xs:var(--p-space-300);--pc-box-width:100%">
    <div class="Polaris-InlineStack" style="--pc-inline-stack-align:space-between;--pc-inline-stack-block-align:center;--pc-inline-stack-wrap:nowrap;--pc-inline-stack-flex-direction-xs:row">
      <div class="Polaris-Box" style="--pc-box-width:100%">
        <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align:center;--pc-inline-stack-wrap:nowrap;--pc-inline-stack-gap-xs:var(--p-space-200);--pc-inline-stack-flex-direction-xs:row">
          <div>
            <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-fill-info);--pc-box-border-radius:var(--p-border-radius-200);--pc-box-padding-block-start-xs:var(--p-space-100);--pc-box-padding-block-end-xs:var(--p-space-100);--pc-box-padding-inline-start-xs:var(--p-space-100);--pc-box-padding-inline-end-xs:var(--p-space-100)">
              <span class="Polaris-Banner--textInfoOnBgFill">
                <span class="Polaris-Icon">
		  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                    <path d="M10 14a.75.75 0 0 1-.75-.75v-3.5a.75.75 0 0 1 1.5 0v3.5a.75.75 0 0 1-.75.75Z">
                    </path>
                    <path d="M9 7a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z">
                    </path>
                    <path fill-rule="evenodd" d="M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Zm-1.5 0a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0Z">
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
		<h2 class="Polaris-Text--root Polaris-Text--headingSm" style="display:inline;">Contact Support by clicking on the widget given in the bottom right corner and clear your queries</h2> 
		  <svg style="transform:rotate(90deg);height:1.25rem;margin-bottom:-5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.228 14.772c-.304-.304-.304-.797 0-1.101l7.113-7.114h-3.993c-.43 0-.779-.348-.779-.778 0-.43.349-.779.779-.779h5.873c.207 0 .405.082.55.228.147.146.229.344.229.55v5.874c0 .43-.349.779-.779.779-.43 0-.779-.35-.779-.78v-3.992l-7.113 7.113c-.304.304-.797.304-1.1 0Z"/></svg>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="Polaris-Banner__DismissIcon">
      <button onclick="document.getElementById('contact_support').style.display = 'none';" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantTertiary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Dismiss notification" type="button">
        <span class="Polaris-Button__Icon">
          <span class="Polaris-Banner__icon--secondary">
	    <span class="Polaris-Icon">
              <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                <path d="M13.97 15.03a.75.75 0 1 0 1.06-1.06l-3.97-3.97 3.97-3.97a.75.75 0 0 0-1.06-1.06l-3.97 3.97-3.97-3.97a.75.75 0 0 0-1.06 1.06l3.97 3.97-3.97 3.97a.75.75 0 1 0 1.06 1.06l3.97-3.97 3.97 3.97Z">
                </path>
              </svg>
            </span>
          </span>
        </span>
      </button>
    </div>
  </div>
</div>
</div>

<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);height:auto;margin-top:1rem;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
    <h2 class="Polaris-Text--root Polaris-Text--headingSm" style="margin-bottom:0.5rem;">Was the widget working as expected in your store?</h2>
<div class="Polaris-LegacyStack Polaris-LegacyStack--vertical">
  <div class="Polaris-LegacyStack__Item">
    <div>
      <label class="Polaris-Choice Polaris-RadioButton__ChoiceLabel" for="disabled">
        <span class="Polaris-Choice__Control">
          <span class="Polaris-RadioButton">
            <input id="disabled" name="button" type="radio" class="Polaris-RadioButton__Input" aria-describedby="disabledHelpText" value="Yes" onclick="submit_form('Yes','App Working')">
            <span class="Polaris-RadioButton__Backdrop">
            </span>
          </span>
        </span>
        <span class="Polaris-Choice__Label">
          <span class="Polaris-Text--root Polaris-Text--bodyMd">Yes, it is working 🥳</span>
        </span>
      </label>
    </div>
  </div>
  <div style="margin-top:0.25rem;" class="Polaris-LegacyStack__Item">
    <div>
      <label class="Polaris-Choice Polaris-RadioButton__ChoiceLabel" for="optional">
        <span class="Polaris-Choice__Control">
          <span class="Polaris-RadioButton">
            <input id="optional" name="button" type="radio" class="Polaris-RadioButton__Input" aria-describedby="optionalHelpText" value="No" onclick="submit_form('No','App not working')">
            <span class="Polaris-RadioButton__Backdrop">
            </span>
          </span>
        </span>
        <span class="Polaris-Choice__Label">
          <span class="Polaris-Text--root Polaris-Text--bodyMd">No, it's not working 😢, I need help.</span>
        </span>
      </label>
    </div>
  </div>
</div>
</div>
</div>
</form>

<script>
function submit_form(button,message)
{
	if(button == 'No')
	{
		document.getElementById('contact_support').style.display = "block";
	}
	else
	{
		startLoading();
	}
	let form = document.getElementById('onboarding_form');
	form.action = "{{env('APP_URL')}}/api/notify_on_telegram/{{$shop->our_passw_token}}/"+message+"/6";
	fetch(form.action, {
    	method: 'POST',
    	body: new FormData(form),
	})
	.then(response => response.json())  
	.then(data => {
    		if (data.status === 'no') {
        		document.getElementById('contact_support').style.display = "block";
    		}
    		else {
        		window.location.href = "/home/{{$shop->our_passw_token}}";
    		}
	});
}

stopLoading();
</script>
@endsection

