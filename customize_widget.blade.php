@extends ('shopconnect::shopify_app')

@section ('content')

@php($data = $app_data['customization'])

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
	#label_for_color:hover
	{
		background-color:whitesmoke;
	}
	.radiobox 
	{
  		position: relative;
  		width: 8.5vw;
		height: 7vh;
		margin-top:0.5rem;
  		margin-right:0.3rem;
  		border-radius:10px;
  		border: 1px solid lightgrey;
  		display: flex;
  		justify-content: center;
  		align-items: center;
  		display: inline-block;
	}

	input[type="radio"] 
	{
  		appearance: none;
	}

	input[type="radio"] + label 
	{
  		position: absolute;
		width: 8.1vw;
		font-size:2.4vh;
  		height: 6.3vh;
  		top: 0;
  		left: 0;
  		display: flex;
  		align-items: center;
  		justify-content: center;
  		cursor:pointer;
	}

	input[type="radio"]:checked + label 
	{
  		border-radius:10px;
  		cursor:pointer;
  		background: whitesmoke;
	}
		
	input[type="color"]::-webkit-color-swatch-wrapper 
	{
		padding: 0.2rem;
	}

	.suPPort
	{
		display:none;
	}
	#customize{
  		overflow-y: scroll;  /* Enable vertical scrolling */
  		scrollbar-width: thin;  /* For Firefox */
  		scrollbar-color: transparent transparent;  /* For Firefox */
	}

	#customize::-webkit-scrollbar {
  		width: 0px;  /* Hides the scrollbar */
	}

	#customize::-webkit-scrollbar-thumb {
  		background: transparent;  /* Ensures the thumb doesn't appear */
	}

	#customize::-webkit-scrollbar-track {
  		background: transparent;  /* Ensures the track doesn't appear */
	}
	
	#body_content {
    		scrollbar-width: none;
	}

	#body_content {
    		font-family: auto;
    		overflow-x: hidden;
    		-webkit-overflow-scrolling: touch;
	}

	#body_content::-webkit-scrollbar {
    		display: none;
	}
	.elements
	{
		color: {{ !empty($data) && isset($data['widget_text']) ? $data['widget_text'] : 'white' }};
        	background-color: {{ !empty($data) && isset($data['theme_color']) ? $data['theme_color'] : 'slateblue' }};
	}
</style>

<div style="display:flex;">
<div id="customize" class="Polaris-ShadowBevel" style="--pc-shadow-bevel-z-index: 32;width:35%;position:absolute;height:100%;top:0;left:0;">
  <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400);padding:6% 9% 9% 9%;">

<h2 style="font-size:16px;font-weight:bold;cursor:default;">Style your widget to match your store.</h2>
<p style="margin-top:4%;cursor:default;">When the customer clicks on your widget, a panel opens up with your loyalty program details.</p>
{{--@if($page == "onboarding")
<form id="myform" action="{{my_app_env('APP_URL')}}/api/store_customization/{{$shop->our_passw_token}}?page=onboarding" method="POST" onsubmit="loading()">
@else
<form id="myform" action="{{my_app_env('APP_URL')}}/api/store_customization/{{$shop->our_passw_token}}?page=navigation" method="POST" onsubmit="loading()">
@endif--}}
<form id="myform" action="{{my_app_env('APP_URL')}}/api/store_customization/{{$shop->our_passw_token}}" method="POST" onsubmit="loading()">
@csrf
    <div class="Polaris-BlockStack" style="--pc-block-stack-order:column;--pc-block-stack-gap-xs:var(--p-space-500);margin-top:7%;">
      <div style="display:inline-flex;">
