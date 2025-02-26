@extends ('shopconnect::shopify_app')

@section ('content')

<style>
	.xyz 
	{
	font-size:13px;
	margin-top: 8px;
	margin-bottom: 8px;
	}

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

	.setup-guide:hover
	{
		background-color:whitesmoke !important;
	}
	.setup-guide
	{
		border-radius:10px;
		margin:0% 1%;
		padding-left:1%;
		margin-bottom:1px;
	}
	.checkbox-wrapper-18 .round 
	{
		position: relative;
		-webkit-tap-highlight-color: transparent;
  	}

  	.checkbox-wrapper-18 .round label {
    		background-color: #fff;
    		border: 2px solid grey;
		border-style: dashed;
    		border-radius: 50%;
    		cursor: pointer;
    		height: 20px;
    		width: 20px;
		display: block;
  	}

	.checkbox-wrapper-18 .round label:hover
	{
		border-style:solid;
	}

  	.checkbox-wrapper-18 .round label:after {
    		border: 2px solid #fff;
    		border-top: none;
    		border-right: none;
    		content: "";
    		height: 5px;
    		left: 6px;
    		opacity: 0;
    		position: absolute;
    		top: 7px;
    		transform: rotate(-45deg);
    		width: 9px;
  	}

  	.checkbox-wrapper-18 .round input[type="checkbox"] {
    		visibility: hidden;
    		display: none;
    		opacity: 0;
  	}

  	.checkbox-wrapper-18 .round input[type="checkbox"]:checked + label {
    		background-color: #1a1a1a;
    		border-color: #8a8a8a;
         	border: 2px solid #ccc;
	}

  	.checkbox-wrapper-18 .round input[type="checkbox"]:checked + label:after {
    		opacity: 1;
	}
	
	#arrow:hover
	{
		background-color:whitesmoke;
	}
	
	.switch 
	{
  		position: relative;
  		display: inline-block;
  		width: 47px;
  		height: 21px;
	}

	.switch input 
	{
  		opacity: 0;
  		width: 0;
  		height: 0;
	}

	.slider 
	{
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
	
	.slider:before 
	{
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

	input:checked + .slider 
	{
  		background-color: #32CD32;
	}

	input:focus + .slider 
	{
  		box-shadow: 0 0 1px #32CD32;
	}

	input:checked + .slider:before 
	{
  		-webkit-transform: translateX(26px);
  		-ms-transform: translateX(26px);
  		transform: translateX(26px);
	}

	.slider.round 
	{
  		border-radius: 34px;
	}

	.slider.round:before 
	{
  		border-radius: 50%;
	}

</style>
{{--/*<!--div class="Polaris-LegacyCard" style="margin-left:11%;margin-right:11%;">
  <div class="Polaris-CalloutCard__Container">
    <div class="Polaris-LegacyCard__Section Polaris-LegacyCard__FirstSectionPadding Polaris-LegacyCard__LastSectionPadding" style="padding:0 0 1% 0;">
      <div class="Polaris-CalloutCard">
	<div class="Polaris-CalloutCard__Content">
	<div onclick="show_setup_guide()">
	<div style="display:flex;justify-content:space-between;padding:2% 2% 0 2%;">
          <div class="Polaris-CalloutCard__Title">
	    <p style="font-size:15px;cursor:default;" class="Polaris-Text--root Polaris-Text--headingSm"><b>Setup guide</b></p>
	  </div>
	    <svg id="arrow" style="-webkit-tap-highlight-color: transparent;transform :rotate(0deg);cursor:pointer;height:25px;border-radius:30%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.24 8.2a.75.75 0 0 1 1.06.04l2.7 2.908 2.7-2.908a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 0 1 .04-1.06Z"/></svg>
	</div>
          <span class="Polaris-Text--root Polaris-Text--bodyMd">
            <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;padding-left:2%;">
              <p style="cursor:default;">Use this personalized guide to get your store up and running.</p>
            </div>
	  </span>

	<span class="Polaris-Tag" aria-disabled="false" style="margin:1% 0 1% 2%;background-color: white;border: 1px solid lightgrey;padding: 4px 8px 4px 8px;">
      		<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--block Polaris-Text--truncate">
        		<span id="onboarding_step" style="cursor:default;font: -webkit-control;" class="Polaris-Tag__Text">{{$count}} / {{$total_steps}} Completed</span>
      		</span>
	</span>
	</div>

<div id="learn_to_get_help" class="setup-guide" style="display:none;background-color:white;">
  <div>
    <div class="Polaris-LegacyCard__Section Polaris-LegacyCard__FirstSectionPadding Polaris-LegacyCard__LastSectionPadding" style="padding-top:1px;padding-bottom:1%;padding-left:0;padding-right:0;margin-top:9px;">
      <div class="Polaris-LegacyStack Polaris-LegacyStack--vertical">
	<div class="Polaris-LegacyStack__Item" style="display:flex;">

	<div class="checkbox-wrapper-18" style="margin-right: 2%;margin-top: 7px;" onmouseover="show_tooltip('checkbox-18',1)" onmouseout="hide_tooltip(1)">
		<div class="round">
			<input type="checkbox" style="-webkit-tap-highlight-color: transparent;" id="checkbox-18" onchange="checkbox_changed('checkbox-18',1)" @if($onboarding_step[1] == "completed") checked @endif />
    			<label for="checkbox-18"></label>
  		</div>
	</div>
	<div id="mark_as_done_1" style="display:none;position:relative;" data-portal-id="tooltip-:r0:" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  	 <div id="tooltip-1" class="Polaris-PositionedOverlay" style="bottom: 22px;width: 103px;left: -48px;">
    	  <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-chevron-x-pos: 31.242188px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
     	    <svg class="Polaris-Tooltip-TooltipOverlay__Tail" width="19" height="11" fill="none">
        	<path d="m0 2 6.967 7.25a3 3 0 0 0 4.243.083L18.829 2h-1.442l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2H0Z" fill="var(--p-color-tooltip-tail-down-border)">
        	</path>
        	<path d="M1.387 0h16v2l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2V0Z" fill="var(--p-color-bg-surface)">
        	</path>
            </svg>
            <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-chevron-x-pos: 78.2421875px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 28.2812px;">
        	<span id="text-1" class="Polaris-Text--root Polaris-Text--bodyMd">Mark as done</span>
      	    </div>
           </div>
         </div>
        </div>
	  <button id="get_help_heading_button" class="button" style="-webkit-tap-highlight-color: transparent;border:0;background:none;padding:0;width:100%;text-align:left;cursor:pointer;" onclick="show_details(0,this.id)" type="button" aria-controls="basic-collapsible" aria-expanded="true">
            <span id="learn_how_to_get_help_heading" style="font:unset;font-weight:200;" class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium heading">Learn how to get help</span>
          </button>
        </div>
        <div style="display:none;margin-top:1%;" class="Polaris-LegacyStack__Item details">
          <div id="basic-collapsible" style="transition-delay:var(--p-motion-duration-0);transition-duration:500ms;transition-timing-function:ease-in-out;max-height:none;overflow:visible" class="Polaris-Collapsible Polaris-Collapsible--expandOnPrint" aria-hidden="false">
	    <div class="Polaris-TextContainer">
              <p style="cursor:default;margin-left:35px;">Contact Support by clicking on the widget shown in bottom right corner and say Hi. If we are online we will reply instantly, if not we take a maximum of 12 hrs to get back to you.
	      </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="setup-guide" style="display:none;background-color:white;">
  <div>
    <div class="Polaris-LegacyCard__Section Polaris-LegacyCard__FirstSectionPadding Polaris-LegacyCard__LastSectionPadding" style="padding-top:1px;padding-bottom:1%;padding-left:0;padding-right:0;">
      <div class="Polaris-LegacyStack Polaris-LegacyStack--vertical">
	<div class="Polaris-LegacyStack__Item" style="display:flex;">
	  
	<div class="checkbox-wrapper-18" style="margin-right: 2%;margin-top: 7px;" onmouseover="show_tooltip('checkbox-18-2',2)" onmouseout="hide_tooltip(2)">
		<div class="round">
			<input type="checkbox" style="-webkit-tap-highlight-color: transparent;" id="checkbox-18-2" onchange="checkbox_changed('checkbox-18-2',2)" @if($onboarding_step[2] == "completed") checked @endif />
    			<label for="checkbox-18-2"></label>
  		</div>
	</div>
	<div id="mark_as_done_2" style="display:none;position:relative;" data-portal-id="tooltip-:r0:" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  	 <div id="tooltip-2" class="Polaris-PositionedOverlay" style="bottom: 22px;width: 103px;left: -48px;">
    	  <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-chevron-x-pos: 31.242188px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
     	    <svg class="Polaris-Tooltip-TooltipOverlay__Tail" width="19" height="11" fill="none">
        	<path d="m0 2 6.967 7.25a3 3 0 0 0 4.243.083L18.829 2h-1.442l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2H0Z" fill="var(--p-color-tooltip-tail-down-border)">
        	</path>
        	<path d="M1.387 0h16v2l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2V0Z" fill="var(--p-color-bg-surface)">
        	</path>
            </svg>
            <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-chevron-x-pos: 78.2421875px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 28.2812px;">
        	<span id="text-2" class="Polaris-Text--root Polaris-Text--bodyMd">Mark as done</span>
      	    </div>
           </div>
         </div>
        </div>
	  <button id="enable_extension_heading_button" class="button" style="-webkit-tap-highlight-color: transparent;border:0;background:none;padding:0;width:100%;text-align:left;cursor:pointer;" onclick="show_details(1,this.id)" type="button" aria-controls="basic-collapsible" aria-expanded="true">
            <span style="font:unset;font-weight:200;" class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium heading">Enable extension</span>
          </button>
        </div>
        <div style="display:none;margin-top:1%;" class="Polaris-LegacyStack__Item details">
          <div id="basic-collapsible" style="transition-delay:var(--p-motion-duration-0);transition-duration:500ms;transition-timing-function:ease-in-out;max-height:none;overflow:visible" class="Polaris-Collapsible Polaris-Collapsible--expandOnPrint" aria-hidden="false">
	    <div class="Polaris-TextContainer"> 
              <p style="cursor:default;margin-left:35px;">Enable the app extension to embed it into your store.
	      </p>
	       <button onclick="enable_button_popup()" style="margin-left:35px;padding-top:1px;padding-bottom:1px;margin-top:10px;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
		<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Enable</span>
               </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div data-portal-id="modal-:R5eq6:" id="enable_button_popup" style="display:none;">
        <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
                <div role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog">
                        <div class="Polaris-Modal-Dialog__Modal" style="min-height:28rem;">
                                <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-surface-tertiary); --pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-end-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);">
                                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs: 1fr auto; --pc-inline-grid-gap-xs: var(--p-space-400);">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <h2 style="cursor:default;" class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--break" id=":Req6:">Embed app</h2>
                                                </div>
                                                <button onclick="enable_button_popup()" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantTertiary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Close" type="button" aria-pressed="false">
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
                                                <label style="padding-left:4%;" id=":Rq6:Label" for=":Rq6:" class="Polaris-Label__Text">Enabling app embed won't alter your theme, and no residual code will remain upon uninstallation.<br><b>Note:</b> Please remember to click the save button after enabling the app.</label>
                                        </div>
                                </div>
                                <br>
				<div style="width:50%;">
                        		<img src="{{my_app_env('APP_URL')}}/extension.gif" style="width:125%;position:relative;left:37%;margin-bottom:10%;"></img>
				</div>
				<div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                        <div class="Polaris-Box" style="--pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-start-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400); --pc-box-width: 100%;">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-align: space-between; --pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <div class="Polaris-Box">
                                                        </div>
							<div class="Polaris-InlineStack" style="--pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-200); --pc-inline-stack-flex-direction-xs: row;">
							<a style="color:white;text-decoration:none;-webkit-tap-highlight-color: transparent;" href="https://{{$shop->msd}}/admin/themes/current/editor?context=apps&activateAppId={{my_app_env('THEME_EXTENSION_ID')}}/app" target="_blank">
                                                                <button onclick="logActivity('pressed Go to theme settings button on dashboard page','{{$shop->msd}}')" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
									<span>Go to theme settings</span>
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


<div class="setup-guide" style="display:none;background-color:white;">
  <div>
    <div class="Polaris-LegacyCard__Section Polaris-LegacyCard__FirstSectionPadding Polaris-LegacyCard__LastSectionPadding" style="padding-top:1px;padding-bottom:1%;padding-left:0;padding-right:0;">
      <div class="Polaris-LegacyStack Polaris-LegacyStack--vertical">
	<div class="Polaris-LegacyStack__Item" style="display:flex;">
	  <div class="checkbox-wrapper-18" style="margin-right: 2%;margin-top: 7px;" onmouseover="show_tooltip('checkbox-18-3',3)" onmouseout="hide_tooltip(3)">
		<div class="round">
                        <input type="checkbox" style="-webkit-tap-highlight-color: transparent;" id="checkbox-18-3" onchange="checkbox_changed('checkbox-18-3',3)" @if($onboarding_step[3] == "completed") checked @endif />
			<label for="checkbox-18-3"></label>
                </div>
	  </div>
	<div id="mark_as_done_3" style="display:none;position:relative;" data-portal-id="tooltip-:r0:" class="p-theme-light Polaris-ThemeProvider--themeContainer">
         <div id="tooltip-3" class="Polaris-PositionedOverlay" style="bottom: 22px;width: 103px;left: -48px;">
          <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-chevron-x-pos: 31.242188px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
            <svg class="Polaris-Tooltip-TooltipOverlay__Tail" width="19" height="11" fill="none">
                <path d="m0 2 6.967 7.25a3 3 0 0 0 4.243.083L18.829 2h-1.442l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2H0Z" fill="var(--p-color-tooltip-tail-down-border)">
                </path>
                <path d="M1.387 0h16v2l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2V0Z" fill="var(--p-color-bg-surface)">
                </path>
            </svg>
            <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-chevron-x-pos: 78.2421875px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 28.2812px;">
                <span id="text-3" class="Polaris-Text--root Polaris-Text--bodyMd">Mark as done</span>
            </div>
           </div>
         </div>
        </div>
	  <button id="enable_activities_heading_button" class="button" style="-webkit-tap-highlight-color: transparent;border:0;background:none;padding:0;width:100%;text-align:left;cursor:pointer;" onclick="show_details(2,this.id)" type="button" aria-controls="basic-collapsible" aria-expanded="true">
            <span style="font:unset;font-weight:200;" class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium heading">Enable activities</span>
          </button>
        </div>
        <div style="display:none;margin-top:1%;" class="Polaris-LegacyStack__Item details">
          <div id="basic-collapsible" style="transition-delay:var(--p-motion-duration-0);transition-duration:500ms;transition-timing-function:ease-in-out;max-height:none;overflow:visible" class="Polaris-Collapsible Polaris-Collapsible--expandOnPrint" aria-hidden="false">
            <div class="Polaris-TextContainer">
              <p style="cursor:default;margin-left:35px;margin-right:3px;">It includes activities that customer can perform in order to earn points.</p>
		<a style="color:white;text-decoration:none;margin-left:35px;-webkit-tap-highlight-color: transparent;" href="{{my_app_env('APP_URL')}}/points_earn_setup/{{$shop->our_passw_token}}?page=onboarding">
               <button style="padding-top:1px;padding-bottom:1px;margin-top:10px;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
                <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Enable Activities</span>
               </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="setup-guide" style="display:none;background-color:white;">
  <div>
    <div class="Polaris-LegacyCard__Section Polaris-LegacyCard__FirstSectionPadding Polaris-LegacyCard__LastSectionPadding" style="padding-top:1px;padding-bottom:1%;padding-left:0;padding-right:0;">
      <div class="Polaris-LegacyStack Polaris-LegacyStack--vertical">
	<div class="Polaris-LegacyStack__Item" style="display:flex;">
	  <div class="checkbox-wrapper-18" style="margin-right: 2%;margin-top: 7px;" onmouseover="show_tooltip('checkbox-18-4',4)" onmouseout="hide_tooltip(4)">
		<div class="round">
                        <input type="checkbox" style="-webkit-tap-highlight-color: transparent;" id="checkbox-18-4" onchange="checkbox_changed('checkbox-18-4',4)" @if($onboarding_step[4] == "completed") checked @endif />
			<label for="checkbox-18-4"></label>
                </div>
	  </div>
	<div id="mark_as_done_4" style="display:none;position:relative;" data-portal-id="tooltip-:r0:" class="p-theme-light Polaris-ThemeProvider--themeContainer">
         <div id="tooltip-4" class="Polaris-PositionedOverlay" style="bottom: 22px;width: 103px;left: -48px;">
          <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-chevron-x-pos: 31.242188px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
            <svg class="Polaris-Tooltip-TooltipOverlay__Tail" width="19" height="11" fill="none">
                <path d="m0 2 6.967 7.25a3 3 0 0 0 4.243.083L18.829 2h-1.442l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2H0Z" fill="var(--p-color-tooltip-tail-down-border)">
                </path>
                <path d="M1.387 0h16v2l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2V0Z" fill="var(--p-color-bg-surface)">
                </path>
            </svg>
            <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-chevron-x-pos: 78.2421875px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 28.2812px;">
                <span id="text-4" class="Polaris-Text--root Polaris-Text--bodyMd">Mark as done</span>
            </div>
           </div>
         </div>
        </div>
	  <button id="enable_rewards_heading_button" class="button" style="-webkit-tap-highlight-color: transparent;border:0;background:none;padding:0;width:100%;text-align:left;cursor:pointer;" onclick="show_details(3,this.id)" type="button" aria-controls="basic-collapsible" aria-expanded="true">
            <span style="font:unset;font-weight:200;" class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium heading">Enable rewards</span>
          </button>
        </div>
        <div style="display:none;margin-top:1%;" class="Polaris-LegacyStack__Item details">
          <div id="basic-collapsible" style="transition-delay:var(--p-motion-duration-0);transition-duration:500ms;transition-timing-function:
ease-in-out;max-height:none;overflow:visible" class="Polaris-Collapsible Polaris-Collapsible--expandOnPrint" aria-hidden="false">
            <div class="Polaris-TextContainer">
              <p style="cursor:default;margin-left:35px;">It includes rewards that customer can redeem using earned points.</p>
		<a style="color:white;text-decoration:none;margin-left:35px;-webkit-tap-highlight-color: transparent;" href="{{my_app_env('APP_URL')}}/rewards_setup/{{$shop->our_passw_token}}?page=onboarding">
               <button style="padding-top:1px;padding-bottom:1px;margin-top:10px;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
                <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Enable Rewards</span>
               </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="setup-guide" style="display:none;background-color:white;">
  <div>
    <div class="Polaris-LegacyCard__Section Polaris-LegacyCard__FirstSectionPadding Polaris-LegacyCard__LastSectionPadding" style="padding-top:1px;padding-bottom:1%;padding-left:0;padding-right:0;">
      <div class="Polaris-LegacyStack Polaris-LegacyStack--vertical">
	<div class="Polaris-LegacyStack__Item" style="display:flex;">
	  <div class="checkbox-wrapper-18" style="margin-right: 2%;margin-top: 7px;" onmouseover="show_tooltip('checkbox-18-5',5)" onmouseout="hide_tooltip(5)">
		<div class="round">
                        <input type="checkbox" style="-webkit-tap-highlight-color: transparent;" id="checkbox-18-5" onchange="checkbox_changed('checkbox-18-5',5)" @if($onboarding_step[5] == "completed") checked @endif />
			<label for="checkbox-18-5"></label>
                </div>
	  </div>

	<div id="mark_as_done_5" style="display:none;position:relative;" data-portal-id="tooltip-:r0:" class="p-theme-light Polaris-ThemeProvider--themeContainer">
         <div id="tooltip-5" class="Polaris-PositionedOverlay" style="bottom: 22px;width: 103px;left: -48px;">
          <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-chevron-x-pos: 31.242188px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
            <svg class="Polaris-Tooltip-TooltipOverlay__Tail" width="19" height="11" fill="none">
                <path d="m0 2 6.967 7.25a3 3 0 0 0 4.243.083L18.829 2h-1.442l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2H0Z" fill="var(--p-color-tooltip-tail-down-border)">
                </path>
                <path d="M1.387 0h16v2l-6.87 6.612a2 2 0 0 1-2.83-.055L1.387 2V0Z" fill="var(--p-color-bg-surface)">
                </path>
            </svg>
            <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-chevron-x-pos: 78.2421875px; --pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 28.2812px;">
                <span id="text-5" class="Polaris-Text--root Polaris-Text--bodyMd">Mark as done</span>
            </div>
           </div>
         </div>
        </div>
	  <button id="customize_widget_heading_button" class="button" style="-webkit-tap-highlight-color: transparent;cursor:pointer;border:0;background:none;padding:0;width:100%;text-align:left;" onclick="show_details(4,this.id)" type="button" aria-controls="basic-collapsible" aria-expanded="true">
            <span style="font:unset;font-weight:200;" class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium heading">Customize widget</span>
          </button>
        </div>
        <div style="display:none;margin-top:1%;" class="Polaris-LegacyStack__Item details">
          <div id="basic-collapsible" style="transition-delay:var(--p-motion-duration-0);transition-duration:500ms;transition-timing-function:
ease-in-out;max-height:none;overflow:visible" class="Polaris-Collapsible Polaris-Collapsible--expandOnPrint" aria-hidden="false">
	    <div class="Polaris-TextContainer">
              <p style="cursor:default;margin-left:35px;">Customize the widget that is to be shown on your store.</p>
		<a style="color:white;text-decoration:none;margin-left:35px;-webkit-tap-highlight-color: transparent;" href="{{my_app_env('APP_URL')}}/customize_widget/{{$shop->our_passw_token}}?page=onboarding">
               <button style="padding-top:1px;padding-bottom:1px;margin-top:10px;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="button">
                <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Customize Widget</span>
               </button>
	      </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
	</div>
	</div>
      </div>
    </div>
  </div-->*/--}}

<!-------------------Data card------------------------->
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); margin-top: 1%; margin-bottom: 1%;margin-left:11%;margin-right:11%;">
        <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:1%;">

<div style="display: flex; gap:1%;">
		<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); width: 100%;">
                <div id="customers_div" onmouseover="display_on_hover('customers_enrolled',this.id)" onmouseout="display_on_hover('customers_enrolled',this.id)" class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:4%;background-color:white;cursor:pointer;-webkit-tap-highlight-color: transparent;">
