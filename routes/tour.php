<?php

use App\Http\Controllers\Tour\GuideController;

Route::group(['prefix' => '/tour', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'tour.'], function () {
    Route::resource('guides', GuideController::class)->except(['show']);
});
