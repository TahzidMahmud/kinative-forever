<div class="aiz-card-box bg-white has-transition hov-shadow-md mb-2 mt-1  border">
    <div class="position-relative">
        <a href="{{ route('product', $product->slug) }}" class="d-block">
            <img
                class="img-fit lazyload mx-auto"
                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                alt="{{  $product->getTranslation('name')  }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            >
        </a>
    </div>
    <div class="px-md-3 px-2 pt-3 text-center pb-0">
        <div class="fw-700 fs-13  ">
            <a href="{{ route('product', $product->slug) }}" class="d-block text-reset text-truncate-2 l-h-1 lh-1-2 h-35px ">{{  $product->getTranslation('name')  }}</a>
        </div>
        <div class="fs-13 mb-5 fw-500">
            @if(home_base_price($product) != home_discounted_base_price($product))
                <del class=" opacity-50 mr-1">{{ home_base_price($product) }}</del>
            @endif
            <span class="fw-500 text-dark">{{ $product->unit }}</span>
            <span class="fw-500 text-dark m-1">|</span>
            <span class="fw-500 text-primary">{{ home_discounted_base_price($product) }}</span>
        </div>
        {{-- @if($product->variant_product == 1)
            <button type="button" class="btn text-primary fw-600 fs-13" onclick="showAddToCartModal({{ $product->id }})">{{ translate('Add To Cart') }}</button>
        @else
            <button type="button" class="btn text-primary fw-600 fs-13" onclick="addToCart(this)" data-id="{{ $product->id }}">{{ translate('Add To Cart') }}</button>
        @endif --}}
    </div>
</div>
