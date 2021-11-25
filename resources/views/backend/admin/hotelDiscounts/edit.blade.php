@extends('backend.layouts.app')

@section('title', 'Update Hotel Discount')
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
                    <!-- Content Header (slider header) -->
                    <div class="box box-purple box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Update Hotel Discount') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.hotel-discounts.index') }}"
                                    class="btn btn-sm bg-green"><i class="fa fa-list"></i>
                                    {{ __('Hotel Discount List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form
                                action="{{ route('admin.hotel-discounts.update', [$hotelDiscount->id]) }}"
                                method="POST" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">{{ __('Discount') }}</label>
                                            <div class="col-md-9">

                                                <select name="discount_id" class="form-control select2" id="" required>

                                                    <option value="">{{ 'Select discount' }}</option>
                                                    @foreach ($discounts as $discount)
                                                        <option value="{{ $discount->id }}" @if ($discount->id == $hotelDiscount->discount_id) {{ 'selected' }} @endif>
                                                            {{ $discount->discount }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">{{ __('Start') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" name="start_date" id="start_date" class="form-control"
                                                    placeholder="{{ __('Start Date') }}" autocomplete="off"
                                                    value="{{ $hotelDiscount->start_date }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">{{ __('End') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" name="end_date" id="end_date" class="form-control"
                                                    placeholder="{{ __('End Date') }}" autocomplete="off"
                                                    value="{{ $hotelDiscount->end_date }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn-sm bg-purple">{{ __('Update') }}</button>
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
    <script type="text/javascript">
        $(function() {
            $('#start_date, #end_date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "dd-mm-yy",
                yearRange: "-10:+10"
            });
        });
    </script>
@endsection
