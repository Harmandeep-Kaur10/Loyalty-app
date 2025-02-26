<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer src="https://cdn.tailwindcss.com/3.4.3"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<style>

body {
    font-family: auto;
    overflow-x: hidden; 
    -webkit-overflow-scrolling: touch;
}


body::-webkit-scrollbar {
    display: none; 
}

body {
    scrollbar-width: none;
}

#body_content::-webkit-scrollbar {
  display: none;
}

</style>
<body>

<div>
	<div class="flex justify-between elements p-4">
		<div>
		  <p class="text-lg font-bold cursor-default">Welcome {{explode(' ',$customer->name)[0]}}</p>
		  <p class="text-lg font-bold cursor-default" id="customer_points">{{$customer->points}} points</p>
		</div>

		<div>
			<button type="button" id="cross" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 elements" data-dismiss-target="#toast-default" aria-label="Close">
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
		<div tabindex="0" id = "earn_points_tab" role="link" aria-label="Example Link" class="cursor-default text-black p-3" aria-current="page" onclick="earn_points_tab()">Earn Points</div>
	</li>
	<li class="">
	    <div tabindex="0" id ="rewards_tab" role="link" aria-label="Example Link" class="cursor-default text-black p-3" onclick = "rewards_tab()">Rewards</div>
	</li>
	<li class="">
	    <div tabindex="0" id ="your_rewards_tab" role="link" aria-label="Example Link" class="cursor-default text-black p-3" onclick = "customer_rewards_tab()">Your Coupons</div>
	</li>
    </ul>
</div>



<div id="body_content" class="h-64 overflow-y-scroll">
<!-----------------------------Ways to earn points------------->
<div>
@foreach($activities as $activity)
@if($activity['state'] == 1)
	<div class="p-3 bg-white border border-gray-200 rounded-lg earn-points-tab">
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
			<input type="text" id="url" class="block w-56 p-2 text-gray-900 border border-gray-300 bg-gray-50 text-sm" value="https://{{$shop->msd}}?bunny_ref={{$customer->customer_id}}" disabled readonly>
			<div class="text-center w-14 border border-gray-300 bg-gray-50">
        			<div id="copy_url" tabindex="0" role="link" onclick = "CopyToClipboard('url',this.id)" aria-label="Example Link" class="cursor-pointer text-sm font-medium text-blue-600 hover:bg-blue-100 h-9 leading-9">Copy</div>
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
<div class="p-3 bg-white border border-gray-200 rounded-lg shadow rewards-tab flex justify-between">
	<div>
		<h6 class="font-bold tracking-tight text-gray-900 cursor-default">{{$reward['name']}}</h6>
		<p id="{{$reward['handle']}}" class=" font-normal text-gray-700 cursor-default">
			@if($reward['handle'] == "convert_points_to_store_credit")
				{{$customer->points}} points = {{ str_replace("amount","$calculated_store_credit","$shop->currency_format") }}
			@else
				Cost: {{$reward['cost']}} points
			@endif
		</p>
	</div>

	<div>
		@if($reward['handle'] == "convert_points_to_store_credit")
		<button id="claim_{{$reward['handle']}}"   onclick="document.getElementById('store_credit_info').style.display = 'block'"   class="cursor-pointer text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-neutral-200 px-3 py-1 elements" aria-label="More Info" role="button">More Info</button>
		@else
		<div tabindex="0" id="claim_{{$reward['handle']}}" role="link" aria-label="Example Link" onclick = "claim_reward('{{$customer->customer_id}}','{{$reward['name']}}','{{$reward['handle']}}','{{$reward['cost']}}')" class="cursor-pointer text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-neutral-200 px-3 py-1 w-16 h-7 text-center elements">Claim</div>
		@endif
<!-----------------Spinner-------------------->
		<div id="spinner_{{$reward['handle']}}" role="status" class="relative left-6 bottom-6" style="display:none;">
		<svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-white-400" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
			<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
		</svg>
		<span class="sr-only">Loading...</span>
		</div>
	</div>
</div>
@endif
@endforeach


