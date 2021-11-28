<div class="aiz-card-box hov-shadow-md mb-2 has-transition bg-white">
    @php
        $discount_applicable = false;
        $lowest_price = $product->stocks->min('price');
        if($lowest_price == 0){
        $lowest_price=1;
        }
      
        $discount_percent = 0;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        }
        elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
            $discount_applicable = true;
        }
        
        if ($discount_applicable) {
            if($product->discount_type == 'percent'){
                $discount_percent = round($product->discount);
            }
            elseif($product->discount_type == 'amount'){
              
                $discount_percent = round($product->discount*100/$lowest_price);
            }
        }
    @endphp

    <div class="position-relative">
        @if($discount_percent > 0)
        <span class="badge badge-inline badge-danger absolute-top-right z-1 fs-12 text-uppercase px-2 py-1 d-inline-block h-auto" style="background:#f00">{{ $discount_percent }}% OFF</span>
        @endif
        <a href="{{ route('product', $product->slug) }}" class="d-block">
            <img
                class="img-fit lazyload mx-auto h-160px h-md-230px"
                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                alt="{{  $product->getTranslation('name')  }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            >
        </a>
        <div class="absolute-top-right aiz-p-hov-icon  ">
            <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                <i class="la la-heart-o"></i>
            </a>
            <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                <i class="las la-sync"></i>
            </a>
            <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                <i class="las la-shopping-cart"></i>
            </a>
        </div>
    </div>
    <div class="p-md-2 p-2 text-left">
        <h3 class="fw-500 fs-13 text-truncate lh-1-4 h-16px mb-2 mt-2">
            <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{  $product->getTranslation('name')  }}</a>
        </h3>
        <div class="fs-15 mb-1">
            @if(home_base_price($product) != home_discounted_base_price($product))
                <del class="fw-800 opacity-50 mr-1">{{ home_base_price($product) }}</del>
            @endif
            <span class="fw-800 text-primary">{{ home_discounted_base_price($product) }}</span>
        </div>
        {{-- <a href="{{ route('product', $product->slug) }}" class="text-alter text-uppercase fs-10 fw-500">{{ translate('View Product') }}</a> --}}
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                {{ translate('Club Point') }}:
                <span class="fw-700 float-right">{{ $product->earn_point }}</span>
            </div>
        @endif
    </div>
</div>