<div style="display:flex;">
			<svg xmlns="http://www.w3.org/2000/svg" style="height:16px;position:relative;top:2px;" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-2 3.5a2 2 0 1 1 4 0 2 2 0 0 1-4 0Z"/><path fill-rule="evenodd" d="M15.484 14.227a6.274 6.274 0 0 0-10.968 0l-.437.786a1.338 1.338 0 0 0 1.17 1.987h9.502a1.338 1.338 0 0 0 1.17-1.987l-.437-.786Zm-9.657.728a4.773 4.773 0 0 1 8.346 0l.302.545h-8.95l.302-.545Z"/></svg>
			<p style="font-size:13px;cursor:pointer;border-bottom: 2px dotted lightgrey;text-decoration: none;"><b>Customers Enrolled</b></p>
</div>
                        <p style="font-size:15px; margin-left:13px;margin-top: 4px;cursor:pointer;"><b>{{$shop->total_customers}}</b></p>
                </div>
	</div>
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); width:100%;">
                <div id="revenue_div" onmouseover="display_on_hover('total_revenue',this.id)" onmouseout="display_on_hover('total_revenue',this.id)" class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:4%;background-color:white;cursor:pointer;-webkit-tap-highlight-color: transparent;">
<div style="display:flex;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" style="height:17px;position:relative;top:1px;"><path d="M9.5 6.5a.75.75 0 0 1 1.5 0v.25h.75a.75.75 0 0 1 0 1.5h-2.25a.5.5 0 0 0 0 1h1a2 2 0 1 1 0 4v.25a.75.75 0 0 1-1.5 0v-.25h-.75a.75.75 0 0 1 0-1.5h2.25a.5.5 0 0 0 0-1h-1a2 2 0 1 1 0-4v-.25Z"/><path fill-rule="evenodd" d="M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Zm-1.5 0a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0Z"/></svg>
                        <p style="font-size:13px;cursor:pointer;border-bottom: 2px dotted lightgrey;text-decoration: none;"><b>Total Revenue</b></p>
