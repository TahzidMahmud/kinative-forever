@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All suppliers')}}</h1>
        </div>
        <div class="col text-right">
            <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#add-new-modal">
                <span>{{translate('Add New Supplier')}}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <form class="" id="sort_products" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6">{{ translate('All list') }}</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('Name')}}</th>
                        <th data-breakpoints="sm">{{translate('Contact Person')}}</th>
                        <th data-breakpoints="md">{{translate('Phone')}}</th>
                        <th data-breakpoints="lg">{{translate('Email')}}</th>
                        <th data-breakpoints="sm" class="text-right">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $key => $supplier)
                    <tr>
                        <td>{{ ($key+1) + ($suppliers->currentPage() - 1)*$suppliers->perPage() }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->contact_person }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"  href="{{ route('inventory-supplier.edit', $supplier->id) }}" title="{{ translate('Edit') }}">
                                <i class="las la-pen"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $suppliers->appends(request()->input())->links() }}
            </div>
        </div>
    </form>
</div>
@endsection
@section('modal')
<div class="modal fade" tabindex="-1" id="add-new-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ translate('Supplier info') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventory-supplier.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required="">
                    </div>
                    <div class="form-group">
                        <label>Contact Person <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact_person" required="">
                    </div>
                    <div class="form-group">
                        <label>Phone<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="phone" required="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">{{ translate('Add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection