@extends('backend.layouts.app')
@section('title', 'New Table Booking')
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
                            <h3 class="box-title">{{ __('New Table Booking') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('restaurant.bookings.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Table Booking List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('restaurant.bookings.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Room') }}</label>
                                            <select name="room_id" class="form-control select2" id="number"
                                                style="width: 100%;" required="">
                                                <option value="">{{ __('Select Room Number') }}</option>
                                                @foreach ($rooms as $key => $room)
                                                    <option value="{{ $room->id }}" @if (old('id') == $room->id) {{ 'selected' }}  @endif>
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
                                                style="width: 100%;" required="">
                                                <option value="">{{ __('Select Table') }}</option>
                                                @foreach ($tables as $key => $table)
                                                    <option value="{{ $table->id }}" @if (old('table_id') == $table->id) {{ 'selected' }}  @endif>
                                                        {{ $table->number }}</option>
                                                @endforeach
                                            </select>
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
