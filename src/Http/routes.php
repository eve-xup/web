<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Xup\Web\Http\Controllers',
    'middleware' => 'web',
], function(){

    Route::get('/', 'WelcomeController@index');

    Route::get('/login', 'HomeController@login')->name('login');

    require_once __DIR__ . '/Routes/authentication.php';
});



Route::group([
    'middleware'=>['web', 'auth']
], function(){
    Route::group([
        'namespace' => 'Xup\Web\Http\Controllers',
    ], function(){

        Route::get('/user/set_main/{character}', 'HomeController@setMainCharacter')->name('user.set.main');

        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('/logout', 'HomeController@logout')->name('auth.logout');
    });



    require_once __DIR__ . '/Routes/fleets.php';

    require_once __DIR__ . '/Routes/settings/routes.php';

});