<!----------------------Position----------------->
      		<p style="font-size:1.1em;font-weight:bold;cursor:default;" class="Polaris-Text--root Polaris-Text--bodyMd">Position</p>
      		<div class="Polaris-LegacyStack Polaris-LegacyStack--vertical" style="display: contents;">
                        <div class="Polaris-LegacyStack__Item" style="padding-left:8.3vw;margin-top: 0;">
                                <div>
                                        <label style="padding-top:0;" class="Polaris-Choice Polaris-RadioButton__ChoiceLabel" for="disabled">
                                                <span class="Polaris-Choice__Control">
                                                        <span class="Polaris-RadioButton" style="margin-top:0.5vh;">
								<input style="cursor:pointer;appearance:auto;" type="radio" id="disabled" name="align" value="" onclick="left_align()" {{ array_key_exists('align', $data) ? $data['align']=="left" ? 'checked' : '' : '' }}> 
                                                        </span>
                                                </span>
                                                <span class="Polaris-Choice__Label">
                                                        <span>Left</span>
                                                </span>
                                        </label>
                                </div>
			</div>
			<input type="hidden" id="hiddeninput" name="alignment"
                       @if(array_key_exists('align',$data) && $data['align'] == 'left')
                               value="left"
                       @else
                               value="right"
                       @endif
                       >
                        <div class="Polaris-LegacyStack__Item" style="padding-left:3vw;margin-top: 0;">
                                <div>
                                        <label style="padding-top:0;" class="Polaris-Choice Polaris-RadioButton__ChoiceLabel" for="optional">
                                                <span class="Polaris-Choice__Control">
							<span class="Polaris-RadioButton" style="margin-top:0.5vh;">
							<input style="cursor:pointer;appearance:auto;" type="radio" id="optional" name="align" value="" onclick="right_align()" {{ array_key_exists('align', $data) ? $data['align']=="right" ? 'checked' : '' : 'checked' }}>
                                                        </span>
                                                </span>
                                                <span class="Polaris-Choice__Label">
                                                        <span>Right</span>
                                                </span>
                                        </label>
                                </div>
                        </div>
                </div>
	</div>
      <hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border-secondary)">
<!------------------------Theme color------------------------->
	<div style="display:inline-flex;justify-content:space-between;">
      		<p style="font-weight:bold;font-size:1.1em;cursor:default;padding-top:1.4vh;" class="Polaris-Text--root Polaris-Text--bodyMd">Theme color</p>
		<div>
			<label id="label_for_color" for="themecolor" style="cursor:pointer;display: block;width: auto;height: 6.7vh;border: 1px solid lightgrey;border-radius: 0.6rem;">
				<input type="color" id="themecolor" name="theme_color" oninput="change_background_color()" style="border:1px solid lightslategray;cursor:pointer;margin-top:0.8vh;margin-left:0.6vw;height: 4.8vh;width: 5vw;appearance:none;" value="{{ array_key_exists('theme_color', $data) ? $data['theme_color'] : '#6a5acd' }}">
                               <span id="color_value" style="font-size:1.4vw;margin-left:0.5vw;margin-right:0.5vw;position:relative;bottom:0.7vh;" class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">{{ array_key_exists('theme_color', $data) ? $data['theme_color'] : '#6a5acd' }}</span>
			</label>
		</div>
	</div>
      <hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border-secondary)">
<!-------------------------------Text color------------------>
	<div style="display:inline-flex;justify-content:space-between;">
      		<p style="font-weight:bold;font-size:1.1em;cursor:default;" class="Polaris-Text--root Polaris-Text--bodyMd">Text color</p>
		<div>
			<div class="Polaris-Select" style="height: 4.5vh;width:13vw;">
				<select id="widgettext" name="widget_text" class="Polaris-Select__Input" style="cursor:pointer;padding-left:1vw;" aria-invalid="false" onchange="change_text_color()">
                                       @if(array_key_exists('widget_text', $data) && $data['widget_text'] == 'black')
                                       <option value="white">White</option>
                                       <option value="black" selected="">Black</option>
                                       @else
                                         <option value="white" selected="">White</option>
                                         <option value="black">Black</option>
                                       @endif
                                </select>
                                <div class="Polaris-Select__Content" style="top:-0.7vh;font-size:1.1em;" aria-hidden="true">
					<span class="Polaris-Select__SelectedOption" id="textValue">{{ array_key_exists('widget_text', $data) ? $data['widget_text']=='black'? 'Black' : 'White' : 'White' }}</span>
                                        <span class="Polaris-Select__Icon">
                                                <span class="Polaris-Icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.24 8.2a.75.75 0 0 1 1.06.04l2.7 2.908 2.7-2.908a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 0 1 .04-1.06Z"/></svg>
                                                </span>
                                        </span>
                                </div>
                                <div style="border-color:silver;" class="Polaris-Select__Backdrop">
                                </div>
                        </div>
		</div>
	</div>
      <hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border-secondary)">
<!------------------------Display type------------------------->
     <p style="font-weight:bold;font-size:1.1em;cursor:default;" class="Polaris-Text--root Polaris-Text--bodyMd">Display type</p>

