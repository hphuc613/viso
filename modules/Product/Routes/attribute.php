<?php

use Illuminate\Support\Facades\Route;

Route::prefix("attribute")->group(function(){

    /** Product attribute router */
    Route::get("/", "AttributeController@index")->name("get.attribute.list")->middleware('can:attribute');
    Route::middleware('can:attribute-create')->group(function(){
        Route::get("/create", "AttributeController@getCreate")->name("get.attribute.create");
        Route::post("/create", "AttributeController@postCreate")->name("post.attribute.create");
    });
    Route::middleware('can:attribute-update')->group(function(){
        Route::get("/update/{id}", "AttributeController@getUpdate")->name("get.attribute.update");
        Route::post("/update/{id}", "AttributeController@postUpdate")->name("post.attribute.update");
    });
    Route::get("/delete/{id}", "AttributeController@delete")
         ->name("get.attribute.delete")
         ->middleware('can:attribute-delete');

    Route::middleware('can:attribute-create')->group(function(){
        Route::get("/create-realtime", "AttributeController@getCreateRealtime")->name("get.attribute.create_realtime");
        Route::post("/create-realtime", "AttributeController@postCreateRealtime")
             ->name("post.attribute.create_realtime");
    });


    /** Product attribute option router */
    Route::prefix("option")->group(function(){
        Route::middleware('can:attribute-create')->group(function(){
            Route::get("/create/{attribute_id}", "AttributeController@getCreateOption")->name("get.attribute_option.create");
            Route::post("/create/{attribute_id}", "AttributeController@postCreateOption")->name("post.attribute_option.create");
            Route::get("/update/{id}", "AttributeController@getUpdateOption")->name("get.attribute_option.update");
            Route::post("/update/{id}", "AttributeController@postUpdateOption")->name("post.attribute_option.update");
            Route::get("/delete/{id}", "AttributeController@deleteOption")->name("get.attribute_option.delete");
        });
    });
});
