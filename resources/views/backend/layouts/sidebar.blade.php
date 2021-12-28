<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset(auth()->user()->photo) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
            </div>
        </div>
        <br>
        <!-- search form -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ __('MAIN NAVIGATION') }}</li>
            <li class="@if (request()->is('admin/dashboard') || request()->is('restaurant/dashboard') || request()->is('parking/dashboard')) {{ 'active' }} @endif">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ __('Dashboard') }}</span>
                </a>
            </li>
            @if (auth()->user()->can('All') ||
    auth()->user()->can('Hotel'))
                <li
                    class="treeview @if (request()->is('admin/profile') ||
    request()->is('admin/booking') ||
    request()->is('admin/booking/*') ||
    request()->is('admin/service-charge/create') ||
    request()->is('admin/services') ||
    request()->is('admin/rooms') ||
    request()->is('admin/rooms/create') ||
    request()->is('admin/rooms/*') ||
    request()->is('admin/room-rents') ||
    request()->is('admin/room-rents/create') ||
    request()->is('admin/room-rents/*') ||
    request()->is('admin/room-rents') ||
    request()->is('admin/room-rents/create') ||
    request()->is('admin/room-rents/*') ||
    request()->is('admin/users') ||
    request()->is('admin/users/create') ||
    request()->is('admin/users/*') ||
    request()->is('admin/hotel-discounts/create') ||
    request()->is('admin/hotel-discounts') ||
    request()->is('admin/hotel-discounts/*') ||
    request()->is('admin/booking-vats') ||
    request()->is('admin/rules') ||
    request()->is('admin/reviews') ||
    request()->is('admin/review-categories') ||
    request()->is('admin/room-reviews') ||
    request()->is('admin/room-review-categories') ||
    request()->is('admin/types') ||
    request()->is('admin/costs') ||
    request()->is('admin/costs/*') ||
    request()->is('admin/room-discounts/create') ||
    request()->is('admin/room-discounts') ||
    request()->is('admin/room-discounts/*') ||
    request()->is('admin/room-facilities/create') ||
    request()->is('admin/room-facilities') ||
    request()->is('admin/room-facilities/*') ||
    request()->is('admin/banks') ||
    request()->is('admin/mobile-banks') ||
    request()->is('admin/bank-transactions') ||
    request()->is('admin/bank-transactions/*') ||
    request()->is('admin/mobile-transactions') ||
    request()->is('admin/mobile-transactions/*')) {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-building"></i> <span>Hotel Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview @if (request()->is('admin/profile') || request()->is('admin/services') || request()->is('admin/rules') || request()->is('admin/costs') || request()->is('admin/costs/*') || request()->is('admin/reviews') || request()->is('admin/review-categories') || request()->is('admin/hotel-discounts') || request()->is('admin/hotel-discounts/*') || request()->is('admin/users') || request()->is('admin/users/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-share"></i> <span>Hotel Info</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (request()->is('admin/profile')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.profile') }}">
                                        <i class="fa fa-unlock-alt"></i> <span>{{ __('Hotel Profile') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->is('admin/services')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.services.index') }}">
                                        <i class="fa fa-wrench"></i> <span>{{ __('Services') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->is('admin/rules')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.rules.index') }}">
                                        <i class="fa fa-rub"></i> <span>{{ __('House Rule') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->is('admin/costs') || request()->is('admin/costs/*')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.costs.index') }}">
                                        <i class="fa fa-money"></i> <span>{{ __('Daily Costs') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->is('admin/reviews')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.reviews.index') }}">
                                        <i class="fa fa-star"></i> <span>{{ __('Hotel Review') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->is('admin/review-categories')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.review-categories.index') }}">
                                        <i class="fa fa-list-alt"></i> <span>{{ __('Hotel Review Category') }}</span>
                                    </a>
                                </li>
                                <li class="treeview @if (request()->is('admin/users') || request()->is('admin/users/*')) {{ 'active' }} @endif">
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                        <span>{{ __('Users') }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/users/create')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.users.create') }}"><i
                                                    class="fa fa-plus"></i>
                                                {{ __('New User') }}</a>
                                        </li>
                                        <li class="@if (request()->is('admin/users')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.users.index') }}"><i class="fa fa-list"></i>
                                                {{ __('Users') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview @if (request()->is('admin/hotel-discounts') || request()->is('admin/hotel-discounts/*')) {{ 'active' }} @endif">
                                    <a href="#"><i class="fa fa-h-square"></i> {{ __('Hotel Discounts') }}
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/hotel-discounts/create')){{ 'active' }} @endif">
                                            <a href="{{ route('admin.hotel-discounts.create') }}"><i
                                                    class="fa fa-plus"></i> {{ __('New Hotel Discount') }}</a>
                                        </li>
                                        <li class="class=" @if (request()->is('admin/hotel-discounts')){{ 'active' }} @endif"">
                                            <a href="{{ route('admin.hotel-discounts.index') }}"><i
                                                    class="fa fa-list"></i> {{ __('Hotel Discounts') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (request()->is('admin/types') || request()->is('admin/room-reviews') || request()->is('admin/room-review-categories') || request()->is('admin/rooms') || request()->is('admin/rooms/*') || request()->is('admin/room-rents') || request()->is('admin/room-rents/*') || request()->is('admin/room-discounts') || request()->is('admin/room-discounts/*') || request()->is('admin/room-facilities') || request()->is('admin/room-facilities/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-share"></i> <span>Room Info</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (request()->is('admin/types')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.types.index') }}">
                                        <i class="fa fa-file-o"></i> <span>{{ __('Room Types') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->is('admin/room-reviews')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.room-reviews.index') }}">
                                        <i class="fa fa-star"></i> <span>{{ __('Room Review') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->is('admin/room-review-categories')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.room-review-categories.index') }}">
                                        <i class="fa fa-list-alt"></i> <span>{{ __('Room Review Category') }}</span>
                                    </a>
                                </li>
                                {{-- <li class="@if (request()->is('admin/packages')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.packages.index') }}">
                                    <i class="fa fa-gift"></i> <span>{{ __('Packages') }}</span>
                                    </a> 
                                </li> --}}
                                <li class="treeview @if (request()->is('admin/rooms') || request()->is('admin/rooms/*')) {{ 'active' }} @endif">
                                    <a href="#">
                                        <i class="fa fa-home"></i>
                                        <span>{{ __('Rooms') }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/rooms/create')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.rooms.create') }}"><i
                                                    class="fa fa-plus"></i>
                                                {{ __('New Room') }}</a>
                                        </li>
                                        <li class="@if (request()->is('admin/rooms')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.rooms.index') }}"><i class="fa fa-list"></i>
                                                {{ __('Rooms') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview @if (request()->is('admin/room-rents') || request()->is('admin/room-rents/*')) {{ 'active' }} @endif">
                                    <a href="#">
                                        <i class="fa fa-home"></i>
                                        <span>{{ __('Room Rents') }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/room-rents/create')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.room-rents.create') }}"><i
                                                    class="fa fa-plus"></i>
                                                {{ __('New Room Rent') }}</a>
                                        </li>
                                        <li class="@if (request()->is('admin/room-rents')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.room-rents.index') }}"><i
                                                    class="fa fa-list"></i>
                                                {{ __('Room Rents') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview @if (request()->is('admin/room-discounts') || request()->is('admin/room-discounts/*')) {{ 'active' }} @endif">
                                    <a href="#"><i class="fa fa-home"></i> {{ __('Room Discounts') }}
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/room-discounts/create')){{ 'active' }} @endif">
                                            <a href="{{ route('admin.room-discounts.create') }}"><i
                                                    class="fa fa-plus"></i> {{ __('New Room Discount') }}</a>
                                        </li>
                                        <li class="class=" @if (request()->is('admin/room-discounts')){{ 'active' }} @endif"">
                                            <a href="{{ route('admin.room-discounts.index') }}"><i
                                                    class="fa fa-list"></i> {{ __('Room Discounts') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview @if (request()->is('admin/room-facilities') || request()->is('admin/room-facilities/*')) {{ 'active' }} @endif">
                                    <a href="#"><i class="fa fa-home"></i> {{ __('Room Facilities') }}
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/room-facilities/create')){{ 'active' }} @endif">
                                            <a href="{{ route('admin.room-facilities.create') }}"><i
                                                    class="fa fa-plus"></i> {{ __('New Room Facility') }}</a>
                                        </li>
                                        <li class="class=" @if (request()->is('admin/room-facilities')){{ 'active' }} @endif"">
                                            <a href="{{ route('admin.room-facilities.index') }}"><i
                                                    class="fa fa-list"></i> {{ __('Room Facilities') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (request()->is('admin/booking') || request()->is('admin/booking/*') || request()->is('admin/service-charge/create') || request()->is('admin/booking-vats')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-share"></i> <span>Booking Info</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview @if (request()->is('admin/booking') || request()->is('admin/booking/*')) {{ 'active' }} @endif">
                                    <a href="#">
                                        <i class="fa fa-home"></i>
                                        <span>{{ __('Booking') }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/booking')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.booking.index') }}"><i
                                                    class="fa fa-list"></i>
                                                {{ __('Single Room Booking') }}</a>
                                        </li>
                                        <li class="@if (request()->is('admin/booking/create')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.booking.create') }}"><i
                                                    class="fa fa-plus"></i>
                                                {{ __('Multiple Room Booking') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="@if (request()->is('admin/service-charge/create')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.serviceCharge.create') }}">
                                        <i class="fa fa-money"></i> <span>{{ __('Service Charge') }}</span>
                                    </a>
                                </li>
                                <li class="@if (request()->is('admin/booking-vats')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.booking-vats.index') }}">
                                        <i class="fa fa-percent"></i> <span>{{ __('Booking Vats') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (request()->is('admin/banks') || request()->is('admin/mobile-banks') || request()->is('admin/bank-transactions') || request()->is('admin/bank-transactions/*') || request()->is('admin/mobile-transactions') || request()->is('admin/mobile-transactions/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-share"></i> <span>Banking Info</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (request()->is('admin/banks')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.banks.index') }}">
                                        <i class="fa fa-bank"></i> <span>{{ __('Bank') }}</span>
                                    </a>
                                </li>
                                <li class="treeview @if (request()->is('admin/bank-transactions') || request()->is('admin/bank-transactions/*')) {{ 'active' }} @endif">
                                    <a href="#">
                                        <i class="fa fa-exchange"></i>
                                        <span>{{ __('Bank Transactions') }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/bank-transactions')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.bank-transactions.create') }}"><i
                                                    class="fa fa-plus"></i>
                                                {{ __('New Bank Transactions') }}</a>
                                        </li>
                                        <li class="@if (request()->is('admin/bank-transactions/create')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.bank-transactions.index') }}"><i
                                                    class="fa fa-list"></i>
                                                {{ __('Bank Transactions') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="@if (request()->is('admin/mobile-banks')) {{ 'active' }} @endif">
                                    <a href="{{ route('admin.mobile-banks.index') }}">
                                        <i class="fa fa-mobile"></i> <span>{{ __('Mobile Banks') }}</span>
                                    </a>
                                </li>
                                <li class="treeview @if (request()->is('admin/mobile-transactions') || request()->is('admin/mobile-transactions/*')) {{ 'active' }} @endif">
                                    <a href="#">
                                        <i class="fa fa-exchange"></i>
                                        <span>{{ __('Mobile Transactions') }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="@if (request()->is('admin/mobile-transactions')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.mobile-transactions.create') }}"><i
                                                    class="fa fa-plus"></i>
                                                {{ __('New Mobile Transactions') }}</a>
                                        </li>
                                        <li class="@if (request()->is('admin/mobile-transactions/create')) {{ 'active' }} @endif">
                                            <a href="{{ route('admin.mobile-transactions.index') }}"><i
                                                    class="fa fa-list"></i>
                                                {{ __('Mobile Transactions') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('All') ||
    auth()->user()->can('Restaurant'))
                <li class="treeview @if (Request::path() === 'restaurant/orders/create' || Request::path() === 'restaurant/orders' || request()->is('restaurant/orders/*') || Request::path() === 'restaurant/types/*' || Request::path() === 'restaurant/types' || Request::path() === 'restaurant/categories/*' || Request::path() === 'restaurant/categories' || Request::path() === 'restaurant/vats/*' || Request::path() === 'restaurant/vats' || Request::path() === 'restaurant/items/create' || Request::path() === 'restaurant/items' || request()->is('restaurant/items/*/edit') || Request::path() === 'restaurant/menus/create' || Request::path() === 'restaurant/menus' || request()->is('restaurant/menus/*') || Request::path() === 'restaurant/tables/*' || Request::path() === 'restaurant/tables' || Request::path() === 'restaurant/bookings/create' || Request::path() === 'restaurant/bookings' || request()->is('restaurant/bookings/*') || request()->is('restaurant/costs') || request()->is('restaurant/costs/*')) {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-cutlery"></i> <span>Restaurant Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview @if (Request::path() === 'restaurant/orders/create' || Request::path() === 'restaurant/orders') {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-first-order"></i> <span>Orders</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'restaurant/orders/create') {{ 'active' }} @endif"><a
                                        href="{{ route('restaurant.orders.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Order</a>
                                </li>
                                <li class="@if (Request::path() === 'restaurant/orders') {{ 'active' }} @endif"><a
                                        href="{{ route('restaurant.orders.index') }}"><i
                                            class="fa fa-list"></i>
                                        View Orders</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@if (request()->is('restaurant/costs') || request()->is('restaurant/costs/*')) {{ 'active' }} @endif">
                            <a href="{{ route('restaurant.costs.index') }}">
                                <i class="fa fa-money"></i> <span>{{ __('Daily Costs') }}</span>
                            </a>
                        </li>
                        <li class="@if (Request::path() === 'restaurant/types/*' || Request::path() === 'restaurant/types') {{ 'active' }} @endif">
                            <a href="{{ route('restaurant.types') }}">
                                <i class="fa fa-list"></i> <span>Food Types</span>
                            </a>
                        </li>
                        <li class="@if (Request::path() === 'restaurant/categories/*' || Request::path() === 'restaurant/categories') {{ 'active' }} @endif">
                            <a href="{{ route('restaurant.categories') }}">
                                <i class="fa fa-list"></i> <span>Food Categories</span>
                            </a>
                        </li>
                        <li class="@if (Request::path() === 'restaurant/vats/*' || Request::path() === 'restaurant/vats') {{ 'active' }} @endif">
                            <a href="{{ route('restaurant.vats') }}">
                                <i class="fa fa-money"></i> <span>Food Vat</span>
                            </a>
                        </li>
                        <li class="treeview @if (Request::path() === 'restaurant/items/create' || Request::path() === 'restaurant/items' || request()->is('restaurant/items/*/edit')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-list-alt"></i> <span>Items</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'restaurant/items/create') {{ 'active' }} @endif"><a
                                        href="{{ route('restaurant.items.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Items</a>
                                </li>
                                <li class="@if (Request::path() === 'restaurant/items') {{ 'active' }} @endif"><a
                                        href="{{ route('restaurant.items.index') }}"><i class="fa fa-list"></i>
                                        View Items</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (Request::path() === 'restaurant/menus/create' || Request::path() === 'restaurant/menus' || request()->is('restaurant/menus/*/edit')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-minus-square"></i> <span>Menus</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'restaurant/menus/create') {{ 'active' }} @endif"><a
                                        href="{{ route('restaurant.menus.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Menus</a>
                                </li>
                                <li class="@if (Request::path() === 'restaurant/menus') {{ 'active' }} @endif"><a
                                        href="{{ route('restaurant.menus.index') }}"><i class="fa fa-list"></i>
                                        View Menus</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@if (Request::path() === 'restaurant/tables/*' || Request::path() === 'restaurant/tables') {{ 'active' }} @endif">
                            <a href="{{ route('restaurant.tables') }}">
                                <i class="fa fa-table"></i> <span>Table</span>
                            </a>
                        </li>
                        <li class="treeview @if (Request::path() === 'restaurant/bookings/create' || Request::path() === 'restaurant/bookings' || request()->is('restaurant/bookings/*/edit')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Bookings</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'restaurant/bookings/create') {{ 'active' }} @endif"><a
                                        href="{{ route('restaurant.bookings.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Booking</a>
                                </li>
                                <li class="@if (Request::path() === 'restaurant/bookings') {{ 'active' }} @endif"><a
                                        href="{{ route('restaurant.bookings.index') }}"><i
                                            class="fa fa-list"></i>
                                        View Booking</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('All') ||
    auth()->user()->can('Employee'))
                <li class="treeview @if (Request::path() === 'admin/departments' || Request::path() === 'admin/salary/create' || Request::path() === 'admin/salary' || request()->is('admin/salary/*/edit') || Request::path() === 'admin/employees/create' || Request::path() === 'admin/employees' || request()->is('admin/employees/*/edit') || Request::path() === 'admin/loan-advance/create' || Request::path() === 'admin/loan-advance' || Request::path() === 'admin/attendance/create' || Request::path() === 'admin/attendance' || Request::path() === 'admin/employee-shifts/create' || Request::path() === 'admin/employee-shifts' || request()->is('admin/employee-shifts/*/edit') || Request::path() === 'admin/shifts') {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-share"></i> <span>Employee Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@if (Request::path() === 'admin/departments') {{ 'active' }} @endif"><a href="{{ route('admin.departments') }}"><i
                                    class="fa fa-building"></i> Departments</a></li>
                        <li class="@if (Request::path() === 'admin/shifts') {{ 'active' }} @endif"><a href="{{ route('admin.shifts.index') }}"><i
                                    class="fa fa-shirtsinbulk"></i> Shifts</a></li>
                        <li class="treeview @if (Request::path() === 'admin/employee-shifts/create' || Request::path() === 'admin/employee-shifts' || request()->is('admin/employee-shifts/*/edit')) {{ 'active' }} @endif">
                            <a href="#"><i class="fa fa-shirtsinbulk"></i> Employee Shifts
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'admin/employee-shifts/create') {{ 'active' }} @endif"><a
                                        href="{{ route('admin.employee-shifts.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Employee Shift</a>
                                </li>
                                <li class="@if (Request::path() === 'admin/employee-shifts') {{ 'active' }} @endif"><a
                                        href="{{ route('admin.employee-shifts.index') }}"><i
                                            class="fa fa-list"></i>
                                        View Employee Shift</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (Request::path() === 'admin/employees/create' || Request::path() === 'admin/employees' || request()->is('admin/employees/*/edit')) {{ 'active' }} @endif">
                            <a href="#"><i class="fa fa-users"></i> Employees
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'admin/employees/create') {{ 'active' }} @endif"><a
                                        href="{{ route('admin.employees.create') }}"><i class="fa fa-plus"></i>
                                        New
                                        Employee</a>
                                </li>
                                <li class="@if (Request::path() === 'admin/employees') {{ 'active' }} @endif"><a
                                        href="{{ route('admin.employees.index') }}"><i class="fa fa-list"></i>
                                        View
                                        Employee</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@if (Request::path() === 'admin/salary/create' || Request::path() === 'admin/salary' || request()->is('admin/salary/*/edit')) {{ 'active' }} @endif">
                            <a href="{{ route('admin.salary.index') }}">
                                <i class="fa fa-money"></i> <span>Salary Payment</span>
                            </a>
                        </li>
                        <li class="treeview @if (Request::path() === 'admin/loan-advance/create' || Request::path() === 'admin/loan-advance') ) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-money"></i> <span>Loan or advances</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'admin/loan-advance/create') {{ 'active' }} @endif"><a
                                        href="{{ route('admin.loan.advance.create') }}"><i
                                            class="fa fa-plus"></i>
                                        Add loan
                                        or advance</a>
                                </li>
                                <li class="@if (Request::path() === 'admin/loan-advance') {{ 'active' }} @endif"><a
                                        href="{{ route('admin.loan.advance') }}"><i class="fa fa-list"></i>
                                        View loan or
                                        advance</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (Request::path() === 'admin/attendance/create' || Request::path() === 'admin/attendance') {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-clock-o"></i> <span>Attendance</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'admin/attendance/create') {{ 'active' }} @endif"><a
                                        href="{{ route('admin.attendance.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New
                                        attendance</a>
                                </li>
                                <li class="@if (Request::path() === 'admin/attendance') {{ 'active' }} @endif"><a href="{{ route('admin.attendance') }}"><i
                                            class="fa fa-list"></i>
                                        View
                                        attendance</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('All') ||
    auth()->user()->can('Report'))
                <li class="treeview @if (Request::path() === 'admin/booking-reports' || Request::path() === 'admin/restaurant-reports' || Request::path() === 'admin/parking-reports') {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-file"></i> <span>Report</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@if (Request::path() === 'admin/booking-reports') {{ 'active' }} @endif"><a href="{{ route('admin.booking.report') }}"><i
                                    class="fa fa-list"></i> Booking Report
                            </a>
                        </li>
                        <li class="@if (Request::path() === 'admin/restaurant-reports') {{ 'active' }} @endif"><a href="{{ route('admin.restaurant.report') }}"><i
                                    class="fa fa-list"></i> Restaurant Report
                            </a>
                        </li>
                        <li class="@if (Request::path() === 'admin/parking-reports') {{ 'active' }} @endif"><a href="{{ route('admin.parking.report') }}"><i
                                    class="fa fa-list"></i> Parking Report
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('All') || auth()->user()->can('Parking'))
                <li class="treeview @if (Request::path() === 'parking/parkings/create' || Request::path() === 'parking/parkings' || request()->is('parking/parkings/*') || Request::path() === 'parking/charges/*' || Request::path() === 'parking/charges' || request()->is('parking/costs') || request()->is('parking/costs/*') || request()->is('parking/categories')) {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-car"></i> <span>Parking Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@if (request()->is('parking/categories')) {{ 'active' }} @endif">
                            <a href="{{ route('parking.categories.index') }}">
                                <i class="fa fa-list"></i> <span>{{ __('Vehicle Categories') }}</span>
                            </a>
                        </li>
                        <li class="@if (request()->is('parking/costs') || request()->is('parking/costs/*')) {{ 'active' }} @endif">
                            <a href="{{ route('parking.costs.index') }}">
                                <i class="fa fa-money"></i> <span>{{ __('Daily Costs') }}</span>
                            </a>
                        </li>
                        <li class="@if (Request::path() === 'parking/charges/*' || Request::path() === 'parking/charges') {{ 'active' }} @endif">
                            <a href="{{ route('parking.charges.index') }}">
                                <i class="fa fa-money"></i> <span>Parking Charge</span>
                            </a>
                        </li>
                        <li class="treeview @if (Request::path() === 'parking/parkings/create' || Request::path() === 'parking/parkings' || request()->is('parking/parkings/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-car"></i> <span>Parkings</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'parking/parkings/create') {{ 'active' }} @endif"><a
                                        href="{{ route('parking.parkings.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Booking</a>
                                </li>
                                <li class="@if (Request::path() === 'parking/parkings') {{ 'active' }} @endif"><a
                                        href="{{ route('parking.parkings.index') }}"><i class="fa fa-list"></i>
                                        View Booking</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('All') ||
    auth()->user()->can('Hall'))
                <li class="treeview @if (request()->is('hall/costs') || request()->is('hall/costs/*') || request()->is('hall/categories') || Request::path() === 'hall/halls' || request()->is('hall/halls/*') || Request::path() === 'hall/rents' || request()->is('hall/rents/*') || Request::path() === 'hall/bookings' || request()->is('hall/bookings/*')) {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-university"></i> <span>Hall Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="treeview @if (Request::path() === 'hall/bookings' || request()->is('hall/bookings/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-university"></i> <span>Hall Booking</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'hall/bookings/create') {{ 'active' }} @endif"><a
                                        href="{{ route('hall.bookings.create') }}"><i class="fa fa-plus"></i>
                                        New Hall Booking</a>
                                </li>
                                <li class="@if (Request::path() === 'hall/bookings') {{ 'active' }} @endif"><a
                                        href="{{ route('hall.bookings.index') }}"><i class="fa fa-list"></i>
                                        View Hall Booking</a>
                                </li>
                            </ul>
                        </li>

                        <li class="@if (request()->is('hall/categories')) {{ 'active' }} @endif">
                            <a href="{{ route('hall.categories.index') }}">
                                <i class="fa fa-list"></i> <span>{{ __('Hall Categories') }}</span>
                            </a>
                        </li>
                        <li class="@if (request()->is('hall/costs') || request()->is('hall/costs/*')) {{ 'active' }} @endif">
                            <a href="{{ route('hall.costs.index') }}">
                                <i class="fa fa-money"></i> <span>{{ __('Daily Costs') }}</span>
                            </a>
                        </li>

                        <li class="treeview @if (Request::path() === 'hall/halls' || request()->is('hall/halls/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-university"></i> <span>Hall</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'hall/halls/create') {{ 'active' }} @endif"><a href="{{ route('hall.halls.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Hall</a>
                                </li>
                                <li class="@if (Request::path() === 'hall/halls') {{ 'active' }} @endif"><a href="{{ route('hall.halls.index') }}"><i
                                            class="fa fa-list"></i>
                                        View Hall</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (Request::path() === 'hall/rents' || request()->is('hall/rents/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-money"></i> <span>Hall Rent</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'hall/rents/create') {{ 'active' }} @endif"><a
                                        href="{{ route('hall.rents.create') }}"><i class="fa fa-plus"></i>
                                        New Hall Rent</a>
                                </li>
                                <li class="@if (Request::path() === 'hall/rents') {{ 'active' }} @endif"><a href="{{ route('hall.rents.index') }}"><i
                                            class="fa fa-list"></i>
                                        View Hall Rent</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('All') ||
    auth()->user()->can('Gym'))
                <li class="treeview @if (Request::path() === 'gym/gyms' || request()->is('gym/gyms/*') || Request::path() === 'gym/charges' || request()->is('gym/charges/*') || Request::path() === 'gym/users' || request()->is('gym/users/*')) {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-university"></i> <span>Gym Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="treeview @if (Request::path() === 'gym/gyms' || request()->is('gym/gyms/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-university"></i> <span>Gym</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'gym/gyms/create') {{ 'active' }} @endif"><a href="{{ route('gym.gyms.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Gym</a>
                                </li>
                                <li class="@if (Request::path() === 'gym/gyms') {{ 'active' }} @endif"><a href="{{ route('gym.gyms.index') }}"><i
                                            class="fa fa-list"></i>
                                        View Gym</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (Request::path() === 'gym/charges' || request()->is('gym/charges/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-money"></i> <span>Gym Charge</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'gym/charges/create') {{ 'active' }} @endif"><a
                                        href="{{ route('gym.charges.create') }}"><i class="fa fa-plus"></i>
                                        New Gym Charge</a>
                                </li>
                                <li class="@if (Request::path() === 'gym/charges') {{ 'active' }} @endif"><a
                                        href="{{ route('gym.charges.index') }}"><i class="fa fa-list"></i>
                                        View Gym Charge</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (Request::path() === 'gym/users' || request()->is('gym/users/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-user-circle"></i> <span>Gym User</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'gym/users/create') {{ 'active' }} @endif"><a href="{{ route('gym.users.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Gym User</a>
                                </li>
                                <li class="@if (Request::path() === 'gym/users') {{ 'active' }} @endif"><a href="{{ route('gym.users.index') }}"><i
                                            class="fa fa-list"></i>
                                        View Gym User</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('All') ||
    auth()->user()->can('Tour'))
                <li class="treeview @if (Request::path() === 'tour/tours' || request()->is('tour/tours/*') || Request::path() === 'tour/charges' || request()->is('tour/charges/*') || Request::path() === 'tour/guides' || request()->is('tour/guides/*') || request()->is('tour/packages')) {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-globe"></i> <span>Tour Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="treeview @if (Request::path() === 'tour/tours' || request()->is('tour/tours/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-globe"></i> <span>Tour</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'tour/tours/create') {{ 'active' }} @endif"><a
                                        href="{{ route('tour.tours.create') }}"><i class="fa fa-plus"></i>
                                        New Tour</a>
                                </li>
                                <li class="@if (Request::path() === 'tour/tours') {{ 'active' }} @endif"><a href="{{ route('tour.tours.index') }}"><i
                                            class="fa fa-list"></i>
                                        View Tour</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@if (request()->is('tour/packages')) {{ 'active' }} @endif">
                            <a href="{{ route('tour.packages.index') }}">
                                <i class="fa fa-money"></i> <span>{{ __('Tour Package') }}</span>
                            </a>
                        </li>
                        <li class="treeview @if (Request::path() === 'tour/charges' || request()->is('tour/charges/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-money"></i> <span>Tour Guide Charge</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'tour/charges/create') {{ 'active' }} @endif"><a
                                        href="{{ route('tour.charges.create') }}"><i class="fa fa-plus"></i>
                                        New Tour Guide Charge</a>
                                </li>
                                <li class="@if (Request::path() === 'tour/charges') {{ 'active' }} @endif"><a
                                        href="{{ route('tour.charges.index') }}"><i class="fa fa-list"></i>
                                        View Tour Guide Charge</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (Request::path() === 'tour/guides' || request()->is('tour/guides/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-user-circle"></i> <span>Tour Guide</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'tour/guides/create') {{ 'active' }} @endif"><a
                                        href="{{ route('tour.guides.create') }}"><i class="fa fa-plus"></i>
                                        New Tour Guide</a>
                                </li>
                                <li class="@if (Request::path() === 'tour/guides') {{ 'active' }} @endif"><a
                                        href="{{ route('tour.guides.index') }}"><i class="fa fa-list"></i>
                                        View Tour Guide</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('All') || auth()->user()->can('Laundry'))
                <li class="treeview @if (request()->is('laundry/costs') || request()->is('laundry/costs/*') || request()->is('laundry/products') || Request::path() === 'laundry/charges' || request()->is('laundry/charges/*') || Request::path() === 'laundry/services' || request()->is('laundry/services/*')) {{ 'active' }} @endif">
                    <a href="#">
                        <i class="fa fa-shirtsinbulk"></i> <span>Laundry Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="@if (request()->is('laundry/costs') || request()->is('laundry/costs/*')) {{ 'active' }} @endif">
                            <a href="{{ route('laundry.costs.index') }}">
                                <i class="fa fa-money"></i> <span>{{ __('Daily Costs') }}</span>
                            </a>
                        </li>

                        <li class="@if (request()->is('laundry/products')) {{ 'active' }} @endif">
                            <a href="{{ route('laundry.products.index') }}">
                                <i class="fa fa-product-hunt"></i> <span>{{ __('Product') }}</span>
                            </a>
                        </li>

                        <li class="treeview @if (Request::path() === 'laundry/charges' || request()->is('laundry/charges/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-money"></i> <span>Laundry Charge</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'laundry/charges/create') {{ 'active' }} @endif"><a
                                        href="{{ route('laundry.charges.create') }}"><i class="fa fa-plus"></i>
                                        New Laundry Charge</a>
                                </li>
                                <li class="@if (Request::path() === 'laundry/charges') {{ 'active' }} @endif"><a
                                        href="{{ route('laundry.charges.index') }}"><i class="fa fa-list"></i>
                                        View Laundry Charge</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if (Request::path() === 'laundry/services' || request()->is('laundry/services/*')) {{ 'active' }} @endif">
                            <a href="#">
                                <i class="fa fa-shirtsinbulk"></i> <span>Laundry Service</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if (Request::path() === 'laundry/services/create') {{ 'active' }} @endif"><a
                                        href="{{ route('laundry.services.create') }}"><i
                                            class="fa fa-plus"></i>
                                        New Laundry service</a>
                                </li>
                                <li class="@if (Request::path() === 'laundry/services') {{ 'active' }} @endif"><a
                                        href="{{ route('laundry.services.index') }}"><i class="fa fa-list"></i>
                                        View Laundry service</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
