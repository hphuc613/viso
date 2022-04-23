<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("member")->group(function () {
        Route::get("/", "MemberController@index")->name("get.member.list")->middleware('can:member');
        Route::group(['middleware' => 'can:member-create'], function () {
            Route::get('/create', 'MemberController@getCreate')->name('get.member.create');
            Route::post('/create', 'MemberController@postCreate')->name('post.member.create');
        });
        Route::group(['middleware' => 'can:member-update'], function () {
            Route::get('/update/{id}', 'MemberController@getUpdate')->name('get.member.update');
            Route::post('/update/{id}', 'MemberController@postUpdate')->name('post.member.update');
        });
        Route::get('/delete/{id}', 'MemberController@delete')->name('get.member.delete')->middleware('can:member-delete');
        Route::group(['middleware' => 'can:member-voucher'], function () {
            Route::get("/voucher/{id}", "MemberController@getVoucher")->name("get.member.voucher");
            Route::get("/voucher/{member_id}/delete/{voucher_id}", "MemberController@deleteVoucher")->name("get.member.deleteVoucher");
        });
    });
});
