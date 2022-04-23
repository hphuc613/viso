@php
    use App\AppHelpers\Helper;
    $logo = Helper::getSetting('LOGO_NORMAL');
    $favicon = Helper::getSetting('FAVICON');
    $website_name = Helper::getSetting('WEBSITE_NAME');
    $facebook = Helper::getSetting('FACEBOOK');
    $instagram = Helper::getSetting('INSTAGRAM')
@endphp
<html lang="{{ !empty(App::getLocale()) ? App::getLocale() : 'en' }}">
<head>
    <title>{{!empty($website_name) ? $website_name : 'Viso Mall'}}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="Viso">
    <meta name="description" content="VISO MALL 以簡易操作為本，我們相信能給您一個既方便且充滿樂趣的網購體驗。">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="theme-color" content="#00A9E0">
    <meta name="msapplication-navbutton-color" content="#00A9E0">
    <meta name="apple-mobile-web-app-status-bar-style" content="#00A9E0">
    <!--whatsapp-->
    <meta property="og:image:secure_url" itemprop="image" content="tba/wts_ogp.jpg">
    <!--og-->
    <meta property="og:locale" content="zh_hk">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Viso Mall">
    <meta property="og:description" content="VISO MALL 以簡易操作為本，我們相信能給您一個既方便且充滿樂趣的網購體驗。">
    <!--meta property="og:url" content=""-->
    <meta property="og:site_name" content="Viso Mall">
    <meta property="og:image:secure_url" content="tba/ogp.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <!--twitter-->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Viso Mall">
    <meta name="twitter:description" content="VISO MALL 以簡易操作為本，我們相信能給您一個既方便且充滿樂趣的網購體驗。">
    <meta name="twitter:image" content="tba/ogp.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/multi_dd.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="icon" href="{{ url(asset( !empty($favicon) ? $favicon :'storage/upload/Home/products.png')) }}">

    @stack('css')
</head>
<body>
@include('Base::frontend.header.header')

@yield('content')

@include('Base::frontend.modal_group')

@include('Base::frontend.footer')
<!-- Back to top -->
<a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
    <i class="fas fa-chevron-up"></i>
</a>

<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/pjax/jquery.pjax.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datetimepicker/js/datetimepicker.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.zh-TW.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/cart.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast/toast.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/plugins/printjs/print.min.js') }}"></script>
@include('Base::frontend.flash_noti')

@stack('js')
<script>
    $(document).ready(function () {
        addToCart('{{ route('get.cart.addToCart') }}');
    });
</script>
</body>
</html>
