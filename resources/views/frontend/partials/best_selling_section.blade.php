@if (get_setting('best_selling') == 1)
    <section class="mb-4">
        <div class="container">
            <div class=" py-4  py-md-3">
                <div class="d-flex mb-3 align-items-baseline">
                    @if(filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(12)->get())
                        <h5 class="h5 fw-500 mb-0">
                            <span class=" pb-3 d-inline-block">{{ translate('Best Selller Items') }}</span>
                        </h5>
                    @endif
                    <a href="javascript:void(0)" class="ml-auto mr-0  text-alter-2 text-uppercase"><span class="border-bottom border-primary py-1">{{ translate('View aLL') }}</span></a>
                </div>
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="2" data-xs-items="2" data-arrows='false' data-infinite='true' data-autoplay="true">
                    @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(12)->get() as $key => $product)
                        <div class="carousel-box">
                            @include('frontend.partials.product_box_1',['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
