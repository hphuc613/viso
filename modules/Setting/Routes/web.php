<?php
use Illuminate\Support\Facades\Route;
Route::get('paypal-api', 'SettingController@getPaypalConfigAjax')->name('get.paypal_api');
