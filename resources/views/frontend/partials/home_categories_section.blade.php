@php $home_categories = json_decode(get_setting('home_categories')); @endphp
<section class="mb-4">
    <div class="container">
        <div>
            <h6 class=" h5 mt-5 mb-3 text-center">{{ translate('Handpicked
            For You') }}</h6>
        </div>
        <div class="nav filters-button-group tst text-uppercase mb-3 mb-md-4 mobile-hor-swipe d-md-flex justify-content-center align-items-center tts" >
            <a class="text-reset bg-transparent border-0 button fw-500 px-3 pl-xl-0 py-2 tts text-uppercase fs-12 opacity-70 active " data-toggle="tab" href="#all-category">
                <div class="d-flex flex-column align-items-center">
                    <div class="img-back bg-alter-2 d-flex align-items-center justify-content-center tts my-2">
                        <img src="{{ static_asset('assets/img/all_featured_icon.png') }}" alt="">
                    </div>
                {{ translate('Featured Products') }}
                </div>
            </a>
            @foreach ($home_categories as $key => $value)
                @php $category = \App\Category::find($value); @endphp
                @if($category != null)
                <a class="bg-transparent tts border-0 button fw-500 px-3 py-2 text-uppercase text-reset fs-12 opacity-70" data-toggle="tab" href="#category-{{ $category->id }}">
                    <div class="d-flex flex-column align-items-center" >
                            <div class="img-back  bg-alter-2  d-flex align-items-center justify-content-center tts my-2">
                                <img  src="{{ uploaded_asset($category->icon) }}" alt="">
                            </div>
                        {{ $category->getTranslation('name') }}
                    </div>
                </a>
                @endif
            @endforeach
        </div>
        <div class="tab-content  ttb" >
            <div class="tab-pane fade show active" id="all-category" >
                <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 gutters-5">
                    @foreach (\App\Product::where('published', '1')->where('featured', '1')->latest()->limit(10)->get() as $key => $product)
                    <div class="col mb-2">
                        @include('frontend.partials.product_box_3',['product'=>$product])
                    </div>
                    @endforeach
                </div>
            </div>
            @foreach ($home_categories as $key => $value)
                @php $category = \App\Category::find($value); @endphp
                @if ($category != null)
                    <div class="tab-pane fade" id="category-{{ $category->id }}" >
                        <div class="row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 gutters-5">
                            @foreach (get_cached_products($category->id) as $key => $product)
                            <div class="col mb-2">
                                @include('frontend.partials.product_box_2',['product'=>$product,'type'=>'handpick','cati'=>$category->slug])
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<script>
      $('a[data-toggle="tab"]').on('hidden.bs.tab', function (event) {
        event.target;// newly activated tab
        AIZ.plugins.slickCarousel();
        event.relatedTarget; // previous active tab

        })
</script>
