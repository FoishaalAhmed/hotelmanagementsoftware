@extends('backend.layouts.app')
@section('title', 'Update Coupon')
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
                            <h3 class="box-title">{{ __('Update Coupon') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.coupons.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Coupon List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Code') }}</label>
                                                <input name="code" placeholder="{{ __('Code') }}" class="form-control"
                                                    required="" type="text" value="{{ $coupon->code }}"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Amount') }}</label>
                                                <input type="number" class="form-control"
                                                    placeholder="{{ __('Amount') }}" name="amount"
                                                    value="{{ $coupon->amount }}" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Expire') }}</label>
                                                <input name="expire" placeholder="{{ __('Expire') }}"
                                                    class="form-control" type="text" value="{{ $coupon->expire }}"
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
                                                    <option value="1" @if ($coupon->status == 1) {{ 'selected' }}

                                                        @endif>{{ __('Active') }}</option>
                                                    <option value="0" @if ($coupon->status == 0) {{ 'selected' }}

                                                        @endif>{{ __('Inactive') }}</option>
                                                </select>
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