<!-------------------Not enough points popup---------------->
<div id="toast-warning" class="items-center max-w-xs text-gray-500 bg-white rounded-lg shadow fixed h-12 left-3 w-80 bottom-4" style="box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.2), 0 2px 8px rgba(0, 0, 0, 0.2);display:none;" role="alert">
<div class="flex">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg mt-2 mx-2">
	<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
	    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
	</svg>
	<span class="sr-only">Warning icon</span>
    </div>
    <div class="cursor-default mt-3 font-bold text-black text-base">Not enough points.</div>
    <button type="button" class="mt-2 ml-24 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" onclick = "close_toast('toast-warning')" aria-label="Close">
	<span class="sr-only">Close</span>
	<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
	    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
	</svg>
    </button>
</div>
</div>


<!------------------Redeem code popup--------------->
<div id="toast-redeem" class="items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow fixed h-20 bottom-4 left-3" style="display:none;box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.2), 0 2px 8px rgba(0, 0, 0, 0.2);" role="alert">
   <div class="flex">
 	<div class="cursor-default font-bold text-black text-base ml-5">
       		Success! use this code at checkout.
   	</div>

	<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" onclick = "close_toast('toast-redeem')"  aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
<div class="flex">
    <div id = "coupon-code" class="cursor-default ml-5">

    </div>
    <div class="ml-16 text-center w-14 mt-0.5">
	<div id="copy_coupon_code" tabindex="0" role="link" onclick = "CopyToClipboard('coupon-code',this.id)" aria-label="Example Link" class="cursor-pointer text-sm font-medium text-blue-600 hover:bg-blue-100 rounded-lg">Copy</div>
    </div>
</div>
</div>

<!---------------------Store credit info popup-------------------->
<div id="store_credit_info" style="display:none;box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.2), 0 2px 8px rgba(0, 0, 0, 0.2);" class="w-80 p-4 text-gray-500 bg-white rounded-lg shadow fixed bottom-4 ml-3" role="alert">
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
	<div id="no_points_available" class="text-base text-red-600 text-center cursor-default" style="display:none;">
		No earned points.
	</div>
	<div tabindex="0" id="store_credit_claim_button" role="link" aria-label="Example Link" onclick="claim_convert_to_store_credit_reward()" class="cursor-pointer items-center text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-neutral-200 px-3 py-1 elements w-16 h-7"> Claim</div>
	<div id="spinner_for_convert_to_store_credit" class="absolute bottom-6" role="status" style="display:none;">
		<svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-white-400" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
			<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
		</svg>
		<span class="sr-only">Loading...</span>
	</div>
  </div>
</div>


<!---------------------Rewards redeemed by customer---------------->
@if($decode_rewards != '[]')
    @foreach($decode_rewards as $claimed_reward)
        @if($claimed_reward['name'] != 'Convert points to store credit')
            <div tabindex="0" role="link" aria-label="Example Link" onclick="popup_in_redeemed_rewards(`{{ $claimed_reward['discount_code'] }}`)" class="cursor-default p-3 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 your-rewards-tab flex justify-between">
        @else
            <div tabindex="0" role="link" aria-label="Example Link" class="cursor-default max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 your-rewards-tab flex justify-between">
        @endif

        <div class="gap-2">
            <h5 class="mb-1 font-bold tracking-tight text-gray-900">
                @if(ctype_digit($claimed_reward['name']))
                    {{ str_replace("amount", $claimed_reward['name'], $shop->currency_format) }} off
                @else
                    {{ $claimed_reward['name'] }}
                @endif
            </h5>
            <p class="font-normal text-gray-700 ">Spent {{ $claimed_reward['cost'] }} points</p>
        </div>

	@if($claimed_reward['redeemed'] == "true")
	<div>
            <span class="bg-blue-100 text-blue-800 text-base font-medium px-2.5 py-0.5 rounded-full">Redeemed</span>
	</div>
        @endif

        <div class="flex cursor-pointer p-2">
            @if($claimed_reward['name'] != 'Convert points to store credit')
                <svg class="text-gray-800" height="20" width="10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
                </svg>
            @endif
        </div>

    </div>
    @endforeach
@endif


