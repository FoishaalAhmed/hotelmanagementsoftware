@extends('backend.layouts.app')
@section('title', 'Booking')
@section('content')
    <!-- Content Wrapper. Contains page content -->
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
            @include('includes.error')
            <!-- Modal-1 Start -->
            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog width-setup" role="document">
                    <div class="modal-content" style="background-color: #dadada; margin: 0 !important;">
                        <div class="modal-header " style="border: none; padding: 0; ">
                            <h4 style="margin-top: 25px !important;" class="modal-title text-center h4-tag-style"
                                id="exampleModalLongTitle">Room Detail</h4>
                            <button style="padding: 0 !important;" type="button" class="close " data-dismiss="modal"
                                aria-label="Close">
                                <span style="color: red !important; padding: 0; margin-right: 15px;"
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="border-bottom: 2px solid #a59c9c;">
                            <div class="">
                                <div class=" row text-align" style="background-color: #a59c9c;">
                                    <div class="col-lg-6 col-xs-12 text-align-l">
                                        <h4 style="font-weight: 800;">Hotel Name</h4>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 text-align-r">
                                        <h4 style="font-weight: 800;">Invoice No # 02145</h4>
                                    </div>
                                </div>
                                <div class="row text-align" style="border-bottom: 2px solid #a59c9c;">
                                    <div class="col-lg-4 col-xs-12 text-align-l">
                                        <h4 style=" font-weight: bold;">General Info</h4>
                                    </div>
                                    <div class="col-lg-4 col-xs-12 text-align-r">
                                        <h4 style="font-weight: 800;">Facilities</h4>
                                    </div>
                                    <div class="col-lg-4 col-xs-12 text-align-r">
                                        <h4 style="font-weight: 800;">Availablity</h4>
                                    </div>
                                </div>
                                <!-- Guest Information Start -->
                                <div class="row">
                                    <div class="col-lg-6 col-xs-12 " style="margin-top: 5px">
                                        <h4 class="h4-tag-style">Room Number : <span id="number"></span></h4>
                                        <h4 class="h4-tag-style">Type : <span id="type"></span></h4>
                                        <h4 class="h4-tag-style">Rent : <span id="rent"></span></h4>
                                        <h4 class="h4-tag-style">Bed: <span id="bed"></span></h4>
                                        <h4 class="h4-tag-style">Situate: <span id="situate"></span></h4>
                                        <h4 class="h4-tag-style">Facing: <span id="facing"></span></h4>
                                    </div>
                                    <div class="col-lg-6 col-xs-12" style="margin-top: 5px">
                                        <div class="" style=" width: 100%; ">
                                            <span id=" facility">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class=" footer-btn" style="padding: 2% 0; margin: 0;">
                                <button class="btn ">Print</button>
                                <button class="btn ">Save as PDF</button>
                                <button class="btn " data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MOdal-1 End -->
            <!-- Modal-2 Start -->
            <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog width-setup" role="document">
                    <div class="modal-content" style="background-color: #dadada; margin: 0 !important;">
                        <div class="modal-header " style="border: none; padding: 0; ">
                            <h4 style="margin-top: 25px !important;" class="modal-title text-center h4-tag-style"
                                id="exampleModalLongTitle">QUICK BOOKING/ RESERVATION</h4>
                            <button style="padding: 0 !important;" type="button" class="close " data-dismiss="modal"
                                aria-label="Close">
                                <span style="color: red !important; padding: 0; margin-right: 15px;"
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="border-bottom: 2px solid #a59c9c;">
                            <div class="">
                                <div class=" row text-align" style="background-color: #a59c9c;">
                                    <div class="col-lg-6 text-align-l">
                                        <h4 style="font-weight: 800;">Hotel Name</h4>
                                    </div>
                                    <div class="col-lg-6  text-align-r">
                                        <h4 style="font-weight: 800;">Invoice No # 02145</h4>
                                    </div>
                                </div>
                                <div class="row text-align" style="border-bottom: 2px solid #a59c9c;">
                                    <div class="col-lg-4  text-align-l">
                                        <h4 style=" font-weight: bold;">Customer Info</h4>
                                    </div>
                                    <div class="col-lg-4  text-align-l">
                                    </div>
                                    <div class="col-lg-4  text-align-r">
                                        <h4 style="font-weight: 800;">Hotel type : STANDARD</h4>
                                    </div>
                                </div>
                                <div class="">
                                    <form action=" {{ route('admin.booking.store') }}" class=" form-alignment"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="column-label input-date-width mr">
                                            <label for="country">Check In</label>
                                            <input class="input-date-width-border" type="date" name="check_in" id="check_in"
                                                value="{{ old('check_in') }}">
                                        </div>
                                        <div class="column-label input-date-width mr">
                                            <label for="country">Check Out</label>
                                            <input class="input-date-width-border" type="date" name="check_out"
                                                onchange="calculateDay()" id="check_out" value="{{ old('check_out') }}">
                                        </div>
                                        <div class="column-label mr">
                                            <label for="country">Adult</label>
                                            <select style="width: 100%; border: 0; border-radius: 5px;" id="payment"
                                                name="adult">
                                                <option value="1" @if (old('adult') == 1)
                                                    {{ 'selected' }}
                                                    @endif>1</option>
                                                <option value="2" @if (old('adult') == 2)
                                                    {{ 'selected' }}
                                                    @endif>2</option>
                                                <option value="3" @if (old('adult') == 3)
                                                    {{ 'selected' }}
                                                    @endif>3</option>
                                                <option value="4" @if (old('adult') == 4)
                                                    {{ 'selected' }}
                                                    @endif>4</option>
                                                <option value="5" @if (old('adult') == 5)
                                                    {{ 'selected' }}
                                                    @endif>5</option>
                                            </select>
                                        </div>
                                        <div class="column-label mr">
                                            <label for="country">Child</label>
                                            <select style="width: 100%; border: 0; border-radius: 5px;" id="children"
                                                name="children">
                                                <option value="0" @if (old('children') == 0)
                                                    {{ 'selected' }}
                                                    @endif>0</option>
                                                <option value="1" @if (old('children') == 1)
                                                    {{ 'selected' }}
                                                    @endif>1</option>
                                                <option value="2" @if (old('children') == 2)
                                                    {{ 'selected' }}
                                                    @endif>2</option>
                                                <option value="3" @if (old('children') == 3)
                                                    {{ 'selected' }}
                                                    @endif>3</option>
                                                <option value="4" @if (old('children') == 4)
                                                    {{ 'selected' }}
                                                    @endif>4</option>
                                                <option value="5" @if (old('children') == 5)
                                                    {{ 'selected' }}
                                                    @endif>5</option>
                                            </select>
                                        </div>
                                        <div class="column-label mr">
                                            <label for="country">Rate Type</label>
                                            <select style="width: 100%; border: 0; border-radius: 5px;" id="payment"
                                                name="type" onchange="getRoomRent(this.value)">
                                                <option value="Normal Rate" @if (old('type') == 'Normal Rate')
                                                    {{ 'selected' }}
                                                    @endif>Normal Rate</option>
                                                <option value="Seasonal Rate" @if (old('type') == 'Seasonal Rate')
                                                    {{ 'selected' }}
                                                    @endif>Seasonal Rate</option>
                                                <option value="Festival Rate" @if (old('type') == 'Festival Rate')
                                                    {{ 'selected' }}
                                                    @endif>Festival Rate</option>
                                            </select>
                                        </div>
                                </div>
                                <!-- Guest Information Start -->
                                <div class="row">
                                    <div class="col-lg-6 col-xs-12 " style="margin-top: 5px">
                                        <div class="" style=" width: 100%; ">
                                            <div class="                  row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Name </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <input style="width: 100%; border-radius: 5px;" type="text" name="name"
                                                        value="{{ old('name') }}">
                                                </div>
                                            </div>
                                            <div class="  row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Phone Number </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <input style="width: 100%; border-radius: 5px;" type="number"
                                                        name="phone" value="{{ old('phone') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Email Address </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <input style="width: 100%; border-radius: 5px;" type="email"
                                                        name="email" value="{{ old('email') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">NID NO </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <input style="width: 100%; border-radius: 5px;" type="text"
                                                        name="nid_number" value="{{ old('nid_number') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Photo/Capture </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-align-c ">
                                                    <div class='file'>
                                                        <label class="label-input" for='input-file'>
                                                            Upload/ Capture
                                                        </label>
                                                        <input id='input-file' type='file' name="photo" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Payment </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <select style="width: 100%; border-radius: 5px;" id="payment"
                                                        name="payment_method" onchange="showHidePayment(this.value)">
                                                        <option value="Cash" @if (old('payment_method') == 'Cash')
                                                            {{ 'select' }}
                                                            @endif>Cash</option>
                                                        <option value="Bank" @if (old('payment_method') == 'Bank')
                                                            {{ 'select' }}
                                                            @endif>Bank</option>
                                                        <option value="MFS" @if (old('payment_method') == 'MFS')
                                                            {{ 'select' }}
                                                            @endif>MFS</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="bank" style="display: @if (old('method') != 'Bank') {{ 'none' }} @endif">
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-6 text-left">
                                                        <h4 class="h4-tag-style-2">Payment Type </h4>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-6 text-right">
                                                        <select name="bank_payment_type" class="form-control"
                                                            style="width: 100%"
                                                            onchange="showHidePaymentOption(this.value)">
                                                            <option value="">{{ __('Select Type') }}</option>
                                                            <option value="Card" @if (old('bank_payment_type') == 'Card') {{ 'selected' }} @endif>
                                                                {{ __('Debit/Credit Card') }}</option>
                                                            <option value="Cheque" @if (old('bank_payment_type') == 'Cheque') {{ 'selected' }} @endif>
                                                                {{ __('Cheque') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-6 text-left">
                                                        <h4 class="h4-tag-style-2">Bank Name </h4>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-6 text-right">
                                                        <select name="bank" class="form-control"
                                                            style="width: 100%"
                                                            >
                                                            @foreach ($banks as $item)
                                                            <option value="{{ $item->id }}" @if (old('bank') == $item->id ) {{ 'selected' }} @endif>
                                                                {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="row" id="card"
                                                    style="display: @if (old('bank_payment_type') != 'Card') {{ 'none' }} @endif">
                                                    <div class="col-lg-6 col-xs-6 text-left">
                                                        <h4 class="h4-tag-style-2">Card Number </h4>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-6 text-right">
                                                        <input style="width: 100%; border-radius: 5px;" type="text"
                                                            name="card_number" value="{{ old('card_number') }}">
                                                    </div>
                                                </div>

                                                <div id="cheque" style="display: @if (old('bank_payment_type') != 'Cheque') {{ 'none' }} @endif">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-xs-6 text-left">
                                                            <h4 class="h4-tag-style-2">Cheque Number </h4>
                                                        </div>
                                                        <div class="col-lg-6 col-xs-6 text-right">
                                                            <input style="width: 100%; border-radius: 5px;" type="text"
                                                                name="cheque_number" value="{{ old('cheque_number') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-xs-6 text-left">
                                                            <h4 class="h4-tag-style-2">Date of Cheque </h4>
                                                        </div>
                                                        <div class="col-lg-6 col-xs-6 text-right">
                                                            <input style="width: 100%; border-radius: 5px;" type="date"
                                                                name="cheque_date" value="{{ old('cheque_date') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="MFS" style="display: @if (old('method') != 'MFS') {{ 'none' }} @endif">
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-6 text-left">
                                                        <h4 class="h4-tag-style-2">Payment Type </h4>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-6 text-right">
                                                        <select name="mfs_payment_type" id="mfs_type"
                                                            class="form-control" style="width: 100%">
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
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-6 text-left">
                                                        <h4 class="h4-tag-style-2">Mobile Number </h4>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-6 text-right">
                                                        <input style="width: 100%; border-radius: 5px;" type="text"
                                                            name="mobile_number" value="{{ old('mobile_number') }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-6 text-left">
                                                        <h4 class="h4-tag-style-2">TrxnID </h4>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-6 text-right">
                                                        <input style="width: 100%; border-radius: 5px;" type="text"
                                                            name="transaction_id" value="{{ old('transaction_id') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Paid </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <input style="width: 100%; border-radius: 5px;" type="text" name="paid"
                                                        value="{{ old('paid') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12" style="margin-top: 5px">
                                        <div class="" style=" width: 100%; ">
                                            <div class="                         row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Amount </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <h4 class="h4-tag-style-2"><input
                                                            style="width: 80%; border: 0; border-radius: 5px;" type="text"
                                                            name="rent" id="rent_amount" value="{{ old('rent') }}"> Taka
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Vat/Tax </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <h4 class="h4-tag-style-2"><input
                                                            style="width: 80%; border: 0; border-radius: 5px;" type="text"
                                                            name="vat" id="vat_percent" value="{{ old('vat') }}"
                                                            readonly> %</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Vat/Tax Amount </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <h4 class="h4-tag-style-2"><input
                                                            style="width: 80%; border: 0; border-radius: 5px;" type="text"
                                                            name="vat_amount" id="vat_amount"
                                                            value="{{ old('vat_amount') }}">
                                                        Taka</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Sub Total</h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <h4 class="h4-tag-style-2"><input
                                                            style="width: 80%; border: 0; border-radius: 5px;" type="text"
                                                            name="subtotal" id="subtotal" value="{{ old('subtotal') }}">
                                                        Taka
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Coupon Code </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <input style="width: 80%; border: 0; border-radius: 5px;" type="text"
                                                        name="coupon_code" id="coupon_code"
                                                        onfocusout="getCoupon(this.value)"
                                                        value="{{ old('coupon_code') }}">
                                                    <input type="hidden" name="room_id" id="room_id">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Discount </h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <h4><input style="width: 80%; border: 0; border-radius: 5px;"
                                                            type="text" name="discount" id="discount"
                                                            onchange="calculateGrand()" value="{{ old('discount') }}">
                                                        Taka
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-xs-6 text-left">
                                                    <h4 class="h4-tag-style-2">Total</h4>
                                                </div>
                                                <div class="col-lg-6 col-xs-6 text-right">
                                                    <h4 class="h4-tag-style-2">
                                                        <input style="width: 80%; border: 0; border-radius: 5px;"
                                                            type="text" name="total" id="total"
                                                            value="{{ old('total') }}"> Taka
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class=" footer-btn" style="padding: 2% 0; margin: 0;">
                                <button class="btn btn-primary" type="submit">Print</button>
                                <button class="btn btn-primary" type="submit">Save as PDF</button>
                                <button class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal-2 End -->
            <div class="row">
                <div class="booking-filter">
                    <button class="bg-3" type="button" data-filter='.all'>All</button>
                    <button class="bg-1" type="button" data-filter='.available'>AVAILABLE</button>
                    <button class="bg-2" type="button" data-filter='.booked'>BOOKED</button>
                    <a class="bg-3"
                        style="width: 8em !important;color: white !important;font-size: 1.8rem;padding: 1rem 2rem;border: 0;border-radius: 0.5rem;text-transform: uppercase; color: #3c4761;margin: 0.5rem;transition: .5s;"
                        href="{{ route('admin.booking.create') }}">MULTIPLE
                        ROOM BOOKING</a>
                </div>
            </div>
            <div class="boxPopUp">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @foreach ($rooms as $room)
                        <div class="col-lg-2 col-xs-6 mix all <?php if ($room->bookings->isNotEmpty() && $room->bookings->first()->status == 1) {
    echo 'booked';
} else {
    echo 'available';
} ?>">
                            <!-- small box -->
                            <div class="small-box <?php if ($room->bookings->isNotEmpty() && $room->bookings->first()->status == 1) {
    echo 'bg-2';
} else {
    echo 'bg-1';
} ?>">
                                <div class="inner text-center">
                                    <h4 class="new-header-style">ROOM NO: {{ $room->number }}</h4>
                                    <!-- <h3>150</h3> -->
                                    <div class="row">
                                        <div class="col">
                                            <?php if($room->bookings->isNotEmpty() && $room->bookings->first()->status == 1) {  ?>
                                            <a href="{{ route('admin.booking.edit', $room->bookings->first()->booking_id) }}"
                                                class="new-button-style"
                                                style="width: 105px !important;height: 30px !important;margin-bottom: 3px;background-color: #7e7979; color: white;display: inline-block; border: 1px solid;">UPDATE
                                                NOW</a>
                                            <?php } else { ?>
                                            <button data-toggle="modal" data-target="#bookingModal"
                                                class="new-button-style" data-room_id="{{ $room->id }}"
                                                data-rent="{{ $room->rate }}">CHECK IN
                                            </button>
                                            <?php } ?>
                                        </div>
                                        <div class="col">
                                            <?php if($room->bookings->isNotEmpty() && $room->bookings->first()->status == 1) {  ?>
                                            <a href="{{ route('admin.booking.checkout', $room->bookings->first()->booking_id) }}"
                                                class="new-button-style"
                                                style="width: 105px !important;height: 30px !important; margin-bottom: 3px;background-color: #7e7979;color: white;display: inline-block; border: 1px solid;">CHECK
                                                OUT</a>
                                            <?php } else { ?>
                                            <button data-toggle="modal" data-target="#detailModal" class="new-button-style"
                                                data-type="{{ $room->type }}" data-rent="{{ $room->rent }}"
                                                data-situate="{{ $room->situate }}" data-facing="{{ $room->facing }}"
                                                data-bed="{{ $room->bed }}" data-number="{{ $room->number }}"
                                                data-id="{{ $room->id }}">VIEWS
                                                DETAILS</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.row5 -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('footer')
    <script type="text/javascript">
        $('#detailModal').on("show.bs.modal", function(event) {
            var e = $(event.relatedTarget);
            var type = e.data('type');
            var rent = e.data('rent');
            var situate = e.data('situate');
            var facing = e.data('facing');
            var bed = e.data('bed');
            var number = e.data('number');
            var id = e.data('id');
            $("#type").text(type);
            $("#rent").text(rent);
            $("#situate").text(situate);
            $("#facing").text(facing);
            $("#number").text(number);
            $("#bed").text(bed);

            $.ajaxSetup({

                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }

            });

            $.ajax({

                url: '{{ route('get.room.facility') }}',
                method: 'POST',
                data: {
                    'room_id': id,
                },

                success: function(data2) {
                    var data = JSON.parse(data2);
                    $('#facility').html(data);
                },

                error: function(error) {

                    console.log(error);
                }
            });


        });

        $('#bookingModal').on("show.bs.modal", function(event) {

            var e = $(event.relatedTarget);
            var room = e.data('room_id');
            var rent = e.data('rent');
            //alert(rent);
            $("#room_id").val(room);
            $("#rent_amount").val(rent);


        });

        $('#extendModal').on("show.bs.modal", function(event) {

            var e = $(event.relatedTarget);
            var checkin = e.data('checkin');
            var checkout = e.data('checkout');
            var client = e.data('client');
            var address = e.data('address');
            var phone = e.data('phone');
            var booking_id = e.data('booking_id');

            $("#checkin").val(checkin);
            $("#checkout").val(checkout);
            $("#client").val(client);
            $("#address").val(address);
            $("#phone").val(phone);
            $("#booking_id").val(booking_id);

        });

        $(function() {

            $('.date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "dd-mm-yy",
                yearRange: "-0:+10"
            });
        });

        function calculateGrand() {
            let discount = $('#discount').val();
            let subtotal = $('#subtotal').val();
            let grand = parseFloat(subtotal) - parseFloat(discount);
            $('#total').val(grand);
        }

        function calculateDay() {
            let vat = '{{ $vat }}';
            let check_in = $('#check_in').val();
            let check_out = $('#check_out').val();
            let inn = new Date(check_in);
            let out = new Date(check_out);
            const diffTime = Math.abs(out - inn);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            let rent = $("#rent_amount").val();
            let total = diffDays * rent;
            $("#rent_amount").val(total);
            $("#vat_percent").val(vat);
            let vatAmount = total * vat / 100;
            $('#vat_amount').val(vatAmount);
            let subtotal = parseFloat(total) + parseFloat(vatAmount);
            $('#subtotal').val(subtotal);
            $('#total').val(subtotal);
        }

        function getCoupon(code) {

            $.ajaxSetup({

                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }

            });

            $.ajax({

                url: '{{ route('get.coupon') }}',
                method: 'POST',
                data: {
                    'code': code,
                },

                success: function(data2) {
                    if (data2 == 'Coupon Expire') {
                        alert(data2);
                    } else {
                        var data = JSON.parse(data2);
                        $('#discount').val(data.amount);
                        let subtotal = $('#subtotal').val();
                        let grand = parseFloat(subtotal) - parseFloat(data.amount);
                        $('#total').val(grand);
                    }
                },

                error: function(error) {

                    console.log(error);
                }
            });
        }

        function getRoomRent(type) {
            let room_id = $("#room_id").val();
            let check_in = $('#check_in').val();
            let check_out = $('#check_out').val();
            let inn = new Date(check_in);
            let out = new Date(check_out);
            const diffTime = Math.abs(out - inn);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            $.ajaxSetup({

                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }

            });

            $.ajax({

                url: '{{ route('get.room.other.rent') }}',
                method: 'POST',
                data: {
                    'type': type,
                    'room_id': room_id,
                },

                success: function(data) {
                    let total = diffDays * data;
                    $("#rent_amount").val(total);
                },

                error: function(error) {

                    console.log(error);
                }
            });
        }

        function showHidePayment(method) {

            if (method == 'Bank') {
                $('#bank').show();
                $('#MFS').hide();
            } else if (method == 'MFS') {
                $('#bank').hide();
                $('#MFS').show();
            } else {
                $('#bank').hide();
                $('#MFS').hide();
            }
        }

        function showHidePaymentOption(type) {

            if (type == 'Card') {
                $('#card').show();
                $('#cheque').hide();
            } else if (type == 'Cheque') {
                $('#card').hide();
                $('#cheque').show();
            } else {
                $('#card').hide();
                $('#cheque').hide();
            }
        }
    </script>
@endsection
