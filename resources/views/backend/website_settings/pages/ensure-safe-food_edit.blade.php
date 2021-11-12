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
            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->slug, 'lang'=> $language->code,'page'=>'featured_page'] ) }}">
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
				<label class="col-sm-2 col-from-label" for="name">{{translate('Top Banner')}} <span class="text-danger">*</span></label>
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
            <div class="form-group">
                <label>{{ translate('Content') }}</label>
                <input type="hidden" name="types[][{{ $lang }}]" value="description">
                <textarea class="aiz-text-editor form-control" name="description" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">{!! get_page_setting('description',$page->id,null,$lang) !!}</textarea>
            </div>
            <div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Text Before Content')}} </label>
				<div class="col-sm-10">
                    <input type="hidden" name="types[][{{ $lang }}]" value="stage_text">
					<input type="text" class="form-control" placeholder="{{translate('We are committed providing safe food to our consumers')}}" name="stage_text" value="{{ get_page_setting('stage_text',$page->id,null,$lang) }}" >
				</div>
			</div>
            <div class="form-group">
                <label>{{ translate('Left right Text banner') }}</label>
                <div class="home-banner3-target">
                    <input type="hidden" name="types[]" value="banner_text_images">
                    <input type="hidden" name="types[][{{ $lang }}]" value="banner_text_titles">
                    <input type="hidden" name="types[][{{ $lang }}]" value="banner_text_details">
                    <input type="hidden" name="types[]" value="banner_text_links">
                </div>
                @if (get_page_setting('banner_text_images',$page->id) != null)
                    @foreach (json_decode(get_page_setting('banner_text_images',$page->id), true) as $key => $value)
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
                                    <input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="banner_text_titles[]" value="{{ json_decode(get_page_setting('banner_text_titles',$page->id,null,$lang),true)[$key] }}">
                                </div>
                            </div>
                            <div class="col-xl">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ translate('Link') }}" name="banner_text_links[]" value="{{ json_decode(get_page_setting('banner_text_links',$page->id),true)[$key] }}">
                                </div>
                            </div>
                            <div class="col-xl">
                                <div class="form-group">
                                	<textarea class="form-control" placeholder="" name="banner_text_details[]">{{ json_decode(get_page_setting('banner_text_details',$page->id,null,$lang),true)[$key] }}</textarea>
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

            {{-- <div class="form-group row mb-3">
                <label class="col-sm-3 control-label" for="products">{{translate('Products')}}</label>
                <div class="col-sm-9">
                    <input type="hidden" name="types[]" value="products">
                    <select name="products[]" id="products" class="form-control aiz-selectpicker" multiple required data-placeholder="{{ translate('Choose Products') }}" data-live-search="true" data-selected-text-format="count" data-selected="{{ get_page_setting('products',$page->id) }}">
                        @foreach(\App\Product::orderBy('created_at', 'desc')->get() as $product)
                            <option value="{{$product->id}}">{{ $product->getTranslation('name') }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
			{{-- <div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Shop link')}}</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="{{translate('link with http or https')}}" name="shop_link" value="{{ get_page_setting('shop_link',$page->id) }}">
				</div>
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
