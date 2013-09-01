<?php

Route::group(array('prefix' => Config::get('laravel-oauth::route')), function() {
    Route::delete('{provider}', '\Thomaswelton\LaravelOauth\OAuthController@destroy');
    Route::get('{provider}/login/', '\Thomaswelton\LaravelOauth\OAuthController@login');
    Route::get('{provider}/authorize/', '\Thomaswelton\LaravelOauth\OAuthController@authorize');
    Route::get('{provider}', '\Thomaswelton\LaravelOauth\OAuthController@index');
});
