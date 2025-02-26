function findCustomerId() {
       if ( __st.cid ) {
               return __st.cid;
       }

        if (window.ShopifyAnalytics && window.ShopifyAnalytics.meta && window.ShopifyAnalytics.meta.page && window.ShopifyAnalytics.meta.page.customerId)
        {
                return window.ShopifyAnalytics.meta.page.customerId;
        }

       let urlParams = new URLSearchParams(window.location.search);
       if (urlParams.has('accountnumber')) {
           return urlParams.get('accountnumber');
       }

       return false;
}

function getKeyFromLocal(key) {
        var item = JSON.parse(localStorage.getItem('bossLyTy'));
        if ( item ){
                if(item[key] !== undefined && item[key] !== null ) {
                        return item[key];
                }
        }
        return false;
}

function setKeysToLocal(key, value)
{
    var result = JSON.parse(localStorage.getItem('bossLyTy'));

    if (! result ) {
        var result = {};
    }

    result[key] = value;
    var serializedItem = JSON.stringify(result);
    localStorage.setItem('bossLyTy', serializedItem);
}

async function save_visit_points(customer_id)
{
	var last_visit = getKeyFromLocal(customer_id);
        var today = new Date().toISOString().slice(0, 10);
        if(customer_id && {{$visit_activity_state}} == 1)
	{
                if(!last_visit)
                {
                        setKeysToLocal(customer_id, today);
                }
                else
                {
                        if(today > last_visit)
			{
                                await fetch("{{my_app_env('APP_URL')}}/api/save_visit_entry/{{$shop->our_passw_token}}/"+customer_id,{method: "GET",});
                                setKeysToLocal(customer_id, today);
                        }
                }
        }
}

function prepare_referred_friend_frame(customer_id)
{
	let popup = document.createElement("iframe");
        popup.id = "bunnyReferredFriendIframe";
        popup.style.cssText = 'background:white;opacity:1;position:fixed;bottom:25px;z-index:2147483647;width:412px;height:278px;border:none;border-radius:10px;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);';

        iframe_styling_from_db(popup);

        document.body.appendChild(popup);

        popup.setAttribute("src", "{{my_app_env('APP_URL')}}/referred_friend_popup/{{$shop->our_passw_token}}/"+customer_id);
}

function prepareFrame()
{
        let ifrm = document.createElement("iframe");
        ifrm.id = "bunnyLoyaltyIframe";
	ifrm.style.cssText = 'background:white;opacity:1;display:none;position:fixed;bottom:90px;z-index:2147483647;width:346px;height:400px;border:none;border-radius:10px;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);';

	ifrm.setAttribute('srcdoc','<h2 style="padding-top:50%;text-align:center;">Loading...</h2>');
        iframe_styling_from_db(ifrm);

        document.body.appendChild(ifrm);

        load_html_of_iframe(ifrm);
}

function iframe_styling_from_db(ifrm)
{
	let data = @json($app_data['customization']);
	if(Object.keys(data).length === 0)
        {
                ifrm.style.right = '15px';
        }
	else
	{
                if(data.align == "right")
                {
                        ifrm.style.right = "15px";
                }
                if(data.align == "left")
                {
                        ifrm.style.left = "15px";
                }
        }
}

function load_html_of_iframe(ifrm)
{
	let customer_id = findCustomerId();
        if( customer_id )
        {
		ifrm.setAttribute('loading', 'lazy');
                ifrm.onload = function()
                {
			ifrm.removeAttribute('srcdoc');
                        ifrm.style.background = "#f6f6f7";
                }
                ifrm.setAttribute("src", "{{my_app_env('APP_URL')}}/points_popup/{{$shop->our_passw_token}}/"+customer_id);
                save_visit_points(customer_id);
        }
        else
        {
                ifrm.onload = function()
		{
			ifrm.removeAttribute('srcdoc');
                        ifrm.style.background = "#f6f6f7";
                }

                ifrm.setAttribute("src", "{{my_app_env('APP_URL')}}/signup_popup/{{$shop->our_passw_token}}");
        }
}

