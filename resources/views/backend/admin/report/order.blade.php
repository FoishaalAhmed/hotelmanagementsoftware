@extends('backend.layouts.app')

@section('title', 'Restaurant Report')
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
                    <!-- Content Header (customer header) -->
                    <div class="box box-purple box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Restaurant Report</h3>
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

                            @if (isset($orders))
                                <br> <br>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">{{ __('Sl.') }}</th>
                                            <th style="width: 20%;">{{ __('Date & Time') }}</th>
                                            <th style="width: 10%;">{{ __('Invoice') }}</th>
                                            <th style="width: 15%;">{{ __('Room') }}</th>
                                            <th style="width: 15%;">{{ __('Table') }}</th>
                                            <th style="width: 15%;">{{ __('Total') }}</th>
                                            <th style="width: 15%;">{{ __('Paid') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $key => $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d M, Y', strtotime($item->date)) }}
                                                    {{ date('h:i A', strtotime($item->time)) }}</td>
                                                <td>{{ $item->invoice }}</td>
                                                <td>{{ $item->room }}</td>
                                                <td>{{ $item->table }}</td>
                                                <td>{{ $item->total }}</td>
                                                <td>{{ $item->paid }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