</div>
                        <p style="font-size:15px; margin-left:17px;margin-top: 4px;cursor:pointer;"><b>{{$shop->total_revenue}}</b></p>
                </div>
        </div>
        <div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); width:100%;">
                <div id="rewards_div" onmouseover="display_on_hover('rewards_claimed',this.id)" onmouseout="display_on_hover('rewards_claimed',this.id)" class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;padding:4%;--pc-box-padding-inline-end-xs:var(--p-space-400);background-color:white;cursor:pointer;-webkit-tap-highlight-color: transparent;">
<div style="display:flex;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" style="height:17px;position:relative;top:2px;"><path fill-rule="evenodd" d="M8.654 14.33a2.084 2.084 0 0 1-.41-.48.568.568 0 0 0-.61-.252c-.219.05-.435.065-.643.048l-.935 1.604h.56a1 1 0 0 1 .832.445l.244.366.962-1.732Zm-3.011-1.349a2.048 2.048 0 0 1-.49-1.866.568.568 0 0 0-.253-.61 2.068 2.068 0 0 1 0-3.51.568.568 0 0 0 .253-.61 2.068 2.068 0 0 1 2.482-2.482.568.568 0 0 0 .61-.253c.81-1.3 2.7-1.3 3.51 0a.568.568 0 0 0 .61.253 2.068 2.068 0 0 1 2.482 2.482.567.567 0 0 0 .253.61c1.3.81 1.3 2.7 0 3.51a.567.567 0 0 0-.252.61 2.047 2.047 0 0 1-.44 1.81l1.353 2.321a1 1 0 0 1-.864 1.504h-1.227l-.478.782a1 1 0 0 1-1.72-.025l-1.457-2.539-1.41 2.538a1 1 0 0 1-1.706.069l-.55-.825h-1.164a1 1 0 0 1-.863-1.504l1.32-2.265Zm6.71 3.048-.986-1.718a2.09 2.09 0 0 0 .388-.46.567.567 0 0 1 .61-.254c.247.058.49.07.721.041l.94 1.612h-.636a1 1 0 0 0-.853.478l-.184.301Zm-1.871-2.972a.568.568 0 0 1-.964 0 2.068 2.068 0 0 0-2.223-.92.568.568 0 0 1-.681-.682c.2-.862-.17-1.756-.921-2.223a.568.568 0 0 1 0-.964 2.068 2.068 0 0 0 .92-2.223.568.568 0 0 1 .682-.681c.862.2 1.756-.17 2.223-.921a.568.568 0 0 1 .964 0 2.067 2.067 0 0 0 2.223.92.568.568 0 0 1 .681.682c-.2.862.17 1.756.921 2.223a.568.568 0 0 1 0 .964 2.068 2.068 0 0 0-.92 2.223.568.568 0 0 1-.682.681c-.862-.2-1.755.17-2.223.921Z"/></svg>
                        <p style="font-size:13px;cursor:pointer;border-bottom: 2px dotted lightgrey;text-decoration: none;"><b>Rewards Claimed</b></p>
