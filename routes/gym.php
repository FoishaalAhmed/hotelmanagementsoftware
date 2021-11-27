<?php

use App\Http\Controllers\Gym\GymController;
use App\Http\Controllers\Gym\GymChargeController;
use App\Http\Controllers\Gym\GymUserController;

Route::group(['prefix' => '/gym', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'gym.'], function () {
    Route::resource('gyms', GymController::class)->except(['show']);
    Route::resource('charges', GymChargeController::class)->except(['show']);
    Route::resource('users', GymUserController::class)->except(['show', 'edit', 'update']);
});
