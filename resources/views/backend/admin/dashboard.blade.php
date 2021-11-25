@extends('backend.layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Content Header (attendance header) -->
                    <div class="box box-teal box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Short Cut Link</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad table-responsive">
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-block btn-success btn-lg"><a
                                                    href="{{ route('admin.booking.index') }}" style="color: white">Single
                                                    Booking</a></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-block btn-success btn-lg"><a
                                                    href="{{ route('admin.booking.create') }}"
                                                    style="color: white">Multiple Booking</a></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-block btn-success btn-lg"><a
                                                    href="{{ route('admin.room-rents.index') }}" style="color: white">Room
                                                    Rents</a></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-block btn-success btn-lg"><a
                                                    href="{{ route('admin.services.index') }}" style="color: white">Hotel
                                                    Facility</a></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-block btn-success btn-lg"><a
                                                    href="{{ route('restaurant.orders.index') }}"
                                                    style="color: white">Restaurant Order</a></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-block btn-success btn-lg"><a
                                                    href="{{ route('restaurant.orders.create') }}"
                                                    style="color: white">New Order</a></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-block btn-success btn-lg"><a
                                                    href="{{ route('admin.room-discounts.index') }}"
                                                    style="color: white">Hotel Discount</a></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-block btn-success btn-lg"><a href="{{ route('admin.booking.index') }}"
                                                    style="color: white">Available Room</a></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.attendance.employee') }}" style="color: #333">
                        <div class="info-box">
                            <span class="info-box-icon bg-teal"><i class="fa fa-clock-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><br></span>
                                <span class="info-box-number">Pay Salary</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-home"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today Booking Amount</span>
                            <span class="info-box-number">{{ $todayBooking }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-home"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Seven Day Booking Amount</span>
                            <span class="info-box-number">{{ $previousSevenDayBooking }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-home"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Month Booking Amount</span>
                            <span class="info-box-number">{{ $lastMonthBooking }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-bookmark-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today Booking By Amarlodge Amount</span>
                            <span class="info-box-number">{{ $todayBookingByAmarlodge }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-bookmark-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Seven Day Booking By Amarlodge Amount</span>
                            <span class="info-box-number">{{ $previousSevenDayBookingByAmarlodge }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-bookmark-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Month Booking By Amarlodge Amount</span>
                            <span class="info-box-number">{{ $lastMonthBookingByAmarlodge }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-first-order"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today Order Amount</span>
                            <span class="info-box-number">{{ $todayOrder }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-first-order"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Seven Day Order Amount</span>
                            <span class="info-box-number">{{ $previousSevenDayOrder }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-first-order"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Seven Day Order Amount</span>
                            <span class="info-box-number">{{ $lastMonthOrder }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-car"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today Parking Amount</span>
                            <span class="info-box-number">{{ $todayParking }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-car"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Seven Day Parking Amount</span>
                            <span class="info-box-number">{{ $previousSevenDayParking }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fa fa-car"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Seven Day Parking Amount</span>
                            <span class="info-box-number">{{ $lastMonthParking }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
