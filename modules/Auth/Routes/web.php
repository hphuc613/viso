<?php

use Illuminate\Support\Facades\Route;

Route::get('register', 'AuthMemberController@getRegister')->name('get.home.register');
Route::post('register', 'AuthMemberController@postRegister')->name('post.home.register');
Route::get('email-verify', 'AuthMemberController@getEmailVerify')->name('get.home.email_verify');

Route::get('login-page', 'AuthMemberController@loginPage')->name('get.home.login_page');

Route::get('login', 'AuthMemberController@login')->name('get.home.login');
Route::post('login', 'AuthMemberController@login')->name('post.home.login');

Route::get('logout', 'AuthMemberController@logout')->name('get.home.logout');

Route::get('forgot-password', 'AuthMemberController@forgotPassword')->name('get.home.forgotPassword');
Route::post('forgot-password', 'AuthMemberController@forgotPassword')->name('post.home.forgotPassword');
Route::get('reset-password', 'AuthMemberController@getResetPassword')->name('get.home.resetPassword');
Route::post('reset-password', 'AuthMemberController@postResetPassword')->name('post.home.resetPassword');
