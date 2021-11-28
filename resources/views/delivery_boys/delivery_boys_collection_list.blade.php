@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All Collection List')}}</h1>
        </div>
    </div>
</div>
<form action="{{ route('delivery-boys-collection-histories') }}" action="GET">
    @csrf

<div class="card">
    <div class="card-header d-block d-lg-flex">
        <h5 class="mb-0 h6">{{translate('Collection List')}}</h5>
        <div class="col-lg-2 ml-auto">
            <select class="form-control aiz-selectpicker" name="delivery_boy" id="delivery_boy" data-title="Filter by delivery status">
                @foreach ($delivery_boys as $key=>$boy)
                @php
                   $usr= \App\User::where('id',$boy->user_id)->first();
                //    dd($usr);
                @endphp
                @if($usr)
                <option value={{ $boy->user_id }} @if($delivery_boy==$boy->user_id) selected @endif>{{ $usr->name}}</option>

                @endif

              @endforeach
            </select>
        </div>
        <div class="col-lg-2">
            <div class="form-group mb-0">
                <input type="text" class="aiz-date-range form-control" value="{{ $date }}"  name="date" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
            </div>
        </div>

        <div class="col-auto">
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
            </div>
        </div>

    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Delivery Boy')}}</th>
                    <th class="text-center">{{translate('Collected Amount')}}</th>
                    <th class="text-right">{{translate('Collected At ')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($delivery_boy_collections as $key => $delivery_boy_collection)

                <tr>
                    <td>{{ ($key+1) + ($delivery_boy_collections->currentPage() - 1) * $delivery_boy_collections->perPage() }}</td>
                    <td>
                        {{ $delivery_boy_collection->user->name }}
                    </td>
                    <td class="text-center">
                        {{ $delivery_boy_collection->collection_amount }}
                    </td>
                    <td class="text-right">
                        {{Carbon\Carbon::parse($delivery_boy_collection->created_at)->format('d-m-Y')}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $delivery_boy_collections->appends(request()->input())->links() }}
        </div>
    </div>
</div>
</form>

@endsection
