<?php

use App\Http\Controllers\Api\Employee\DepartmentController;
use App\Http\Controllers\Api\Employee\EmployeeController;
use App\Http\Controllers\Api\Hall\HallCategoryController;
use App\Http\Controllers\Api\Hall\HallController;
use App\Http\Controllers\Api\Hall\HallRentController;
use App\Http\Controllers\Api\HelperController as ApiHelperController;
use App\Http\Controllers\Api\Hotel\BankController;
use App\Http\Controllers\Api\Hotel\BankTransactionController;
use App\Http\Controllers\Api\Hotel\BookingController;
use App\Http\Controllers\Api\Hotel\BookingHelperController;
use App\Http\Controllers\Api\Hotel\BookingServiceController;
use App\Http\Controllers\Api\Hotel\BookingVatController;
use App\Http\Controllers\Api\Hotel\CostController;
use App\Http\Controllers\Api\Hotel\DiscountHotelController;
use App\Http\Controllers\Api\Hotel\RegistrationController;
use App\Http\Controllers\Api\Hotel\RoomController;
use App\Http\Controllers\Api\Hotel\RoomRentController;
use App\Http\Controllers\Api\Hotel\HelperController;
use App\Http\Controllers\Api\Hotel\HotelReviewCategoryController;
use App\Http\Controllers\Api\Hotel\HotelReviewController;
use App\Http\Controllers\Api\Hotel\HotelRuleController;
use App\Http\Controllers\Api\Hotel\MobileBankController;
use App\Http\Controllers\Api\Hotel\MobileTransactionController;
use App\Http\Controllers\Api\Hotel\ServiceController;
use App\Http\Controllers\Api\Hotel\ProfileController;
use App\Http\Controllers\Api\Hotel\ReportController;
use App\Http\Controllers\Api\Hotel\RoomDiscountController;
use App\Http\Controllers\Api\Hotel\RoomFacilityController;
use App\Http\Controllers\Api\Hotel\RoomReviewCategoryController;
use App\Http\Controllers\Api\Hotel\RoomReviewController;
use App\Http\Controllers\Api\Hotel\RoomTypeController;
use App\Http\Controllers\Api\Hotel\UserController;
use App\Http\Controllers\Api\Parking\ChargeController;
use App\Http\Controllers\Api\Parking\ParkingController;
use App\Http\Controllers\Api\Parking\VehicleCategoryController;
use App\Http\Controllers\Api\Restaurant\FoodCategoryController;
use App\Http\Controllers\Api\Restaurant\FoodTypeController;
use App\Http\Controllers\Api\Restaurant\FoodVatController;
use App\Http\Controllers\Api\Restaurant\ItemController;
use App\Http\Controllers\Api\Restaurant\MenuController;
use App\Http\Controllers\Api\Restaurant\OrderController;
use App\Http\Controllers\Api\Restaurant\TableBookingController;
use App\Http\Controllers\Api\Restaurant\TableController;
use App\Http\Controllers\Api\Restaurant\HelperController as RestaurantHelperController;
use Illuminate\Support\Facades\Route;

