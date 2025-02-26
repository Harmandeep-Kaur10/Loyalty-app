@extends ('shopconnect::shopify_app')

@section ('content')

<style>
        .customerName
	{
		padding-bottom: 4px;
    		font-weight: var(--p-text-heading-sm-font-weight);
    		font-size: var(--p-text-heading-sm-font-size);
    		line-height: var(--p-text-heading-sm-font-line-height);
    		padding-top: 4px;
		text-align:left;
        }
        .customerName:hover
        {
                text-decoration:underline;
	}
	.data
	{
		padding-bottom: 4px;
    		font-size: var(--p-text-heading-sm-font-size);
    		line-height: var(--p-text-heading-sm-font-line-height);
    		padding-top: 4px;
		text-align:left;
	}
	.row:hover
	{
		background-color:ghostwhite;
	}
	.row
	{
		cursor:pointer;
	}
	.heading
	{
		text-align:left;
		cursor:default;
		color:darkgrey;
		background-color:whitesmoke;
		padding-bottom: 4px;
    		font-weight: var(--p-text-heading-sm-font-weight);
    		font-size: var(--p-text-heading-sm-font-size);
    		line-height: var(--p-text-heading-sm-font-line-height);
    		padding-top: 7px;
	}
</style>
<!------------------------table----------------------->
@if(count($customers) > 0)
<div class="Polaris-Page" style="position:absolute;top:25px;width:75%;padding-left:0px;padding-right:0px;margin-left:11%;margin-right:11%;">
        <div class="Polaris-LegacyCard">
                <div class="Polaris-DataTable__ScrollContainer">
                        <table class="Polaris-DataTable__Table">
                                <thead style="line-height:0;height:33px;">
                                        <tr>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header heading" scope="col">Name</th>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col" style="text-align:left">Email</th>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Activities</th>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Points</th>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Rewards</th>
                                                <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric heading" scope="col">Revenue</th>
                                        </tr>
                                </thead>
                                <tbody id="myTable" style="line-height:0;height:33px;">
				@foreach($customers as $customer_model)
					<tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable row" onClick="show_details({{$customer_model->customer_id}})">
					  	<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric customerName">
							@if($customer_model->name == " ")
                                                                No Name
                                                        @else
                                                                {{ $customer_model->name }}
							@endif
                                                </td>
						<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">@if($customer_model->email == 0)
			unavailable
		      @else
			{{ $customer_model->email }}
		      @endif</td>
						<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">{{ $customer_model->activities }}</td>
						<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">{{ $customer_model->points }}</td>
						<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">{{ count(json_decode($customer_model->rewards)) }}</td>
						<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric data">{{ str_replace("amount", number_format( $customer_model->revenue, 2),"$shop->currency_format") }}</td>
					</tr>
                                @endforeach
                                </tbody>
                        </table>
                </div>
        </div>
</div>
<!---------------pagination-------------------->
<nav aria-label="Pagination" class="Polaris-Pagination" style="display:flex; justify-content:center;position:absolute;left:40%;bottom:2%;">
  <div class="Polaris-ButtonGroup Polaris-ButtonGroup--variantSegmented" data-buttongroup-variant="segmented">
    <div class="Polaris-ButtonGroup__Item">
@if($customers->onFirstPage())
     <a style="cursor:default;"><button id="previousURL" style="pointer-events:none;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Previous" type="button" disabled>
@else
     <a href="{{$customers->previousPageUrl()}}"><button id="previousURL" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Previous" type="button">
@endif
        <span class="Polaris-Button__Icon">
	  <span class="Polaris-Icon">
	    <svg viewBox="0 0 20 20" @if($customers->onFirstPage()) style="fill:lightgrey;" @endif class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
              <path fill-rule="evenodd" d="M11.764 5.204a.75.75 0 0 1 .032 1.06l-3.516 3.736 3.516 3.736a.75.75 0 1 1-1.092 1.028l-4-4.25a.75.75 0 0 1 0-1.028l4-4.25a.75.75 0 0 1 1.06-.032Z">
              </path>
            </svg>
          </span>
        </span>

      </button></a>
    </div>
<div style="padding-right: 15px; padding-left: 15px; cursor:default;"><span> {{$customers->currentPage()}}</span> out of <span>{{$customers->lastPage()}} </span></div>

    <div class="Polaris-ButtonGroup__Item">
@if($customers->onLastPage())
     <a style="cursor:default;"><button id="nextURL" style="pointer-events:none;" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Next" type="button" disabled>
@else
     <a href="{{$customers->nextPageUrl()}}"><button id="nextURL" class="Polaris-Button Polaris-Button--pressable Polaris-Button--variantSecondary Polaris-Button--sizeMedium Polaris-Button--textAlignCenter Polaris-Button--iconOnly" aria-label="Next" type="button">
@endif
        <span class="Polaris-Button__Icon">
	  <span class="Polaris-Icon">
	    <svg viewBox="0 0 20 20" @if($customers->onLastPage()) style="fill:lightgrey;" @endif class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
              <path fill-rule="evenodd" d="M7.72 14.53a.75.75 0 0 1 0-1.06l3.47-3.47-3.47-3.47a.75.75 0 0 1 1.06-1.06l4 4a.75.75 0 0 1 0 1.06l-4 4a.75.75 0 0 1-1.06 0Z">
              </path>
            </svg>
          </span>
        </span>
      </button></a>
    </div>
  </div>
</nav>
@endif
<!--------------No customers card------------->
@if(count($customers) == 0)
<div class="Polaris-LegacyCard" style="margin-left:11%;margin-right:11%;">
        <div class="Polaris-LegacyCard__Section Polaris-LegacyCard__FirstSectionPadding Polaris-LegacyCard__LastSectionPadding">
                <div class="Polaris-Box" style="--pc-box-padding-block-start-xs:var(--p-space-500);--pc-box-padding-block-end-xs:var(--p-space-1600);--pc-box-padding-inline-start-xs:var(--p-space-0);--pc-box-padding-inline-end-xs:var(--p-space-0)">
                        <div class="Polaris-BlockStack" style="--pc-block-stack-inline-align:center;--pc-block-stack-order:column">
                                <div class="Polaris-EmptyState__ImageContainer Polaris-EmptyState__SkeletonImageContainer">
                                        <img alt="" src="https://cdn.shopify.com/s/files/1/0262/4071/2726/files/emptystate-files.png" class="Polaris-EmptyState__Image" role="presentation">
                                        <div class="Polaris-EmptyState__SkeletonImage"></div>
                                </div>
                                <div class="Polaris-Box" style="--pc-box-max-width:400px">
                                        <div class="Polaris-BlockStack" style="--pc-block-stack-inline-align:center;--pc-block-stack-order:column">
                                                <div class="Polaris-Box" style="--pc-box-padding-block-end-xs:var(--p-space-400)">
                                                        <div class="Polaris-Box" style="--pc-box-padding-block-end-xs:var(--p-space-150)">
                                                                <p class="Polaris-Text--root Polaris-Text--headingMd Polaris-Text--block Polaris-Text--center">No Customers Enrolled</p>
                                                        </div>
                                                        <span class="Polaris-Text--root Polaris-Text--bodySm Polaris-Text--block Polaris-Text--center">
                                                                <p>Nothing to display</p>
                                                        </span>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endif

<script>
	function show_details(customer_id)
	{
		startLoading();
		window.location = "{{my_app_env('APP_URL')}}/customer_history/{{$shop->our_passw_token}}?customer_id="+customer_id;
	}
	stopLoading();
</script>
@endsection

