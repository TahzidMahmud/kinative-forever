@extends('backend.layouts.app')

@section('content')

<div class="row">
	<div class="col-xl-8 mx-auto">
		<div class="card">
	        <div class="card-header row gutters-5">
	            <div class="col">
	                <h5 class="mb-md-0 h6">{{ translate('Edit supplier') }}</h5>
	            </div>
	        </div>
	        <div class="card-body">
		    	<form action="{{ route('inventory-supplier.update',$supplier->id) }}" method="POST">
		    		@csrf
		    		@method('PATCH')
                	<input type="hidden" name="id" value="{{ $supplier->id }}">
		            <div class="form-group">
		                <label>Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" name="name" required="" value="{{ $supplier->name }}">
		            </div>
		            <div class="form-group">
		                <label>Contact Person <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" name="contact_person" required="" value="{{ $supplier->contact_person }}">
		            </div>
		            <div class="form-group">
		                <label>Phone<span class="text-danger">*</span></label>
		                <input type="number" class="form-control" name="phone" required="" value="{{ $supplier->phone }}">
		            </div>
		            <div class="form-group">
		                <label>Email</label>
		                <input type="email" class="form-control" name="email" value="{{ $supplier->email }}">
		            </div>
		            <div class="form-group">
		                <label>Address</label>
		                <input type="text" class="form-control" name="address" value="{{ $supplier->address }}">
		            </div>
		            <div class="text-right">
		                <button class="btn btn-primary" type="submit">{{ translate('Update') }}</button>
		            </div>
		    	</form>
		    </div>
		</div>
	</div>
</div>
@endsection