<!-------------------No data card--------------------------------->
<div id="no_data_card" class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow" style="text-align:center;display:none;">
	<h6 id="no_data_card_heading" class="mb-2 font-bold tracking-tight text-gray-900 cursor-default"></h6>
</div>
<!---------------------Clone for customer reward card------------------->
<div id="customer_reward" tabindex="0" role="link" aria-label="Example Link" class="cursor-default p-3 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 flex justify-between" style="display:none;">
		<div class="gap-2">
			<h5 id="customer_reward_name" class="mb-1 font-bold tracking-tight text-gray-900"></h5>
			<p id="customer_reward_cost" class="font-normal text-gray-700"></p>
		</div>
		<div class="flex cursor-pointer p-2">
			<svg class="text-gray-800 " height="20" width="10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
			</svg>
		</div>
</div>


<!-----------------------Popup in Your Rewards tab for discount code------------------->

<div id="discount-code" class="p-2 flex justify-center fixed bottom-4 right-3 max-w-xs items-center w-full text-gray-500 bg-white rounded-lg shadow" role="alert" style="display: none;box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.2), 0 2px 8px rgba(0, 0, 0, 0.2);">


<div class="flex justify-between">
    <div class="cursor-default flex justify-between font-bold text-black text-base px-2 py-1">
       Use this discount code on your next order.
    </div>

    <div>
        <button type="button" class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" onclick = "close_toast('discount-code')"  aria-label="Close">
        <span class="sr-only">Close</span> <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>  </svg> </button>
     </div>
</div>

<div class="flex justify-between">
    <div id="code" class="cursor-default px-2 py-1"></div>
    <div id="copy_code" onclick = "CopyToClipboard('code',this.id)" class="cursor-pointer px-2 py-1 font-medium text-blue-600 hover:bg-blue-100 rounded-lg">Copy</div>
</div>
</div>

</body>
<!--------------------JAVASCRIPT------------------->
<script>
document.getElementById("cross").addEventListener("click", function()
{
	window.parent.postMessage("closeIframe", "*");
});

function CopyToClipboard(containerid,copy_button) 
{
	if (document.selection) 
	{
		let range = document.body.createTextRange();
		range.moveToElementText(document.getElementById(containerid));
		range.select().createTextRange();
		document.execCommand("copy");
	} 
	else if (window.getSelection) 
	{
		let range = document.createRange();
		range.selectNode(document.getElementById(containerid));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(range);
		document.execCommand("copy");
	}
	document.getElementById(copy_button).innerHTML = "Copied";
	
	setTimeout(function() {    
			document.getElementById(copy_button).innerHTML = "Copy";
	}, 2000);
}

async function claim_convert_to_store_credit_reward()
{
	if(document.getElementById('customer_points').innerHTML == "0 points")
	{
		document.getElementById('no_points_available').style.display = 'block';
		document.getElementById('store_credit_claim_button').style.display = 'none';
	}
	else
	{
		document.getElementById('store_credit_claim_button').innerHTML = "";
		document.getElementById('spinner_for_convert_to_store_credit').style.display = 'block';
		url  = "{{my_app_env('APP_URL')}}/api/convert_points_to_store_credit/{{$shop->msd}}/{{$customer->customer_id}}";
		await fetch(url,  {
		method: "get",
		}).then(r => r.json()).then(data => {
		if(data['res'] == 1)
		{
			document.getElementById('store_credit_info').style.display = "none";
			document.getElementById("customer_points").innerHTML = "0 points";
			const currency_format = '{{$shop->currency_format}}';
			document.getElementById("convert_points_to_store_credit").innerHTML = "0 points = "+currency_format.replace("amount", 0);
			show_convert_to_store_credit_claimed_reward_under_your_rewards_tab(data);
			document.getElementById('store_credit_claim_button').innerHTML = "Claim";
			document.getElementById('spinner_for_convert_to_store_credit').style.display = 'none';
		}
		});
	}	
}

