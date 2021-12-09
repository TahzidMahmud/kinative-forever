<div class="aiz-card-box hov-shadow-md mb-2 has-transition ">
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
        $photos = explode(',', $product->photos);
    @endphp

    <div class="position-relative">
        @if($discount_percent > 0)
        <span class="badge badge-inline badge-danger absolute-top-right z-1 fs-12 text-uppercase px-2 py-1 d-inline-block h-auto" style="background:#f00">{{ $discount_percent }}% OFF</span>
        @endif
        @if($product->todays_deal == 1)
        <div class=" absolute-top-right fs-12 text-uppercase mx-2 my-2 px-3 py-3 d-inline-block h-auto d-flex justify-content-center align-items-center text-white" style="background:#f00;height:3rem;width:3rem;border-radius:50%;"><span class="fw-700 fs-11">Sale</span></div>
        @endif
        <div class=""  data-fade='true' data-auto-height='true'>
            @if($photos[0]!= "")
                {{-- @foreach ($photos as $key => $photo) --}}

                    <div class="rounded">
                        <a href="{{ route('product', $product->slug) }}" class="d-block">
                        <img
                        id="productimg-{{$type}}-{{ $cati }}-{{ $product->id }}"
                            class="img-fluid lazyload img-cus"
                            src="{{ static_asset('assets/img/placeholder.jpg') }}"

                            data-src="{{ uploaded_asset($photos[0]) }}"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                        >
                        </a>
                    </div>
                {{-- @endforeach --}}
            @else
                     {{-- for variants pics  --}}
            {{-- @foreach ($product->stocks as $key => $stock) --}}
                {{-- @if ($stock->image != null) --}}
                @php
                    $imgs=explode(",",$product->stocks[0]->image);
                @endphp
                {{-- @foreach ($imgs as $key => $img) --}}
                    <div class=" rounded">
                        <a href="{{ route('product', $product->slug) }}" class="d-block">
                            <img
                            id="productimg-{{$type}}-{{ $cati }}-{{ $product->id }}"
                                class="img-fluid lazyload img-cus"

                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($imgs[0]) }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                            >
                        </a>
                    </div>
                {{-- @endforeach --}}
                {{-- @endif --}}
            {{-- @endforeach --}}
            @endif

        </div>

        <div class="absolute-top-right aiz-p-hov-icon  ">
            <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                <i class="la la-heart-o"></i>
            </a>
            <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                <i class="las la-sync"></i>
            </a>
            <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Quick View') }}" data-placement="left">
                <i class="las la-eye"></i>
            </a>
        </div>
    </div>
    <div class="p-md-2 p-2 text-left">
        <h3 class="fw-500 fs-14 text-truncate lh-1-4 h-16px mb-2 mt-2">
            <a href="{{ route('product', $product->slug) }}" class="d-block text-reset text-center">{{  $product->getTranslation('name')  }}</a>
        </h3>
       <div style="height: 2rem;">
            @if (count(json_decode($product->colors)) > 0)
                <div class="row no-gutters d-flex justify-content-center align-items-center">
                    <div class="col newcar">
                        <div class="aiz-radio-inline">
                            <div class="aiz-carousel half-outside-arrow mobile-img-auto-height dot-small-white " data-dots="false" data-autoplay='true'  data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="3" data-xs-items="3" data-arrows="true">
                                @foreach (json_decode($product->colors) as $key => $color)

                                    <div class="carousel-box d-flex align-items-center" id="{{ $cati}}" onclick="changephoto1({{ $product->id}},{{$key}},this.id)">
                                            <label class="aiz-megabox my-0 py-0" data-toggle="tooltip" data-title="{{ \App\Color::where('code', $color)->first()->name }}">

                                                <input
                                                type="radio"
                                                name="color"
                                                value="{{ \App\Color::where('code', $color)->first()->name }}"

                                            >
                                            <span class="size-25px d-inline-block  aiz-megabox-elem px-1" style="background: {{ $color }};border-radius: 25px;"></span>
                                            </label>

                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            @endif
       </div>

        <div class="fs-15 mb-1 text-center">
            @if(home_base_price($product) != home_discounted_base_price($product))
                <del class="fw-600 opacity-50 mr-1 text-dark">{{ home_base_price($product) }}</del>
            @endif
            <span class="fw-600 text-alter-2">{{ home_discounted_base_price($product) }}</span>
        </div>
        {{-- <a href="{{ route('product', $product->slug) }}" class="text-alter text-uppercase fs-10 fw-500">{{ translate('View Product') }}</a> --}}
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                {{ translate('Club Point') }}:
                <span class="fw-500 float-right ">{{ $product->earn_point }}</span>
            </div>
        @endif
    </div>

</div>

<script>

    function changephoto1(id,tt,dd){
        var p_id=id;
        var variation_id=tt;

        $.ajax({
                   type:"POST",
                   url: '{{ route('image.get') }}',
                   data:{
                    _token : AIZ.data.csrf,
                       id:p_id,
                       variation:variation_id
                   },
                   success: function(data){

                    var ids=`#productimg-{{$type}}-${dd}-${p_id}`;
                    console.log('from1',ids);
                       $(ids).attr("src",data.image);
                    }
               });
    }
</script>
