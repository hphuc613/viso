<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("setting")->group(function () {
        Route::get("/", "SettingController@index")->name("get.setting.list");
        Route::get("/email", "SettingController@emailConfig")->name("get.setting.emailConfig");
        Route::post("/email", "SettingController@emailConfig")->name("post.setting.emailConfig");
        Route::get("/test-email", "SettingController@testSendMail")->name("get.setting.testSendMail");
        Route::get("/website", "SettingController@websiteConfig")->name("get.setting.websiteConfig");
        Route::post("/website", "SettingController@websiteConfig")->name("post.setting.websiteConfig");
        Route::get("/point-exchange", "SettingController@pointExchange")->name("get.setting.pointExchange");
        Route::post("/point-exchange", "SettingController@pointExchange")->name("post.setting.pointExchange");
        Route::prefix('payment')->group(function(){
            Route::get("/", "SettingController@getPaymentConfig")->name("get.setting.paymentConfig");
            Route::post("stripe", "SettingController@postStripeConfig")->name("post.setting.stripeConfig");
            Route::post("paypal", "SettingController@postPaypalConfig")->name("post.setting.paypalConfig");
        });
    });
});
