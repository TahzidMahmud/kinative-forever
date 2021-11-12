@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Website Footer') }}</h1>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-fill border-light">
        @foreach (\App\Language::all() as $key => $language)
            <li class="nav-item">
                <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('website.footer', ['lang'=> $language->code] ) }}">
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
                    <h6 class="mb-0">{{ translate('branches (Max 3)') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Branch & Links') }} </label>
                            <div class="home-banner3-target">
                                <input type="hidden" name="types[][{{$lang}}]" value="home_branch_name">
                                <input type="hidden" name="types[][{{$lang}}]" value="home_branch_subtitle">
                                <input type="hidden" name="types[]" value="home_branch_link">
                                @if (get_setting('home_branch_name', null, $lang) != null)
                                    @foreach (json_decode(get_setting('home_branch_name', null, $lang), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-xl">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="{{ translate('Name') }}" name="home_branch_name[]" value="{{ json_decode(get_setting('home_branch_name', null, $lang), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="{{ translate('Subtitle') }}" name="home_branch_subtitle[]" value="{{ json_decode(get_setting('home_branch_subtitle', null, $lang), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="http://" name="home_branch_link[]" value="{{ json_decode(get_setting('home_branch_link'), true)[$key] }}">
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
                                data-content='
                                        <div class="row gutters-5">
                                            <div class="col-xl">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="{{ translate('Name') }}" name="home_branch_name[]">
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="{{ translate('Subtitle') }}" name="home_branch_subtitle[]">
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="http://" name="home_branch_link[]">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>'
                                data-target=".home-banner3-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('About') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="signinSrEmail">{{ translate('Footer Logo') }}</label>
                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="types[]" value="footer_logo">
                                <input type="hidden" name="footer_logo" class="selected-files" value="{{ get_setting('footer_logo') }}">
                            </div>
                            <div class="file-preview"></div>
                        </div>
                        <div class="form-group">
                            <label>{{ translate('About description') }}</label>
                            <input type="hidden" name="types[][{{ $lang }}]" value="about_us_description">
                            <textarea class="aiz-text-editor form-control" name="about_us_description" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                                @php echo get_setting('about_us_description', null, $lang); @endphp
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>{{ translate('Social Links') }}</label>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-facebook-f"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="facebook_link">
                                <input type="text" class="form-control" placeholder="http://" name="facebook_link" value="{{ get_setting('facebook_link')}}">
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-twitter"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="twitter_link">
                                <input type="text" class="form-control" placeholder="http://" name="twitter_link" value="{{ get_setting('twitter_link')}}">
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-instagram"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="instagram_link">
                                <input type="text" class="form-control" placeholder="http://" name="instagram_link" value="{{ get_setting('instagram_link')}}">
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-youtube"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="youtube_link">
                                <input type="text" class="form-control" placeholder="http://" name="youtube_link" value="{{ get_setting('youtube_link')}}">
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-linkedin-in"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="linkedin_link">
                                <input type="text" class="form-control" placeholder="http://" name="linkedin_link" value="{{ get_setting('linkedin_link')}}">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Left Menu Widget + payment image') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Links') }}</label>
                            <div class="w3-links-target">
                                <input type="hidden" name="types[][{{ $lang }}]" value="widget_one_labels">
                                <input type="hidden" name="types[]" value="widget_one_links">
                                @if (get_setting('widget_one_labels', null, $lang) != null)
                                    @foreach (json_decode(get_setting('widget_one_labels', null, $lang), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Label" name="widget_one_labels[]" value="{{ $value }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="http://" name="widget_one_links[]" value="{{ json_decode(App\BusinessSetting::where('type', 'widget_one_links')->first()->value, true)[$key] }}">
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
                                            <input type="text" class="form-control" placeholder="Label" name="widget_one_labels[]">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="http://" name="widget_one_links[]">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>'
                                data-target=".w3-links-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                          <div class="form-group">
                              <label>{{ translate('Payment Methods') }}</label>
                              <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                  </div>
                                  <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                  <input type="hidden" name="types[]" value="payment_method_images">
                                  <input type="hidden" name="payment_method_images" class="selected-files" value="{{ get_setting('payment_method_images')}}">
                              </div>
                              <div class="file-preview box sm">
                              </div>
                           </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="fw-600 mb-0">{{ translate('Copyright Widget') }}</h6>
                </div>
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   <div class="card-body">
                        <div class="form-group">
                            <label>{{ translate('Copyright Text') }}</label>
                            <input type="hidden" name="types[][{{ $lang }}]" value="frontend_copyright_text">
                            <textarea class="aiz-text-editor form-control" name="frontend_copyright_text" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">@php echo get_setting('frontend_copyright_text', null, $lang); @endphp</textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
