@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('City Information')}}</h5>
</div>

<div class="row">
  <div class="col-lg-8 mx-auto">
      <div class="card">
          <div class="card-body p-0">
              <form class="p-4" action="{{ route('areas.update', $area->id) }}" method="POST" enctype="multipart/form-data">
                  <input name="_method" type="hidden" value="PATCH">
                  @csrf
                  <div class="form-group mb-3">
                      <label for="name">{{translate('Name')}}</label>
                      <input type="text" placeholder="{{translate('Name')}}" value="{{ $area->name }}" name="name" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <label for="country">{{translate('City')}}</label>
                      <select class="select2 form-control aiz-selectpicker" name="city_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true" data-selected="{{ $area->id }}">
                          @foreach ($cities as $city)
                              <option value="{{ $city->id }}">{{ $city->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group mb-3 text-right">
                      <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection
