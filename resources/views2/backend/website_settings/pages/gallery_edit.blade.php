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
            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->slug, 'lang'=> $language->code,'page'=>'gallery_archive'] ) }}">
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
					<input type="text" class="form-control" placeholder="{{translate('Title')}}" name="title" value="{{ $page->getTranslation('title',$lang) }}" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Subtitle')}} <span class="text-danger">*</span></label>
				<div class="col-sm-10">
                    <input type="hidden" name="types[][{{ $lang }}]" value="subtitle">
					<input type="text" class="form-control" placeholder="{{translate('Subtitle')}}" name="subtitle" value="{{ get_page_setting('subtitle',$page->id,null,$lang) }}" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Banner')}} <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<div class="input-group " data-toggle="aizuploader" data-type="image">
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
			<div class="gallery-target">
				<input type="hidden" name="types[][{{ $lang }}]" value="gallery_title">
				<input type="hidden" name="types[]" value="gallery_all_images">
                {{-- {{ dd(json_decode(get_page_setting('gallery_title',$page->id,null,$lang), true)) }} --}}
                @if (get_page_setting('gallery_title',$page->id,null,$lang) != null)
                    @foreach (json_decode(get_page_setting('gallery_title',$page->id,null,$lang), true) as $key => $value)
					<div class="row">
						<div class="col-md-5">
				            <div class="form-group">
				                <label>{{ translate('Title') }}</label>
				                <input type="text" name="gallery_title[]" placeholder="Title" value="{{ $value }}" class="form-control">
				            </div>
				        </div>
						<div class="col-md-7">
							<div class="form-group ">
								<label>{{translate('All Images')}}</label>
								<div>
									<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple='true'>
										<div class="input-group-prepend">
											<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
										</div>
										<div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        {{-- {{ dd(get_page_setting('gallery_all_images',$page->id,$lang)) }} --}}
										@if(!is_int(get_page_setting('gallery_all_images',$page->id)))
                                            <input type="hidden" name="gallery_all_images[]" value="{{ json_decode(get_page_setting('gallery_all_images',$page->id),true)[$key] }}" class="selected-files">
                                        @else
                                            <input type="hidden" name="gallery_all_images[]" value="{{ get_page_setting('gallery_all_images',$page->id) }}" class="selected-files">
                                        @endif
									</div>
									<div class="file-preview box sm">
									</div>
								</div>
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
					                <label>{{ translate('Title') }}</label>
					                <input type="text" name="gallery_title[]" placeholder="Title" class="form-control">
					            </div>
					        </div>
							<div class="col">
								<div class="form-group">
									<label>{{translate('All Images')}}</label>
									<div>
										<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="gallery_all_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
							</div>
                            <div class="col-auto">
                                <button type="button" class="mt-4 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                    <i class="las la-times"></i>
                                </button>
                            </div>
                        </div>'
                data-target=".gallery-target">
                {{ translate('Add New') }}
            </button>
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
