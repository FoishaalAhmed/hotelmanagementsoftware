<?php


use App\Http\Controllers\Hall\CostController;
use App\Http\Controllers\Hall\HallController;
use App\Http\Controllers\Hall\HallCategoryController;
use App\Http\Controllers\Hall\HallRentController;

Route::group(['prefix' => '/hall', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'hall.'], function () {
    Route::resource('costs', CostController::class)->except(['create', 'show']);
    Route::resource('halls', HallController::class)->except(['show']);
    Route::resource('rents', HallRentController::class)->except(['show']);
    Route::resource('categories', HallCategoryController::class)->except(['create', 'edit', 'show']);
});
