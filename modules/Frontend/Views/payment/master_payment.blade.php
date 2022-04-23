@php
    use App\AppHelpers\Helper;
    $logo = Helper::getSetting('LOGO_PAYMENT_PAGE')
@endphp
<html lang="{{ !empty(App::getLocale()) ? App::getLocale() : 'en' }}">
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl-carousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datetimepicker/css/datetimepicker-custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <title>Glad Beauty</title>

    @stack('css')
</head>
<body>

<div class="main-wrap">
    <div id="payment" class="container payment">
        <div class="row row-payment">
            <div class="col-md-6 payment-info">
                <div class="header-payment">
                    <div id="logo">
                        <a href="{{ route('get.home.index') }}">
                            <img src="{{asset(!empty($logo) ? $logo : 'storage/upload/Home/logo-black.svg')}}"
                                 alt="Logo"></a>
                    </div>
                </div>
                @yield('content')
            </div>
            <div class="col-md-6 order-detail">
                <div class="product-list">
                    @foreach($cart['items'] as $item)
                        @php($item_product = $item['product'])
                        <div class="product-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 position-relative">
                                    <img src="{{ asset($item_product->image ?? '') }}"
                                         alt="{{ asset($item_product->image ?? '') }}">
                                    <span class="quantity">{{ $item['quantity'] }}</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="row">
                                        <div class="col-md-7 col-12">
                                            <h6 class="title">{{ $item_product->name ?? '' }}</h6>
                                            <div class="text">{{ $item['capacity'] ?? NULL }}</div>
                                        </div>
                                        <div class="col-md-5  col-12 product-price">
                                            <div class="price">{{ moneyFormat($item['final_price'] ?? 0) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="discount py-3">
                    <div class="input-group">
                        <div class="form-floating w-75">
                            <a href="{{ route('get.home.getApplyVoucher') }}" data-bs-toggle="modal"
                               data-bs-target="#form-modal-normal"
                               id="discount"
                               class="form-control voucher-applied rounded-0 px-2 py-1 d-flex align-items-center">
                                @if(isset($cart['voucher']) && !empty($cart['voucher']))
                                    <span class="text-secondary py-1 px-2 text-truncate border text-white"
                                          style="max-width: 100%; background-color: #ff6200">
                                        {{ ($cart['voucher'])->name ?? NULL }}
                                    </span>
                                @else
                                    <span class="text-secondary text-truncate w-100">
                                        {{ trans('Gift card or discount code') }}
                                    </span>
                                @endif
                            </a>
                        </div>
                        <button class="btn btn-clear-voucher w-25">{{trans('Clear')}}</button>
                    </div>
                </div>
                <hr>
                <div class="price-calculate py-3">
                    <div class="subtotal d-flex justify-content-between">
                        <div class="text">{{trans('Subtotal')}}</div>
                        <div class="price" id="payment_subtotal">{{ moneyFormat($cart['total_price'], "$") }}</div>
                    </div>
                    <div class="subtotal d-flex justify-content-between">
                        <div class="text">{{trans('Voucher')}}</div>
                        <div class="price" id="payment_subtotal">-{{ moneyFormat($cart['voucher_price'], "$") }}</div>
                    </div>
                    <div class="shipping d-flex justify-content-between">
                        <div class="text mb-0">{{trans('Shipping')}} <i class="fas fa-question-circle"></i></div>
                        <div class="price">{{ moneyFormat($shipping->value ?? 0) }}</div>
                        <input type="hidden" id="payment_shipping_value" value="{{ $shipping->value ?? 0 }}">
                    </div>
                </div>
                <hr>
                <div class="total-price py-4 d-flex justify-content-between">
                    <div class="text">{{trans('Total')}}</div>
                    <div>
                        @php($amount = $cart['amount'] + (int)($shipping->value ?? 0))
                        <div class="price" id="payment_total">{{ moneyFormat($amount) }}</div>
                        <input type="hidden" id="total-amount" value="{{round(((float)($amount) * 0.1284), 2) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 policy">
                <div class="text cl-text-primary">
                    By checking the sign-up box for text message offers and clicking Continue to shipping, I consent
                    to
                    receive recurring automated marketing text messages from GLADS BEAUTY WORKSHOP at the number
                    provided, and I agree that texts may be sent using through an autodialer or other technology.
                    Consent is not a condition of purchase. Text STOP to cancel, HELP for help. Message and Data
                    rates
                    may apply. For more information see [Terms of Service] & [Privacy Policy].
                </div>
                <div class="policy-link">
                    <a href="#">{{trans('Refund policy')}}</a>
                    <a href="#">{{trans('Shipping policy')}}</a>
                    <a href="#">{{trans('Terms of Service')}}</a>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block order-detail"></div>
        </div>
    </div>
</div>

<a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
    <i class="fas fa-chevron-up"></i>
</a>
@include('Base::frontend.modal_group')
<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/pjax/jquery.pjax.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/cart.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast/toast.js') }}"></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.zh-TW.js') }}"></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('Base::frontend.flash_noti')

@stack('js')
<script>
    $(document).ready(function () {
        updateGeneralCart("{{ route('get.cart.updateCart') }}");
    });
</script>
</body>
</html>
