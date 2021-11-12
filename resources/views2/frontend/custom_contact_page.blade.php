@extends('frontend.layouts.app')

@section('meta_title'){{ $page->meta_title }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($page->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($page->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($page->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ URL($page->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($page->meta_img) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($page->unit_price) }}" />
@endsection

@section('content')
<section class="mb-4 px-10px ">
    <div class="text-white bg-cover bg-no-repeat bg-center py-9" style="background-image: url({{uploaded_asset(get_page_setting('banner',$page->id)) }});">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <div class="text-uppercase mb-1">{{ get_page_setting('subtitle',$page->id,null,App::getLocale()) }}</div>
                    <h1 class="h2 mb-3">{{ $page->getTranslation('title') }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="border-bottom brder-bottom pb-5">
	<div class="container">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="card mb-5">
                    <div class="card-body">
                        <form id="contact-form" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{ translate('Name') }}</label>
                                        <input type="text" class="form-control" name="name" placeholder="{{ translate('Your name') }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ translate('Email') }}</label>
                                        <input type="email" class="form-control" name="email" placeholder="{{ translate('Your email') }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ translate('Contact Number') }}</label>
                                        <input type="number" class="form-control" name="phone" placeholder="{{ translate('Your mobile number') }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ translate('Company Name') }}</label>
                                        <input type="text" class="form-control" name="company" placeholder="{{ translate('Your company name') }}" required="">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{ translate('Message') }}</label>
                                        <textarea class="form-control" name="message" rows="13" placeholder="{{ translate('Your message') }}" required=""></textarea>
                                    </div>                            
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary" id="send-email">{{ translate('Send Inquiries') }}</button>
                            </div>
                            <div class="alert contact-alert d-none mt-2">
                                
                            </div>
                        </form>
                    </div>
                </div>
                <div class="embed-responsive embed-responsive-21by9">
                    {!! get_page_setting('g_map_iframe_code',$page->id) !!}
                </div>
            </div>
        </div>
	</div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#send-email").click(function(e){
            e.preventDefault();
            $(this).html('<span>Sending</span><span class="spinner-grow spinner-grow-sm ml-2"></span>');
            $.ajax({
                type: "POST",
                url: '{{ route('contact-send-email') }}',
                data: $('#contact-form').serialize(),
                success: function(data){


                    $('.contact-alert').removeClass('d-none');
                    if(data.error == 'success'){
                        $('#send-email').html('{{ translate('Send Inquiries') }}');
                        $('.contact-alert').removeClass('alert-danger').addClass('alert-success').html('Your email has been sent successfully!');
                    }else if(data.error == 'missing'){
                        setTimeout(function(){
                            $('#send-email').html('{{ translate('Send Inquiries') }}');
                            $('.contact-alert').removeClass('alert-success').addClass('alert-danger').html('Please fill all information!');
                        }, 2000);
                    }else if(data.error == 'email'){
                        setTimeout(function(){
                            $('#send-email').html('{{ translate('Send Inquiries') }}');
                            $('.contact-alert').removeClass('alert-success').addClass('alert-danger').html('Please provide a valid email!');
                        }, 2000);
                    }
                },
                error: function (data) {
                    console.log(data);
                    $('#send-email').html('Send Email');
                },
            });

        });
    });
</script>
@endsection