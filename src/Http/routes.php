<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Xup\Web\Http\Controllers',
    'middleware' => 'web',
], function(){

    Route::get('/', 'HomeController@index');

});