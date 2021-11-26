<?php

use App\Http\Controllers\Gym\GymController;
use App\Http\Controllers\Gym\GymChargeController;

Route::group(['prefix' => '/gym', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'gym.'], function () {
    Route::resource('gyms', GymController::class)->except(['show']);
    Route::resource('charges', GymChargeController::class)->except(['show']);
});
