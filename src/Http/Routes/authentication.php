<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => '\Xup\Web\Http\Controllers\Auth',
    'middleware' => 'web',
], function(){

    Route::get('/auth/public/redirect', 'PublicSsoController@redirect')->name('auth.public.redirect');


    Route::get('/auth/callback', 'PublicSsoController@callback');

});