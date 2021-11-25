@extends('backend.layouts.app')
@section('title', 'New Coupon')
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
                    <!-- Content Header (Coupon header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Coupon') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.coupons.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Coupon List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.coupons.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Code') }}</label>
                                                <input name="code" placeholder="{{ __('Code') }}" class="form-control"
                                                    required="" type="text" value="{{ old('code') }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Amount') }}</label>
                                                <input type="number" class="form-control"
                                                    placeholder="{{ __('Amount') }}" name="amount"
                                                    value="{{ old('amount') }}" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Expire') }}</label>
                                                <input name="expire" placeholder="{{ __('Expire') }}"
                                                    class="form-control" type="text" value="{{ old('expire') }}"
                                                    autocomplete="off" required="" id="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Status') }}</label>
                                                <select name="status" class="form-control" required="" id="status"
                                                    style="width: 100%">
                                                    <option value="1">{{ __('Active') }}</option>
                                                    <option value="0">{{ __('Inactive') }}</option>
                                                </select>
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
        $(function() {
            $('#date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "dd-mm-yy",
                yearRange: "-0:+1"
            });
        });
    </script>
@endsection