let h = 0;
function show_convert_to_store_credit_claimed_reward_under_your_rewards_tab(data)
{
	let customer_reward_card = document.getElementById("customer_reward");
	let clone_for_card = customer_reward_card.cloneNode(true);
	let id_for_clone_card = "convert_to_store_credit_new_reward" + ++h;
	clone_for_card.id = id_for_clone_card;
	customer_reward_card.parentNode.appendChild(clone_for_card);
	document.getElementById(id_for_clone_card).classList.add("your-rewards-tab");
	let child_nodes = clone_for_card.childNodes;
	let sub_childs = child_nodes[1].childNodes;
	let first_child_node_id = "store_credit_reward_name" + ++h;
	sub_childs[1].id = first_child_node_id;
	let third_child_node_id = "store_credit_reward_cost" + h;
	sub_childs[3].id = third_child_node_id;
	child_nodes[3].style.display = "none";
	document.getElementById(first_child_node_id).innerHTML = 'Convert points to store credit';
	document.getElementById(third_child_node_id).innerHTML = "Spent "+data['reward_cost']+" points";
}

async function claim_reward(customer_id,reward_name,reward_handle,reward_cost)
{
	document.getElementById('spinner_'+reward_handle).style.display = "block";
	document.getElementById('claim_'+reward_handle).innerHTML = "";
	let points = parseInt(document.getElementById('customer_points').innerHTML.split(' ')[0]);
	if(points < reward_cost)
	{
		document.getElementById("toast-warning").style.display = "block";
                document.getElementById('spinner_'+reward_handle).style.cssText = "display:none;"
		document.getElementById('claim_'+reward_handle).innerHTML = "Claim";
		//logActivity('customer id: {{$customer->customer_id}} does not have enough points to claim ${reward_handle} reward','{{$shop->msd}}');
	}
	else
	{
		//logActivity('customer id: {{$customer->customer_id}} have enough points to claim ${reward_handle} reward','{{$shop->msd}}');
		store_claimed_reward_in_db(customer_id,reward_name,reward_handle);
	}
	/*url  = "{{my_app_env('APP_URL')}}/api/compare_points_with_reward_cost/{{$shop->msd}}/"+customer_id+"?reward="+reward_handle;
	await fetch(url,  {
	method: "get",
	}).then(r => r.json()).then(data => {
	if(data['res'] == 0)
	{
		document.getElementById("toast-warning").style.display = "block";
		document.getElementById('spinner_'+reward_handle).style.cssText = "display:none;"
		document.getElementById('claim_'+reward_handle).innerHTML = "Claim";
	}
	if(data['res'] == 1)
	{
		store_claimed_reward_in_db(customer_id,reward_name,reward_handle);
	}

	});*/
}

async function store_claimed_reward_in_db(customer_id,reward_name,reward_handle)
{
	url  = "{{my_app_env('APP_URL')}}/api/save_claimed_reward/{{$shop->msd}}/"+customer_id+"?reward="+reward_handle;
	await fetch(url, {
	method: "post",
	}).then(r => r.json()).then(data => {
	if(data['discount_code'])
	{
		document.getElementById("coupon-code").innerHTML = data['discount_code'];
		document.getElementById("toast-redeem").style.display = "block";
		document.getElementById('spinner_'+reward_handle).style.cssText = "display:none;"
		document.getElementById('claim_'+reward_handle).innerHTML = "Claim";

		update_customer_points(data);   

		show_claimed_reward_under_your_rewards_tab(data, reward_name);
	}
	});
}

function update_customer_points(data)
{
	document.getElementById("customer_points").innerHTML = data['customer_points']+" points";
	if(document.getElementById("convert_points_to_store_credit"))
	{
		const currency_format = '{{$shop->currency_format}}';
		document.getElementById("convert_points_to_store_credit").innerHTML = data['customer_points']+" points = "+currency_format.replace("amount", data['calculated_store_credit']);
	}
}

