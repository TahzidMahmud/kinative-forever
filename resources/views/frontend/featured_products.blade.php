@extends('frontend.layouts.app')

@section('content')
<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Featured Products') }}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('featured.products') }}">"{{ translate('Featured Products') }}"</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="mb-4">
	<div class="container">
		<div class="row gutters-5 row-cols-xxl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">
			@foreach ($products as $key => $product)
	        <div class="col">
	            @include('frontend.partials.product_box_1',['product'=>$product])
	        </div>
	        @endforeach
		</div>
		<div class="aiz-pagination mt-3">
			{{ $products->links() }}
		</div>
	</div>
</section>
@endsection