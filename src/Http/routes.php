<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Xup\Web\Http\Controllers',
    'middleware' => 'web',
], function(){

    Route::get('/', 'WelcomeController@index');

    Route::get('/home', 'HomeController@index')->name('home');

});


Route::group([
    'namespace' => 'Xup\Web\Http\Controllers\Auth',
    'middleware' => 'web',
], function(){

    Route::get('/auth/public/redirect', 'PublicSsoController@redirect')->name('auth.public.redirect');

    Route::get('/auth/callback', 'PublicSsoController@callback');

});

