<!DOCTYPE html>
<?php if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1): ?>
<html dir="rtl" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<?php else: ?>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<?php endif; ?>
<head>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="app-url" content="<?php echo e(getBaseURL()); ?>">
    <meta name="file-base-url" content="<?php echo e(getFileBaseURL()); ?>">

    <title><?php echo $__env->yieldContent('meta_title', get_setting('website_name').' | '.get_setting('site_motto')); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', get_setting('meta_description') ); ?>" />
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', get_setting('meta_keywords') ); ?>">

    <?php echo $__env->yieldContent('meta'); ?>

    <?php if(!isset($detailedProduct) && !isset($customer_product) && !isset($shop) && !isset($page) && !isset($blog)): ?>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo e(get_setting('meta_title')); ?>">
    <meta itemprop="description" content="<?php echo e(get_setting('meta_description')); ?>">
    <meta itemprop="image" content="<?php echo e(uploaded_asset(get_setting('meta_image'))); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo e(get_setting('meta_title')); ?>">
    <meta name="twitter:description" content="<?php echo e(get_setting('meta_description')); ?>">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="<?php echo e(uploaded_asset(get_setting('meta_image'))); ?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo e(get_setting('meta_title')); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo e(route('home')); ?>" />
    <meta property="og:image" content="<?php echo e(uploaded_asset(get_setting('meta_image'))); ?>" />
    <meta property="og:description" content="<?php echo e(get_setting('meta_description')); ?>" />
    <meta property="og:site_name" content="<?php echo e(env('APP_NAME')); ?>" />
    <meta property="fb:app_id" content="<?php echo e(env('FACEBOOK_PIXEL_ID')); ?>">
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(uploaded_asset(get_setting('site_icon'))); ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Raleway:wght@400&family=Roboto&display=swap" rel="stylesheet">


    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo e(static_asset('assets/css/vendors.css')); ?>">
    <?php if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1): ?>
    <link rel="stylesheet" href="<?php echo e(static_asset('assets/css/bootstrap-rtl.min.css')); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(static_asset('assets/css/aiz-core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(static_asset('assets/css/custom-style.css')); ?>">


    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '<?php echo e(translate('Nothing selected')); ?>',
            nothing_found: '<?php echo e(translate('Nothing found')); ?>',
            choose_file: '<?php echo e(translate('Choose file')); ?>',
            file_selected: '<?php echo e(translate('File selected')); ?>',
            files_selected: '<?php echo e(translate('Files selected')); ?>',
            add_more_files: '<?php echo e(translate('Add more files')); ?>',
            adding_more_files: '<?php echo e(translate('Adding more files')); ?>',
            drop_files_here_paste_or: '<?php echo e(translate('Drop files here, paste or')); ?>',
            browse: '<?php echo e(translate('Browse')); ?>',
            upload_complete: '<?php echo e(translate('Upload complete')); ?>',
            upload_paused: '<?php echo e(translate('Upload paused')); ?>',
            resume_upload: '<?php echo e(translate('Resume upload')); ?>',
            pause_upload: '<?php echo e(translate('Pause upload')); ?>',
            retry_upload: '<?php echo e(translate('Retry upload')); ?>',
            cancel_upload: '<?php echo e(translate('Cancel upload')); ?>',
            uploading: '<?php echo e(translate('Uploading')); ?>',
            processing: '<?php echo e(translate('Processing')); ?>',
            complete: '<?php echo e(translate('Complete')); ?>',
            file: '<?php echo e(translate('File')); ?>',
            files: '<?php echo e(translate('Files')); ?>',
        }
    </script>

    <style>
        body{
            font-family:'Raleway',sans-serif;
            font-family: 'georgia', sans-serif;
            font-family: 'Lato', sans-serif;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
        }
        :root{
            --primary: <?php echo e(get_setting('base_color', '#e62d04')); ?>;
            --hov-primary: <?php echo e(get_setting('base_hov_color', '#c52907')); ?>;
            --soft-primary: <?php echo e(hex2rgba(get_setting('base_color','#e62d04'),.15)); ?>;
        }
    </style>

<?php if(get_setting('google_analytics') == 1): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('TRACKING_ID')); ?>"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo e(env('TRACKING_ID')); ?>');
    </script>
<?php endif; ?>

<?php if(get_setting('facebook_pixel') == 1): ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo e(env('FACEBOOK_PIXEL_ID')); ?>');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo e(env('FACEBOOK_PIXEL_ID')); ?>&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
<?php endif; ?>

<?php
    echo get_setting('header_script');
?>