</div>
                        <p style="font-size:15px; margin-left:17px;margin-top: 4px;cursor:pointer;"><b>{{$shop->total_rewards_claimed}}</b></p>
                </div>
        </div>
     </div>
  </div>
</div>

<div data-portal-id="tooltip-:r0:" id="customers_enrolled" style="display:none;" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div class="Polaris-PositionedOverlay data-tooltips" style="top: 12%; left: 16.8%;">
    <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);height:90px;">
      <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 48.2812px;position:relative;height:90px;">
	<p class="Polaris-Text--root Polaris-Text--bodyMd"><b>Customers enrolled</b></p>
        <span class="Polaris-Text--root Polaris-Text--bodyMd">It displays total number of customers enrolled into your store through this app.</span>
      </div>
    </div>
  </div>
</div>

<div data-portal-id="tooltip-:r0:" id="total_revenue" style="display:none;" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div class="Polaris-PositionedOverlay data-tooltips" style="top: 12%; left: 41.7%;">
    <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);height:90px;">
      <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 48.2812px;position:relative;">
        <p class="Polaris-Text--root Polaris-Text--bodyMd"><b>Total Revenue</b></p>
        <span class="Polaris-Text--root Polaris-Text--bodyMd">It includes revenue of all the orders on which customers have applied your rewards.</span>
      </div>
    </div>
  </div>
