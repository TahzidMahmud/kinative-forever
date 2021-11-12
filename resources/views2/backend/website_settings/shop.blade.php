@extends('backend.layouts.app')

@section('content')

<ul class="nav nav-tabs nav-fill border-light">
    @foreach (\App\Language::all() as $key => $language)
        <li class="nav-item">
            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('website.shop', ['lang'=> $language->code] ) }}">
                <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                <span>{{$language->name}}</span>
            </a>
        </li>
    @endforeach
</ul>
    <div class="">
    	<div class="">
    		<div class="card">
    			<div class="card-header">
    				<h6 class="fw-600 mb-0">{{ translate('Shop setting') }}</h6>
    			</div>
    			<div class="card-body">
    				<form action="{{ route('business_settings.update') }}" method="POST">
    					@csrf


                        <div class="border-bottom pb-3 mb-3">
                            <label class="">{{translate('Header Nav Menu')}}</label>
                            <div class="header-nav-menu">
                                <input type="hidden" name="types[][{{ $lang }}]" value="shop_menu_labels">
                                <input type="hidden" name="types[]" value="shop_menu_links">
                                @if (get_setting('shop_menu_labels', null, $lang) != null)
                                    @foreach (json_decode( get_setting('shop_menu_labels', null, $lang), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="{{translate('Label')}}" name="shop_menu_labels[]" value="{{ $value }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="shop_menu_links[]" value="{{ json_decode(App\BusinessSetting::where('type', 'shop_menu_links')->first()->value, true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button
                                type="button"
                                class="btn btn-soft-secondary btn-sm"
                                data-toggle="add-more"
                                data-content='<div class="row gutters-5">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="{{translate('Label')}}" name="shop_menu_labels[]">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="shop_menu_links[]">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>'
                                data-target=".header-nav-menu">
                                {{ translate('Add New') }}
                            </button>
                        </div>

                        <div class="form-group border-bottom pb-3 mb-3">
                            <label class="from-label">{{ translate('Shop banners') }}</label>
                            <div class="">
                                <div class="input-group " data-toggle="aizuploader" data-type="image" data-multiple='true'>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="types[]" value="shop_banners">
                                    <input type="hidden" name="shop_banners" value="{{ get_setting('shop_banners') }}" class="selected-files">
                                </div>
                                <div class="file-preview box"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ translate('Offer Banners') }}</label>
                            <div class="home-slider-target">
                                <input type="hidden" name="types[]" value="shop_slider_images">
                                <input type="hidden" name="types[]" value="shop_slider_links">
                                @if (get_setting('shop_slider_images') != null)
                                    @foreach (json_decode(get_setting('shop_slider_images'), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="shop_slider_images[]" class="selected-files" value="{{ json_decode(get_setting('shop_slider_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="shop_slider_links">
                                                    <input type="text" class="form-control" placeholder="http://" name="shop_slider_links[]" value="{{ json_decode(get_setting('shop_slider_links'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button
                                type="button"
                                class="btn btn-soft-secondary btn-sm"
                                data-toggle="add-more"
                                data-content='
                                <div class="row gutters-5">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                <input type="hidden" name="shop_slider_images[]" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="http://" name="shop_slider_links[]">
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                <i class="las la-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>'
                                data-target=".home-slider-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
    					<div class="text-right">
    						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
    					</div>
                    </form>
    			</div>
    		</div>
    	</div>
    </div>

@endsection