let i = 0;
function show_claimed_reward_under_your_rewards_tab(data, reward_name)
{
	let customer_reward_card = document.getElementById("customer_reward");
	let clone_for_card = customer_reward_card.cloneNode(true);
	let id_for_clone_card = "customer_new_reward" + ++i;
	clone_for_card.id = id_for_clone_card;
	customer_reward_card.parentNode.appendChild(clone_for_card);
	document.getElementById(id_for_clone_card).setAttribute("onClick", `popup_in_redeemed_rewards('${data['discount_code']}')`);
	document.getElementById(id_for_clone_card).classList.add("your-rewards-tab");
	let child_nodes = clone_for_card.childNodes;
	let sub_childs = child_nodes[1].childNodes;
	let first_child_node_id = "reward_name" + ++i;
	sub_childs[1].id = first_child_node_id;
	let third_child_node_id = "reward_cost" + i;
	sub_childs[3].id = third_child_node_id;
	/*if(reward_name.match(/^[0-9]+$/) != null)
	{
		document.getElementById(first_child_node_id).innerHTML = "{{$shop->currency_format}}".replace('amount',reward_name)+" off";
	}
	else
	{*/
		document.getElementById(first_child_node_id).innerHTML = reward_name;
	//}
	document.getElementById(third_child_node_id).innerHTML = "Spent "+data['reward_cost']+" points";
}
function close_toast(toast_id)
{
	document.getElementById(toast_id).style.display = "none";
}

