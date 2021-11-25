<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::group(['middleware' => ['auth']], function () {

    /** profile route start **/
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'photo'])->name('profile');
    Route::post('/password', [ProfileController::class, 'password'])->name('password.change');
    Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    /** profile route end **/
    Route::post('/find-employee', [HelperController::class, 'employee'])->name('find.employee');
    Route::post('/find-coupon', [HelperController::class, 'coupon'])->name('get.coupon');
    Route::post('/get-room-facility', [HelperController::class, 'room_facility'])->name('get.room.facility');
    Route::post('/get-room-rent', [HelperController::class, 'room_rent'])->name('get.room.rent');
    Route::post('/get-room-other-rent', [HelperController::class, 'room_other_rent'])->name('get.room.other.rent');
    Route::get('/salary-attendance-print/{id}', 'PrintController@salary')->name('salary.print');
    Route::post('/find-district', [HelperController::class, 'district'])->name('find.district');
    Route::post('/find-upozilla', [HelperController::class, 'upozilla'])->name('find.upozilla');
    Route::post('get-charge-type', [HelperController::class, 'charge'])->name('get.charge.type');
    Route::post('/delete-hotel-photo', [HelperController::class, 'delete_hotel_photo'])->name('delete.hotel.photo');
    Route::post('/delete-hotel-video', [HelperController::class, 'delete_hotel_video'])->name('delete.hotel.video');
    Route::post('/delete-room-photo', [HelperController::class, 'delete_room_photo'])->name('delete.room.photo');
    Route::post('/delete-room-video', [HelperController::class, 'delete_room_video'])->name('delete.room.video');
    Route::post('/fetch-food-items', [HelperController::class, 'food_items'])->name('fetch.food.items');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
