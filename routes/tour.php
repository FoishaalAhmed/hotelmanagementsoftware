<?php

use App\Http\Controllers\Tour\ChargeController;
use App\Http\Controllers\Tour\GuideController;
use App\Http\Controllers\Tour\PackageController;

Route::group(['prefix' => '/tour', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'tour.'], function () {
    Route::resource('guides', GuideController::class)->except(['show']);
    Route::resource('charges', ChargeController::class)->except(['show']);
    Route::resource('packages', PackageController::class)->except(['create', 'edit', 'show']);
});