<div style="display:inline-flex;justify-content:space-between;">
	<div id="icon_and_text_radio_button" class="radiobox" 
       @if(array_key_exists('display_type', $data))
       @if($data['display_type']=='icon_and_text'))
                style="border:2px solid black;" 
       @endif
       @else
               style="border:2px solid black;"
       @endif >
               <input type="radio" id="icon_and_text" name="radio" onclick="change_display_type('icon_and_text_radio_button',this.id)" {{ array_key_exists('display_type', $data) ? $data['display_type']=="icon_and_text" ? 'checked' : '' : 'checked' }}/>
  		<label for="icon_and_text">Icon & Text</label>
	</div>
	<div id="text_only_radio_button" class="radiobox" 
       @if(array_key_exists('display_type', $data) && $data['display_type']=='text_only')
               style="border:2px solid black;"
       @endif >
               <input type="radio" id="text_only" name="radio" onclick="change_display_type('text_only_radio_button',this.id)" {{ array_key_exists('display_type', $data) ? $data['display_type']=="text_only" ? 'checked' : '' : '' }}/>
  		<label for="text_only">Text only</label>
	</div>
	<div id="icon_only_radio_button" class="radiobox"
       @if(array_key_exists('display_type', $data) && $data['display_type']=="icon_only") 
               style="border:2px solid black;"
       @endif >
               <input type="radio" id="icon_only" name="radio" onclick="change_display_type('icon_only_radio_button',this.id)" {{ array_key_exists('display_type', $data) ? $data['display_type']=="icon_only" ? 'checked' : '' : '' }}/>
  		<label for="icon_only">Icon only</label>
	</div>
</div>
	<input type="hidden" id="display_type_input" name="display_type"
               @if(array_key_exists('display_type',$data))
                       value="{{$data['display_type']}}"
               @else
                       value="icon_and_text"
               @endif >
	<hr class="Polaris-Divider" style="border-block-start:var(--p-border-width-025) solid var(--p-color-border-secondary)">

    </div>
    <div style="display:flex;margin-top:7%;">
    	<button class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPrimary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" type="submit">
      		<span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--medium">Save changes</span>
	</button>

     </div>
</form>



<button onclick='show_feature_request()' style="position:relative;top:0.5rem" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantPlain Polaris-Button--sizeMedium Polaris-Button--textAlignCenter" aria-label="Add variant" type="button">
        <span class="">Want any other customization?</span>
</button>

<div data-portal-id="modal-:R5eq6:" id="feature_request" style="display:none;">
        <div class="Polaris-Modal-Dialog__Container Polaris-Modal-Dialog--animateFadeUp Polaris-Modal-Dialog--entering Polaris-Modal-Dialog--entered" data-polaris-layer="true" data-polaris-overlay="true">
                <div role="dialog" aria-modal="true" aria-label=":Req6:" aria-labelledby=":Req6:" tabindex="-1" class="Polaris-Modal-Dialog" style="position:relative;width:510px;left:25%;">
                        <div class="Polaris-Modal-Dialog__Modal">
                                <div class="Polaris-Box" style="--pc-box-background: var(--p-color-bg-surface-tertiary); --pc-box-border-color: var(--p-color-border); --pc-box-border-style: solid; --pc-box-border-block-end-width: var(--p-border-width-025); --pc-box-padding-block-start-xs: var(--p-space-400); --pc-box-padding-block-end-xs: var(--p-space-400); --pc-box-padding-inline-start-xs: var(--p-space-400); --pc-box-padding-inline-end-xs: var(--p-space-400);">
                                        <div class="Polaris-InlineGrid" style="--pc-inline-grid-grid-template-columns-xs: 1fr auto; --pc-inline-grid-gap-xs: var(--p-space-400);">
                                                <div class="Polaris-InlineStack" style="--pc-inline-stack-block-align: center; --pc-inline-stack-wrap: wrap; --pc-inline-stack-gap-xs: var(--p-space-400); --pc-inline-stack-flex-direction-xs: row;">
                                                        <h2 style="cursor:default;" class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--break" id=":Req6:">Let us know what else you want to customize!</h2>
                                                </div>
						<button onclick="close_feature_request()" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantTertiary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Close" type="button" aria-pressed="false">
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
                                                                <textarea autocomplete="off" name="feature_request" class="Polaris-TextField__Input" type="text" rows="4" aria-labelledby=":Rq6:Label" aria-invalid="false" aria-multiline="true" data-1p-ignore="true" data-lpignore="true" data-form-type="other" style="height: 85px;" placeholder="I want to change the background color of widget." required=""></textarea>
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



</div>
</div>

<!-----------iframe---------------->
<div style="width:65%;">
<h2 style="position:fixed;padding-left:57%;font-size:20px;font-weight:bold;cursor:default;">Frontend Preview</h2>

