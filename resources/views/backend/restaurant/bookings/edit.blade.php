@extends('backend.layouts.app')
@section('title', 'Table Booking Update')
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
                    <!-- Content Header (Table Booking header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Table Booking Update') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('restaurant.bookings.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Table Booking List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('restaurant.bookings.update', $booking->id) }}" method="POST"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Room') }}</label>
                                            <select name="room_id" class="form-control select2" id="number"
                                                style="width: 100%;" required="">
                                                <option value="">{{ __('Select Room Number') }}</option>
                                                @foreach ($rooms as $key => $item)
                                                    <option value="{{ $item->id }}" @if ($room->id == $item->id) {{ 'selected' }}  @endif>
                                                        {{ $item->number }}</option>
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
                                                style="width: 100%;" required="">
                                                <option value="">{{ __('Select Table') }}</option>
                                                <option value="{{ $table->id }}" @if ($booking->table_id == $table->id) {{ 'selected' }}  @endif>
                                                    {{ $table->number }} </option>

                                                @foreach ($tables as $key => $item)
                                                    <option value="{{ $item->id }}" @if ($booking->table_id == $item->id) {{ 'selected' }}  @endif>
                                                        {{ $item->number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Date') }}</label>
                                            <input type="text" class="form-control" id="date" placeholder="Check Out"
                                                name="date" autocomplete="off" value="{{ $booking->date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 bootstrap-timepicker">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Time') }}</label>
                                            <input type="text" class="form-control timepicker" id="start_time"
                                                placeholder="Check Out" name="start_time" autocomplete="off"
                                                value="{{ $booking->start_time }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('duration') }}</label>
                                            <input type="text" class="form-control" id="duration" placeholder="Check Out"
                                                name="duration" autocomplete="off" value="{{ $booking->duration }}">
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
            $('#date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "mm/dd/yy",
                yearRange: "-0:+1"
            });

            $('.timepicker').timepicker({
                showInputs: false
            })
        });
    </script>
@endsection
