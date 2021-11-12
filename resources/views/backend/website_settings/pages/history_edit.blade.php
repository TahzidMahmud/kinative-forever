@extends('backend.layouts.app')
@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col">
			<h1 class="h3">{{ translate('Edit Page') }}</h1>
		</div>
	</div>
</div>
<ul class="nav nav-tabs nav-fill border-light">
    @foreach (\App\Language::all() as $key => $language)
        <li class="nav-item">
            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->slug, 'lang'=> $language->code,'page'=>'about_us'] ) }}">
                <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                <span>{{$language->name}}</span>
            </a>
        </li>
    @endforeach
</ul>
<form action="{{ route('custom-pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="_method" value="PATCH">
	<input type="hidden" name="type" value="featured_page" required>
	<input type="hidden" name="lang" value="{{ $lang }}">
	<div class="card">
		<div class="card-header">
			<h6 class="fw-600 mb-0">{{ translate('Page info') }}</h6>
		</div>
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Link')}} <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<div class="input-group d-block d-md-flex">
						<div class="input-group-prepend "><span class="input-group-text flex-grow-1">{{ route('home') }}/</span></div>
						<input type="text" class="form-control w-100 w-md-auto" placeholder="{{ translate('Slug') }}" value="{{ $page->slug }}" name="slug" required>
					</div>
					<small class="form-text text-muted">{{ translate('Use character, number, hypen only') }}</small>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Title')}} <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="{{translate('Title')}}" name="title" value="{{ $page->getTranslation('title',$lang) }}" >
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Subtitle')}} <span class="text-danger">*</span></label>
				<div class="col-sm-10">
                    <input type="hidden" name="types[][{{ $lang }}]" value="subtitle">
					<input type="text" class="form-control" placeholder="{{translate('Subtitle')}}" name="subtitle" value="{{ get_page_setting('subtitle',$page->id,null,$lang) }}" >
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Banners')}} <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<div class="input-group " data-toggle="aizuploader" data-type="image" data-multiple='true'>
						<div class="input-group-prepend">
								<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
						</div>
						<div class="form-control file-amount">{{ translate('Choose File') }}</div>
                    	<input type="hidden" name="types[]" value="banner">
						<input type="hidden" name="banner" class="selected-files" value="{{ get_page_setting('banner',$page->id) }}">
					</div>
					<div class="file-preview">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<h6 class="fw-600 mb-0">{{ translate('Content') }}</h6>
		</div>

		<div class="card-body">
            {{-- <div class="form-group">
                <label>{{ translate('Who We are Content') }}</label>
                <input type="hidden" name="types[][{{ $lang }}]" value="who_we_are">
                <textarea class="aiz-text-editor form-control" name="who_we_are" placeholder="Type.." data-min-height="150">{!! get_page_setting('who_we_are',$page->id,null,$lang) !!}</textarea>
            </div> --}}
			<div class="form-group ">
				<label>{{translate('Chairman Image')}}</label>
				<div>
					<div class="input-group" data-toggle="aizuploader" data-type="image">
						<div class="input-group-prepend">
							<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
						</div>
						<div class="form-control file-amount">{{ translate('Choose File') }}</div>
						<input type="hidden" name="types[]" value="chairman_image">

						<input type="hidden" name="chairman_image" value="{{ get_page_setting('chairman_image',$page->id) }}" class="selected-files">
					</div>
					<div class="file-preview">
					</div>
				</div>
			</div>
            <div class="form-group">
                <label>{{ translate('About Content') }}</label>
                <input type="hidden" name="types[][{{ $lang }}]" value="description">
                <textarea class="aiz-text-editor form-control" name="description" placeholder="Type.." data-min-height="150">{!! get_page_setting('description',$page->id,null,$lang) !!}</textarea>
            </div>

            <div class="row">
            	<div class="col-lg-4">
		            <div class="form-group">
		                <label>{{ translate('Operating Since') }}</label>
		                <input type="hidden" name="types[][{{ $lang }}]" value="operating_since">
		                <input type="text" class="form-control" name="operating_since" value="{{ get_page_setting('operating_since',$page->id,null,$lang) }}">
		            </div>
            	</div>
            	<div class="col-lg-4">
		            <div class="form-group">
		                <label>{{ translate('Subdiary Companies') }}</label>
		                <input type="hidden" name="types[][{{ $lang }}]" value="subdiary_companies">
		                <input type="text" class="form-control" name="subdiary_companies" value="{{ get_page_setting('subdiary_companies',$page->id,null,$lang) }}">
		            </div>
            	</div>
            	<div class="col-lg-4">
		            <div class="form-group">
		                <label>{{ translate('Employees and staff') }}</label>
		                <input type="hidden" name="types[][{{ $lang }}]" value="employees_staff">
		                <input type="text" class="form-control" name="employees_staff" value="{{ get_page_setting('employees_staff',$page->id,null,$lang) }}">
		            </div>
            	</div>
            </div>

            {{-- <div class="form-group">
                <label>{{ translate('Our Mission') }}</label>
                <input type="hidden" name="types[][{{ $lang }}]" value="our_mission">
                <textarea class="form-control" name="our_mission" placeholder="Type.." >{!! get_page_setting('our_mission',$page->id,null,$lang) !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ translate('Our Vision') }}</label>
                <input type="hidden" name="types[][{{ $lang }}]" value="our_vision">
                <textarea class="form-control" name="our_vision" placeholder="Type.." >{!! get_page_setting('our_vision',$page->id,null,$lang) !!}</textarea>
            </div> --}}

            {{-- <div class="form-group">
                <label>{{ translate('Management team') }}</label>
                <div class="management-target">
                    <input type="hidden" name="types[]" value="management_team_images">
                    <input type="hidden" name="types[][{{ $lang }}]" value="management_team_names">
                    <input type="hidden" name="types[][{{ $lang }}]" value="management_team_designations">
                    <input type="hidden" name="types[][{{ $lang }}]" value="management_team_details">
	                @if (get_page_setting('management_team_images',$page->id) != null)
	                    @foreach (json_decode(get_page_setting('management_team_images',$page->id), true) as $key => $value)
	                    	<div class="row gutters-5">
	                            <div class="col-xl">
	                                <div class="form-group">
	                                    <div class="input-group " data-toggle="aizuploader" data-type="image">
			                                <div class="input-group-prepend">
			                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
			                                </div>
			                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
			                                <input type="hidden" name="management_team_images[]" class="selected-files" value="{{ $value }}">
			                            </div>
			                            <div class="file-preview"></div>
	                                </div>
	                            </div>
	                            <div class="col-xl-2">
	                                <div class="form-group">
	                                	<input type="text" class="form-control" placeholder="{{translate('Name')}}" name="management_team_names[]" value="{{ json_decode(get_page_setting('management_team_names',$page->id,null,$lang),true)[$key] }}" required>
	                                </div>
	                            </div>
	                            <div class="col-xl-2">
	                                <div class="form-group">
	                                	<input type="text" class="form-control" placeholder="{{translate('Designation')}}" name="management_team_designations[]" value="{{ json_decode(get_page_setting('management_team_designations',$page->id,null,$lang),true)[$key] }}" required>
	                                </div>
	                            </div>
	                            <div class="col-xl">
	                                <div class="form-group">
	                                	<textarea class="form-control" name="management_team_details[]" placeholder="Details" rows="4">{!! json_decode(get_page_setting('management_team_details',$page->id,null,$lang),true)[$key] !!}</textarea>
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
                                        <div class="input-group " data-toggle="aizuploader" data-type="image">
			                                <div class="input-group-prepend">
			                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
			                                </div>
			                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
			                                <input type="hidden" name="management_team_images[]" class="selected-files">
			                            </div>
			                            <div class="file-preview"></div>
                                    </div>
                                </div>
	                            <div class="col-xl-2">
	                                <div class="form-group">
	                                	<input type="text" class="form-control" placeholder="{{translate('Name')}}" name="management_team_names[]" required>
	                                </div>
	                            </div>
	                            <div class="col-xl-2">
	                                <div class="form-group">
	                                	<input type="text" class="form-control" placeholder="{{translate('Designation')}}" name="management_team_designations[]" required>
	                                </div>
	                            </div>
                                <div class="col-xl">
                                    <div class="form-group">
                                		<textarea class="form-control" name="management_team_details[]" placeholder="Details" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>'
                    data-target=".management-target">
                    {{ translate('Add New') }}
                </button>
            </div> --}}

            <div class="form-group">
                <label>{{ translate('Subsidiaries') }}</label>
                <div class="subsidiaries-target">
                    <input type="hidden" name="types[]" value="subsidiaries_images">
                    <input type="hidden" name="types[]" value="subsidiaries_links">
                </div>
                @if (get_page_setting('subsidiaries_images',$page->id) != null)

                    @foreach (json_decode(get_page_setting('subsidiaries_images',$page->id), true) as $key => $value)
                    	<div class="row gutters-5">
                            <div class="col-xl">
                                <div class="form-group">
                                    <div class="input-group " data-toggle="aizuploader" data-type="image">
		                                <div class="input-group-prepend">
		                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                                </div>
		                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
		                                <input type="hidden" name="subsidiaries_images[]" class="selected-files" value="{{ $value }}">
		                            </div>
		                            <div class="file-preview"></div>
                                </div>
                            </div>
                            <div class="col-xl">
                               @if(json_decode(get_page_setting('subsidiaries_links',$page->id), true)) !=null)
                                @else
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ translate('http://') }}" name="subsidiaries_links[]">
                                </div>
                               @endif
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
			                                <input type="hidden" name="subsidiaries_images[]" class="selected-files">
			                            </div>
			                            <div class="file-preview"></div>
                                    </div>
                                </div>
                                <div class="col-xl">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{ translate('http://') }}" name="subsidiaries_links[]">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>'
                    data-target=".subsidiaries-target">
                    {{ translate('Add New') }}
                </button>
            </div>

            {{-- certifications --}}
            {{-- <div class="form-group">
                <label>{{ translate('certifications description') }}</label>
                <input type="hidden" name="types[][{{ $lang }}]" value="certification_description">
                <textarea class="aiz-text-editor form-control" name="certification_description" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                    @php echo get_setting('certification_description', null, $lang); @endphp
                </textarea>
            </div> --}}
            {{-- <div class="form-group">
                <label>{{ translate('certifications Images') }}</label>
                <div class="certifications-target">
                    <input type="hidden" name="types[]" value="certifications_images">
                    <input type="hidden" name="types[]" value="certifications_links">
                </div>
                @if (get_page_setting('certifications_images',$page->id) != null)

                    @foreach (json_decode(get_page_setting('certifications_images',$page->id), true) as $key => $value)
                    	<div class="row gutters-5">
                            <div class="col-xl">
                                <div class="form-group">
                                    <div class="input-group " data-toggle="aizuploader" data-type="image">
		                                <div class="input-group-prepend">
		                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                                </div>
		                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
		                                <input type="hidden" name="certifications_images[]" class="selected-files" value="{{ $value }}">
		                            </div>
		                            <div class="file-preview"></div>
                                </div>
                            </div>
                            <div class="col-xl">
                               @if(json_decode(get_page_setting('certifications_links',$page->id), true)) !=null)
                                @else
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ translate('http://') }}" name="certifications_links[]">
                                </div>
                               @endif
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
			                                <input type="hidden" name="certifications_images[]" class="selected-files">
			                            </div>
			                            <div class="file-preview"></div>
                                    </div>
                                </div>
                                <div class="col-xl">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{ translate('http://') }}" name="certifications_links[]">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>'
                    data-target=".certifications-target">
                    {{ translate('Add New') }}
                </button>
            </div> --}}
            {{-- our mission  --}}
            {{-- <div class="form-group">
                <label>{{ translate('Our mission description') }}</label>
                <input type="hidden" name="types[][{{ $lang }}]" value="mission_description">
                <textarea class="aiz-text-editor form-control" name="mission_description" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                    @php echo get_setting('mission_description', null, $lang); @endphp
                </textarea>
                <label class="form-label" for="signinSrEmail">{{ translate('mission image') }}</label>
                <div class="input-group " data-toggle="aizuploader" data-type="image">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                    </div>
                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                    <input type="hidden" name="types[]" value="mission_image">
                    <input type="hidden" name="mission_image" class="selected-files" value="{{ get_setting('mission_image') }}">
                </div>
                <div class="file-preview"></div>
            </div> --}}
            {{-- our vision  --}}
            {{-- <div class="form-group">
                <label>{{ translate('Our vision description') }}</label>
                <input type="hidden" name="types[][{{ $lang }}]" value="vision_description">
                <textarea class="aiz-text-editor form-control" name="vision_description" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                    @php echo get_setting('vision_description', null, $lang); @endphp
                </textarea>
                <label class="form-label" for="signinSrEmail">{{ translate('vision image') }}</label>
                <div class="input-group " data-toggle="aizuploader" data-type="image">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                    </div>
                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                    <input type="hidden" name="types[]" value="vision_image">
                    <input type="hidden" name="vision_image" class="selected-files" value="{{ get_setting('vision_image') }}">
                </div>
                <div class="file-preview"></div>
            </div> --}}
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<h6 class="fw-600 mb-0">{{ translate('Seo Fields') }}</h6>
		</div>
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Title')}}</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="{{translate('Title')}}" name="meta_title" value="{{ $page->meta_title }}">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Description')}}</label>
				<div class="col-sm-10">
					<textarea class="resize-off form-control" placeholder="{{translate('Description')}}" name="meta_description" value="{{ $page->meta_description }}"></textarea>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Keywords')}}</label>
				<div class="col-sm-10">
					<textarea class="resize-off form-control" placeholder="{{translate('Keyword, Keyword')}}" name="keywords">{{  $page->keywords }}</textarea>
					<small class="text-muted">{{ translate('Separate with coma') }}</small>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Image')}}</label>
				<div class="col-sm-10">
					<div class="input-group " data-toggle="aizuploader" data-type="image">
						<div class="input-group-prepend">
								<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
						</div>
						<div class="form-control file-amount">{{ translate('Choose File') }}</div>
						<input type="hidden" name="meta_image" value="{{  $page->meta_image }}" class="selected-files">
					</div>
					<div class="file-preview">
					</div>
				</div>
			</div>

			<div class="text-right">
				<button type="submit" class="btn btn-primary">{{ translate('Save Page') }}</button>
			</div>
		</div>
	</div>
</form>
@endsection
