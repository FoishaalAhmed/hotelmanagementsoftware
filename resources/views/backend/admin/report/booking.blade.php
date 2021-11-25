@extends('backend.layouts.app')

@section('title', 'Cost Report')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">Booking Report</li>
            </ol>
        </section>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Content Header (customer header) -->
                    <div class="box box-purple box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Booking Report</h3>
                            <div class="box-tools pull-right">

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="" method="get" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Start date</label>
                                            <input type="text" class="form-control" placeholder="start date"
                                                name="start_date" value="{{ old('start_date') }}" id="start_date"
                                                autocomplete="off">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>End date</label>
                                            <input type="text" class="form-control" placeholder="end date" name="end_date"
                                                value="{{ old('end_date') }}" id="end_date" autocomplete="off">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label><br></label>
                                    <button type="submit" class="btn btn-sm bg-purple form-control">Search</button>
                                </div>
                            </form>

                            @if (isset($bookings))
                                <br> <br>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sl.</th>
                                            <th style="width: 10%;">Booked At</th>
                                            <th style="width: 15%;">Client</th>
                                            <th style="width: 15%;">Email</th>
                                            <th style="width: 10%;">Phone</th>
                                            <th style="width: 13%;">Address</th>
                                            <th style="width: 8%;">Room</th>
                                            <th style="width: 8%;">Adult</th>
                                            <th style="width: 8%;">Children</th>
                                            <th style="width: 8%;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($bookings as $value)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d M, Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->room }}</td>
                                                <td>{{ $value->adult }}</td>
                                                <td>{{ $value->children }}</td>
                                                <td>{{ $value->total }} <?php $total += $value->total ?> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tr>
                                            <td colspan="9" style="text-align: right; font-weight: bold">{{ __('Total') }}</td>
                                            <td>{{ $total }} </td>
                                        </tr>
                                </table>
                            @endif
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
