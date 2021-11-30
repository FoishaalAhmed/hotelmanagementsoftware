@extends('backend.layouts.app')
@section('title', 'New Hall Booking')
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
                    <!-- Content Header (hall Booking header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Hall Booking') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('hall.bookings.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Hall Booking List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('hall.bookings.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Hall') }}</label>
                                                <select name="hall_id" class="form-control select2" id="hall_id" required=""
                                                    style="width: 100%">
                                                    @foreach ($halls as $item)
                                                        <option value="{{ $item->id }}" @if (old('hall_id') == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Type') }}</label>
                                                <select name="type" class="form-control select2" id="type" required=""
                                                    style="width: 100%" onchange="hideShowRoomOutSide(this.value)">
                                                    <option value="In House">{{ __('In House') }}</option>
                                                    <option value="Outside">{{ __('Outside') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="room">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Room') }}</label>
                                                <select name="room_id" class="form-control select2" id="room_id" 
                                                    style="width: 100%">
                                                    <option value="">{{ __('Select Room') }}</option>
                                                    @foreach ($rooms as $item)
                                                        <option value="{{ $item->id }}" @if (old('room_id') == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="outSide" style="display: none">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Name') }}</label>
                                                    <input name="name" placeholder="{{ __('Name') }}"
                                                        class="form-control" type="text" value="{{ old('name') }}"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Phone') }}</label>
                                                    <input name="phone" placeholder="{{ __('Phone') }}"
                                                        class="form-control" type="text" value="{{ old('phone') }}"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('E-mail') }}</label>
                                                    <input name="email" placeholder="{{ __('E-mail') }}"
                                                        class="form-control" type="email" value="{{ old('email') }}"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Address') }}</label>
                                                    <input name="address" placeholder="{{ __('Address') }}"
                                                        class="form-control" type="text" value="{{ old('address') }}"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Booking Type') }}</label>
                                                <select name="booking_type" class="form-control select2" id="booking_type"
                                                    required="" style="width: 100%"
                                                    onchange="hideShowBookingInfo(this.value)">
                                                    <option value="">{{ __('Select Booking Type') }}</option>
                                                    <option value="Hourly">{{ __('Hourly') }}</option>
                                                    <option value="Daily">{{ __('Daily') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="hourly">
                                        <div class="col-md-4">
                                            <div class="form-group bootstrap-timepicker">
                                                <div class="col-md-12">
                                                    <label>{{ __('Start Time') }}</label>
                                                    <input name="start_time" placeholder="{{ __('Start Time') }}"
                                                        class="form-control timepicker" type="text"
                                                        value="{{ old('start_time') }}" autocomplete="off" id="start_time">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group bootstrap-timepicker">
                                                <div class="col-md-12">
                                                    <label>{{ __('End Time') }}</label>
                                                    <input name="end_time" placeholder="{{ __('End Time') }}"
                                                        class="form-control timepicker" type="text"
                                                        value="{{ old('end_time') }}" autocomplete="off" id="end_time" onchange="getTimeOrdate()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="daily" style="display: none">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Start Date') }}</label>
                                                    <input name="start_date" placeholder="{{ __('Start Date') }}"
                                                        class="form-control" type="text"
                                                        value="{{ old('start_date') }}" autocomplete="off"
                                                        id="start_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('End Date') }}</label>
                                                    <input name="end_date" placeholder="{{ __('End Date') }}"
                                                        class="form-control" type="text" value="{{ old('end_date') }}" autocomplete="off" id="end_date" onchange="getTimeOrdate()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Rent') }}</label>
                                                <input name="rent" placeholder="{{ __('Rent') }}" class="form-control" type="text" value="{{ old('rent') }}" autocomplete="off" id="rent">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Payment Method</label>
                                                <select name="payment_method" id="method" class="form-control select2" style="width: 100%" onchange="showHidePayment()">
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
                                                            <option value="{{ $item->id }}" @if (old('bank') == $item->id) {{ 'selected' }} @endif>
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
                                                            <option value="{{ $item->id }}" @if (old('mfs_payment_type') == $item->id) {{ 'selected' }} @endif>
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
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-blue">{{ __('Save') }}</button>
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
        function hideShowRoomOutSide(type) {
            if (type == 'In House') {
                $('#room').show();
                $('#outSide').hide();
            } else {
                $('#room').hide();
                $('#outSide').show();
            }
        }

        $(function() {
            $('#start_date, #end_date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "mm/dd/yy",
                yearRange: "-0:+10"
            });

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

        function hideShowBookingInfo(bookingType) {
            if (bookingType == 'Hourly') {
                $('#hourly').show();
                $('#daily').hide();
            } else {
                $('#hourly').hide();
                $('#daily').show();
            }
        }

        function getTimeOrdate() {

            var bookingType = $('#booking_type').val();
            var hall_id = $('#hall_id').val();
            $.ajaxSetup({

                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }

            });

            $.ajax({

                url: "{{ route('hall.get.rent') }}",
                method: 'POST',
                data: {
                    'type': bookingType,
                    'hall_id': hall_id,
                },

                success: function(data2) {
                    
                    var data = JSON.parse(data2);
                    if (bookingType == 'Hourly') {
                        var time1 = $('#start_time').val();
                        var time2 = $('#end_time').val();

                        var timeStart = new Date("01/01/2007 " + time1).getHours();
                        var timeEnd = new Date("01/01/2007 " + time2).getHours();

                        var hourDiff = timeEnd - timeStart;   
                        var rent = hourDiff * data.rent;

                    } else {
                        let check_in = $('#start_date').val();
                        let check_out = $('#end_date').val();
                        let inn = new Date(check_in);
                        let out = new Date(check_out);
                        const diffTime = Math.abs(out - inn);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        const date = diffDays + 1;
                        var rent = date * data.rent;
                    }

                    $('#rent').val(rent);
                },

                error: function(error) {

                    console.log(error);
                }


            });
        }
    </script>
@endsection