Route::post('/hotel-login', [RegistrationController::class, 'login']);
Route::get('/service', [HelperController::class, 'service']);
Route::group(
    ['middleware' => ['auth:sanctum']],
    function () {

        /** Hotel Api Start Here **/
        Route::get('/room-types', [RegistrationController::class, 'types']);
        Route::get('/hotel-info', [ProfileController::class, 'index']);
        Route::get('/bookings/checkout/{id}', [BookingController::class, 'checkout']);
        Route::put('/hotel-info/{id}', [ProfileController::class, 'update']);
        Route::delete('/room-photo/{id}', [HelperController::class, 'roomPhoto']);
        Route::delete('/room-video/{id}', [HelperController::class, 'roomVideo']);
        Route::post('/hotel-logo', [HelperController::class, 'logo']);
        Route::get('/total-due/{id}', [HelperController::class, 'due']);
        Route::get('/booking-services/{id}', [HelperController::class, 'services']);
        Route::get('/rents/type', [HelperController::class, 'type']);
        Route::post('/booking/payment', [BookingHelperController::class, 'payment']);
        Route::post('/booking/multiple', [BookingHelperController::class, 'multiple']);
        Route::get('/room/facility/{room_id}', [HelperController::class, 'room_facility']);
        Route::put('/booking-detail/update/{booking_id}', [BookingHelperController::class, 'detail']);
        Route::get('/charge-applicable-service', [BookingServiceController::class, 'index']);
        Route::post('/service-charge-store', [BookingServiceController::class, 'store']);
        Route::get('/get-room-other-rent/{room_id}/{type}', [HelperController::class, 'room_other_rent']);

        // hotel rule route start 
        Route::get('rules', [HotelRuleController::class, 'index'])->name('rules.index');
        Route::put('rules/update/{HotelRule}', [HotelRuleController::class, 'update'])->name('rules.update');
        // hotel rule route start 

        Route::get('reviews', [HotelReviewController::class, 'index'])->name('reviews.index');
        Route::get('reviews/id/{id}/status/{status}', [HotelReviewController::class, 'status'])->name('reviews.status');
        Route::delete('reviews/{id}', [HotelReviewController::class, 'destroy'])->name('reviews.destroy');

        Route::get('room-reviews', [RoomReviewController::class, 'index'])->name('room-reviews.index');
        Route::get('room-reviews/id/{id}/status/{status}', [RoomReviewController::class, 'status'])->name('room-reviews.status');
        Route::delete('room-reviews/{id}', [RoomReviewController::class, 'destroy'])->name('room-reviews.destroy');

        Route::get('room-discount-info', [RoomDiscountController::class, 'returnRoomAndDiscount']);
        Route::get('room-facility-info', [RoomFacilityController::class, 'returnRoomAndFacility']);

        Route::apiResource('banks', BankController::class);
        Route::apiResource('bank-transactions', BankTransactionController::class);
        Route::apiResource('mobile-transactions', MobileTransactionController::class);
        Route::apiResource('mobile-banks', MobileBankController::class);
        Route::apiResource('costs', CostController::class);
        Route::apiResource('rooms', RoomController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('services', ServiceController::class);
        Route::apiResource('room-rents', RoomRentController::class);
        Route::apiResource('hotel-discounts', DiscountHotelController::class);
        Route::apiResource('room-discounts', RoomDiscountController::class);
        Route::apiResource('room-facilities', RoomFacilityController::class);
        Route::apiResource('bookings', BookingController::class)->except(['destroy']);
        Route::apiResource('booking-vats', BookingVatController::class);
        Route::apiResource('hotel-review-categories', HotelReviewCategoryController::class);
        Route::apiResource('room-review-categories', RoomReviewCategoryController::class);
        Route::apiResource('types', RoomTypeController::class)->except(['create', 'edit']);

        /** Hotel Report Route Start */
        Route::get('combine-booking', [ReportController::class, 'combineBooking']);
        Route::get('hotel-booking', [ReportController::class, 'hotelBooking']);
        Route::get('amarlodge-booking', [ReportController::class, 'amarlodgeBooking']);
        Route::get('restaurant-history', [ReportController::class, 'restaurant']);
        /** Hotel Report Route End */

        /** Hotel Api End Here **/

        /** Hotel User Api Start Here **/

        Route::post('/hotel-logout', [RegistrationController::class, 'logout']);
        Route::get('/permissions', [HelperController::class, 'permission']);
        Route::get('/user-permissions/{id}', [HelperController::class, 'userPermission']);

        /** Hotel User Api End Here **/

        /** Restaurant Api Start Here **/
        Route::get('/table-bookings/room-table-info', [TableBookingController::class, 'RoomAndTableInfo']);
        Route::get('/get-item-by-type-category', [RestaurantHelperController::class, 'food_items']);
        Route::get('/orders/other-info', [OrderController::class, 'other']);
        Route::apiResource('food-types', FoodTypeController::class);
        Route::apiResource('food-categories', FoodCategoryController::class);
        Route::apiResource('food-vats', FoodVatController::class);
        Route::apiResource('tables', TableController::class);
        Route::apiResource('items', ItemController::class);
        Route::apiResource('table-bookings', TableBookingController::class);
        Route::apiResource('menus', MenuController::class);
        Route::apiResource('orders', OrderController::class)->except(['update']);
        /** Restaurant Api End Here **/

        /** Parking Api Start Here **/
        Route::apiResource('vehicle-categories', VehicleCategoryController::class);
        Route::apiResource('charges', ChargeController::class);
        Route::apiResource('parkings', ParkingController::class);
        Route::get('parking-charge-type', [ApiHelperController::class, 'charge']);
        Route::get('parking-info', [ApiHelperController::class, 'parkingInfo']);
        /** Parking Api End Here **/

        /** Employee Api Start Here **/
        Route::apiResource('departments', DepartmentController::class);
        Route::apiResource('employees', EmployeeController::class);
        /** Employee Api End Here **/

        /** Hall Management Start Here */
        Route::apiResource('hall-categories', HallCategoryController::class);
        Route::apiResource('halls', HallController::class);
        Route::apiResource('rents', HallRentController::class);
        /** Hall Management End Here */
    }
);
