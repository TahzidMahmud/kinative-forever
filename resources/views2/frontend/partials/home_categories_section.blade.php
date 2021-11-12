@php $filter_categories = get_setting('filter_categories'); @endphp
<section class="py-5 bg-white">
    <div class="container">
        <div class="mb-3 d-flex justify-content-center">
            <div class="af-sec-title text-center">
                <h3 class="h4 fw-700 text-uppercase text-primary fs-20 ">{{ translate('Shop by categories') }}</h3>
            </div>
        </div>
        <div class="nav justify-content-center filters-button-group text-uppercase text-center mb-3 mb-md-4 mobile-hor-swipe">
            <a class="text-reset bg-transparent border-0 button fw-600 px-3 py-2 text-uppercase fs-13 opacity-70 active" data-toggle="tab" href="#all-category">{{ translate('All Featured') }}</a>
            @foreach (json_decode($filter_categories) as $key => $value)
                @php $category = \App\Category::find($value); @endphp
                @if($category != null)
                    <a class="bg-transparent border-0 button fw-600 px-3 py-2 text-uppercase text-reset fs-13 opacity-70" data-toggle="tab" href="#category-{{ $category->id }}">{{ $category->getTranslation('name') }}</a>
                @endif
            @endforeach
        </div>
        <div class="tab-content" >
            <div class="tab-pane fade show active" id="all-category" >
                <div class="row row-cols-xxl-6 row-cols-lg-6 row-cols-md-4 row-cols-sm-3 row-cols-2 gutters-5">
                    @foreach (\App\Product::where('published', '1')->where('featured', '1')->latest()->limit(12)->get() as $key => $product)
                    <div class="col mb-2">
                        @include('frontend.partials.product_box_1',['product'=>$product])
                    </div>
                    @endforeach
                </div>
            </div>
            @foreach (json_decode($filter_categories) as $key => $value)
                @php $category = \App\Category::find($value); @endphp
                @if ($category != null)
                    <div class="tab-pane fade" id="category-{{ $category->id }}" >
                        <div class="row row-cols-xl-6 row-cols-lg-6 row-cols-md-4 row-cols-sm-3 row-cols-2 gutters-5">
                            @foreach (get_cached_products($category->id) as $key => $product)
                            <div class="col mb-2">
                                @include('frontend.partials.product_box_1',['product'=>$product])
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