function earn_points_tab()
{
	let earn_points_tab_elements = document.getElementsByClassName("earn-points-tab");
	for(let i=0; i<earn_points_tab_elements.length; i++)
	{
		earn_points_tab_elements[i].style.display = "block";
	}

	let rewards_tab_elements = document.getElementsByClassName("rewards-tab");
	for(let i=0; i<rewards_tab_elements.length; i++)
	{
		rewards_tab_elements[i].style.display = "none";
	}

	let your_rewards_tab_elements = document.getElementsByClassName("your-rewards-tab");
	for(let i = 0; i < your_rewards_tab_elements.length; i++) 
	{
		your_rewards_tab_elements[i].style.display = "none";
	}

	document.getElementById("toast-redeem").style.display = "none";

	document.getElementById("discount-code").style.display = "none";

	document.getElementById("toast-warning").style.display = "none";

	document.getElementById("store_credit_info").style.display = "none";

	document.getElementById("no_data_card").style.display = "none";

	if({{$enabled_activities}} == 0)
	{
		document.getElementById("no_data_card").style.display = "block";

		document.getElementById("no_data_card_heading").innerHTML = "Currently no way to earn points";
	}

	let data = @json($app_data['customization']);
	let color = data.theme_color;

	if(Object.keys(data).length === 0)
	{
		document.getElementById("earn_points_tab").style.color = "blue";
                document.getElementById("earn_points_tab").style.borderBottom = "2px solid blue";
	}
	else
	{
		document.getElementById("earn_points_tab").style.color = data.theme_color;
		document.getElementById("earn_points_tab").style.borderBottom = "2px solid "+color;
	}

	document.getElementById("rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
	document.getElementById("your_rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";

}

function rewards_tab()
{
	document.getElementById('body_content').scrollTo(0, 0);
	let rewards_tab_elements = document.getElementsByClassName("rewards-tab");
	for(let i=0; i<rewards_tab_elements.length; i++)
	{
		rewards_tab_elements[i].style.display = "flex";
	}

	let earn_points_tab_elements = document.getElementsByClassName("earn-points-tab");
	for(let i=0; i<earn_points_tab_elements.length; i++)
	{
		earn_points_tab_elements[i].style.display = "none";
	}

	let your_rewards_tab_elements = document.getElementsByClassName("your-rewards-tab");
	for(let j = 0; j < your_rewards_tab_elements.length; j++) 
	{
		your_rewards_tab_elements[j].style.display = "none";
	}

	document.getElementById("no_data_card").style.display = "none";
	document.getElementById("discount-code").style.display = "none";

	if({{$enabled_rewards}} == 0)
	{
		document.getElementById("no_data_card").style.display = "block";

		document.getElementById("no_data_card_heading").innerHTML = "Currently no rewards available to claim";
	}

	let data = @json($app_data['customization']);
	let color = data.theme_color;
	
	if(Object.keys(data).length === 0)
	{
		document.getElementById("rewards_tab").style.color = "blue";
		document.getElementById("rewards_tab").style.borderBottom = "2px solid blue";
	}
	else
	{
		document.getElementById("rewards_tab").style.color = color;
                document.getElementById("rewards_tab").style.borderBottom = "2px solid "+color;
	}

	document.getElementById("earn_points_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
        document.getElementById("your_rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
}

function customer_rewards_tab()
{
	let your_rewards_tab_elements = document.getElementsByClassName("your-rewards-tab");
	for(let k = 0; k < your_rewards_tab_elements.length; k++) 
	{
		your_rewards_tab_elements[k].style.display = "flex";
	}

	let rewards_tab_elements = document.getElementsByClassName("rewards-tab");
	for(let i=0; i<rewards_tab_elements.length; i++)
	{
		rewards_tab_elements[i].style.display = "none";
	}

	let earn_points_tab_elements = document.getElementsByClassName("earn-points-tab");
	for(let i=0; i<earn_points_tab_elements.length; i++)
	{
		earn_points_tab_elements[i].style.display = "none";
	}

	document.getElementById("no_data_card").style.display = "none";

	if({{count($decode_rewards)}} == 0 && !document.getElementById("customer_new_reward1") && !document.getElementById("convert_to_store_credit_new_reward1")) 
	{
		document.getElementById("no_data_card").style.display = "block";
		document.getElementById("no_data_card_heading").innerHTML = "No claimed rewards";
	}

	document.getElementById("toast-redeem").style.display = "none";

	document.getElementById("discount-code").style.display = "none";

	document.getElementById("toast-warning").style.display = "none";

	document.getElementById("store_credit_info").style.display = "none";

	let data = @json($app_data['customization']);
	if(Object.keys(data).length === 0)
	{
		document.getElementById("your_rewards_tab").style.color = "blue";
		document.getElementById("your_rewards_tab").style.borderBottom = "2px solid blue";
	}
	else
	{
		document.getElementById("your_rewards_tab").style.color = data.theme_color;
                document.getElementById("your_rewards_tab").style.borderBottom = "2px solid "+data.theme_color;
	}
	
	document.getElementById("earn_points_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
	document.getElementById("rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
}

function popup_in_redeemed_rewards(coupon_code)
{
	document.getElementById("code").innerHTML = coupon_code;
	document.getElementById("discount-code").style.display = "block";
}

window.onload = function()
{
	let rewards_tab_elements = document.getElementsByClassName("rewards-tab");
	for(let i=0; i<rewards_tab_elements.length; i++)
	{
		rewards_tab_elements[i].style.display = "none";
	}

	let your_rewards_tab_elements = document.getElementsByClassName("your-rewards-tab");
	for(let h = 0; h < your_rewards_tab_elements.length; h++)
	{
		your_rewards_tab_elements[h].style.display = "none";
	}

	let data = @json($app_data['customization']);
	let color = data.theme_color;

	document.getElementById("earn_points_tab").style.cursor = "default";
	if(Object.keys(data).length === 0)
	{
		document.getElementById("earn_points_tab").style.color = "blue";
		document.getElementById("earn_points_tab").style.borderBottom = "2px solid blue";
	}
	else
	{
		document.getElementById("earn_points_tab").style.color = data.theme_color;
                document.getElementById("earn_points_tab").style.borderBottom = "2px solid "+color;
	}

	document.getElementById("rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";
        document.getElementById("your_rewards_tab").style.cssText = "border:transparent;color: rgb(75 85 99);border:rgb(209 213 219);cursor:default;";

	if({{$enabled_activities}} == 0)
	{
		document.getElementById("no_data_card").style.display = "block";

		document.getElementById("no_data_card_heading").innerHTML = "Currently no way to earn points";
	}
}

function customization()
{
	let data = @json($app_data['customization']);
	if(Object.keys(data).length === 0)
	{
		let element = document.getElementsByClassName("elements");
		for (let i = 0; i < element.length; i++)
		{
			element[i].style.backgroundColor = "slateblue";
			element[i].style.color = "white";
		}
	}
	else
	{
		let element = document.getElementsByClassName("elements");
                for (let i = 0; i < element.length; i++)
                {
                        element[i].style.backgroundColor = data.theme_color;
                        element[i].style.color = data.widget_text;
                }
	}
}
customization();
</script>
</html>