<div id="iframeid" class="Polaris-ShadowBevel" style="font-family:auto;--pc-shadow-bevel-content-xs: &quot;&quot;; --pc-shadow-bevel-box-shadow-xs: var(--p-shadow-100); --pc-shadow-bevel-border-radius-xs: var(--p-border-radius-300);opacity:1;display:flex;position:fixed;border:none;border-radius:10px;background-color:#f6f6f7;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width:21rem;height:72vh;bottom:87px;
       @if(array_key_exists('align', $data) && $data['align'] == 'left')
               right:31%;
        @else
               right:3%;
        @endif">
        <div class="Polaris-Box" style="--pc-box-background:var(--p-color-bg-surface);--pc-box-min-height:100%;--pc-box-overflow-x:clip;--pc-box-overflow-y:clip;--pc-box-padding-block-start-xs:var(--p-space-400);--pc-box-padding-block-end-xs:var(--p-space-400);--pc-box-padding-inline-start-xs:var(--p-space-400);--pc-box-padding-inline-end-xs:var(--p-space-400);padding:0px;width:100%;">
<div>
        <div class="flex justify-between elements p-4">
                <div>
                  <p class="text-lg font-bold cursor-default">Welcome Alice</p>
                  <p class="text-lg font-bold cursor-default">10 points</p>
                </div>

                <div>
                        <button type="button" onClick="close_iframe()" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8 elements" data-dismiss-target="#toast-default" aria-label="Close">
                                <span class="sr-only">Close</span>
                           <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                        </button>
                </div>
        </div>
</div>
<!--------------------------Tabs on Top--------------------------->
<div class=" font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex justify-between">
        <li class="">
                <div tabindex="0" id = "earn_points_tab" role="link" aria-label="Example Link" class="text-base cursor-default p-3" aria-current="page" style="@if(array_key_exists('theme_color', $data))
                                        color:{{$data['theme_color']}};border-bottom: 2px solid {{$data['theme_color']}};
                                @else
                                        color: slateblue;border-bottom: 2px solid slateblue;
                                @endif" onclick="earn_points_tab()">Earn Points</div>
        </li>
        <li class="">
            <div tabindex="0" id ="rewards_tab" role="link" aria-label="Example Link" class="text-base cursor-default p-3" onclick = "rewards_tab()" style="border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);">Rewards</div>
        </li>
        <li class="">
            <div tabindex="0" id ="your_rewards_tab" role="link" aria-label="Example Link" class="text-base cursor-default p-3" onclick = "customer_rewards_tab()" style="border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);">Your Coupons</div>
        </li>
    </ul>
</div>

<div id="body_content" class="h-64 text-base overflow-y-scroll">
<!-----------------------------Ways to earn points------------->
<div>
@foreach($activities as $activity)
@if($activity['state'] == 1)
        <div class="p-3 bg-white border border-gray-200 rounded-lg earn-points-tab" style="display:block;">
                <h6 class="font-bold tracking-tight text-gray-900 cursor-default">{{$activity['name']}}</h6>
                @if($activity['handle'] == 'refer_a_friend')
                <p class="font-normal text-gray-700 cursor-default">Share this below given URL with your friends to give them reward and get your own after they make a purchase.</p>
                        <div class="flex my-2">
                                <svg class="w-5 h-5 mr-2 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6.072 10.072 2 2 6-4m3.586 4.314.9-.9a2 2 0 0 0 0-2.828l-.9-.9a2 2 0 0 1-.586-1.414V5.072a2 2 0 0 0-2-2H13.8a2 2 0 0 1-1.414-.586l-.9-.9a2 2 0 0 0-2.828 0l-.9.9a2 2 0 0 1-1.414.586H5.072a2 2 0 0 0-2 2v1.272a2 2 0 0 1-.586 1.414l-.9.9a2 2 0 0 0 0 2.828l.9.9a2 2 0 0 1 .586 1.414v1.272a2 2 0 0 0 2 2h1.272a2 2 0 0 1 1.414.586l.9.9a2 2 0 0 0 2.828 0l.9-.9a2 2 0 0 1 1.414-.586h1.272a2 2 0 0 0 2-2V13.8a2 2 0 0 1 .586-1.414Z"/>
                                </svg>
                                <p class="font-normal text-gray-700 cursor-default">They get: {{$activity['friend_reward']}}% off<p>
                        </div>
                        <div class="flex">
                                <svg class="w-5 h-5 mr-2 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
                                        <path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
                                </svg>
                                <p class="font-normal text-gray-700 cursor-default">You get: {{$activity['referrer_reward']}}% off<p>
                        </div>
                        @else
                        <p class="font-normal text-gray-700 cursor-default">
                                Points: {{$activity['points']}}
                                @if($activity['handle'] == 'make_a_purchase')
                                        @if($activity['type'] == 'Percentage')
                                                % of order amount
                                        @endif
                                        per order
                                @endif
                                @if($activity['handle'] == 'visit')
                                        per visit
                                @endif
                        </p>
                        @endif
                @if($activity['handle'] == 'refer_a_friend')
                <div class="flex my-2 pl-5">
                        <input id="url" type="text" class="block w-56 p-2 text-gray-900 border border-gray-300 bg-gray-50 text-sm" value="https://{{$shop->msd}}" disabled readonly>
                        <div class="text-center w-14 border border-gray-300 bg-gray-50">
                                <div id="copy_button" onclick="CopyToClipboard()" tabindex="0" role="link" aria-label="Example Link" class="cursor-pointer text-sm font-medium text-blue-600 hover:bg-blue-100 h-9 leading-9">Copy</div>
                        </div>
                </div>
                @endif
        </div>
