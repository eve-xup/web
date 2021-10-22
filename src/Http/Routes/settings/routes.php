<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'settings',
], function(){


    require_once __DIR__ .'/access.php';

});