</div>

<div data-portal-id="tooltip-:r0:" id="rewards_claimed" style="display:none;" class="p-theme-light Polaris-ThemeProvider--themeContainer">
  <div class="Polaris-PositionedOverlay data-tooltips" style="top: 12%; left:66.7%;">
    <div class="Polaris-Tooltip-TooltipOverlay Polaris-Tooltip-TooltipOverlay--measured Polaris-Tooltip-TooltipOverlay--instant Polaris-Tooltip-TooltipOverlay--positionedAbove" data-polaris-layer="true" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200);">
      <div id=":Rq6:" role="tooltip" class="Polaris-Tooltip-TooltipOverlay__Content Polaris-Tooltip-TooltipOverlay--default" style="--pc-tooltip-border-radius: var(--p-border-radius-200); --pc-tooltip-padding: var(--p-space-100) var(--p-space-200); min-height: 48.2812px;position:relative;">
        <p class="Polaris-Text--root Polaris-Text--bodyMd"><b>Rewards Claimed</b></p>
        <span class="Polaris-Text--root Polaris-Text--bodyMd">It displays total number of rewards, such as free shipping, claimed by customers on your store.</span>
      </div>
    </div>
  </div>
</div>
<!-----------------------Loyalty program Status card---------------------->
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);margin-left:11%;margin-right:11%;height:fit-content;margin-top:10px;margin-bottom:10px;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
    <h2 style="cursor:default;" class="Polaris-Text--root Polaris-Text--headingSm">Loyalty Program Status</h2>
  <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs:1fr auto">
    <h2 class="Polaris-Text--root Polaris-Text--bodyMd" style="padding-top:7px;cursor:default;">Keep it enabled in order to make widget visible on your store. Also remember to follow the above given setup guide to complete your onboarding.</h2>
    <div style="height:0px;" class="Polaris-ButtonGroup Polaris-ButtonGroup--variantSegmented" data-buttongroup-variant="segmented">
       <div class="Polaris-ButtonGroup__Item">
           <label class="switch" onclick="shift_toggle_button('toggle_button')">
                <a href="{{my_app_env('APP_URL')}}/enable_or_disable_app_status/{{$shop->our_passw_token}}" style="-webkit-tap-highlight-color: transparent;">
                        <input id="toggle_button" type="checkbox" @if($app_data['app_status'] == "on") checked @endif>
                        <span class="slider round"></span>
                </a>
          </label>
        </div>
      </div>
   </div>
  </div>
