@extends('backend.layouts.app')
@section('title', 'Bank Info')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
        </section>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Content Header (user header) -->
                    <div class="box box-teal box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bank Info</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">
                            @include('includes.error')
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.bank.info') }}" method="post" class="form-horizontal">
                                        @csrf
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Bank Name') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Bank Name') }}" name="bank"
                                                        value="{{ $hotel->bank }}" autocomplete="off" required=""
                                                        id="bank">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Account Number') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Account Number') }}" name="account_number"
                                                        value="{{ $hotel->account_number }}" autocomplete="off"
                                                        required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Contact Person') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Contact Person') }}" name="contact_person"
                                                        value="{{ $hotel->contact_person }}" autocomplete="off"
                                                        required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Contact Number') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Contact Number') }}" name="contact_number"
                                                        value="{{ $hotel->contact_number }}" autocomplete="off"
                                                        required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <center>
                                                <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                                <button type="submit"
                                                    class="btn btn-sm bg-teal">{{ __('Update') }}</button>
                                            </center>

                                        </div>
                                    </form>
                                </div>
                            </div>
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
            $('#date, #cheque_date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "dd-mm-yy",
                yearRange: "-10:+10"
            });
        });

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
    </script>
@endsection
