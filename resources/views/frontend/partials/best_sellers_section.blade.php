{{-- @php $home_categories_2 = json_decode(get_setting('home_categories_2')); @endphp
@foreach ($home_categories_2 as $key => $value)
    @php $category = \App\Category::find($value); @endphp
    <section class="pb-5">
        <div class="container">
            <div class="row py-3">
                <div class="col-md-4 col-lg-4 d-none d-lg-block d-md-block">

                </div>
                <div class="col-6 col-md-4 col-lg-4">
                   <div class="d-flex justify-content-center">
                        <h3 class="h6 fw-500 text-uppercase ">
                            <span class="">{{ $category->getTranslation('name') }}</span>
                        </h3>
                   </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary d-flex align-items-center" style="height: 2rem;"  href="{{ route('products.category', $category->slug) }}" class="d-inline-block">
                            <span class="text-alter text-uppercase text-light fs-11 px-2 py-0 my-0">{{ translate('View All') }}</span>

                        </a>
                    </div>

                </div>
            </div>
            <div class="aiz-carousel  gutters-5  dot-small-black" data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='false' data-dots="true" data-infinite='false' data-autoplay='true'>
                @foreach (get_cached_products($category->id) as $key => $product)
                    <div class="carousel-box">
                        @include('frontend.partials.product_box_1',['product'=>$product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endforeach --}}



@php $home_categories = \App\Category::where('parent_id',0)->take(6)->get();


@endphp
<section class="mb-4">
    <div class="container">

        <div class="row">
            <div class="col" style="min-width: 15%;max-width:20%;"></div>
            <div class="col"style="max-width:80%;">
                 <div class="nav flex-grow filters-button-group text-uppercase  mobile-hor-swipe d-block d-md-flex justify-content-around " style="background-color: rgba(255, 255, 255, 0)!important;">
                    @foreach ($home_categories as $key => $value)
                    @if($value != null)
                        @if($key==0)
                            <a class="bg-transparent border-0 button fw-700 px-2 py-4 text-uppercase text-reset fs-12 opacity-40 active" style="display: inline-block;"  data-toggle="tab" href="#categoryl-{{ $value->id }}"><span class="py-4 my-4">{{ $value->getTranslation('name') }}</span></a>
                        @else
                            <a class="bg-transparent border-0 button fw-700 px-2 py-4 text-uppercase text-reset fs-12 opacity-40" style="display: inline-block;"  data-toggle="tab" href="#categoryl-{{ $value->id }}"><span class="py-4 my-4">{{ $value->getTranslation('name') }}</span></a>
                        @endif
                    @endif
                    @endforeach
                 </div>
            </div>
            <div class="col" style="min-width: 10%;max-width:10%;"></div>
        </div>

        <div class="tab-content p-2"  style="background-color: rgba(255, 255, 255, 0);">

            @foreach ($home_categories as $key => $value)

                @if ($value != null)
                    @if($key==0)
                        <div class="tab-pane show active" id="categoryl-{{ $value->id }}" >
                            <div class="row row-cols-xl-5 row-cols-lg-5 row-cols-md-5 row-cols-sm-2 row-cols-2 gutters-5">
                                @foreach (get_cached_products($value->id) as $key => $product)
                                <div class="col mb-2">
                                    @include('frontend.partials.product_box_1',['product'=>$product])
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="tab-pane fade" id="categoryl-{{ $value->id }}" >
                            <div class="row row-cols-xl-5 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 gutters-5">
                                @foreach (get_cached_products($value->id) as $key => $product)
                                <div class="col mb-2">
                                    @include('frontend.partials.product_box_1',['product'=>$product])
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</section>
