@extends('backend.layouts.app')
@section('title', 'Service Charge')
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
                            <h3 class="box-title">Service Charge</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">
                            @include('includes.error')
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.serviceCharge.store') }}" method="post"
                                        class="form-horizontal">
                                        @csrf

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="room_number">{{ __('Room Number') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Room Number') }}" name="room_number"
                                                        value="{{ old('room_number') }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="name">{{ __('Service') }}</label>
                                                    <select name="service_id" id="service_id" class="form-control select2"
                                                        required style="width: 100%">
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->service_id }}"
                                                                @if (old('service_id') == '{{ $service->service_id }}') {{ 'selected' }} @endif>{{ $service->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="charge">{{ __('Charge Amount') }}</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="{{ __('Charge Amount') }}" name="charge"
                                                        value="{{ old('charge') }}" autocomplete="off" required="">
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="paid">{{ __('Paid Amount') }}</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="{{ __('Paid Amount') }}" name="paid"
                                                        value="{{ old('paid') }}" autocomplete="off" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label for=""><br /></label>
                                            <button type="submit"
                                                class="btn btn-sm bg-teal form-control">{{ __('Save') }}</button>
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
