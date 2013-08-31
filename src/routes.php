<?php

Route::group(array('prefix' => Config::get('laravel-oauth::route')), function() {
    Route::get('{provider}/login/', '\Thomaswelton\LaravelOauth\OAuthController@login');
    Route::controller('/', '\Thomaswelton\LaravelOauth\OAuthController');
});
