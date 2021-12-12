<?php

use App\Http\Controllers\Laundry\CostController;
use App\Http\Controllers\Laundry\HelperController;
use App\Http\Controllers\Laundry\LaundryProductController;
use App\Http\Controllers\Laundry\LaundryChargeController;
use App\Http\Controllers\Laundry\LaundryServiceController;

Route::group(['prefix' => '/laundry', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'laundry.'], function () {

    Route::post('get-charge-by-type', [HelperController::class, 'charge'])->name('get.charge.by.type');
    Route::resource('costs', CostController::class)->except(['create', 'show']);
    Route::resource('products', LaundryProductController::class)->except(['create', 'show', 'edit']);
    Route::resource('charges', LaundryChargeController::class)->except(['show']);
    Route::resource('services', LaundryServiceController::class)->except(['edit', 'update']);

});
