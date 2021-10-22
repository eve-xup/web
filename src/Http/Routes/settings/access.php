<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'=>'access',
    'namespace' => '\\Xup\\Web\\Http\\Controllers\\Settings',
    'middleware' => 'can:acl.manage'
], function(){


    Route::get('/roles', 'AclController@index')
        ->name('settings.acl.index');

    Route::post('/roles', 'AclController@store')
        ->name('settings.acl.store');


    Route::get('/roles/{role}/edit', 'AclController@edit')
        ->name('settings.acl.edit');

    Route::put('/roles/{role}/edit', 'AclController@update');



});