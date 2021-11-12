@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Update Pickup Time Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('pick_up_times.store') }}" method="POST">
                    @csrf
                    <div class="form-group row ">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Pick-up Time
                        Days')}}</label>
                        <div class="col-sm-9">
                            <select name="days[]" id="days" class="form-control aiz-selectpicker" multiple required>
                                <option value="sat">{{translate('Saturday')}}</option>
                                <option value="sun">{{translate('Sunday')}}</option>
                                <option value="mon">{{translate('Monday')}}</option>
                                <option value="tue">{{translate('Tuesday')}}</option>
                                <option value="wed">{{translate('Wednesday')}}</option>
                                <option value="thu">{{translate('Thursday')}}</option>
                                <option value="fri">{{translate('Friday')}}</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="start">{{translate('Pick-up Time
                            Start')}}</label>

                            <input type="text" name="start"  id="start" class="col-sm-9 form-control aiz-time-picker">
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="end">{{translate('Pick-up Time
                            End')}}</label>

                            <input type="text" name="end"  id="end" class="col-sm-9 form-control aiz-time-picker">
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