</div>
<!-----------------------Contact support----------------->
<div class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32; --pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300); margin-top: 1%;margin-left:11%;margin-right:11%;">
        <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400)">
                <p style="font-size:15px;font-weight:500;cursor:default;padding-bottom:10px;" class="Polaris-Text--root Polaris-Text--bodyMd"><b>Contact Us for Questions, Feedback and Support.</b></p>

                <p style="cursor:default;" class="xyz Polaris-Text--root Polaris-Text--bodyMd">We welcome your questions, feedback and support.</p>
                <p style="cursor:default;" class="xyz Polaris-Text--root Polaris-Text--bodyMd">Contact Us at <b>evagreenehere@gmail.com</b></p>
                <p style="cursor:default;margin-bottom:0;" class="xyz Polaris-Text--root Polaris-Text--bodyMd">Your input matters and we're dedicated to improving your experience.</p>
</div>
</div>

<button style="margin-bottom:1%;margin-top:1%;margin-left:11%;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--toneCritical" onclick="show_uninstall_popup()"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Uninstall the App</span></span></button>
<script>
	function shift_toggle_button(id)
        {
                startLoading();
                if(document.getElementById(id).checked == true)
                {
                        document.getElementById(id).checked = false;
                }
                else
                {
                        document.getElementById(id).checked = true;
                }
        }

	function show_uninstall_popup()
	{
		document.getElementById('uninstallReason').style.display = "block";
		logActivity('pressed Uninstall the App button','{{$shop->msd}}');
	}

	/*function show_tooltip(input_id,element)
	{
		document.getElementById('mark_as_done_'+element).style.display = "block";
		if(document.getElementById(input_id).checked)
		{
			document.getElementById('text-'+element).innerHTML = "Mark as not done";
			document.getElementById('tooltip-'+element).style.width = "125px";
		}
		else
		{
			document.getElementById('text-'+element).innerHTML = "Mark as done";			
       	               	document.getElementById('tooltip-'+element).style.width = "103px";
		}
	}

	function hide_tooltip(element)
	{
		document.getElementById('mark_as_done_'+element).style.display = "none";
	}

	let completed_steps = $count;
	async function checkbox_changed(input_id,element)
	{
		show_tooltip(input_id,element);
		url  = "{{env('APP_URL')}}/api/change_onboarding_step_state/{{$shop->msd}}/"+element;
                await fetch(url, {
		method: "post",
		}).then(r => r.json()).then(data => {
                if(data['res'])
		{
			if(data['res'] == "1")
			{
				completed_steps += 1;
				document.getElementById('onboarding_step').innerHTML = completed_steps+" / "+$total_steps+" Completed";
			}
			else
			{
				completed_steps -= 1;
				document.getElementById('onboarding_step').innerHTML = completed_steps+" / "+$total_steps+" Completed";
			}
		}
		});
	}*/

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

	/*function show_setup_guide()
	{
		if(document.getElementById('arrow').style.transform == "rotate(0deg)")
		{
			document.getElementById('arrow').style.transform = "rotate(180deg)";
		}
		else
		{
			document.getElementById('arrow').style.transform = "rotate(0deg)";
		}
		let elements = document.getElementsByClassName("setup-guide");
                for(let i=0; i<elements.length; i++)
		{

			if(elements[i].style.display == "none")
			{
				elements[i].style.display = "block";
			}
			else
			{
				elements[i].style.display = "none"
			}
		}

		let count = 0;
		let details = document.getElementsByClassName("details");
                for(let a=0; a<details.length; a++)
                {
                        if(details[a].style.display == "block")
                        {
                                count++;
                        }
		}
		if(count == 0)
              	{
			details[0].style.display = "block";
			document.getElementById('learn_to_get_help').style.backgroundColor = "rgba(243,243,243,1)";
			document.getElementById('learn_how_to_get_help_heading').style.fontWeight = "bold";
			document.getElementById('get_help_heading_button').style.cursor = "default";
		}

		let tooltip = document.getElementsByClassName("data-tooltips");
		for(let q=0; q<tooltip.length;q++)
		{
			if(tooltip[q].style.top == "81%")
			{
				tooltip[q].style.top = "34%";
			}
			else
			{
				tooltip[q].style.top = "81%";
			}
		}
	}

	function show_details(heading_number,button_id)
	{
		let buttons = document.getElementsByClassName("button");
                for(let b=0; b<buttons.length; b++)
		{
			buttons[b].style.cursor = "pointer";
		}
		document.getElementById(button_id).style.cursor = "default";

		let elements = document.getElementsByClassName("details");
                for(let i=0; i<elements.length; i++)
		{
			if(i != heading_number)
			{
                        	elements[i].style.display = "none";
			}
			else
			{
                             	elements[i].style.display = "block";
			}
                }

		let arr = document.getElementsByClassName("heading");
                for(let j=0; j<arr.length; j++)
                {
                        if(j != heading_number)
                        {
                                arr[j].style.fontWeight = "200";
                        }
                        else
                        {
                         	arr[j].style.fontWeight = "bold";
                        }
                }

		let elem = document.getElementsByClassName("setup-guide");
                for(let k=0; k<elem.length; k++)
                {
                        if(k != heading_number)
                        {
                                elem[k].style.backgroundColor = "white";
			}
			else
			{
				elem[k].style.backgroundColor = "rgba(243,243,243,1)";
			}
                }
	}

	function enable_button_popup()
	{
		if(document.getElementById('enable_button_popup').style.display == "none")
		{
			document.getElementById('enable_button_popup').style.display = "block";
			logActivity('pressed Enable button on dashboard page', '{{$shop->msd}}');
		}
		else
		{
			document.getElementById('enable_button_popup').style.display = "none";
		}
	}
	*/
	stopLoading();
	//show_setup_guide();
</script>
@endsection
