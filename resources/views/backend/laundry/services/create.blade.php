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
                            <form action="{{ route('laundry.services.store') }}" class="form-horizontal" method="POST"
                                enctype="multipart/form-data" id="booking-form">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Room') }}</label>
                                                    <select name="room_id" id="room_id" class="form-control select2"
                                                        required style="width: 100%">
                                                        @foreach ($rooms as $item)
                                                            <option value="{{ $item->id }}" @if (old('room_id') == $item->id) {{ 'selected' }} @endif>
                                                                {{ $item->number }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Charge') }}</label>
                                                    <input name="charge" placeholder="{{ __('Charge') }}"
                                                        class="form-control" type="text" value="{{ old('charge') }}"
                                                        autocomplete="off" required="" id="total_charge">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group table-responsive">

                                                <table class="table" style="width: 100%;">

                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">Sl.</th>
                                                            <th style="width: 25%;">Product</th>
                                                            <th style="width: 20%;">Type</th>
                                                            <th style="width: 15%;">Quantity</th>
                                                            <th style="width: 15%;">Charge</th>
                                                            <th style="width: 15%;">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <input type="hidden" name="showrowid" id="showrowid" value="1">
                                                        <?php for ($i=0; $i < 10 ; $i++) { ?>
                                                        <tr id="trid<?= $i ?>" style="<?php if ($i > 0) {
    echo 'display: none';
} ?>">
                                                            <td>{{ $i + 1 }}</td>

                                                            <td>

                                                                <select name="laundry_product_id[]"
                                                                    id="laundry_product_id<?= $i ?>"
                                                                    class="form-control select2" style="width: 100%">
                                                                    <option value="">{{ __('Select Room Number') }}
                                                                    </option>
                                                                    @foreach ($products as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            @if (old('laundry_product_id.' . $i) == $item->id) {{ 'selected' }} @endif>
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </td>

                                                            <td>

                                                                <select name="type[]" id="type<?= $i ?>"
                                                                    class="form-control" required style="width: 100%"
                                                                    onchange="getLaundryCharge(<?= $i ?>)">
                                                                    <option value="">{{ __('Select Wash Type') }}
                                                                    </option>
                                                                    <option value="Normal" @if (old('type.' . $i) == 'Normal') {{ 'selected' }} @endif>
                                                                        {{ __('Normal') }}
                                                                    </option>
                                                                    <option value="Dry" @if (old('type.' . $i) == 'Dry') {{ 'selected' }} @endif>
                                                                        {{ __('Dry') }}
                                                                    </option>
                                                                </select>

                                                            </td>

                                                            <td>

                                                                <input type="text" name="quantity[]" class="form-control"
                                                                    id="quantity<?= $i ?>" placeholder="quantity"
                                                                    value="{{ old('quantity.' . $i) }}"
                                                                    autocomplete="off" onkeyup="chargeShow(<?= $i ?>)">

                                                            </td>

                                                            <td>

                                                                <input type="number" name="rate[]" class="form-control"
                                                                    id="rate<?= $i ?>" placeholder="rate"
                                                                    value="{{ old('rate.' . $i) }}" autocomplete="off"
                                                                    onkeyup="chargeShow(<?= $i ?>)">

                                                            </td>

                                                            <td>

                                                                <input type="number" name="total[]" class="form-control"
                                                                    id="total<?= $i ?>" placeholder="total"
                                                                    value="{{ old('total.' . $i) }}" autocomplete="off">

                                                            </td>

                                                        </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
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
                                        <div id="bank" style="display: @if (old('payment_method') != 'Bank') {{ 'none' }} @endif">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">Bank Name</label>
                                                        <select name="bank" id="bank" class="form-control select2"
                                                            style="width: 100%">
                                                            @foreach ($banks as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if (old('bank') == $item->id) {{ 'selected' }} @endif>
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="MFS" style="display: @if (old('payment_method') != 'MFS') {{ 'none' }} @endif">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">Payment Type</label>
                                                        <select name="mfs_payment_type" id="mfs_type"
                                                            class="form-control select2" style="width: 100%">
                                                            @foreach ($mobileBanks as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if (old('mfs_payment_type') == $item->id) {{ 'selected' }} @endif>
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <center>
                                            <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                            <button type="button" onclick="saveBooking()"
                                                class="btn btn-sm bg-blue">{{ __('Save') }}</button>
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

        function getLaundryCharge(id) {

            var laundry_product_id = $('#laundry_product_id' + id).val();
            var type = $('#type' + id).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });

            $.ajax({

                url: "{{ route('laundry.get.charge.by.type') }}",
                method: 'POST',
                data: {
                    'type': type,
                    'laundry_product_id': laundry_product_id,
                },

                success: function(data) {
                    $('#quantity' + id).val(1);
                    $('#rate' + id).val(data);
                    $('#total' + id).val(data);

                    var total_amount = 0;
                    for (var i = 0; i < 10; i++) {
                        var tempamount = $('#total' + i).val();
                        total_amount += Number(tempamount);
                    }

                    $('#total_charge').val(total_amount);

                },

                error: function(error) {
                    console.log(error);
                }
            });
        }

        function chargeShow(id) {

            var quantity = $('#quantity' + id).val();
            var rate = $('#rate' + id).val();
            var total = quantity * rate;
            $('#total' + id).val(total);
            var total_amount = 0;
            for (var i = 0; i < 10; i++) {
                var tempamount = $('#total' + i).val();
                total_amount += Number(tempamount);
            }
            $('#total_charge').val(total_amount);
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
