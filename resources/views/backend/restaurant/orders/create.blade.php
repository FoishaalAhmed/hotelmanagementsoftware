@extends('backend.layouts.app')
@section('title', 'New Order')
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
                    <!-- Content Header (Order header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Order') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('restaurant.orders.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Order List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('restaurant.orders.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data" id="orderForm">
                                @csrf
                                <div class="col-md-7">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Room') }}</label>
                                                <select name="room_id" class="form-control select2" id="room_id"
                                                    style="width: 100%;" required="">
                                                    <option value="">{{ __('Select Room') }}</option>
                                                    @foreach ($rooms as $key => $room)
                                                        <option value="{{ $room->id }}" @if (old('room_id') == $room->id) {{ 'selected' }}  @endif>
                                                            {{ $room->number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Table') }}</label>
                                                <select name="table_id" class="form-control select2" id="table_id"
                                                    style="width: 100%;">
                                                    <option value="">{{ __('Select Table') }}</option>
                                                    @foreach ($tables as $key => $table)
                                                        <option value="{{ $table->id }}" @if (old('table_id') == $table->id) {{ 'selected' }}  @endif>
                                                            {{ $table->number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Items') }}</label>
                                                <select name="item_id" class="form-control select2" id="item_id"
                                                    style="width: 100%;" required="">
                                                    <option value="">{{ __('Select Item') }} </option>
                                                    @foreach ($items as $key => $item)
                                                        <option value="{{ $item->id }}" @if (old('item_id') == $item->id) {{ 'selected' }}  @endif data-price="{{ $item->price }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Quantity') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Quantity') }}" value="" autocomplete="off"
                                                    required="" id="quantity" onchange="calculateTotal()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Price') }}</label>
                                                <input type="text" class="form-control" placeholder="{{ __('Price') }}"
                                                    value="" autocomplete="off" required="" id="price"
                                                    onchange="calculateTotal()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Total') }}</label>
                                                <input type="text" class="form-control" placeholder="{{ __('Total') }}"
                                                    value="" autocomplete="off" required="" id="total" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Subtotal') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Subtotal') }}" value="{{ old('subtotal') }}"
                                                    name="subtotal" autocomplete="off" required="" id="subtotal" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Vat') }}</label>
                                                <input type="text" class="form-control" placeholder="{{ __('Vat') }}"
                                                    value="{{ old('vat') }}" name="vat" autocomplete="off" required=""
                                                    id="vat" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Discount') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Discount') }}" value="{{ old('discount') }}"
                                                    name="discount" autocomplete="off" required="" id="discount"
                                                    onkeyup="calculateGrandTotal(this.value)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Total') }}</label>
                                                <input type="text" class="form-control" placeholder="{{ __('Total') }}"
                                                    value="{{ old('grand_total') }}" name="grand_total"
                                                    autocomplete="off" required="" id="grand" readonly>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <label for="">Payment Type</label>
                                                    <select name="bank_payment_type" id="type" class="form-control select2"
                                                        style="width: 100%" onchange="showHidePaymentOption()">
                                                        <option value="">{{ __('Select Type') }}</option>
                                                        <option value="Card" @if (old('bank_payment_type') == 'Card') {{ 'selected' }} @endif>
                                                            {{ __('Debit/Credit Card') }}</option>
                                                        <option value="Cheque" @if (old('bank_payment_type') == 'Cheque') {{ 'selected' }} @endif>
                                                            {{ __('Cheque') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Bank Name</label>
                                                    <input type="text" name="bank" class="form-control"
                                                        placeholder="Bank Name" value="<?php echo old('bank'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="card" style="display: @if (old('bank_payment_type') != 'Card') {{ 'none' }} @endif">
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">Cheque Number</label>
                                                        <input type="text" name="cheque_number" class="form-control"
                                                            placeholder="Cheque Number" value="<?php echo old('cheque_number'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                    <div id="MFS" style="display: @if (old('payment_method') != 'MFS') {{ 'none' }} @endif">
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Mobile Number</label>
                                                    <input type="text" name="mobile_number" class="form-control"
                                                        id="mobile_number" placeholder="Mobile Number"
                                                        value="<?php echo old('mobile_number'); ?>" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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

                                <div class="col-md-5">
                                    <div class="box box-primary box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"> {{ __('Items') }} </h3>
                                        </div>
                                        <div class="box-body box-profile">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 55%;">{{ __('Item') }}</th>
                                                        <th style="width: 15%;">{{ __('Price') }}</th>
                                                        <th style="width: 15%;">{{ __('QTY') }}</th>
                                                        <th style="width: 15%;">{{ __('Total') }}</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                </tbody>
                                            </table>
                                            <button type='button' class='delete-row btn btn-sm bg-red'>Delete</button>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="button" class="btn btn-sm bg-blue"
                                            onclick="$('#orderForm').submit();">{{ __('Save') }}</button>
                                    </center>
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


        $('#item_id').change(function() {
            var price = $(this).find(':selected').attr('data-price');
            $('#price').val(price);
            $('#quantity').val(1);
            $('#total').val(price);
            $('#quantity').select();
        });

        function calculateTotal() {
            var price = $('#price').val();
            var quantity = $('#quantity').val();
            var total = price * quantity;
            $('#total').val(total);
        }

        function confirmItem() {

            var item_id = $("#item_id").val();
            var item = $('#item_id option:selected').text();
            var price = $('#price').val();
            var quantity = $('#quantity').val();
            var total = $('#total').val();

            var markup = "<tr> <td> <input type='checkbox' name='record'> <input type='hidden' name='item_id[]'  value=" +
                item_id + "> " + item +
                " </td> <td> <input type='hidden' name='price[]' value=" + price + ">" + price +
                "</td> <td> <input type='hidden' name='quantity[]' value=" + quantity + ">" + quantity +
                "</td> <td class='total'> <input type='hidden' name='total[]' value=" + total + ">" + total +
                "</td> </tr>";
            $("table tbody").append(markup);
            var subtotal = 0;
            let discounts = $(".total").each(function() {
                subtotal += Number($(this).text());
            });

            $('#subtotal').val(subtotal);
            let percent = '{{ $vat->percent }}';
            let vat = subtotal * percent / 100;
            $('#vat').val(vat);
            let grand = subtotal + vat;
            $('#grand').val(grand);
        }

        $(document).keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                confirmItem();
            }
        });

        $(document).ready(function() {
            $(".delete-row").click(function() {
                $("table tbody").find('input[name="record"]').each(function() {
                    if ($(this).is(":checked")) {
                        $(this).parents("tr").remove();

                        var subtotal = 0;
                        let discounts = $(".total").each(function() {
                            subtotal += Number($(this).text());
                        });

                        $('#subtotal').val(subtotal);
                        let percent = '{{ $vat->percent }}';
                        let vat = subtotal * percent / 100;
                        $('#vat').val(vat);
                        let grand = subtotal + vat;
                        $('#grand').val(grand);
                    }
                });
            });
        });

        function calculateGrandTotal(discount) {
            let subtotal = $('#subtotal').val();
            let vat = $('#vat').val();
            let grand = parseFloat(subtotal) + parseFloat(vat);
            let total = parseFloat(grand) - parseFloat(discount);
            $('#grand').val(total);
        }

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

        $(function() {
            $('#cheque_date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "dd-mm-yy",
                yearRange: "-0:+1"
            });
        });

        $('#item_id').change(function() {

            var price = $(this).find(':selected').attr('data-price');
            $('#quantity').val(1);
            $('#price').val(price);
            $('#total').val(price);
        });
    </script>
@endsection
