<?php

use Illuminate\Support\Facades\Route;
use Xup\Web\Http\Controllers\Fleets\FleetController;

Route::group([
    'prefix' => 'fleets',
    'namespace' => '\\Xup\\Web\\Http\\Controllers\Fleets',
], function(){

    Route::get('create', [FleetController::class, 'index'])
        ->middleware(['can:xup.fleet-commander'])
        ->name('xup.fleets.create');


    Route::get('current', [FleetController::class, 'manage'])
        ->middleware(['can:xup.fleet-commander'])
        ->name('xup.fleets.current');

});