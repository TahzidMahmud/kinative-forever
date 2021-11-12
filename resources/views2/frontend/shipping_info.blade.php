@extends('frontend.layouts.app')

@section('content')

<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row aiz-steps arrow-divider">
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block ">{{ translate('1. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('2. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('3. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('4. Confirmation')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-4 gry-bg">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-xxl-10 mx-auto">
                <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                    @csrf
                        @if(Auth::check())
                        <input type="hidden" name="checkout_type" value="logged">
                        <div class="border-gray-200 border bg-white p-4 rounded mb-4">
                            <h4>{{ translate('Shippping Address') }}</h4>
                            <div class="row mb-4">
                                @foreach (Auth::user()->addresses as $key => $address)
                                <div class="col-lg-6">
                                    <div class="position-relative mt-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" name="address_id" value="{{ $address->id }}" @if ($address->set_default)
                                                checked
                                            @endif required>
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Name') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->name }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Phone') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->phone }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Address') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->address }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Postal Code') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->postal_code }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Area') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->area }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('City') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->city }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Country') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->country }}</span>
                                                    </div>
                                                </span>
                                            </span>
                                        </label>
                                        <div class="dropdown position-absolute right-0 top-0">
                                            <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                                <i class="la la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                                    {{ translate('Edit') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <h4 class="mb-3">{{ translate('Billing Address') }}</h4>
                            <div class="form-group mb-0">
                                <label class="aiz-checkbox mb-0">
                                    <input type="checkbox" checked name="same_address" onchange="same_add(this)">
                                    <span class="aiz-square-check"></span>
                                    <span>Same as shipping address</span>
                                </label>
                            </div>
                            <div class="row mb-4 d-none same_address">
                                @foreach (Auth::user()->addresses as $key => $address)
                                <div class="col-lg-6">
                                    <div class="position-relative mt-3">
                                        <label class="aiz-megabox d-block bg-white mb-0">
                                            <input type="radio" name="billing_address_id" value="{{ $address->id }}" @if ($address->set_default)
                                                checked
                                            @endif>
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Name') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->name }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Phone') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->phone }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Address') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->address }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Postal Code') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->postal_code }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Area') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->area }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('City') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->city }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Country') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->country }}</span>
                                                    </div>
                                                </span>
                                            </span>
                                        </label>
                                        <div class="dropdown position-absolute right-0 top-0">
                                            <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                                <i class="la la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                                    {{ translate('Edit') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="border p-3 rounded mb-3 mt-5 bg-light c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center" onclick="add_new_address()">
                                <i class="las la-plus la-2x mb-3"></i>
                                <div class="alpha-7">{{ translate('Add New Address') }}</div>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="checkout_type" value="guest">
                        <div class="border-gray-200 border bg-white p-4 rounded mb-4">
                            <div class="mb-5">
                                <h4>{{ translate('Shippping Address') }}</h4>
                                <div class="form-group">
                                    <label class="control-label">{{ translate('Name')}}</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ translate('Name')}}" required>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="control-label">{{ translate('Phone')}}</label>
                                    <input type="number" lang="en" min="0" class="form-control" placeholder="{{ translate('Phone')}}" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ translate('Email')}}</label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ translate('Email')}}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ translate('Address')}}</label>
                                    <input type="text" class="form-control" name="address" placeholder="{{ translate('Address')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ translate('Select your country')}}</label>
                                    <select class="form-control aiz-selectpicker" data-live-search="true" name="country" data-title="Select Country" required onchange="get_city(this)" data-city=".add-new-city" data-area=".add-new-area">
                                        @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group has-feedback">

                                    <label class="control-label">{{ translate('City')}}</label>
                                    <select class="form-control aiz-selectpicker add-new-city" data-live-search="true" name="city" data-title="Select City" required onchange="get_area(this)" data-area=".add-new-area">

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ translate('Area')}}</label>
                                    <select class="form-control aiz-selectpicker add-new-area" data-live-search="true" name="area" data-title="Select Area" required>

                                    </select>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="control-label">{{ translate('Postal code')}}</label>
                                    <input type="text" class="form-control" placeholder="{{ translate('Postal code')}}" name="postal_code" required>
                                </div>
                            </div>
                            <div class="mb-5">
                                <h4>{{ translate('Billing Address') }}</h4>
                                <div class="form-group">
                                    <label class="aiz-checkbox mb-0">
                                        <input type="checkbox" checked name="same_address" onchange="same_add(this)">
                                        <span class="aiz-square-check"></span>
                                        <span>Same as shipping address</span>
                                    </label>
                                </div>
                                <div class=" d-none same_address">
                                    <div class="form-group">
                                        <label class="control-label">{{ translate('Name')}}</label>
                                        <input type="text" class="form-control" name="billing_name" placeholder="{{ translate('Name')}}">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="control-label">{{ translate('Phone')}}</label>
                                        <input type="number" lang="en" min="0" class="form-control" placeholder="{{ translate('Phone')}}" name="billing_phone">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{ translate('Email')}}</label>
                                        <input type="text" class="form-control" name="billing_email" placeholder="{{ translate('Email')}}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">{{ translate('Address')}}</label>
                                        <input type="text" class="form-control" name="billing_address" placeholder="{{ translate('Address')}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{ translate('Select your country')}}</label>
                                        <select class="form-control aiz-selectpicker" data-live-search="true" name="billing_country" data-title="Select Country" onchange="get_city(this)" data-city=".add-billing-city" data-area=".add-billing-area">
                                            @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group has-feedback">

                                        <label class="control-label">{{ translate('City')}}</label>
                                        <select class="form-control aiz-selectpicker add-billing-city" data-live-search="true" name="billing_city" data-title="Select City" onchange="get_area(this)" data-area=".add-billing-area">

                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{ translate('Area')}}</label>
                                        <select class="form-control aiz-selectpicker add-billing-area" data-live-search="true" name="billing_area" data-title="Select Area">

                                        </select>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="control-label">{{ translate('Postal code')}}</label>
                                        <input type="text" class="form-control" placeholder="{{ translate('Postal code')}}" name="billing_postal_code">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                            <a href="{{ route('home') }}" class="btn btn-link">
                                <i class="las la-arrow-left"></i>
                                {{ translate('Return to shop')}}
                            </a>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <button type="submit" class="btn btn-primary fw-600">{{ translate('Continue to Delivery Info')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
<div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ translate('New Address')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Name')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Name')}}" name="name" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Phone')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('+880')}}" name="phone" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Address')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{ translate('Address')}}" rows="1" name="address" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Country')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="country" data-title="Select Country" required onchange="get_city(this)" data-city=".add-new-city" data-area=".add-new-area">
                                    @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('City')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker add-new-city" data-live-search="true" name="city" data-title="Select City" required onchange="get_area(this)" data-area=".add-new-area">

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Area')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker add-new-area" data-live-search="true" name="area" data-title="Select Area" required>

                                </select>
                            </div>
                        </div>

                        @if (get_setting('google_map') == 1)
                            <div class="row">
                                <input id="searchInput" class="controls" type="text" placeholder="{{translate('Enter a location')}}">
                                <div id="map"></div>
                                <ul id="geoData">
                                    <li style="display: none;">Full Address: <span id="location"></span></li>
                                    <li style="display: none;">Postal Code: <span id="postal_code"></span></li>
                                    <li style="display: none;">Country: <span id="country"></span></li>
                                    <li style="display: none;">Latitude: <span id="lat"></span></li>
                                    <li style="display: none;">Longitude: <span id="lon"></span></li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-md-2" id="">
                                    <label for="exampleInputuname">Longitude</label>
                                </div>
                                <div class="col-md-10" id="">
                                    <input type="text" class="form-control mb-3" id="longitude" name="longitude" readonly="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2" id="">
                                    <label for="exampleInputuname">Latitude</label>
                                </div>
                                <div class="col-md-10" id="">
                                    <input type="text" class="form-control mb-3" id="latitude" name="latitude" readonly="">
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Postal code')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Postal Code')}}" name="postal_code" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{  translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Address Edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="edit_modal_body">

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function edit_address(address) {
            var url = '{{ route("addresses.edit", ":id") }}';
            url = url.replace(':id', address);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#edit_modal_body').html(response.html);
                    $('#edit-address-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');

                    @if (get_setting('google_map') == 1)
                        var lat     = -33.8688;
                        var long    = 151.2195;

                        if(response.data.address_data.latitude && response.data.address_data.longitude) {
                            lat     = response.data.address_data.latitude;
                            long    = response.data.address_data.longitude;
                        }

                        initialize(lat, long, 'edit_');
                    @endif
                }
            });
        }

        function get_city(e) {
            var country = $(e).val();
            var city_selector = $(e).data('city');
            var area_selector = $(e).data('area');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-city')}}",
                type: 'POST',
                data: {
                    country_name: country
                },
                success: function (response) {
                    var obj = JSON.parse(response);

                    $('body').find('select'+city_selector).html(obj);
                    $('body').find('select'+area_selector).html(null);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            });
        }
        function get_area(e) {
            var city = $(e).val();
            var area_selector = $(e).data('area');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-area')}}",
                type: 'POST',
                data: {
                    city_name: city
                },
                success: function (response) {
                    var obj = JSON.parse(response);

                    $('body').find('select'+area_selector).html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            });
        }

        function add_new_address(){
            $('#new-address-modal').modal('show');
        }

        function same_add(e){
            console.log($(e).is(':checked'));
            if($(e).is(':checked')){
                $('.same_address').addClass('d-none');
            }else{
                $('.same_address').removeClass('d-none');
            }
        }

    </script>

    @if (get_setting('google_map') == 1)
    
        @include('frontend.partials.google_map')
        
    @endif

@endsection
