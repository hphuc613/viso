<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('get.home.index');

/** Account Page */
Route::prefix('my-account')->group(function(){
    Route::get('/', 'AccountController@getProfile')->name('get.home.profile');
    Route::post('/', 'AccountController@postProfile')->name('post.home.profile');
    Route::get('/delivery-address', 'AccountController@getDeliveryAddress')->name('get.home.delivery_address');
    Route::post('/delivery-address', 'AccountController@postDeliveryAddress')->name('post.home.delivery_address');
});


Route::get('point-reward', 'HomeController@pointReward')->name('get.home.pointReward');
Route::get('apply-voucher', 'HomeController@getApplyVoucher')->name('get.home.getApplyVoucher');

Route::get('about-us', 'PageController@getPage')->name('get.page.aboutUs');
Route::get('our-mission', 'PageController@getPage')->name('get.page.ourMission');
Route::get('shipping-information', 'PageController@getPage')->name('get.page.shippingInformation');
Route::get('common-problem', 'PageController@getPage')->name('get.page.commonProblem');
Route::get('contact-us', 'PageController@getPage')->name('get.page.contactUs');
Route::get('order-teaching', 'PageController@getPage')->name('get.page.orderTeaching');

Route::get('past-participating', 'PageController@participate')->name('get.page.participate');

Route::prefix('product')->group(function(){
    Route::get('', 'ProductController@productListing')->name('get.product.productListing');
    Route::get('detail/{slug}', 'ProductController@productDetail')->name('get.product.productDetail');
    Route::get('feedback/{slug}', 'ProductController@feedback')->name('get.product.feedback');
    Route::post('feedback/{slug}', 'ProductController@feedback')->name('post.product.feedback');
});

Route::prefix('post')->group(function(){
    Route::get('', 'PostController@index')->name('get.post.postListing');
    Route::get('detail/{id}-{slug}', 'PostController@detail')->name('get.post.postDetail');
});

Route::prefix('cart')->group(function(){
    Route::get('box', 'CartController@cartBox')->name('get.cart.cartBox');
    Route::get('add', 'CartController@addToCart')->name('get.cart.addToCart');
    Route::get('update', 'CartController@updateCart')->name('get.cart.updateCart');
    Route::get('shopping-cart', 'CartController@shoppingCart')->name('get.cart.shoppingCart');
});

Route::prefix('offer')->group(function(){
    Route::get('', 'OfferController@index')->name('get.offer.offerListing');
    Route::get('bundle/{id}', 'OfferController@bundle')->name('get.offer.bundle');
});

Route::prefix('payment')->group(function(){
    Route::get('information', 'PaymentController@getPaymentInfo')->name('get.payment.getPaymentInfo');
    Route::get('shipping', 'PaymentController@getPaymentShipping')->name('get.payment.getPaymentShipping');
    Route::get('payment-now', 'PaymentController@getPaymentNow')->name('get.payment.getPaymentNow');
    Route::post('payment-now', 'PaymentController@postPayment')->name('post.payment.postPayment');

    /** PayPal */
    Route::get('paypal', 'PaymentPayPalController@index')->name('payment.paypal');
    Route::get('paypal-cancel', 'PaymentPayPalController@cancel')->name('paypal.cancel');
    Route::get('paypal-success', 'PaymentPayPalController@success')->name('paypal.success');

    /** Stripe */
    Route::get('stripe', 'PaymentStripeController@index')->name('payment.stripe');
    Route::get('stripe-cancel', 'PaymentStripeController@cancel')->name('stripe.cancel');
    Route::get('stripe-success', 'PaymentStripeController@success')->name('stripe.success');
});


/** Member */
Route::post('register-email', 'VoucherController@registerEmail')->name('post.home.registerEmail');
Route::get('my-voucher', 'MemberController@getVoucher')->name('get.home.voucher');
Route::get('my-order', 'MemberController@getOrder')->name('get.home.order');
Route::get('my-voucher/{id}/detail', 'MemberController@getVoucherDetail')->name('get.home.voucherDetail');
Route::get('my-voucher/{id}/redeem', 'VoucherController@redeemVoucher')->name('get.home.redeemVoucher');
Route::get("my-order/{id}/detail", "MemberController@getOrderDetail")->name("get.home.orderDetail");


