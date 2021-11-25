<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BankTransactionController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\BookingHelperController;
use App\Http\Controllers\Admin\BookingVatController;
use App\Http\Controllers\Admin\CostController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountRoomController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DiscountHotelController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployeeShiftController;
use App\Http\Controllers\Admin\FacilityRoomController;
use App\Http\Controllers\Admin\HotelRuleController;
use App\Http\Controllers\Admin\LoanAdvanceController;
use App\Http\Controllers\Admin\MobileBankController;
use App\Http\Controllers\Admin\MobileTransactionController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewCategoryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomRentController;
use App\Http\Controllers\Admin\RoomReviewCategoryController;
use App\Http\Controllers\Admin\RoomReviewController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\ServiceChargeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin', 'status'], 'as' => 'admin.'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [DashboardController::class, 'update'])->name('profile.update');
    Route::get('service-charge/create', [ServiceChargeController::class, 'create'])->name('serviceCharge.create');
    Route::post('service-charge/store', [ServiceChargeController::class, 'store'])->name('serviceCharge.store');
    Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkouts.store');

    /* Department routes start */
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments');
    Route::post('departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::put('departments/update', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('departments/destroy/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    /* Department routes end */
    /** Loan routes start**/
    Route::get('loan-advance', [LoanAdvanceController::class, 'index'])->name('loan.advance');
    Route::get('loan-advance/create', [LoanAdvanceController::class, 'create'])->name('loan.advance.create');
    Route::post('loan-advance/store', [LoanAdvanceController::class, 'store'])->name('loan.advance.store');
    Route::delete('loan-advance/destroy/{id}', [LoanAdvanceController::class, 'destroy'])->name('loan.advance.destroy');
    /** Loan routes end**/

    /** Attendances routes start**/

    //Route::get('/attendances/view', [AttendanceController::class, 'create'])->name('attendance.view');
    Route::get('attendance/employee', [AttendanceController::class, 'employee'])->name('attendance.employee');
    Route::get('attendance/employee/attend', [AttendanceController::class, 'employee_attend'])->name('attendance.employee-attendance');
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('attendance/update', [AttendanceController::class, 'update'])->name('attendance.update');
    /** Attendances routes end**/
    // booking extra route start 
    Route::get('booking/checkout/{id}', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::post('booking/payment', [BookingHelperController::class, 'payment'])->name('booking.payment');
    Route::post('booking/multiple', [BookingHelperController::class, 'multiple'])->name('booking.multiple');
    Route::put('booking-detail/update/{booking_id}', [BookingHelperController::class, 'detail'])->name('booking-detail.update');
    // booking extra route start 

    // hotel rule route start 
    Route::get('rules', [HotelRuleController::class, 'index'])->name('rules.index');
    Route::put('rules/update/{HotelRule}', [HotelRuleController::class, 'update'])->name('rules.update');
    // hotel rule route start 
    // hotel review route start 
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('reviews/id/{id}/status/{status}', [ReviewController::class, 'status'])->name('reviews.status');
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    // room review route start 
    Route::get('room-reviews', [RoomReviewController::class, 'index'])->name('room-reviews.index');
    Route::get('room-reviews/id/{id}/status/{status}', [RoomReviewController::class, 'status'])->name('room-reviews.status');
    Route::delete('room-reviews/{id}', [RoomReviewController::class, 'destroy'])->name('room-reviews.destroy');

    Route::resource('users', UserController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('room-rents', RoomRentController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('salary', SalaryController::class);
    Route::resource('shifts', ShiftController::class);
    Route::resource('costs', CostController::class)->except(['create', 'show']);
    Route::resource('employee-shifts', EmployeeShiftController::class);
    Route::resource('bank-transactions', BankTransactionController::class);
    Route::resource('mobile-transactions', MobileTransactionController::class);
    Route::resource('hotel-discounts', DiscountHotelController::class);
    Route::resource('booking-vats', BookingVatController::class)->except(['create', 'show', 'edit']);
    Route::resource('banks', BankController::class)->except(['create', 'show', 'edit']);
    Route::resource('mobile-banks', MobileBankController::class)->except(['create', 'show', 'edit']);
    Route::resource('review-categories', ReviewCategoryController::class)->except(['create', 'show', 'edit']);
    Route::resource('room-review-categories', RoomReviewCategoryController::class)->except(['create', 'show', 'edit']);
    Route::resource('room-discounts', DiscountRoomController::class);
    Route::resource('room-facilities', FacilityRoomController::class);
    Route::resource('types', RoomTypeController::class)->except(['create', 'show', 'edit']);
    // report route
    Route::get('booking-reports', [ReportController::class, 'booking'])->name('booking.report');
    Route::get('restaurant-reports', [ReportController::class, 'restaurant'])->name('restaurant.report');
    Route::get('parking-reports', [ReportController::class, 'parking'])->name('parking.report');
});
