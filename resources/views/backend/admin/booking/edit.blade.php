@extends('backend.layouts.app')
@section('title', 'Room Booking')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12" style="background: white;">
                    @include('includes.error')
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab">Booking Info</a></li>
                            <li><a href="#detail" data-toggle="tab">Booking Detail Info</a></li>
                            <li><a href="#payment" data-toggle="tab">Payments</a></li>
                            <li><a href="#timeline" data-toggle="tab">New Payment</a></li>
                        </ul>
                        <div class="tab-content">
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
                                            @foreach ($bankPayments as $key => $payment)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ date('d M, Y', strtotime($payment->date)) }}</td>
                                                    <td>{{ 'Bank' }}</td>
                                                    <td>{{ $payment->bank }}</td>
                                                    <td></td>
                                                    <td>{{ $payment->amount }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($cashPayments as $key => $payment)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ date('d M, Y', strtotime($payment->date)) }}</td>
                                                    <td>{{ 'Cash' }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ $payment->paid }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($mobilePayments as $key => $payment)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ date('d M, Y', strtotime($payment->date)) }}</td>
                                                    <td>{{ 'MFS' }}</td>
                                                    <td></td>
                                                    <td>{{ $payment->mobile_number }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
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
                                                    <label for="">Paid</label>
                                                    <input type="text" name="paid" class="form-control" id="paid"
                                                        placeholder="Paid" value="{{ old('paid') }}" required=""
                                                        autocomplete="off">
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
                            <div class="tab-pane active" id="settings">
                                <form action="{{ route('admin.booking.update', $booking->id) }}" class="form-horizontal"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
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
                                                    <input type="text" class="form-control"
                                                        placeholder="Check Out" name="checkout_time" autocomplete="off"
                                                        value=" @if ($booking->checkout_time != null) {{ date('h:i A', strtotime($booking->checkout_time)) }} @endif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Total Room</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Check Out" name="room" autocomplete="off"
                                                        value="{{ $booking->room }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Adult</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Adult" name="adult" autocomplete="off"
                                                        value="{{ $booking->adult }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Children</label>
                                                    <input type="text" class="form-control" 
                                                        placeholder="Children" name="children" autocomplete="off"
                                                        value="{{ $booking->children }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Rent</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Rent" name="rent" autocomplete="off"
                                                        value="{{ $booking->rent }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Vat Percentage</label>
                                                    <input type="text" class="form-control" 
                                                        placeholder="Vat Percentage" name="vat" autocomplete="off"
                                                        value="{{ $booking->vat }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Vat Amount</label>
                                                    <input type="text" class="form-control" 
                                                        placeholder="Vat Amount" name="vat_amount" autocomplete="off"
                                                        value="{{ $booking->vat_amount }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Subtotal</label>
                                                    <input type="text" class="form-control" 
                                                        placeholder="Subtotal" name="subtotal" autocomplete="off"
                                                        value="{{ $booking->subtotal }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Discount</label>
                                                    <input type="text" class="form-control" 
                                                        placeholder="Discount" name="discount" autocomplete="off"
                                                        value="{{ $booking->discount }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Total</label>
                                                    <input type="text" class="form-control" 
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
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <center>
                                                <button type="reset"
                                                    class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                                <button type="submit"
                                                    class="btn btn-sm bg-blue">{{ __('Update') }}</button>
                                            </center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="detail">
                                <form action="{{ route('admin.booking-detail.update', $booking->id) }}" class="form-horizontal"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
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
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <center>
                                                <button type="reset"
                                                    class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                                <button type="submit"
                                                    class="btn btn-sm bg-blue">{{ __('Update') }}</button>
                                            </center>
                                        </div>
                                    </div>
                                </form>
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
        // profile picture change
        function readPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#user_photo')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('#inputCheckOut, #inputCheckIn, #check_in, #check_out, #cheque_date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "dd-mm-yy",
                yearRange: "-0:+1"
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

            } else {

                $('#card').hide();
                $('#cheque').hide();
                $('#transfer').hide();
            }
        }
    </script>

@endsection