function widget_styling_from_db(widget)
{
	let data = @json($app_data['customization']);
        if(Object.keys(data).length != 0)
        {
		widget.style.cssText = "position:fixed;bottom:20px;height:50px;border-radius:13px;z-index:9;font-size:15px;cursor:pointer;border:none;font-family:auto;";
		widget.style.backgroundColor = data.theme_color;
		widget.style.color = data.widget_text;
		
                if(data.align == "right")
		{
			widget.style.right = "15px";
                }

                if(data.align == "left")
		{
			widget.style.left = "15px";
		}
	
		if(data.display_type == "icon_and_text")
		{
			widget.style.width = "136px";

			let svgElement = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        		svgElement.setAttribute("id", "loyalty_icon");
        		svgElement.setAttribute("style", "height:38px;position: absolute; top: 50%; left: 13%; transform: translate(-50%, -50%);");
			svgElement.setAttribute("xmlns", "http://www.w3.org/2000/svg");
			svgElement.style.fill = data.widget_text;
        		svgElement.setAttribute("viewBox", "0 0 20 20");

        		let pathElement = document.createElementNS("http://www.w3.org/2000/svg", "path");
        		pathElement.setAttribute("fill-rule", "evenodd");
        		pathElement.setAttribute("d", "M9.716 14.806c.035.005.07.008.106.011l1.4 2.44c.378.66 1.324.673 1.72.024l.479-.781h1.226c.772 0 1.253-.837.864-1.504l-1.167-2c.446-.476.67-1.16.504-1.88-.056-.237.046-.482.252-.61 1.3-.81 1.3-2.702 0-3.511-.206-.128-.308-.374-.252-.61.346-1.491-.992-2.83-2.483-2.482-.236.055-.482-.047-.61-.253-.81-1.3-2.7-1.3-3.51 0-.128.206-.374.308-.61.253-1.492-.347-2.83.99-2.482 2.482.055.236-.047.482-.253.61-1.3.81-1.3 2.7 0 3.51.206.128.308.374.253.61-.135.577-.017 1.131.265 1.573l-1.346 2.308c-.39.667.092 1.504.863 1.504h1.164l.55.825c.415.623 1.342.585 1.706-.07l1.361-2.45Zm-1.31-.73c-.058-.07-.111-.146-.161-.226-.128-.206-.374-.307-.61-.252-.35.08-.69.07-1.003-.014l-.826 1.416h.56c.335 0 .647.167.832.445l.244.365.964-1.735Zm4.582-.428.789 1.352h-.637c-.348 0-.671.181-.853.478l-.184.301-.807-1.407c.174-.141.33-.315.46-.522.127-.206.373-.307.61-.252.211.049.42.064.622.05Zm-3.47-.59c.222.356.742.356.964 0 .468-.752 1.361-1.122 2.223-.921.41.095.777-.273.681-.682-.2-.862.17-1.756.921-2.223.357-.222.357-.742 0-.964-.75-.467-1.121-1.361-.92-2.223.095-.41-.273-.777-.682-.681-.862.2-1.755-.17-2.223-.921-.222-.357-.742-.357-.964 0-.467.75-1.361 1.121-2.223.92-.41-.095-.777.273-.681.682.2.862-.17 1.756-.921 2.223-.357.222-.357.742 0 .964.75.467 1.121 1.361.92 2.223-.095.41.273.777.682.681.862-.2 1.756.17 2.223.921Z");

        		svgElement.appendChild(pathElement);
        		widget.appendChild(svgElement);

        		let text = document.createElement("p");
			text.innerHTML = "Loyalty Points";
			text.setAttribute("style","padding-left:29px;width:136px;position:absolute;left:1px;bottom:1px;font-weight:bold;");
        		widget.appendChild(text);
		}
		if(data.display_type == "text_only")
		{
			widget.style.width = "115px";

			let text = document.createElement("p");
			text.innerHTML = "Loyalty Points";
			text.setAttribute("style","width:115px;position:absolute;left:1px;bottom:1px;font-weight:bold;");
                        widget.appendChild(text);
		}
		if(data.display_type == "icon_only")
		{
			widget.style.width = "52px";

			let svgElement = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        svgElement.setAttribute("id", "loyalty_icon");
			svgElement.setAttribute("style", "height:38px;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);");
			svgElement.style.fill = data.widget_text;
                        svgElement.setAttribute("xmlns", "http://www.w3.org/2000/svg");
                        svgElement.setAttribute("viewBox", "0 0 20 20");

                        let pathElement = document.createElementNS("http://www.w3.org/2000/svg", "path");
                        pathElement.setAttribute("fill-rule", "evenodd");
                        pathElement.setAttribute("d", "M9.716 14.806c.035.005.07.008.106.011l1.4 2.44c.378.66 1.324.673 1.72.024l.479-.781h1.226c.772 0 1.253-.837.864-1.504l-1.167-2c.446-.476.67-1.16.504-1.88-.056-.237.046-.482.252-.61 1.3-.81 1.3-2.702 0-3.511-.206-.128-.308-.374-.252-.61.346-1.491-.992-2.83-2.483-2.482-.236.055-.482-.047-.61-.253-.81-1.3-2.7-1.3-3.51 0-.128.206-.374.308-.61.253-1.492-.347-2.83.99-2.482 2.482.055.236-.047.482-.253.61-1.3.81-1.3 2.7 0 3.51.206.128.308.374.253.61-.135.577-.017 1.131.265 1.573l-1.346 2.308c-.39.667.092 1.504.863 1.504h1.164l.55.825c.415.623 1.342.585 1.706-.07l1.361-2.45Zm-1.31-.73c-.058-.07-.111-.146-.161-.226-.128-.206-.374-.307-.61-.252-.35.08-.69.07-1.003-.014l-.826 1.416h.56c.335 0 .647.167.832.445l.244.365.964-1.735Zm4.582-.428.789 1.352h-.637c-.348 0-.671.181-.853.478l-.184.301-.807-1.407c.174-.141.33-.315.46-.522.127-.206.373-.307.61-.252.211.049.42.064.622.05Zm-3.47-.59c.222.356.742.356.964 0 .468-.752 1.361-1.122 2.223-.921.41.095.777-.273.681-.682-.2-.862.17-1.756.921-2.223.357-.222.357-.742 0-.964-.75-.467-1.121-1.361-.92-2.223.095-.41-.273-.777-.682-.681-.862.2-1.755-.17-2.223-.921-.222-.357-.742-.357-.964 0-.467.75-1.361 1.121-2.223.92-.41-.095-.777.273-.681.682.2.862-.17 1.756-.921 2.223-.357.222-.357.742 0 .964.75.467 1.121 1.361.92 2.223-.095.41.273.777.682.681.862-.2 1.756.17 2.223.921Z");

                        svgElement.appendChild(pathElement);
                        widget.appendChild(svgElement);
		}
        }
        if(Object.keys(data).length === 0)
        {
                widget.style.cssText = "position:fixed;bottom:20px;right:15px;width:136px;height:50px;border-radius:13px;z-index:9;font-size:15px;cursor:pointer;border:none;background-color:slateblue;color:white;font-family:auto;";
	
		let svgElement = document.createElementNS("http://www.w3.org/2000/svg", "svg");
              	svgElement.setAttribute("id", "loyalty_icon");
         	svgElement.setAttribute("style", "height:38px;fill:white;position: absolute; top: 50%; left: 13%; transform: translate(-50%, -50%);");
             	svgElement.setAttribute("xmlns", "http://www.w3.org/2000/svg");
          	svgElement.setAttribute("viewBox", "0 0 20 20");

           	let pathElement = document.createElementNS("http://www.w3.org/2000/svg", "path");
         	pathElement.setAttribute("fill-rule", "evenodd");
          	pathElement.setAttribute("d", "M9.716 14.806c.035.005.07.008.106.011l1.4 2.44c.378.66 1.324.673 1.72.024l.479-.781h1.226c.772 0 1.253-.837.864-1.504l-1.167-2c.446-.476.67-1.16.504-1.88-.056-.237.046-.482.252-.61 1.3-.81 1.3-2.702 0-3.511-.206-.128-.308-.374-.252-.61.346-1.491-.992-2.83-2.483-2.482-.236.055-.482-.047-.61-.253-.81-1.3-2.7-1.3-3.51 0-.128.206-.374.308-.61.253-1.492-.347-2.83.99-2.482 2.482.055.236-.047.482-.253.61-1.3.81-1.3 2.7 0 3.51.206.128.308.374.253.61-.135.577-.017 1.131.265 1.573l-1.346 2.308c-.39.667.092 1.504.863 1.504h1.164l.55.825c.415.623 1.342.585 1.706-.07l1.361-2.45Zm-1.31-.73c-.058-.07-.111-.146-.161-.226-.128-.206-.374-.307-.61-.252-.35.08-.69.07-1.003-.014l-.826 1.416h.56c.335 0 .647.167.832.445l.244.365.964-1.735Zm4.582-.428.789 1.352h-.637c-.348 0-.671.181-.853.478l-.184.301-.807-1.407c.174-.141.33-.315.46-.522.127-.206.373-.307.61-.252.211.049.42.064.622.05Zm-3.47-.59c.222.356.742.356.964 0 .468-.752 1.361-1.122 2.223-.921.41.095.777-.273.681-.682-.2-.862.17-1.756.921-2.223.357-.222.357-.742 0-.964-.75-.467-1.121-1.361-.92-2.223.095-.41-.273-.777-.682-.681-.862.2-1.755-.17-2.223-.921-.222-.357-.742-.357-.964 0-.467.75-1.361 1.121-2.223.92-.41-.095-.777.273-.681.682.2.862-.17 1.756-.921 2.223-.357.222-.357.742 0 .964.75.467 1.121 1.361.92 2.223-.095.41.273.777.682.681.862-.2 1.756.17 2.223.921Z");

		svgElement.appendChild(pathElement);
          	widget.appendChild(svgElement);

          	let text = document.createElement("p");
            	text.innerHTML = "Loyalty Points";
         	text.setAttribute("style","padding-left:29px;font-weight:bold;");
		widget.appendChild(text);
	}
}

window.onload = async function()
{
	let queryString = window.location.search;
	let params = new URLSearchParams(queryString);
	let hasBunnyRefParam = params.has("bunny_ref");
	let bunnyRefValue = params.get("bunny_ref");

	if(hasBunnyRefParam)
	{
		prepare_referred_friend_frame(bunnyRefValue);
	}

	else
	{
        	prepareFrame();
        	let widget = document.createElement("button");

        	widget_styling_from_db(widget);

        	document.body.appendChild(widget);
        	widget.onclick = function()
        	{
                	document.getElementById("bunnyLoyaltyIframe").style.display = "flex";
        	}
	}
}
window.addEventListener("message", function(event)
{
        if (event.data === "closeIframe")
        {
                document.getElementById("bunnyLoyaltyIframe").style.display = "none";
	}
	if (event.data === "closeReferredFriendPopup")
        {
                document.getElementById("bunnyReferredFriendIframe").style.display = "none";
        }
});

