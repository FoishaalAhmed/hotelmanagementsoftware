@extends('backend.layouts.app')
@section('title', 'New Booking')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ __('Dashboard') }}
                <small>Version 2.0</small>
            </h1>
        </section>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Content Header (Booking header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Booking') }}</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.booking.multiple') }}" class="form-horizontal" method="POST"
                                enctype="multipart/form-data" id="booking-form">
                                @csrf
                                <div class="col-md-9">
                                    <div class="row">
                                        <center>
                                            <h3>Client Info</h3>
                                        </center>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputName">Name</label>
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="Name" name="client" required="" autocomplete="off"
                                                        value="{{ old('client') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputPhone">Phone</label>
                                                    <input type="text" class="form-control" id="inputPhone"
                                                        placeholder="Phone" name="phone" required="" autocomplete="off"
                                                        value="{{ old('phone') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputEmail">Email</label>
                                                    <input type="email" class="form-control" id="inputEmail"
                                                        placeholder="E-mail" name="email" autocomplete="off"
                                                        value="{{ old('email') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputNIDNumber">NID Number</label>
                                                    <input type="text" class="form-control" id="inputNIDNumber"
                                                        placeholder="NID Number" name="nid_number" autocomplete="off"
                                                        value="{{ old('nid_number') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Check in</label>
                                                    <input type="text" class="form-control" id="check_in"
                                                        placeholder="Check Out" name="check_in" autocomplete="off"
                                                        value="{{ old('check_in') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Check Out</label>
                                                    <input type="text" class="form-control" id="check_out"
                                                        placeholder="Check Out" name="check_out" autocomplete="off"
                                                        value="{{ old('check_out') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Total Room</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Check Out" name="room" autocomplete="off"
                                                        value="{{ old('room') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Adult</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Adult" name="adult" autocomplete="off"
                                                        value="{{ old('adult') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Children</label>
                                                    <input type="text" class="form-control" id="inputCheckOut"
                                                        placeholder="Children" name="children" autocomplete="off"
                                                        value="{{ old('children') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <h3>Room Info</h3>
                                            </center>
                                            <div class="form-group table-responsive">

                                                <table class="table" style="width: 100%;">

                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">Sl.</th>
                                                            <th style="width: 15%;">Room</th>
                                                            <th style="width: 45%;">Names</th>
                                                            <th style="width: 15%;">Parson</th>
                                                            <th style="width: 15%;">Rent</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <input type="hidden" name="showrowid" id="showrowid" value="1">
                                                        <?php for ($i=0; $i < sizeof($rooms) ; $i++) { ?>
                                                        <tr id="trid<?= $i ?>" style="<?php if ($i > 0) {
    echo 'display: none';
} ?>">
                                                            <td>{{ $i + 1 }}</td>

                                                            <td>

                                                                <select name="room_id[]" id="room_id<?= $i ?>"
                                                                    class="form-control select2" style="width: 100%"
                                                                    onchange="getRoomRent(this.value, <?= $i ?>)">
                                                                    <option value="">{{ __('Select Room Number') }}
                                                                    </option>
                                                                    @foreach ($rooms as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            @if (old('room_id.' . $i) == $item->id) {{ 'selected' }} @endif>
                                                                            {{ $item->number }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </td>

                                                            <td>

                                                                <input type="text" name="name[]" class="form-control"
                                                                    id="name<?= $i ?>" placeholder="name"
                                                                    value="{{ old('name.' . $i) }}" autocomplete="off">

                                                            </td>

                                                            <td>
                                                                
                                                                <input type="number" name="person[]" class="form-control"
                                                                    id="person<?= $i ?>" placeholder="person"
                                                                    value="{{ old('person.' . $i) }}" autocomplete="off">

                                                            </td>

                                                            <td>

                                                                <input type="number" name="singleRent[]"
                                                                    class="form-control" id="singleRent<?= $i ?>"
                                                                    placeholder="singleRent"
                                                                    value="{{ old('singleRent.' . $i) }}"
                                                                    autocomplete="off">

                                                            </td>

                                                        </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Rent</label>
                                                    <input type="text" class="form-control" id="rent" placeholder="Rent"
                                                        name="rent" autocomplete="off" value="{{ old('rent') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Vat Percentage</label>
                                                    <input type="text" class="form-control" id="vat"
                                                        placeholder="Vat Percentage" name="vat" autocomplete="off"
                                                        value="{{ old('vat') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Vat Amount</label>
                                                    <input type="text" class="form-control" id="vat_amount"
                                                        placeholder="Vat Amount" name="vat_amount" autocomplete="off"
                                                        value="{{ old('vat_amount') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Subtotal</label>
                                                    <input type="text" class="form-control" id="subtotal"
                                                        placeholder="Subtotal" name="subtotal" autocomplete="off"
                                                        value="{{ old('subtotal') }}" onkeyup="calculateTotal()">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Discount</label>
                                                    <input type="text" class="form-control" id="discount"
                                                        placeholder="Discount" name="discount" autocomplete="off"
                                                        value="{{ old('discount') }}" onkeyup="calculateTotal()">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Total</label>
                                                    <input type="text" class="form-control" id="total" placeholder="Total"
                                                        name="total" autocomplete="off" value="{{ old('total') }}">
                                                </div>
                                            </div>
                                        </div>
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
                                                src="{{ asset(old('photo')) }}" alt="User profile picture"
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
                                            <button type="reset" class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                            <button type="button" onclick="saveBooking()"
                                                class="btn btn-sm bg-blue">{{ __('Update') }}</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(function() {
            $('#check_in, #check_out').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "mm/dd/yy",
                yearRange: "-0:+1"
            });


        });

        function getRoomRent(room_id, row) {
            let totalRoom = '{{ sizeof($rooms) }}';
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

                url: '{{ route('get.room.rent') }}',
                method: 'POST',
                data: {
                    'room_id': room_id,
                },

                success: function(data2) {
                    var data = JSON.parse(data2);
                    $('#singleRent' + row).val(data.rate);
                    var total_rent = 0;
                    for (var i = 0; i < totalRoom; i++) {
                        var temprent = $('#singleRent' + i).val();
                        total_rent += Number(temprent * diffDays);
                    }

                    $('#rent').val(total_rent);
                    let vat = '{{ $vat }}';
                    $('#vat').val(vat);
                    let vatAmount = total_rent * vat / 100;
                    //alert(vatAmount);
                    $('#vat_amount').val(vatAmount);
                    let total = parseFloat(total_rent) + parseFloat(vatAmount);
                    $('#subtotal').val(total);
                },

                error: function(error) {

                    console.log(error);
                }


            });
        }

        function makerowvisible() {
            var nextrownumber = $("#showrowid").val();
            $("#trid" + Number(nextrownumber)).show();
            $("#showrowid").val(Number(nextrownumber) + 1);
        }

        $(document).keypress(function(event) {

            var keycode = (event.keyCode ? event.keyCode : event.which);

            if (keycode == '13') {

                makerowvisible();
            }

        });

        function saveBooking() {

            $('#booking-form').submit();
        }

        function calculateTotal() {
            let discount = 0;
            if ($('#discount').val() != '') discount = $('#discount').val();
            let grand = parseFloat(total) - parseFloat(discount);
            $('#total').val(grand);
        }

        function showHidePayment() {

            let method = $('#method').val();

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