@endif
@endforeach
</div>
<!--------------------------Rewards enabled by merchant------------------------>
@foreach($rewards as $reward)
@if($reward['state'] == 1)
<div class="hidden p-3 bg-white border border-gray-200 rounded-lg shadow rewards-tab flex justify-between">
        <div>
                <h6 class="font-bold tracking-tight text-gray-900 cursor-default">
				{{--@if($reward['handle'] == 'amount_off')
                                        {{ str_replace("amount", $reward['amount'], $shop->currency_format) }} off
				@elseif($reward['handle'] == 'percentage_off')
					{{$reward['percent']}}
				@else--}}
                                        {{$reward['name']}}
				{{--@endif--}}</h6>
                <p class=" font-normal text-gray-700 cursor-default">
                        @if($reward['handle'] == "convert_points_to_store_credit")
				10 points = {{ str_replace("amount", $shop->calculated_store_credit, $shop->currency_format) }}
                        @else
                                Cost: {{$reward['cost']}} points
                        @endif
                </p>
        </div>

        <div>
                @if($reward['handle'] == "convert_points_to_store_credit")
                <button onclick="document.getElementById('store_credit_info').style.display = 'block'" class="cursor-pointer text-sm font-medium text-white bg-blue-700 rounded-lg px-3 py-1 elements" aria-label="More Info" type="button">More Info</button>
                @else
                <div tabindex="0" role="link" aria-label="Example Link" class="cursor-pointer text-sm font-medium text-white bg-blue-700 rounded-lg py-1 w-16 h-7 text-center elements">Claim</div>
                @endif
	</div>
</div>
@endif
@endforeach
<!-------------------Store credit info popup---------------->
<div id="store_credit_info" style="display:none;box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.2), 0 2px 8px rgba(0, 0, 0, 0.2);" class="w-80 p-4 text-gray-500 bg-white rounded-lg shadow absolute bottom-4 ml-2" role="alert">
  <div class="flex justify-between">
    <div class="cursor-default">
       You can use your points as store credit at checkout. The amount equal to store credit will be deducted from your order. Simply click on Apply store credit checkbox shown at checkout and it will be applied to your order.
    </div>
    <div>
        <button type="button" class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300  hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" onclick = "document.getElementById('store_credit_info').style.display = 'none';" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
        </button>
    </div>
  </div>
  <div class="flex justify-center mt-2">
        <div tabindex="0" role="link" aria-label="Example Link" class="cursor-pointer items-center text-sm font-medium text-center text-white bg-blue-700 rounded-lg px-3 py-1 elements w-16 h-7"> Claim</div>
  </div>
</div>
<!-------------------No claimed rewards--------------------------------->
<div id="no_data_card" class="hidden max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow your-rewards-tab" style="text-align:center;display:@if($shop->enabled_activities == 0) block; @else none; @endif">
        <h6 id="no_data_card_heading" class="font-bold tracking-tight text-gray-900 cursor-default" style="top:-6px;">Currently no way to earn points</h6>
</div>

        </div>
