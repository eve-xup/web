<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware'=>['web', 'auth'],
    'prefix' => 'fleets'
], function(){

    Route::get('create', [\Xup\Web\Http\Controllers\Fleets\FleetController::class, 'index'])->name('fleets.create');

});