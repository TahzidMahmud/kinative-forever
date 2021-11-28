@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All Payment List')}}</h1>
        </div>
    </div>
</div>


<div class="card">
    <form action="{{ route('delivery-boys-payment-histories') }}" action="GET">
    @csrf

    <div class="card-header d-block d-lg-flex">
        <h5 class="mb-0 h6">{{translate('Payment List')}}</h5>

{{-- {{ $delivery_boys[0]->user->name }} --}}
        <div class="col-lg-3 ml-auto">
            <select class="form-control aiz-selectpicker" name="delivery_boy" id="delivery_boy" data-title="Filter by delivery Name">

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
                    <th class="text-center">{{translate('Payment Amount')}}</th>
                    <th class="text-right">{{translate('Paid At')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($delivery_boy_payments as $key => $delivery_boy_payment)

                <tr>
                    <td>{{ ($key+1) + ($delivery_boy_payments->currentPage() - 1) * $delivery_boy_payments->perPage() }}</td>
                    <td>
                        {{ $delivery_boy_payment->user->name }}
                    </td>
                    <td class="text-center">
                        {{ $delivery_boy_payment->payment }}
                    </td>
                    <td class="text-right">
                        {{Carbon\Carbon::parse($delivery_boy_payment->created_at)->format('d-m-Y')}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $delivery_boy_payments->appends(request()->input())->links() }}
        </div>
    </div>
</form>
</div>

@endsection