</head>
<body class="<?php if(Route::currentRouteName() == 'home'): ?> homepage <?php endif; ?>" style="background-image: url(<?php echo e(static_asset('assets/img/whole_bg.jpg')); ?>);">
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>

        var firebaseConfig = {
            apiKey: "AIzaSyBR_frjj7ItK7A33BHe3jjUW6GFX8ghWlI",
              authDomain: "yuhi-deliveryboy-dd905.firebaseapp.com",
              projectId: "yuhi-deliveryboy-dd905",
              storageBucket: "yuhi-deliveryboy-dd905.appspot.com",
              messagingSenderId: "957586946304",
              appId: "1:957586946304:web:a01522f23f347470535be5",
              measurementId: "G-DTWYMK6CYN"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();


        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });

    </script>
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column " style="overflow: hidden;background-image: url(<?php echo e(static_asset('assets/img/whole_bg.jpg')); ?>);">

        <!-- Header -->
        <?php echo $__env->make('frontend.inc.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('frontend.inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <?php if(get_setting('show_cookies_agreement') == 'on'): ?>
        <div class="aiz-cookie-alert shadow-xl">
            <div class="p-3 bg-dark rounded">
                <div class="text-white mb-3">
                    <?php
                        echo get_setting('cookies_agreement_text');
                    ?>
                </div>
                <button class="btn btn-primary aiz-cookie-accept">
                    <?php echo e(translate('Ok. I Understood')); ?>

                </button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(get_setting('show_website_popup') == 'on'): ?>
        <div class="modal website-popup removable-session d-none" data-key="website-popup" data-value="removed">
            <div class="absolute-full bg-black opacity-60"></div>
            <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md">
                <div class="modal-content position-relative border-0 rounded-0">
                    <div class="aiz-editor-data">
                        <?php echo get_setting('website_popup_content'); ?>

                    </div>
                    <?php if(get_setting('show_subscribe_form') == 'on'): ?>
                        <div class="pb-5 pt-4 px-5">
                            <form class="" method="POST" action="<?php echo e(route('subscribers.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="form-group mb-0">
                                    <input type="email" class="form-control" placeholder="<?php echo e(translate('Your Email Address')); ?>" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-3">
                                    <?php echo e(translate('Subscribe Now')); ?>

                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <button class="absolute-top-right bg-white shadow-lg btn btn-circle btn-icon mr-n3 mt-n3 set-session" data-key="website-popup" data-value="removed" data-toggle="remove-parent" data-parent=".website-popup">
                        <i class="la la-close fs-20"></i>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php echo $__env->make('frontend.partials.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
                <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la-2x">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldContent('modal'); ?>

    <!-- SCRIPTS -->
    <script src="<?php echo e(static_asset('assets/js/vendors.js')); ?>"></script>
    <script src="<?php echo e(static_asset('assets/js/aiz-core.js')); ?>"></script>



    <?php if(get_setting('facebook_chat') == 1): ?>
        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                  xfbml            : true,
                  version          : 'v3.3'
                });
              };

              (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="<?php echo e(env('FACEBOOK_PAGE_ID')); ?>">
        </div>
    <?php endif; ?>

    <script>
        <?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            AIZ.plugins.notify('<?php echo e($message['level']); ?>', '<?php echo e($message['message']); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>

    <script>
        var back_to_top_btn = $('#back_to_top_btn');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 300) {
                back_to_top_btn.addClass('show');
            } else {
                back_to_top_btn.removeClass('show');
            }
        });

        back_to_top_btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop:0}, '300');
        });

        $(document).ready(function() {
            $('.side-menu [data-id]').each(function(i, el) {
                var id = $(el).data('id');
                $(el).on('click',function(){
                    $('.side-menu').addClass('slide');
                    $('#cat-menu-'+id).addClass('slide');
                });
            });
            $('.sub-menu-wrap .back-to-menu').on('click',function(){
                $('.side-menu').removeClass('slide');
                $('.sub-menu-wrap').find('.slide').removeClass('slide');
            });
            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function(){
                    if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                        $.post('<?php echo e(route('category.elements')); ?>', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                            $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                        });
                    }
                });
            });
            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('<?php echo e(route('language.change')); ?>',{_token: AIZ.data.csrf, locale:locale}, function(data){
                            location.reload();
                        });

                    });
                });
            }

            if ($('#currency-change').length > 0) {
                $('#currency-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var currency_code = $this.data('currency');
                        $.post('<?php echo e(route('currency.change')); ?>',{_token: AIZ.data.csrf, currency_code:currency_code}, function(data){
                            location.reload();
                        });

                    });
                });
            }
        });

        $('#search').on('keyup', function(){
            search();
        });

        $('#search').on('focus', function(){
            search();
        });

        function search(){
            var searchKey = $('#search').val();
            if(searchKey.length > 0){
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('<?php echo e(route('search.ajax')); ?>', { _token: AIZ.data.csrf, search:searchKey}, function(data){
                    if(data == '0'){
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                        $('.search-preloader').addClass('d-none');

                    }
                    else{
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
            }
            else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }

        function updateNavCart(view,count){
            $('.cart-count').html(count);
            $('#sidebar-cart').html(view);
            AIZ.extra.plusMinus();
        }

        function updateQuantity(key, element){
            $.post('<?php echo e(route('cart.updateQuantity')); ?>', {
                _token   :  AIZ.data.csrf,
                id       :  key,
                quantity :  element.value
            }, function(data){
                updateNavCart(data.nav_cart_view,data.cart_count);
                $('#cart-summary').html(data.cart_view);
            });
        }

        function removeFromCart(key){
            $.post('<?php echo e(route('cart.removeFromCart')); ?>', {
                _token  : AIZ.data.csrf,
                id      :  key
            }, function(data){
                updateNavCart(data.nav_cart_view,data.cart_count);
                $('#cart-summary').html(data.cart_view);
                AIZ.plugins.notify('success', 'Item has been removed from cart');
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
            });
        }

        function addToCompare(id){
            $.post('<?php echo e(route('compare.addToCompare')); ?>', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#compare').html(data);
                AIZ.plugins.notify('success', "<?php echo e(translate('Item has been added to compare list')); ?>");
                $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
            });
        }

        function addToWishList(id){
            <?php if(Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller')): ?>
                $.post('<?php echo e(route('wishlists.store')); ?>', {_token: AIZ.data.csrf, id:id}, function(data){
                    if(data != 0){
                        $('#wishlist').html(data);
                        AIZ.plugins.notify('success', "<?php echo e(translate('Item has been added to wishlist')); ?>");
                    }
                    else{
                        AIZ.plugins.notify('warning', "<?php echo e(translate('Please login first')); ?>");
                    }
                });
            <?php else: ?>
                AIZ.plugins.notify('warning', "<?php echo e(translate('Please login first')); ?>");
            <?php endif; ?>
        }

        function showAddToCartModal(id){
            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('<?php echo e(route('cart.showCartModal')); ?>', {_token: AIZ.data.csrf, id:id}, function(data){
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                AIZ.plugins.slickCarousel();
                AIZ.plugins.zoom();
                AIZ.extra.plusMinus();
                getVariantPrice();
            });
        }

        $('#option-choice-form input').on('change', function(){
            getVariantPrice();
        });

        function getVariantPrice(){
            if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
                $.ajax({
                   type:"POST",
                   url: '<?php echo e(route('products.variant_price')); ?>',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){

                        $('.product-gallery-thumb .carousel-box').each(function (i) {
                            if($(this).data('variation') && data.variation == $(this).data('variation')){
                                $('.product-gallery-thumb').slick('slickGoTo', i);
                            }
                        })

                       $('#option-choice-form #chosen_price_div').removeClass('d-none');
                       $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                       $('#available-quantity').html(data.quantity);
                       $('.input-number').prop('max', data.max_limit);
                       if(parseInt(data.in_stock) == 0 && data.digital  == 0){
                           $('.buy-now').addClass('d-none');
                           $('.add-to-cart').addClass('d-none');
                           $('.out-of-stock').removeClass('d-none');
                       }
                       else{
                           $('.buy-now').removeClass('d-none');
                           $('.add-to-cart').removeClass('d-none');
                           $('.out-of-stock').addClass('d-none');
                       }
                   }
               });
            }
        }

        function checkAddToCartValidity(){
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                  names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                  count++;
            });

            if($('#option-choice-form input:radio:checked').length == count){
                return true;
            }

            return false;
        }

        function addToCart(){
            if(checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type:"POST",
                    url: '<?php echo e(route('cart.addToCart')); ?>',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data){

                       $('#addToCart-modal-body').html(null);
                       $('.c-preloader').hide();
                       $('#modal-size').removeClass('modal-lg');
                       $('#addToCart-modal-body').html(data.modal_view);
                       AIZ.extra.plusMinus();
                       updateNavCart(data.nav_cart_view,data.cart_count);
                    }
                });
            }
            else{
                AIZ.plugins.notify('warning', 'Please choose all the options');
            }
        }

        function buyNow(){
            if(checkAddToCartValidity()) {
                $('#addToCart-modal-body').html(null);
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                   type:"POST",
                   url: '<?php echo e(route('cart.addToCart')); ?>',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){
                       if(data.status == 1){

                            $('#addToCart-modal-body').html(data.modal_view);
                            updateNavCart(data.nav_cart_view,data.cart_count);

                            window.location.replace("<?php echo e(route('checkout.shipping_info')); ?>");
                       }
                       else{
                            $('#addToCart-modal-body').html(null);
                            $('.c-preloader').hide();
                            $('#modal-size').removeClass('modal-lg');
                            $('#addToCart-modal-body').html(data.modal_view);
                       }
                   }
               });
            }
            else{
                AIZ.plugins.notify('warning', 'Please choose all the options');
            }
        }

        function show_purchase_history_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('<?php echo e(route('purchase_history.details')); ?>', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }


    </script>

    <?php echo $__env->yieldContent('script'); ?>

    <?php
        echo get_setting('footer_script');
    ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>