@extends('backend.layouts.app')
@section('content')

<div class="row">
	<div class="col-xl-10 mx-auto">
		<h6 class="fw-600">{{ translate('Home Page Settings') }}</h6>

		{{-- Home Slider --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Top Banner') }}(Only 1)</h6>
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





		{{-- Home categories--}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Handpicked Categories') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Categories') }}</label>
						<div class="home-categories-target">
							<input type="hidden" name="types[]" value="home_categories">
							@if (get_setting('home_categories') != null)
								@foreach (json_decode(get_setting('home_categories'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col">
											<div class="form-group">
												<select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" data-selected={{ $value }} required>
													@foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
														<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
														@foreach ($category->childrenCategories as $childCategory)
															@include('categories.child_category', ['child_category' => $childCategory])
														@endforeach
													@endforeach
					                            </select>
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
								<div class="col">
									<div class="form-group">
										<select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" required>
											@foreach (\App\Category::all() as $key => $category)
												<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".home-categories-target">
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
				<h6 class="mb-0">{{ translate('Home Banner 1 (Max 3)') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Banner & Links') }}</label>
						<div class="home-banner1-target">
							<input type="hidden" name="types[]" value="home_banner1_images">
							<input type="hidden" name="types[]" value="home_banner1_links">
							@if (get_setting('home_banner1_images') != null)
								@foreach (json_decode(get_setting('home_banner1_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-5">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="home_banner1_images">
					                                <input type="hidden" name="home_banner1_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner1_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner1_labels">
												<input type="text" class="form-control" placeholder="Title" name="home_banner1_labels[]" value="{{ json_decode(get_setting('home_banner1_labels'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner1_links">
												<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]" value="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}">
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
								<div class="col-md-5">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[]" value="home_banner1_images">
											<input type="hidden" name="home_banner1_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner1_labels">
										<input type="text" class="form-control" placeholder="Title" name="home_banner1_labels[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner1_links">
										<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]">
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
							data-target=".home-banner1-target">
							{{ translate('Add New') }}
						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>

		{{-- <div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Specials') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf

                    <div class="form-group">
                        <label>{{ translate('Title') }}</label>
                        <input type="hidden" name="types[]" value="home_specials_title">
                        <input type="text" class="form-control" placeholder="Title" name="home_specials_title" value="{{ get_setting('home_specials_title') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Subtitle') }}</label>
                        <input type="hidden" name="types[]" value="home_specials_subtitle">
                        <input type="text" class="form-control" placeholder="Subtitle" name="home_specials_subtitle" value="{{ get_setting('home_specials_subtitle') }}">
                    </div>
					<div class="form-group">
						<label>{{ translate('Banner & Links') }}</label>
						<div class="home-specials-target">
							<input type="hidden" name="types[]" value="home_specials_images">
							<input type="hidden" name="types[]" value="home_specials_links">
							@if (get_setting('home_specials_images') != null)
								@foreach (json_decode(get_setting('home_specials_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-5">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="home_specials_images">
					                                <input type="hidden" name="home_specials_images[]" class="selected-files" value="{{ json_decode(get_setting('home_specials_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_specials_labels">
												<input type="text" class="form-control" placeholder="Title" name="home_specials_labels[]" value="{{ json_decode(get_setting('home_specials_labels'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_specials_links">
												<input type="text" class="form-control" placeholder="http://" name="home_specials_links[]" value="{{ json_decode(get_setting('home_specials_links'), true)[$key] }}">
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
								<div class="col-md-5">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[]" value="home_specials_images">
											<input type="hidden" name="home_specials_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_specials_labels">
										<input type="text" class="form-control" placeholder="Title" name="home_specials_labels[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_specials_links">
										<input type="text" class="form-control" placeholder="http://" name="home_specials_links[]">
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
							data-target=".home-specials-target">
							{{ translate('Add New') }}
						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div> --}}

		{{-- Home categories--}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Home Categories') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Categories') }}</label>
						<div class="home-categories-2-target">
							<input type="hidden" name="types[]" value="home_categories_2">
							@if (get_setting('home_categories_2') != null)
								@foreach (json_decode(get_setting('home_categories_2'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-xl">
											<div class="form-group">
												<select class="form-control aiz-selectpicker" name="home_categories_2[]" data-live-search="true" data-selected="{{ $value }}" required>
													@foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
														<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
														@foreach ($category->childrenCategories as $childCategory)
															@include('categories.child_category', ['child_category' => $childCategory])
														@endforeach
													@endforeach
					                            </select>
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
								<div class="col-xl">
									<div class="form-group">
										<select class="form-control aiz-selectpicker" name="home_categories_2[]" data-live-search="true" required>
											@foreach (\App\Category::all() as $key => $category)
												<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".home-categories-2-target">
							{{ translate('Add New') }}
						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>

		{{-- Home Banner 2 --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Home Banner 2 (Max 3)') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Banner & Links') }}</label>
						<div class="home-banner2-target">
							<input type="hidden" name="types[]" value="home_banner2_images">
							<input type="hidden" name="types[]" value="home_banner2_links">
							@if (get_setting('home_banner2_images') != null)
								@foreach (json_decode(get_setting('home_banner2_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="home_banner2_images">
					                                <input type="hidden" name="home_banner2_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner2_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_titles">
												<input type="text" class="form-control" placeholder="Title" name="home_banner2_titles[]" value="{{ json_decode(get_setting('home_banner2_titles'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_sub_titles">
												<input type="text" class="form-control" placeholder="Subtitle" name="home_banner2_sub_titles[]" value="{{ json_decode(get_setting('home_banner2_sub_titles'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_links">
												<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]" value="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}">
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
											<input type="hidden" name="types[]" value="home_banner2_images">
											<input type="hidden" name="home_banner2_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner2_titles">
										<input type="text" class="form-control" placeholder="Title" name="home_banner2_titles[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner2_sub_titles">
										<input type="text" class="form-control" placeholder="Subtitle" name="home_banner2_sub_titles[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner2_links">
										<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]">
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
							data-target=".home-banner2-target">
							{{ translate('Add New') }}
						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>

		{{-- Customer review --}}
		{{-- <div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Customer review') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="form-group">
						<label>{{ translate('Reviews') }}</label>
						<div class="customer-review-target">
							<input type="hidden" name="types[]" value="customer_reviews_image">
							<input type="hidden" name="types[]" value="customer_reviews_name">
							<input type="hidden" name="types[]" value="customer_reviews_title">
							<input type="hidden" name="types[]" value="customer_reviews_details">
							@if (get_setting('customer_reviews_image') != null)
								@foreach (json_decode(get_setting('customer_reviews_image'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-lg-3">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="customer_reviews_image">
					                                <input type="hidden" name="customer_reviews_image[]" class="selected-files" value="{{ json_decode(get_setting('customer_reviews_image'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="hidden" name="types[]" value="customer_reviews_name">
												<input type="text" class="form-control" placeholder="{{ translate('Name') }}" name="customer_reviews_name[]" value="{{ json_decode(get_setting('customer_reviews_name'), true)[$key] }}">
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="hidden" name="types[]" value="customer_reviews_title">
												<input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="customer_reviews_title[]" value="{{ json_decode(get_setting('customer_reviews_title'), true)[$key] }}">
											</div>
										</div>
										<div class="col-lg">
											<div class="form-group">
												<input type="hidden" name="types[]" value="customer_reviews_details">
												<input type="text" class="form-control" placeholder="{{ translate('Details') }}" name="customer_reviews_details[]" value="{{ json_decode(get_setting('customer_reviews_details'), true)[$key] }}">
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
								<div class="col-lg-3">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
			                                <div class="input-group-prepend">
			                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
			                                </div>
			                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[]" value="customer_reviews_image">
			                                <input type="hidden" name="customer_reviews_image[]" class="selected-files" >
			                            </div>
			                            <div class="file-preview box sm">
			                            </div>
		                            </div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<input type="hidden" name="types[]" value="customer_reviews_name">
										<input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="customer_reviews_name[]" >
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<input type="hidden" name="types[]" value="customer_reviews_title">
										<input type="text" class="form-control" placeholder="{{ translate('Subtitle') }}" name="customer_reviews_title[]" >
									</div>
								</div>
								<div class="col-lg">
									<div class="form-group">
										<input type="hidden" name="types[]" value="customer_reviews_details">
										<input type="text" class="form-control" placeholder="{{ translate('Details') }}" name="customer_reviews_details[]" >
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".customer-review-target">
							{{ translate('Add New') }}
						</button>
					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div> --}}
          {{-- home banner text and link and title  --}}
          <div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Mid banner Texts') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf

                    <div class="form-group">
                        <label>{{ translate('Title') }}</label>
                        <input type="hidden" name="types[]" value="midbanner_text_title">
                        <input type="text" class="form-control" placeholder="Title" name="midbanner_text_title" value="{{ get_setting('midbanner_text_title') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Subtitle') }}</label>
                        <input type="hidden" name="types[]" value="midbanner_text_subtitle">
                        <input type="text" class="form-control" placeholder="Subtitle" name="midbanner_text_subtitle" value="{{ get_setting('midbanner_text_subtitle') }}">
                    </div>
                    {{-- <div class="form-group">
                        <label>{{ translate('View Shop Link') }}</label>
                        <input type="hidden" name="types[]" value="view_shop_link">
                        <input type="text" class="form-control" placeholder="http://" name="view_shop_link" value="{{ get_setting('view_shop_link') }}">
                    </div> --}}
                    <div class="form-group">
						<label>{{ translate('Icons') }}(max 3)</label>
						<div class="mid_banner_tex">
							<input type="hidden" name="types[]" value="mid_banner_icons">

							@if (get_setting('mid_banner_icons') != null)
								@foreach (json_decode(get_setting('mid_banner_icons'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="mid_banner_icons">
					                                <input type="hidden" name="mid_banner_icons[]" class="selected-files" value="{{ json_decode(get_setting('mid_banner_icons'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
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
                                        <input type="hidden" name="types[]" value="mid_banner_icons">
                                        <input type="hidden" name="mid_banner_icons[]" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
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
                        data-target=".mid_banner_tex">
                        {{ translate('Add New') }}
                    </button>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
        {{-- mid banner --}}
        <div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('mid Banner') }}(Only 2)</h6>
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					{{ translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.') }}
				</div>
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Photos & Links') }}</label>
						<div class="mid_banner-target">
							<input type="hidden" name="types[]" value="mid_banner_images">
							<input type="hidden" name="types[]" value="mid_banner_links">
							@if (get_setting('mid_banner_images') != null)
								@foreach (json_decode(get_setting('mid_banner_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="mid_banner_images">
					                                <input type="hidden" name="mid_banner_images[]" class="selected-files" value="{{ json_decode(get_setting('mid_banner_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="mid_banner_links">
												<input type="text" class="form-control" placeholder="http://" name="mid_banner_links[]" value="{{ json_decode(get_setting('mid_banner_links'), true)[$key] }}">
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
                                        <input type="hidden" name="types[]" value="mid_banner_images">
                                        <input type="hidden" name="mid_banner_images[]" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="hidden" name="types[]" value="mid_banner_links">
                                    <input type="text" class="form-control" placeholder="http://" name="mid_banner_links[]">
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
                        data-target=".mid_banner-target">
                        {{ translate('Add New') }}
                    </button>

					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
         {{-- bottom us  --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Bottom Banner') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
	                    <label class="form-label">{{ translate('Image') }}</label>
	                    <div class="input-group " data-toggle="aizuploader" data-type="image">
	                        <div class="input-group-prepend">
	                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
	                        </div>
	                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
							<input type="hidden" name="types[]" value="bottom_image">
	                        <input type="hidden" name="bottom_image" class="selected-files" value="{{ get_setting('bottom_image') }}">
	                    </div>
						<div class="file-preview"></div>
	                </div>
                    <div class="form-group ">
                        <label>{{ translate('Link') }}</label>
                        <input type="hidden" name="types[]" value="bottom_link">
                        <input type="text" class="form-control" placeholder="http://" name="bottom_link" value="{{ get_setting('bottom_link') }}">
                    </div>
                    <div class="form-group ">
                        <label>{{ translate('Title') }}</label>
                        <input type="hidden" name="types[]" value="bottom_title">
                        <input type="text" class="form-control" placeholder="" name="bottom_title" value="{{ get_setting('bottom_title') }}">
                    </div>
	                <div class="form-group ">
                        <label>{{ translate('Sub-Title') }}</label>
                        <input type="hidden" name="types[]" value="bottom_sub_title">
                        <input type="text" class="form-control" placeholder="" name="bottom_sub_title" value="{{ get_setting('bottom_sub_title') }}">
                    </div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>

        {{-- icon row  --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Feature Icons (Max 5)') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Banner & Links') }}</label>
						<div class="feature_icons">
							<input type="hidden" name="types[]" value="feature_icon_images">
							@if (get_setting('feature_icon_images') != null)
								@foreach (json_decode(get_setting('feature_icon_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="feature_icon_images">
					                                <input type="hidden" name="feature_icon_images[]" class="selected-files" value="{{ json_decode(get_setting('feature_icon_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="feature_icon_titles">
												<input type="text" class="form-control" placeholder="Title" name="feature_icon_titles[]" value="{{ json_decode(get_setting('feature_icon_titles'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="feature_icon_sub_titles">
												<input type="text" class="form-control" placeholder="Subtitle" name="feature_icon_sub_titles[]" value="{{ json_decode(get_setting('feature_icon_sub_titles'), true)[$key] }}">
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
											<input type="hidden" name="types[]" value="feature_icon_images">
											<input type="hidden" name="feature_icon_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="feature_icon_titles">
										<input type="text" class="form-control" placeholder="Title" name="feature_icon_titles[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="feature_icon_sub_titles">
										<input type="text" class="form-control" placeholder="Subtitle" name="feature_icon_sub_titles[]">
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
							data-target=".feature_icons">
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

@section('script')
    <script type="text/javascript">
		$(document).ready(function(){
		    AIZ.plugins.bootstrapSelect('refresh');
		});
    </script>
@endsection
