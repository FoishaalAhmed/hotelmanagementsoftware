<?php

use App\Http\Controllers\Parking\ChargeController;
use App\Http\Controllers\Parking\CostController;
use App\Http\Controllers\Parking\DashboardController;
use App\Http\Controllers\Parking\ParkingController;
use App\Http\Controllers\Parking\VehicleCategoryController;

Route::group(['prefix' => '/parking', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'parking.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('charges', ChargeController::class)->except(['create', 'edit', 'show']);
    Route::resource('categories', VehicleCategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('parkings', ParkingController::class)->except(['show']);
    Route::resource('costs', CostController::class)->except(['create', 'show']);
});
