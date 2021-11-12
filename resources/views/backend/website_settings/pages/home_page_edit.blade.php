@extends('backend.layouts.app')
@section('content')

<h6 class="fw-600 mb-4">{{ translate('Home Page Settings') }}</h6>
<ul class="nav nav-tabs nav-fill border-light">
    @foreach (\App\Language::all() as $key => $language)
        <li class="nav-item">
            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->slug, 'lang'=> $language->code,'page'=>'home'] ) }}">
                <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                <span>{{$language->name}}</span>
            </a>
        </li>
    @endforeach
</ul>

<div class="">
	<div class="">
		{{-- Home Slider --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Home Slider') }}</h6>
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					{{ translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.') }}
				</div>
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Photos & Links') }}</label>
						<div class="home-slider-target">
							<input type="hidden" name="types[]" value="home_slider_images">
							<input type="hidden" name="types[]" value="home_slider_links">
							@if (get_setting('home_slider_images') != null)
								@foreach (json_decode(get_setting('home_slider_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="home_slider_images">
					                                <input type="hidden" name="home_slider_images[]" class="selected-files" value="{{ json_decode(get_setting('home_slider_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_slider_links">
												<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]" value="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
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
											<input type="hidden" name="types[]" value="home_slider_images">
											<input type="hidden" name="home_slider_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_slider_links">
										<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]">
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

		{{-- Home Banner 1 --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('About us') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
	                <div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('Title')}}</label>
						<div class="col-md-8">
							<div class="form-group">
								<input type="hidden" name="types[][{{ $lang }}]" value="home_about_title">
								<input type="text" class="form-control" placeholder="" name="home_about_title" value="{{ get_setting('home_about_title', null, $lang) }}">
							</div>
						</div>
					</div>
                    <div class="form-group">
                        <label>{{ translate('About description') }}</label>
                        <input type="hidden" name="types[][{{ $lang }}]" value="home_about">
                        <textarea class="aiz-text-editor form-control" name="home_about" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                            @php echo get_setting('home_about', null, $lang); @endphp
                        </textarea>
                    </div>

                    <label>{{ translate('About Image') }}</label>
					<div class="home-about-target">
						<input type="hidden" name="types[]" value="home_about_image">
						{{-- @if (get_setting('home_about_image') != null) --}}

								<div class="row gutters-5">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group" data-toggle="aizuploader" data-type="image">
				                                <div class="input-group-prepend">
				                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
				                                </div>
				                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
				                                <input type="hidden" name="home_about_image" class="selected-files" value="{{ json_decode(get_setting('home_about_image'), true) }}">
				                            </div>
				                            <div class="file-preview box sm">
				                            </div>
			                            </div>
									</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="types[]" value="home_about_link">
												<input type="text" class="form-control" placeholder="http://" name="home_about_link" value="{{ json_decode(get_setting('home_about_link'), true) }}">
                                        </div>
                                    </div>

								</div>
                        {{-- @endif --}}

					</div>



                    <div class="form-group">
                        <label>{{ translate('Left right Text & banner') }}</label>
                        <div class="home-banner3-target">
                            <input type="hidden" name="types[]" value="banner_text_images">
                            <input type="hidden" name="types[][{{ $lang }}]" value="banner_text_titles">
                            <input type="hidden" name="types[][{{ $lang }}]" value="banner_text_details">
                            <input type="hidden" name="types[]" value="banner_text_links">
                        </div>
                        @if (get_setting('banner_text_images') != null)
                            @foreach (json_decode(get_setting('banner_text_images'), true) as $key => $value)
                                <div class="row gutters-5">
                                    <div class="col-xl">
                                        <div class="form-group">
                                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                <input type="hidden" name="banner_text_images[]" class="selected-files" value="{{ $value }}">
                                            </div>
                                            <div class="file-preview"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="banner_text_titles[]" value="{{ json_decode(get_setting('banner_text_titles',null,$lang),true)[$key] }}">
                                        </div>
                                    </div>
                                    <div class="col-xl">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="{{ translate('Link') }}" name="banner_text_links[]" value="{{ json_decode(get_setting('banner_text_links'),true)[$key] }}">
                                        </div>
                                    </div>
                                    <div class="col-xl">
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="" name="banner_text_details[]">{{ json_decode(get_setting('banner_text_details',null,$lang),true)[$key] }}</textarea>
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
                        <button
                            type="button"
                            class="btn btn-soft-secondary btn-sm"
                            data-toggle="add-more"
                            data-content='
                                    <div class="row gutters-5">
                                        <div class="col-xl">
                                            <div class="form-group">
                                                <div class="input-group " data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                    <input type="hidden" name="banner_text_images[]" class="selected-files">
                                                </div>
                                                <div class="file-preview"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="banner_text_titles[]">
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{ translate('Link') }}" name="banner_text_links[]">
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="" name="banner_text_details[]"></textarea>
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


		{{-- category wise product filter --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Category wise product filter') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
                    <div class="form-group row">
						<label class="col-md-2 col-from-label">{{translate('Select category (Max 6)')}}</label>
						<div class="col-md-10">
							<input type="hidden" name="types[]" value="filter_categories">
							<select name="filter_categories[]" class="form-control aiz-selectpicker" multiple data-max-options="6" data-live-search="true" data-selected={{ get_setting('filter_categories') }} required>
								@foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
									<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
									@foreach ($category->childrenCategories as $childCategory)
										@include('categories.child_category', ['child_category' => $childCategory])
									@endforeach
								@endforeach
							</select>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>



		{{-- Top 10 --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Corporate clients') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
	                <div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('Title')}}</label>
						<div class="col-md-8">
							<div class="form-group">
								<input type="hidden" name="types[][{{ $lang }}]" value="corporate_client_title">
								<input type="text" class="form-control" placeholder="" name="corporate_client_title" value="{{ get_setting('corporate_client_title', null, $lang) }}">
							</div>
						</div>
					</div>
	                <div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('Sub title')}}</label>
						<div class="col-md-8">
							<div class="form-group">
								<input type="hidden" name="types[][{{ $lang }}]" value="corporate_client_subtitle">
								<input type="text" class="form-control" placeholder="" name="corporate_client_subtitle" value="{{ get_setting('corporate_client_subtitle', null, $lang) }}">
							</div>
						</div>
					</div>
					<div class="corporate-client-target">
						<input type="hidden" name="types[]" value="corporate_clients">
						<div class="form-group">
							<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple='true'>
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="corporate_clients" class="selected-files" value="{{ get_setting('corporate_clients') }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
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

@section('script')
    <script type="text/javascript">
		$(document).ready(function(){
		    AIZ.plugins.bootstrapSelect('refresh');
		});
    </script>
@endsection
