@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('PickUp Point Time Slots')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('pick_up_times.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Create New Time Slot')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('PickUp Point Time Slots')}}</h5>

    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0" >
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Active Days')}}</th>
                    <th data-breakpoints="lg">{{ translate('Start Time') }}</th>
                    <th data-breakpoints="lg">{{ translate('End time') }}</th>
                    <th class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($times as $key => $time)
                    <tr>
                        <td>{{ ($key+1)}}</td>
                        <td>{{ implode(",",json_decode($time->days))}}</td>
                        <td>{{ $time->start_time }}</td>
                        <td>{{ $time->end_time }}</td>

						<td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('pick_up_times.edit', $time->id)}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('pick_up_times.destroy', $time->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="clearfix">
            <div class="pull-right">
                {{ $flash_deals->appends(request()->input())->links() }}
            </div>
        </div> --}}
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">

        // function update_flash_deal_feature(el){
        //     if(el.checked){
        //         var featured = 1;
        //     }
        //     else{
        //         var featured = 0;
        //     }
        //     $.post('{{ route('flash_deals.update_featured') }}', {_token:'{{ csrf_token() }}', id:el.value, featured:featured}, function(data){
        //         if(data == 1){
        //             location.reload();
        //         }
        //         else{
        //             AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
        //         }
        //     });
        // }
    </script>
@endsection
