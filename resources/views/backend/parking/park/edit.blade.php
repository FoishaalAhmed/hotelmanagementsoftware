@extends('backend.layouts.app')
@section('title', 'Parking Update')
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
                    <!-- Content Header (Parking header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Parking Update') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('parking.parkings.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Parking List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('parking.parkings.update', $parking->id) }}" method="POST"
                                class="form-horizontal" enctype="multipart/form-data" id="orderForm">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label>{{ __('Room') }}</label>
                                            <select name="room_id" class="form-control select2" id="room_id"
                                                style="width: 100%;">
                                                <option value="">{{ __('Select Room') }}</option>
                                                @foreach ($rooms as $key => $room)
                                                    <option value="{{ $room->id }}" @if ($parking->room_id == $room->id) {{ 'selected' }}  @endif>
                                                        {{ $room->number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Category') }}</label>
                                            <select name="category_id" class="form-control select2" id="category_id"
                                                style="width: 100%;" required="">
                                                <option value="">{{ __('Select category Type') }}</option>
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{ $category->id }}" @if ($parking->vehicle_category_id == $category->id) {{ 'selected' }}  @endif>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Charge Type') }}</label>
                                            <select name="charge_id" class="form-control select2" id="charge_id"
                                                style="width: 100%;" required="">
                                                <option value="">{{ __('Select Charge Type') }}</option>
                                                @foreach ($charges as $key => $charge)
                                                    <option value="{{ $charge->id }}" @if ($parking->charge_id == $charge->id) {{ 'selected' }}  @endif
                                                        data-charge="{{ $charge->charge }}">
                                                        {{ $charge->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Vehicle') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Vehicle') }}"
                                                        value="{{ $parking->vehicle }}" autocomplete="off" required=""
                                                        id="vehicle" name="vehicle">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Registration Number') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Registration Number') }}"
                                                        value="{{ $parking->registration_number }}" autocomplete="off"
                                                        required="" id="registration_number" name="registration_number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group bootstrap-timepicker">
                                                <div class="col-md-12">
                                                    <label>{{ __('In Time') }}</label>
                                                    <input type="text" class="form-control timepicker"
                                                        placeholder="{{ __('In Time') }}"
                                                        value="{{ $parking->in_time }}" autocomplete="off" required=""
                                                        id="in_time" name="in_time">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group bootstrap-timepicker">
                                                <div class="col-md-12">
                                                    <label>{{ __('Out Time') }}</label>
                                                    <input type="text" class="form-control timepicker"
                                                        placeholder="{{ __('Out Time') }}"
                                                        value="@if ($parking->out_time != null) {{ $parking->out_time }} @endif" name="out_time" autocomplete="off"
                                                        id="out_time">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Charge') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Charge') }}"
                                                        value="{{ $parking->charge }}" name="charge" autocomplete="off"
                                                        required="" id="charge">
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
                                                        placeholder="Paid" value="{{ $parking->paid }}"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Status</label>
                                                    <select name="status" id="status" class="form-control select2"
                                                        style="width: 100%">
                                                        <option value="1" @if ($parking->status == 1) {{ 'selected' }} @endif>
                                                            {{ __('IN') }}</option>
                                                        <option value="2" @if ($parking->status == 2) {{ 'selected' }} @endif>
                                                            {{ __('OUT') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="">Remark</label>
                                                    <textarea name="remark" id="remark" class="form-control" rows="3"
                                                        placeholder="Remark">{{ $parking->remark }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn-sm bg-blue">{{ __('Update') }}</button>
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
        $(function() {
            $('.timepicker').timepicker({
                showInputs: false
            })
        });

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
    </script>
@endsection
