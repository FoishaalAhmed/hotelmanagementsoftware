<?php

use App\Http\Controllers\Restaurant\CostController;
use App\Http\Controllers\Restaurant\DashboardController;
use App\Http\Controllers\Restaurant\FoodCategoryController;
use App\Http\Controllers\Restaurant\FoodTypeController;
use App\Http\Controllers\Restaurant\FoodVatController;
use App\Http\Controllers\Restaurant\ItemController;
use App\Http\Controllers\Restaurant\OrderController;
use App\Http\Controllers\Restaurant\TableBookingController;
use App\Http\Controllers\Restaurant\TableController;
use App\Http\Controllers\Restaurant\TodayMenuController;

Route::group(['prefix' => '/restaurant', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'restaurant.'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    /* types routes start */
    Route::get('/types', [FoodTypeController::class, 'index'])->name('types');
    Route::post('/types/store', [FoodTypeController::class, 'store'])->name('types.store');
    Route::put('/types/update', [FoodTypeController::class, 'update'])->name('types.update');
    Route::delete('/types/destroy/{id}', [FoodTypeController::class, 'destroy'])->name('types.destroy');
    /* types routes end */
    /* types routes start */
    Route::get('/categories', [FoodCategoryController::class, 'index'])->name('categories');
    Route::post('/categories/store', [FoodCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/update', [FoodCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/destroy/{id}', [FoodCategoryController::class, 'destroy'])->name('categories.destroy');
    /* types routes end */
    /* types routes start */
    Route::get('/vats', [FoodVatController::class, 'index'])->name('vats');
    Route::post('/vats/store', [FoodVatController::class, 'store'])->name('vats.store');
    Route::put('/vats/update', [FoodVatController::class, 'update'])->name('vats.update');
    Route::delete('/vats/destroy/{id}', [FoodVatController::class, 'destroy'])->name('vats.destroy');
    /* types routes end */
    /* types routes start */
    Route::get('/tables', [TableController::class, 'index'])->name('tables');
    Route::post('/tables/store', [TableController::class, 'store'])->name('tables.store');
    Route::put('/tables/update', [TableController::class, 'update'])->name('tables.update');
    Route::delete('/tables/destroy/{id}', [TableController::class, 'destroy'])->name('tables.destroy');
    /* types routes end */
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/show/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::resource('items', ItemController::class);
    Route::resource('costs', CostController::class)->except(['create', 'show']);
    Route::resource('menus', TodayMenuController::class);
    Route::resource('bookings', TableBookingController::class);
});