</div>
</div>
<!-------------widget-------------------->
<button id="loyaltywidget" class="elements" onclick="open_iframe()" style="display:flex;font-family:auto;position:fixed;bottom:20px;height:48px;border-radius:13px;font-size:1.1em;cursor:pointer;border:none;
@if(array_key_exists('align', $data))
       @if($data['align'] == 'left' && $data['display_type'] == 'text_only')
               width:7rem;right:52%;
       @elseif($data['align'] == 'left' && $data['display_type'] == 'icon_only')
               width:3.3rem;right:57.5%;
       @elseif($data['align'] == 'left' && $data['display_type'] == 'icon_and_text')
               width:8.3rem;right:50%;
       @elseif($data['align'] == 'right' && $data['display_type'] == 'text_only')
               width:7rem;right:3%;
       @elseif($data['align'] == 'right' && $data['display_type'] == 'icon_only')
               width:3.3rem;right:3%;
       @elseif($data['align'] == 'right' && $data['display_type'] == 'icon_and_text')
               width:8.3rem;right:3%;
       @else
               width:8.3rem;right:3%;
       @endif
@else
       width:8.3rem;right:3%;background-color:slateblue;color:white;
@endif
       ">
<svg id="loyalty_icon" style="height:42px;padding-top:5px;
                       @if(array_key_exists('display_type', $data))
                               @if($data['display_type'] == 'text_only')
                                       display:none;
                               @elseif($data['display_type'] == 'icon_only')
                                       padding-left:8px;fill:{{$data['widget_text']}};
                               @else
                                       fill:{{$data['widget_text']}};
                               @endif
                       @else
                               fill:white;
                       @endif " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9.716 14.806c.035.005.07.008.106.011l1.4 2.44c.378.66 1.324.673 1.72.024l.479-.781h1.226c.772 0 1.253-.837.864-1.504l-1.167-2c.446-.476.67-1.16.504-1.88-.056-.237.046-.482.252-.61 1.3-.81 1.3-2.702 0-3.511-.206-.128-.308-.374-.252-.61.346-1.491-.992-2.83-2.483-2.482-.236.055-.482-.047-.61-.253-.81-1.3-2.7-1.3-3.51 0-.128.206-.374.308-.61.253-1.492-.347-2.83.99-2.482 2.482.055.236-.047.482-.253.61-1.3.81-1.3 2.7 0 3.51.206.128.308.374.253.61-.135.577-.017 1.131.265 1.573l-1.346 2.308c-.39.667.092 1.504.863 1.504h1.164l.55.825c.415.623 1.342.585 1.706-.07l1.361-2.45Zm-1.31-.73c-.058-.07-.111-.146-.161-.226-.128-.206-.374-.307-.61-.252-.35.08-.69.07-1.003-.014l-.826 1.416h.56c.335 0 .647.167.832.445l.244.365.964-1.735Zm4.582-.428.789 1.352h-.637c-.348 0-.671.181-.853.478l-.184.301-.807-1.407c.174-.141.33-.315.46-.522.127-.206.373-.307.61-.252.211.049.42.064.622.05Zm-3.47-.59c.222.356.742.356.964 0 .468-.752 1.361-1.122 2.223-.921.41.095.777-.273.681-.682-.2-.862.17-1.756.921-2.223.357-.222.357-.742 0-.964-.75-.467-1.121-1.361-.92-2.223.095-.41-.273-.777-.682-.681-.862.2-1.755-.17-2.223-.921-.222-.357-.742-.357-.964 0-.467.75-1.361 1.121-2.223.92-.41-.095-.777.273-.681.682.2.862-.17 1.756-.921 2.223-.357.222-.357.742 0 .964.75.467 1.121 1.361.92 2.223-.095.41.273.777.682.681.862-.2 1.756.17 2.223.921Z"/></svg>
<span id="loyalty_text" style="padding-top:12px;font-weight:bold;
                       @if(array_key_exists('display_type', $data))
                                @if($data['display_type'] == 'icon_only')
                                        display:none;
                                @elseif($data['display_type'] == 'text_only')
                                        padding-left:11px;
                                @else
                                       display:block;
                                @endif
                        @endif ">Loyalty Points</span>
</button>

</div>
</div>

