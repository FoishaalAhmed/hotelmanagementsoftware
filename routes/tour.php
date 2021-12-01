<?php

use App\Http\Controllers\Tour\ChargeController;
use App\Http\Controllers\Tour\GuideController;
use App\Http\Controllers\Tour\HelperController;
use App\Http\Controllers\Tour\PackageController;
use App\Http\Controllers\Tour\TourController;

Route::group(['prefix' => '/tour', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'tour.'], function () {
    Route::resource('guides', GuideController::class)->except(['show']);
    Route::resource('charges', ChargeController::class)->except(['show']);
    Route::resource('tours', TourController::class);
    Route::resource('packages', PackageController::class)->except(['create', 'edit', 'show']);

    Route::post('get-charge-by-type', [HelperController::class, 'get_charge_by_type'])->name('get.charge.by.type');
    Route::post('get-charge-by-package', [HelperController::class, 'get_charge_by_package'])->name('get.charge.by.package');
});
