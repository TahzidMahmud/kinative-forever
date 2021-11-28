@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
    	<div class="row align-items-center">
    		<div class="col">
    			<h1 class="h3">{{ translate('Website Footer') }}</h1>
    		</div>
    	</div>
    </div>

    <div class="card">
    	<div class="card-header">
    		<h6 class="fw-600 mb-0">{{ translate('Footer Widget') }}</h6>
    	</div>
    	<div class="card-body">
    		<div class="row gutters-10">
    			<div class="col-lg-6">
    				<div class="card shadow-none bg-light">
    					<div class="card-header">
    						<h6 class="mb-0">{{ translate('About Widget') }}</h6>
    					</div>
    					<div class="card-body">
    						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
    							@csrf
                                <div class="form-group">
                                    <label class="form-label" for="signinSrEmail">{{ translate('Footer Background') }}</label>
                                    <div class="input-group " data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="types[]" value="footer_bg">
                                        <input type="hidden" name="footer_bg" class="selected-files" value="{{ get_setting('footer_bg') }}">
                                    </div>
                                    <div class="file-preview"></div>
                                </div>
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
    								<input type="hidden" name="types[]" value="about_us_description">
    								<textarea class="aiz-text-editor form-control" name="about_us_description" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                                        @php echo get_setting('about_us_description'); @endphp
                                    </textarea>
    							</div>
                                <div class="form-group">
                                    <label>{{ translate('Play Store Link') }}</label>
                                    <input type="hidden" name="types[]" value="play_store_link">
                                    <input type="text" class="form-control" placeholder="http://" name="play_store_link" value="{{ get_setting('play_store_link') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('App Store Link') }}</label>
                                    <input type="hidden" name="types[]" value="app_store_link">
                                    <input type="text" class="form-control" placeholder="http://" name="app_store_link" value="{{ get_setting('app_store_link') }}">
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
    			</div>
    			<div class="col-lg-6">
                    <div class="card shadow-none bg-light">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Policies Links') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ translate('Title') }}</label>
                                    <input type="hidden" name="types[]" value="widget_ten">
                                    <input type="text" class="form-control" placeholder="Widget title" name="widget_two" value="{{ get_setting('widget_two') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Links') }}</label>
                                    <div class="w2-links-target">
                                        <input type="hidden" name="types[]" value="widget_two_labels">
                                        <input type="hidden" name="types[]" value="widget_two_links">
                                        @if (get_setting('widget_two_labels') != null)
                                            @foreach (json_decode(App\BusinessSetting::where('type', 'widget_two_labels')->first()->value, true) as $key => $value)
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="widget_two_labels[]" value="{{ $value }}">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="http://" name="widget_two_links[]" value="{{ json_decode(App\BusinessSetting::where('type', 'widget_two_links')->first()->value, true)[$key] }}">
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
                                                    <input type="text" class="form-control" placeholder="Label" name="widget_two_labels[]">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="http://" name="widget_two_links[]">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>'
                                        data-target=".w2-links-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow-none bg-light">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Quick Links') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ translate('Title') }}</label>
                                    <input type="hidden" name="types[]" value="widget_ten">
                                    <input type="text" class="form-control" placeholder="Widget title" name="widget_ten" value="{{ get_setting('widget_ten') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Links') }}</label>
                                    <div class="w10-links-target">
                                        <input type="hidden" name="types[]" value="widget_ten_labels">
                                        <input type="hidden" name="types[]" value="widget_ten_links">
                                        @if (get_setting('widget_ten_labels') != null)
                                            @foreach (json_decode(App\BusinessSetting::where('type', 'widget_ten_labels')->first()->value, true) as $key => $value)
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="widget_ten_labels[]" value="{{ $value }}">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="http://" name="widget_ten_links[]" value="{{ json_decode(App\BusinessSetting::where('type', 'widget_ten_links')->first()->value, true)[$key] }}">
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
                                                    <input type="text" class="form-control" placeholder="Label" name="widget_ten_labels[]">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="http://" name="widget_ten_links[]">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>'
                                        data-target=".w10-links-target">
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

                <div class="col-lg-12">
                    <div class="card shadow-none bg-light">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Contact Info Widget') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ translate('Contact address') }}</label>
                                    <input type="hidden" name="types[]" value="contact_address">
                                    <input type="text" class="form-control" placeholder="{{ translate('Address') }}" name="contact_address" value="{{ get_setting('contact_address') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Contact phone') }}</label>
                                    <input type="hidden" name="types[]" value="contact_phone">
                                    <input type="text" class="form-control" placeholder="{{ translate('Phone') }}" name="contact_phone" value="{{ get_setting('contact_phone') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Contact email') }}</label>
                                    <input type="hidden" name="types[]" value="contact_email">
                                    <input type="text" class="form-control" placeholder="{{ translate('Email') }}" name="contact_email" value="{{ get_setting('contact_email') }}">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="card">
    	<div class="card-header">
    		<h6 class="fw-600 mb-0">{{ translate('Footer Bottom') }}</h6>
    	</div>
        <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
           <div class="card-body">
                <div class="card shadow-none bg-light">
                    <div class="card-header">
						<h6 class="mb-0">{{ translate('Copyright Widget ') }}</h6>
					</div>
                    <div class="card-body">
                        <div class="form-group">
              				<label>{{ translate('Copyright Text') }}</label>
              				<input type="hidden" name="types[]" value="frontend_copyright_text">
                  			<textarea class="aiz-text-editor form-control" name="frontend_copyright_text" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                              @php echo get_setting('frontend_copyright_text'); @endphp
                            </textarea>
                  		</div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
	</div>
    <div class="card">
    	<div class="card-header">
    		<h6 class="fw-600 mb-0">{{ translate('Footer Bottom') }}</h6>
    	</div>
        <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
           <div class="card-body">
                <div class="card shadow-none bg-light">
                  <div class="card-header">
        						<h6 class="mb-0">{{ translate('Payment Methods Widget ') }}</h6>
        					</div>
                  <div class="card-body">
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
                  </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
	</div>
    <div class="card">
        <div class="card-header">
            <h6 class="fw-600 mb-0">{{ translate('Footer Bottom Links') }}</h6>
        </div>
        <div class="card-body">
            <div class="border-bottom pb-3 mb-3">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="footer_menue">
                    <input type="hidden" name="types[]" value="footer_menue_labes">
                    <input type="hidden" name="types[]" value="footer_menue_links">
                    @if (get_setting('footer_menue_labes') != null)
                        @foreach (json_decode( get_setting('footer_menue_labes'), true) as $key => $value)
                            <div class="row gutters-5">
                                <div class="col-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Label" name="footer_menue_labes[]" value="{{ $value }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="footer_menue_links[]" value="{{ json_decode(App\BusinessSetting::where('type', 'footer_menue_links')->first()->value, true)[$key] }}">
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
                                <input type="text" class="form-control" placeholder="Label" name="footer_menue_labes[]">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="footer_menue_links[]">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                <i class="las la-times"></i>
                            </button>
                        </div>
                    </div>'
                    data-target=".footer_menue">
                    {{ translate('Add New') }}
                </button>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                </div>
            </div>
        </form>
            </div>

        </div>
    </div>
@endsection
