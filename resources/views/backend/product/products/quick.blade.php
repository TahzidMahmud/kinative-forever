<div>
	<h4 class="fs-16 border-bottom pb-3">{{ $product->getTranslation('name') }}</h4>
    <form method="post" action="{{ route('products.quick_update_done') }}">
    	@csrf
    	<input type="hidden" name="product_id" value="{{ $product->id }}">
    	@foreach($product->stocks as $key => $stock)
	    	<div class="row gutters-5">
		    	<div class="col-lg-4">
			        <div class="form-group">
			        	<label>{{ translate('Variant') }}</label>
			        	<input type="text" value="{{ $stock->variant }}" class="form-control" readonly="">
			        </div>
			    </div>
		    	<div class="col-lg-4">
			        <div class="form-group">
			        	<label>{{ translate('Stock') }}</label>
			        	<input type="number" step="1" value="{{ $stock->qty }}" class="form-control" name="stock[{{ $stock->id }}][stock]" required="">
			        </div>
			    </div>
		    	<div class="col-lg-4">
			        <div class="form-group">
			        	<label>{{ translate('Price') }}</label>
			        	<input type="number" class="form-control" value="{{ $stock->price }}" name="stock[{{ $stock->id }}][price]" required="">
			        </div>
			    </div>
		    </div>
        @endforeach
        <div class="text-right">
        	<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
        </div>
    </form>
</div>