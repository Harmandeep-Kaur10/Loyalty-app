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

body {
        font-family:auto;
}

    .elements {
        color: {{ !empty($customization) && isset($customization['widget_text']) ? $customization['widget_text'] : 'white' }};
        background-color: {{ !empty($customization) && isset($customization['theme_color']) ? $customization['theme_color'] : 'slateblue' }};
    }
</style>

<body>

<div class="flex justify-between elements p-4">
        <h5 class="text-xl font-bold">Introducing Loyalty Points</h5>
        <button type="button" id="cross" class="rounded-lg focus:ring-2 p-1.5 inline-flex ring-white h-8 w-8 justify-center items-center" data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
        </button>
</div>

<div class="mt-4">
	<div class="flex justify-center p-4 text-center">
<p><span class="font-bold text-xl">Start earning rewards today!</span><br><br>
<span>Log in to the store to see your points here</span><br>Open this widget after logging in.</p>
{{--                <p>Sign up to <span class="font-bold inline">{{$shop->name}}'s</span> store to start earning rewards</p>--}}
	</div>
<div class="flex justify-center">
	<a href="https://shopify.com/{{$shop_json['id']}}/account" target="_top">
                <button type="button" class="border border-gray-300 focus:outline-none focus:ring-4 font-medium rounded-lg text-base px-4 py-0.5 focus:ring-gray-100 elements">Log In / Sign Up</button>
	</a>
</div>
</div>


{{--
<div class="mt-8">
<div class="flex justify-center p-4 text-center">
	<p class="">Already have an account?</p>
</div>

<div class="flex justify-center">
	<a href="https://shopify.com/{{$shop_json['id']}}/account" target="_top">
                 <button type="button" class="border border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-base px-5 py-0.5 elements">Log In</button>
        </a>
</div>
</div>
--}}
</body>

<script>

document.getElementById("cross").addEventListener("click", function()
{
	window.parent.postMessage("closeIframe", "*");
});

</script>
</html>

