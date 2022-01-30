<?php

use Illuminate\Support\Facades\Route;
use Xup\Web\Http\Controllers\Fleets\FleetController;

Route::group([
    'prefix' => 'fleets',
    'namespace' => '\\Xup\\Web\\Http\\Controllers\Fleets',
], function(){

    Route::get('manage/{fleet}', [FleetController::class, 'manage'])
        ->middleware(['can:xup.in-fleet'])
        ->name('xup.fleets.current');

    Route::get('create', [FleetController::class, 'index'])
        ->middleware(['can:xup.fleet-commander'])
        ->name('xup.fleets.create');


    Route::get('join/{fleet}', [FleetController::class, 'join'])
        ->name('xup.fleet.join');

    /*Route::get('current', [FleetController::class, 'manage'])
        ->middleware(['can:xup.fleet-commander'])
        ->name('xup.fleets.current');*/

});
