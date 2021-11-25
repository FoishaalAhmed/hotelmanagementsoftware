@extends('backend.layouts.app')
@section('title', 'Room Booking')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-9" style="background: white;">
                    @include('includes.error')
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab">Booking Info</a></li>
                            <li><a href="#detail" data-toggle="tab">Booking Detail Info</a></li>
                            <li><a href="#payment" data-toggle="tab">Payments</a></li>
                            <li><a href="#service" data-toggle="tab">Service</a></li>
                            <li><a href="#parking" data-toggle="tab">Parking</a></li>
                            <li><a href="#restaurant" data-toggle="tab">Restaurant</a></li>
                            <li><a href="#checkout" data-toggle="tab">Checkout</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <div class="col-md-9">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputName">Name</label>
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="Name" name="name" required="" autocomplete="off"
                                                        value="{{ $booking->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputPhone">Phone</label>
                                                    <input type="text" class="form-control" id="inputPhone"
                                                        placeholder="Phone" name="phone" required="" autocomplete="off"
                                                        value="{{ $booking->phone }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputEmail">Email</label>
                                                    <input type="email" class="form-control" id="inputEmail"
                                                        placeholder="E-mail" name="email" autocomplete="off"
                                                        value="{{ $booking->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputNIDNumber">NID Number</label>
                                                    <input type="text" class="form-control" id="inputNIDNumber"
                                                        placeholder="NID Number" name="nid_number" autocomplete="off"
                                                        value="{{ $booking->nid_number }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Check in</label>
                                                    <input type="text" class="form-control" id="inputCheckIn"
                                                        placeholder="Check Out" name="check_in" autocomplete="off"
                                                        value="{{ date('d-m-Y', strtotime($booking->check_in)) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Checkin Time</label>
                                                    <input type="text" class="form-control" id="inputCheck"
                                                        placeholder="Check Out" name="checkin_time" autocomplete="off"
                                                        value="{{ date('h:i A', strtotime($booking->checkin_time)) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Check Out</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Check Out" name="check_out" autocomplete="off"
                                                        value="{{ date('d-m-Y', strtotime($booking->check_out)) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Checkout Time</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Check Out" name="checkout_time" autocomplete="off"
                                                        value=" @if ($booking->checkout_time != null) {{ date('h:i A', strtotime($booking->checkout_time)) }} @endif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Total Room</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Check Out" name="room" autocomplete="off"
                                                        value="{{ $booking->room }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Adult</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Adult" name="adult" autocomplete="off"
                                                        value="{{ $booking->adult }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Children</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Children" name="children" autocomplete="off"
                                                        value="{{ $booking->children }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Rent</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Rent" name="rent" autocomplete="off"
                                                        value="{{ $booking->rent }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Vat Percentage</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Vat Percentage" name="vat" autocomplete="off"
                                                        value="{{ $booking->vat }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Vat Amount</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Vat Amount" name="vat_amount" autocomplete="off"
                                                        value="{{ $booking->vat_amount }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Subtotal</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Subtotal" name="subtotal" autocomplete="off"
                                                        value="{{ $booking->subtotal }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Discount</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Discount" name="discount" autocomplete="off"
                                                        value="{{ $booking->discount }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Total</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Total" name="total" autocomplete="off"
                                                        value="{{ $booking->total }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Profile Image -->
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                Picture
                                            </div>
                                            <div class="box-body box-profile">
                                                <img class="profile-user-img img-responsive img-circle"
                                                    src="{{ asset($booking->photo) }}" alt="User profile picture"
                                                    style="width: 112px; height: 112px;" id="user_photo">
                                                <input type="file" name="photo" onchange="readPicture(this);">
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="detail">
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    @foreach ($bookingDetails as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="inputName">Room</label>
                                                        <input type="text" class="form-control" id="inputName"
                                                            placeholder="Room" name="room[]" required="" autocomplete="off"
                                                            value="{{ $item->number }}">
                                                        <input type="hidden" name="room_id[]"
                                                            value="{{ $item->room_id }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="inputName">Person</label>
                                                        <input type="text" class="form-control" id="inputName"
                                                            placeholder="Person" name="person[]" required=""
                                                            autocomplete="off" value="{{ $item->person }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="inputPhone">Names</label>
                                                        <input type="text" class="form-control" id="inputPhone"
                                                            placeholder="Names" name="name[]" required="" autocomplete="off"
                                                            value="{{ $item->name }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="inputCheckOut">Check in</label>
                                                        <input type="text" class="form-control" id="check_in"
                                                            placeholder="Check Out" name="check_in[]" autocomplete="off"
                                                            value="{{ date('d-m-Y', strtotime($item->check_in)) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="inputCheckOut">Check Out</label>
                                                        <input type="text" class="form-control" id="check_out"
                                                            placeholder="Check Out" name="check_out[]" autocomplete="off"
                                                            value="{{ date('d-m-Y', strtotime($item->check_out)) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="payment">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%;">{{ __('Sl.') }}</th>
                                                <th style="width: 20%;">{{ __('Date') }}</th>
                                                <th style="width: 20%;">{{ __('Method') }}</th>
                                                <th style="width: 20%;">{{ __('Bank') }}</th>
                                                <th style="width: 20%;">{{ __('Number') }}</th>
                                                <th style="width: 10%;">{{ __('Amount') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $totalBank = 0;
                                                $totalCash = 0;
                                                $totalMfs = 0;
                                            @endphp
                                            @foreach ($bankPayments as $key => $payment)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ date('d M, Y', strtotime($payment->date)) }}</td>
                                                    <td>{{ 'Bank' }}</td>
                                                    <td>{{ $payment->bank }}</td>
                                                    <td></td>
                                                    <td>{{ $payment->amount }} @php
                                                        $totalBank += $payment->amount;
                                                    @endphp </td>
                                                </tr>
                                            @endforeach
                                            @foreach ($cashPayments as $key => $payment)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ date('d M, Y', strtotime($payment->date)) }}</td>
                                                    <td>{{ 'Cash' }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ $payment->paid }} @php
                                                        $totalCash += $payment->paid;
                                                    @endphp</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($mobilePayments as $key => $payment)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ date('d M, Y', strtotime($payment->date)) }}</td>
                                                    <td>{{ 'MFS' }}</td>
                                                    <td></td>
                                                    <td>{{ $payment->mobile_number }}</td>
                                                    <td>{{ $payment->amount }} @php
                                                        $totalMfs += $payment->amount;
                                                    @endphp</td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="service">
                                <table id="example4" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">{{ __('Sl.') }}</th>
                                            <th style="width: 15%;">{{ __('Date') }}</th>
                                            <th style="width: 55%;">{{ __('Service') }}</th>
                                            <th style="width: 10%;">{{ __('Charge') }}</th>
                                            <th style="width: 10%;">{{ __('Paid') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $total_charge = 0;
                                            $total_paid = 0;
                                        @endphp
                                        @foreach ($services as $key => $service)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d M, Y', strtotime($service->date)) }}</td>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->charge }} @php
                                                    $total_charge += $service->charge;
                                                @endphp</td>
                                                <td>{{ $service->paid }} @php
                                                    $total_paid += $service->paid;
                                                @endphp</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="parking">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">{{ __('Sl.') }}</th>
                                            <th style="width: 10%;">{{ __('Date') }}</th>
                                            <th style="width: 15%;">{{ __('Category') }}</th>
                                            <th style="width: 10%;">{{ __('Room') }}</th>
                                            <th style="width: 10%;">{{ __('Ticket') }}</th>
                                            <th style="width: 10%;">{{ __('In') }}</th>
                                            <th style="width: 10%;">{{ __('Out') }}</th>
                                            <th style="width: 10%;">{{ __('Charge') }}</th>
                                            <th style="width: 10%;">{{ __('Paid') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $parking_charge = 0;
                                            $parking_paid = 0;
                                        @endphp
                                        @foreach ($parkings as $key => $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d M, Y', strtotime($item->created_at)) }} </td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{ $item->ticket }}</td>
                                                <td>{{ date('h:i A', strtotime($item->in_time)) }}</td>
                                                <td>{{ date('h:i A', strtotime($item->out_time)) }}</td>
                                                <td>{{ $item->charge }} @php
                                                    $parking_charge += $item->charge;
                                                @endphp</td>
                                                <td>{{ $item->paid }} @php
                                                    $parking_paid += $item->paid;
                                                @endphp</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="restaurant">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">{{ __('Sl.') }}</th>
                                            <th style="width: 20%;">{{ __('Date & Time') }}</th>
                                            <th style="width: 15%;">{{ __('Invoice') }}</th>
                                            <th style="width: 15%;">{{ __('Room') }}</th>
                                            <th style="width: 10%;">{{ __('Table') }}</th>
                                            <th style="width: 15%;">{{ __('Total') }}</th>
                                            <th style="width: 15%;">{{ __('Paid') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $order_charge = 0;
                                            $order_paid = 0;
                                        @endphp
                                        @foreach ($orders as $key => $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d M, Y', strtotime($item->date)) }}
                                                    {{ date('h:i A', strtotime($item->time)) }}</td>
                                                <td>{{ $item->invoice }}</td>
                                                <td>{{ $item->room }}</td>
                                                <td>{{ $item->table }}</td>
                                                <td>{{ $item->total }} @php
                                                    $order_charge += $item->total;
                                                @endphp</td>
                                                <td>{{ $item->paid }} @php
                                                    $order_paid += $item->paid;
                                                @endphp</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="checkout">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <form action="{{ route('admin.booking.payment') }}" class="form-horizontal"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Payment Method</label>
                                                    <select name="payment_method" id="method" class="form-control select2"
                                                        style="width: 100%" onchange="showHidePayment()">
                                                        <option value="">{{ __('Select Method') }}</option>
                                                        <option value="Cash" @if (old('payment_method') == 'Cash') {{ 'selected' }} @endif>
                                                            {{ __('Cash') }}</option>
                                                        <option value="Bank" @if (old('payment_method') == 'Bank') {{ 'selected' }} @endif>
                                                            {{ __('Bank') }}</option>
                                                        <option value="MFS" @if (old('payment_method') == 'MFS') {{ 'selected' }} @endif>
                                                            {{ __('MFS') }}</option>
                                                    </select>

                                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                    <input type="hidden" name="invoice" value="{{ $booking->invoice }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="bank" style="display: @if (old('method') != 'Bank') {{ 'none' }} @endif">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">Payment Type</label>
                                                        <select name="bank_payment_type" id="type"
                                                            class="form-control select2" style="width: 100%"
                                                            onchange="showHidePaymentOption()">
                                                            <option value="">{{ __('Select Type') }}</option>
                                                            <option value="Card" @if (old('bank_payment_type') == 'Card') {{ 'selected' }} @endif>
                                                                {{ __('Debit/Credit Card') }}</option>
                                                            <option value="Cheque" @if (old('bank_payment_type') == 'Cheque') {{ 'selected' }} @endif>
                                                                {{ __('Cheque') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">Bank Name</label>
                                                        <input type="text" name="bank" class="form-control"
                                                            placeholder="Bank Name" value="<?php echo old('bank'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="card" style="display: @if (old('bank_payment_type') != 'Card') {{ 'none' }} @endif">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label for="">Card Number</label>
                                                            <input type="text" name="card_number" class="form-control"
                                                                placeholder="Card Number" value="<?php echo old('card_number'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="cheque" style="display: @if (old('bank_payment_type') != 'Cheque') {{ 'none' }} @endif">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label for="">Cheque Number</label>
                                                            <input type="text" name="cheque_number" class="form-control"
                                                                placeholder="Cheque Number" value="<?php echo old('cheque_number'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label for="">Date of Cheque</label>
                                                            <input type="text" name="cheque_date" class="form-control"
                                                                placeholder="Date of Cheque" value="<?php echo old('cheque_date'); ?>"
                                                                id="cheque_date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="MFS" style="display: @if (old('method') != 'MFS') {{ 'none' }} @endif">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">Payment Type</label>
                                                        <select name="mfs_payment_type" id="mfs_type"
                                                            class="form-control select2" style="width: 100%">
                                                            <option value="bKash" @if (old('mfs_payment_type') == 'bKash') {{ 'selected' }} @endif>
                                                                {{ __('bKash') }}</option>
                                                            <option value="Rocket" @if (old('mfs_payment_type') == 'Rocket') {{ 'selected' }} @endif>
                                                                {{ __('Rocket') }}</option>
                                                            <option value="Nagad" @if (old('mfs_payment_type') == 'Nagad') {{ 'selected' }} @endif>
                                                                {{ __('Nagad') }}</option>
                                                            <option value="SureCash" @if (old('mfs_payment_type') == 'SureCash') {{ 'selected' }} @endif>
                                                                {{ __('SureCash') }}</option>
                                                            <option value="MyCash" @if (old('mfs_payment_type') == 'MyCash') {{ 'selected' }} @endif>
                                                                {{ __('MyCash') }}</option>
                                                            <option value="mCash" @if (old('mfs_payment_type') == 'mCash') {{ 'selected' }} @endif>
                                                                {{ __('mCash') }}</option>
                                                            <option value="UCash" @if (old('mfs_payment_type') == 'UCash') {{ 'selected' }} @endif>
                                                                {{ __('UCash') }}</option>
                                                            <option value="Others" @if (old('mfs_payment_type') == 'Others') {{ 'selected' }} @endif>
                                                                {{ __('Others') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">Mobile Number</label>
                                                        <input type="text" name="mobile_number" class="form-control"
                                                            id="mobile_number" placeholder="Mobile Number"
                                                            value="<?php echo old('mobile_number'); ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">TrxnID</label>
                                                        <input type="text" name="transaction_id" class="form-control"
                                                            id="TrxnID " placeholder="TrxnID" value="<?php echo old('TrxnID '); ?>"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Total Bill</label>
                                                    <input type="text" name="bill" class="form-control" id="bill"
                                                        placeholder="Total Bill"
                                                        value="{{ $booking->total + $total_charge + $parking_charge + $order_charge }}"
                                                        required="" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Total Paid</label>
                                                    <input type="text" name="total_paid" class="form-control"
                                                        id="total_paid" placeholder="Total Paid"
                                                        value="{{ $totalBank + $totalCash + $totalMfs + $total_paid + $parking_paid + $order_paid }}"
                                                        required="" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Due</label>
                                                    <input type="text" name="due" class="form-control" id="due"
                                                        placeholder="Due"
                                                        value="{{ $booking->total + $total_charge + $parking_charge + $order_charge - $totalBank - $totalCash - $totalMfs - $total_paid - $parking_paid - $order_paid }}"
                                                        required="" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Paid</label>
                                                    <input type="text" name="paid" class="form-control" id="paid"
                                                        placeholder="Paid" value="{{ old('paid') }}" required=""
                                                        autocomplete="off">
                                                    <input type="hidden" name="checkout" value="yes">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <center>
                                                    <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
@endsection
@section('footer')

    <script>
        $(function() {

            $('#cheque_date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "dd-mm-yy",
                yearRange: "-10:+10"
            });


        });

        function showHidePayment() {

            let method = $('#method').val();

            if (method == 'Bank') {
                $('#bank').show();
                $('#MFS').hide();
            } else if (method == 'MFS') {
                $('#bank').hide();
                $('#MFS').show();
            }
        }


        function showHidePaymentOption() {

            let type = $('#type').val();

            if (type == 'Card') {

                $('#card').show();
                $('#cheque').hide();
                $('#transfer').hide();

            } else if (type == 'Cheque') {

                $('#card').hide();
                $('#cheque').show();
                $('#transfer').hide();

            } else if (type == 'Transfer') {

                $('#card').hide();
                $('#cheque').hide();
                $('#transfer').show();

            } else {

                $('#card').hide();
                $('#cheque').hide();
                $('#transfer').hide();
            }
        }

        function showHideDiscount() {

            let method = $('#discount_type').val();

            if (method == 'amount') {
                $('#amount').show();
                $('#percent').hide();
            } else {
                $('#amount').hide();
                $('#percent').show();
            }
        }

        function calculateDue() {

            let total_bill = $('#total_bill').val();
            let total_paid = $('#total_paid').val();
            let discount_percentage = $('#discount_percentage').val();
            let other_paid = $('#other_paid').val();
            let paid = $('#paid').val();

            if (discount_percentage > 0) {
                let discount = parseFloat(total_bill) * parseFloat(discount_percentage) / 100;
                $('#discount_amount').val(discount);
            }

            let discount_amount = $('#discount_amount').val();
            let due = parseFloat(total_bill) - parseFloat(total_paid) - parseFloat(other_paid) - parseFloat(paid) -
                parseFloat(discount_amount);

            $('#due').val(due);
        }
    </script>

@endsection
