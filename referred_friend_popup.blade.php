<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer src="https://cdn.tailwindcss.com/3.4.3"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
@php
    $customization = json_decode(htmlspecialchars_decode(json_encode($app_data['customization']), ENT_QUOTES), true);
@endphp

<style>
.buttons 
{
        color: {{ !empty($customization) && isset($customization['widget_text']) ? $customization['widget_text'] : 'white' }};
        background-color: {{ !empty($customization) && isset($customization['theme_color']) ? $customization['theme_color'] : 'slateblue' }};
}
body {
    font-family: auto;
}

</style>
<body>
<div class="flex justify-between px-4 pt-4">
    	<div>
        	<p class="text-lg font-bold cursor-default">Get your coupon</p>
   	</div>
       	<div>
          	<button type="button" id="cross" class="ms-auto -mx-1.5 -my-1.5 bg-white text-black hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-default" aria-label="Close">
          		<span class="sr-only">Close</span>
                      	<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
           	</button>
      	</div>
</div>
<p class="font-normal text-gray-700 px-4 cursor-default">You’ve got a gift from a friend! Apply this code during checkout to enjoy your reward.</p>
<div class="flex mx-4 mt-2">
	<svg class="h-3 mt-1.5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
    		<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
	</svg>
	<p class="font-normal text-gray-700 px-3 cursor-default">Your gift: <strong class="text-black">{{$friend_reward}}% off</strong></p>
</div>
<form id="myForm" onsubmit="claim_reward()">
<div class="flex justify-center w-full mt-4 mb-2">
	<input type="email" id="email" class="w-80 bg-gray-50 border border-black text-gray-900 text-normal block p-2" placeholder="Enter your email" required />
	<input type="text" id="coupon_code" class="w-80 text-center bg-gray-50 border border-black text-gray-900 text-normal hidden p-2" value="" disabled readonly>
</div> 
<p id="not_eligible_warning" class="text-red-600 text-normal text-center hidden mb-1">You're not eligible to join this referral program.</p>
<div class="flex justify-center w-full">
	<button id="claim_button" type="submit" class="h-11 font-medium text-normal px-5 py-2.5 w-80 focus:outline-none buttons">Claim gift</button>
	<div id="spinner" role="status" class="absolute bottom-14" style="display:none;">
                <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-white-400" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
	</div>
	<button id="copy_button" type="button" onclick="copy_discount_code()" class="h-11 font-medium text-normal px-5 py-2.5 w-80 focus:outline-none hidden buttons">Copy</button>
</div>
</form>
</body>
<script>
document.getElementById("cross").addEventListener("click", function()
{
        window.parent.postMessage("closeReferredFriendPopup", "*");
});

let form = document.getElementById('myForm');
form.addEventListener('submit', function(event) {
	    event.preventDefault();
});

function copy_discount_code()
{
	if (document.selection) 
        {
                let range = document.body.createTextRange();
                range.moveToElementText(document.getElementById('coupon_code'));
                range.select().createTextRange();
                document.execCommand("copy");
        } 
        else if (window.getSelection) 
        {
                let range = document.createRange();
                range.selectNode(document.getElementById('coupon_code'));
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
        }
        document.getElementById('copy_button').innerHTML = "Copied";
        
        setTimeout(function() {    
                        document.getElementById('copy_button').innerHTML = "Copy";
        }, 2000);
}

async function claim_reward()
{
	document.getElementById('not_eligible_warning').style.display = "none";
        document.getElementById('spinner').style.display = "block";
	document.getElementById('claim_button').innerHTML = "";
	let email = document.getElementById('email').value;
        url  = "{{my_app_env('APP_URL')}}/api/claim_referred_friend_reward/{{$shop->our_passw_token}}?customer_id={{$customer_id}}&friend_reward={{$friend_reward}}&email="+email;
        await fetch(url,  {
        method: "get",
        }).then(r => r.json()).then(data => {
        if(data['res'] == "1")
	{
		document.getElementById("coupon_code").value = data['coupon_code'];
		document.getElementById("coupon_code").style.display = "block";
		document.getElementById("email").style.display = "none";
		document.getElementById('spinner').style.display = "none";
		document.getElementById('claim_button').style.display = "none";
		document.getElementById('copy_button').style.display = "block";
	}
	else
	{
		document.getElementById('spinner').style.display = "none";
		document.getElementById('claim_button').innerHTML = "Claim gift";
		document.getElementById('not_eligible_warning').style.display = "block";
	}
	});
}

</script>
</html>

