@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Update Pickup Time Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('pick_up_times.update',$time->id) }}" method="POST">
                	<input name="_method" type="hidden" value="PATCH">

                    @csrf
                    <div class="form-group row ">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Pick-up Time
                        Days')}}</label>
                        <div class="col-sm-9">
                            <select name="days[]" id="days" class="form-control aiz-selectpicker" multiple required data-placeholder="{{ translate('Choose Days') }}" data-live-search="true" data-selected-text-format="count" >
                                    @php
                                        $days=json_decode($time->days);
                                    @endphp
                                   @if(in_array("sat",$days))
                                   <option value="sat" selected>{{translate('Saturday')}}</option>
                                    @else
                                    <option value="sat">{{translate('Saturday')}}</option>
                                   @endif

                                   @if(in_array("sun",$days))
                                   <option value="sun" selected>{{translate('Sunday')}}</option>
                                    @else
                                    <option value="sun">{{translate('Sunday')}}</option>
                                   @endif

                                   @if(in_array("mon",$days))
                                   <option value="mon" selected>{{translate('Monday')}}</option>
                                    @else
                                    <option value="mon">{{translate('Monday')}}</option>
                                   @endif

                                   @if(in_array("tue",$days))
                                   <option value="tue" selected>{{translate('Tuesday')}}</option>
                                    @else
                                    <option value="tue">{{translate('Tuesday')}}</option>
                                   @endif

                                   @if(in_array("wed",$days))
                                   <option value="wed" selected>{{translate('Wednesday')}}</option>
                                    @else
                                    <option value="wed" >{{translate('Wednesday')}}</option>
                                   @endif

                                   @if(in_array("thu",$days))
                                   <option value="thu" selected>{{translate('Thursday')}}</option>
                                    @else
                                    <option value="thu">{{translate('Thursday')}}</option>
                                   @endif
                                   @if(in_array("fri",$days))
                                   <option value="fri" selected>{{translate('Friday')}}</option>
                                    @else
                                    <option value="fri">{{translate('Friday')}}</option>
                                   @endif
                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="start_time">{{translate('Pick-up Time
                            Start')}}</label>

                            <input type="text" name="start_time"  id="start_time" value="{{ $time->start_time }}" class="col-sm-9 form-control aiz-time-picker">
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="end_time">{{translate('Pick-up Time
                            End')}}</label>

                            <input type="text" name="end_time"  id="end_time" value="{{  $time->end_time }}" class="col-sm-9 form-control aiz-time-picker">
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