<script src="https://cdn.tailwindcss.com/3.4.3"></script>
<script>
	function show_feature_request()
        {
		document.getElementById("feature_request").style.display = "block";
		document.getElementById("loyaltywidget").style.zIndex = "-1";
		document.getElementById("iframeid").style.zIndex = "-1";
		logActivity('opened feature request popup for customize widget page','{{$shop->msd}}');
        }

	function close_feature_request()
	{
		document.getElementById('feature_request').style.display = 'none';
		document.getElementById("loyaltywidget").style.zIndex = "0";
                document.getElementById("iframeid").style.zIndex = "0";
	}

	function change_display_type(element_id,type)
	{
		let alignment = document.getElementById('hiddeninput').value;
		let display_buttons = document.getElementsByClassName("radiobox");
                for (let z = 0; z < display_buttons.length; z++)
                {
                        display_buttons[z].style.border = "1px solid lightgrey";
                }

		document.getElementById(element_id).style.border = "2px solid black";
		document.getElementById('display_type_input').value = type;
		let selectBox = document.getElementById("widgettext");
                let selectedValue = selectBox.options[selectBox.selectedIndex].innerHTML;
                if(selectedValue == "Black")
                {
                        document.getElementById("loyalty_icon").style.fill = 'black';
                }
                else
                {
                        document.getElementById("loyalty_icon").style.fill = 'white';
                }

		if(type == "icon_and_text")
		{
			document.getElementById("loyalty_icon").style.display = "block";	
			document.getElementById("loyalty_text").style.display = "block";
			document.getElementById("loyaltywidget").style.width = "8.3rem";
			document.getElementById("loyalty_text").style.paddingLeft = "0px";
			document.getElementById("loyalty_icon").style.paddingLeft = "0px";	
			if(alignment == "left")
			{
				document.getElementById("loyaltywidget").style.right ="50%";
			}
		}
		if(type == "text_only")
		{
			document.getElementById("loyalty_text").style.display = "block";
			document.getElementById("loyalty_icon").style.display = "none";        
			document.getElementById("loyaltywidget").style.width = "7rem";
			document.getElementById("loyalty_text").style.paddingLeft = "11px";  	
			if(alignment == "left")
                        {
				document.getElementById("loyaltywidget").style.right ="52%";
			}
		}
		if(type == "icon_only")
		{
			document.getElementById("loyalty_icon").style.display = "block";  
			document.getElementById("loyalty_text").style.display = "none";
			document.getElementById("loyalty_icon").style.paddingLeft = "8px";
			document.getElementById("loyaltywidget").style.width = "3.3rem";
			if(alignment == "left")
                        {
				document.getElementById("loyaltywidget").style.right ="57.5%";
			}
		}
	}

        function open_iframe()
        {
                 document.getElementById("iframeid").style.display = "flex";
        }

        function close_iframe()
        {
                document.getElementById("iframeid").style.display = "none";
        }

	function loading()
        {
               startLoading();
               popupToast('changes saved');
        }

        function right_align()
        {
		document.getElementById("loyaltywidget").style.right = "3%";
                document.getElementById("iframeid").style.right = "3%";
                document.getElementById("hiddeninput").value = "right";
        }

        function left_align()
	{
		let value = document.getElementById("display_type_input").value;
		if(value == "icon_and_text")
          	{
			document.getElementById("loyaltywidget").style.right ="50%";
           	}
           	if(value == "icon_only")
              	{
			document.getElementById("loyaltywidget").style.right ="57.5%";
            	}
           	if(value == "text_only")
           	{
			document.getElementById("loyaltywidget").style.right ="52%";
		}
                document.getElementById("iframeid").style.right = "31%";
                document.getElementById("hiddeninput").value = "left";
        }

	let earn_points_tab_elements = document.getElementsByClassName("earn-points-tab");
	let rewards_tab_elements = document.getElementsByClassName("rewards-tab");
	let your_rewards_tab_elements = document.getElementsByClassName("your-rewards-tab");

	function change_background_color()
	{
		let color = document.getElementById("themecolor").value;
		document.getElementById("color_value").innerHTML = color;
		let elements = document.getElementsByClassName("elements");
		for (let i = 0; i < elements.length; i++)
		{
			elements[i].style.backgroundColor = color;
		}
		for(let z=0; z<earn_points_tab_elements.length; z++)
        	{
			if(earn_points_tab_elements[z].style.display == "block")
			{
				document.getElementById("earn_points_tab").style.color = color;
        			document.getElementById("earn_points_tab").style.borderBottom = "2px solid "+color;
			}
		}
		for(let j=0; j<rewards_tab_elements.length; j++)
        	{
			if(rewards_tab_elements[j].style.display == "flex")
			{
				document.getElementById("rewards_tab").style.color = color;
        			document.getElementById("rewards_tab").style.borderBottom = "2px solid "+color;
			}
        	}

        	for(let k = 0; k < your_rewards_tab_elements.length; k++)
        	{
			if(your_rewards_tab_elements[k].style.display == "block")
			{
				document.getElementById("your_rewards_tab").style.color = color;
                        	document.getElementById("your_rewards_tab").style.borderBottom = "2px solid "+color;
			}
        	}
	}

        function change_text_color()
        {
                let selectBox = document.getElementById("widgettext");
                let selectedValue = selectBox.options[selectBox.selectedIndex].innerHTML;
                document.getElementById("textValue").innerHTML = selectedValue;
                if(selectedValue == "White")
		{
			document.getElementById("loyalty_icon").style.fill = "white";
                        let elements = document.getElementsByClassName("elements");
                        for (let i = 0; i < elements.length; i++)
                        {
                                elements[i].style.color = "white";
                        }
                }
               if(selectedValue == "Black")
	       {
		        document.getElementById("loyalty_icon").style.fill = "black";
                        let elements = document.getElementsByClassName("elements");
                        for (let i = 0; i < elements.length; i++)
                        {
                                elements[i].style.color = "black";
                        }
                }
        }
	function earn_points_tab()
	{
        	for(let i=0; i<earn_points_tab_elements.length; i++)
        	{
                	earn_points_tab_elements[i].style.display = "block";
        	}

        	for(let j=0; j<rewards_tab_elements.length; j++)
        	{
                	rewards_tab_elements[j].style.display = "none";
        	}

        	for(let k = 0; k < your_rewards_tab_elements.length; k++)
        	{
                	your_rewards_tab_elements[k].style.display = "none";
        	}

		document.getElementById("no_data_card").style.display = "none";

        	if({{$shop->enabled_activities}} == 0)
        	{
                	document.getElementById("no_data_card").style.display = "block";
			document.getElementById("no_data_card_heading").innerHTML = "Currently no way to earn points";
        	}

		document.getElementById("store_credit_info").style.display = "none";
		let theme_color = document.getElementById("themecolor").value;
		document.getElementById("earn_points_tab").style.color = theme_color;
		document.getElementById("earn_points_tab").style.borderBottom = "2px solid "+theme_color;
		document.getElementById("rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
        	document.getElementById("your_rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
	}

	function rewards_tab()
	{
        	for(let i=0; i<rewards_tab_elements.length; i++)
        	{
                	rewards_tab_elements[i].style.display = "flex";
        	}

        	for(let i=0; i<earn_points_tab_elements.length; i++)
        	{
                	earn_points_tab_elements[i].style.display = "none";
        	}

        	for(let j = 0; j < your_rewards_tab_elements.length; j++)
        	{
                	your_rewards_tab_elements[j].style.display = "none";
		}

		document.getElementById("no_data_card").style.display = "none";

        	if({{$shop->enabled_rewards}} == 0)
        	{
                	document.getElementById("no_data_card").style.display = "block";
                	document.getElementById("no_data_card_heading").innerHTML = "Currently no rewards available to claim";
        	}

		let theme_color = document.getElementById("themecolor").value;
		document.getElementById("rewards_tab").style.color = theme_color;
       		document.getElementById("rewards_tab").style.borderBottom = "2px solid "+theme_color;
		document.getElementById("earn_points_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
       	 	document.getElementById("your_rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
	}

	function customer_rewards_tab()
	{
		document.getElementById("no_data_card").style.display = "block";
                document.getElementById("no_data_card_heading").innerHTML = "No claimed rewards";

        	for(let k = 0; k < your_rewards_tab_elements.length; k++)
        	{
                	your_rewards_tab_elements[k].style.display = "block";
        	}

        	for(let i=0; i<rewards_tab_elements.length; i++)
        	{
                	rewards_tab_elements[i].style.display = "none";
        	}

        	for(let i=0; i<earn_points_tab_elements.length; i++)
        	{
                	earn_points_tab_elements[i].style.display = "none";
		}

		document.getElementById("store_credit_info").style.display = "none";
		let theme_color = document.getElementById("themecolor").value;
		document.getElementById("your_rewards_tab").style.color = theme_color;
		document.getElementById("your_rewards_tab").style.borderBottom = "2px solid "+theme_color;
		document.getElementById("earn_points_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
   	     	document.getElementById("rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
	}
		
	function CopyToClipboard()
	{
        	if (document.selection)
        	{
                	let range = document.body.createTextRange();
                	range.moveToElementText(document.getElementById('url'));
                	range.select().createTextRange();
                	document.execCommand("copy");
        	}
        	else if (window.getSelection)
        	{
                	let range = document.createRange();
                	range.selectNode(document.getElementById('url'));
                	window.getSelection().removeAllRanges();
                	window.getSelection().addRange(range);
                	document.execCommand("copy");
        	}
        	document.getElementById('copy_button').innerHTML = "Copied";

        	setTimeout(function() {
                        document.getElementById('copy_button').innerHTML = "Copy";
        	}, 2000);
	}

        stopLoading();
</script>
@endsection

