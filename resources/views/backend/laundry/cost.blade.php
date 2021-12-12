@extends('backend.layouts.app')
@section('title', 'Daily Cost')
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
                            <h3 class="box-title">Daily Cost</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">
                            @include('includes.error')
                            <br>
                            @if (!isset($cost))
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('hall.costs.store') }}" method="post"
                                            class="form-horizontal">
                                            @csrf
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>{{ __('Date') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Date') }}" name="date"
                                                            value="{{ old('date') }}" autocomplete="off" required=""
                                                            id="date">
                                                        <input type="hidden" name="type" value="5">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>{{ __('Cause') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Cause') }}" name="cause"
                                                            value="{{ old('cause') }}" autocomplete="off" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="">Payment Method</label>
                                                        <select name="payment_method" id="method"
                                                            class="form-control select2" style="width: 100%"
                                                            onchange="showHidePayment()">
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
                                                        <label>{{ __('Amount') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Amount') }}" name="amount"
                                                            value="{{ old('amount') }}" autocomplete="off" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="reset"
                                                        class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-sm bg-teal">{{ __('Save') }}</button>
                                                </center>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('hall.costs.update', $cost->id) }}" method="post"
                                            class="form-horizontal">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>{{ __('Date') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Date') }}" name="date"
                                                            value="{{ $cost->date }}" autocomplete="off" required=""
                                                            id="date">
                                                        <input type="hidden" name="type" value="5">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>{{ __('Cause') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Cause') }}" name="cause"
                                                            value="{{ $cost->cause }}" autocomplete="off" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>{{ __('Amount') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Amount') }}" name="amount"
                                                            value="{{ $cost->amount }}" autocomplete="off" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="reset"
                                                        class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-sm bg-teal">{{ __('Update') }}</button>
                                                </center>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Sl.</th>
                                                <th style="width: 15%">Date</th>
                                                <th style="width: 45%">Cause</th>
                                                <th style="width: 20%">Amount</th>
                                                <th style="width: 15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($costs as $key => $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ date('d M, Y', strtotime($item->date)) }}</td>
                                                    <td>{{ $item->cause }}</td>
                                                    <td>{{ $item->amount }}</td>
                                                    <td>
                                                        {{-- <a class="btn btn-sm bg-teal"
                                                            href="{{ route('hall.costs.edit', $item->id) }}"><span
                                                                class="glyphicon glyphicon-edit"></span></a>

                                                         <form action="{{ route('hall.costs.destroy', $item->id) }}"
                                                            method="post" style="display: none;"
                                                            id="delete-form-{{ $item->id }}">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                        </form>
                                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                            event.preventDefault();
                                                            getElementById('delete-form-{{ $item->id }}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }"><span class="glyphicon glyphicon-trash"></span></a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
            $('#date').datepicker({
                autoclose: true,
                changeYear: true,
                changeMonth: true,
                dateFormat: "dd-mm-yy",
                yearRange: "-10:+0"
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
            } else {
                $('#bank').hide();
                $('#MFS').hide();
            }
        }
    </script>
@endsection
