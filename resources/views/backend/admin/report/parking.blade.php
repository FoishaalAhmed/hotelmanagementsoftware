@extends('backend.layouts.app')

@section('title', 'Parking Report')
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
                            <h3 class="box-title">Parking Report</h3>
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

                            @if (isset($parkings))
                                <br> <br>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">{{ __('Sl.') }}</th>
                                            <th style="width: 10%;">{{ __('Date') }}</th>
                                            <th style="width: 15%;">{{ __('Category') }}</th>
                                            <th style="width: 10%;">{{ __('Room') }}</th>
                                            <th style="width: 10%;">{{ __('Ticket') }}</th>
                                            <th style="width: 10%;">{{ __('In') }}</th>
                                            <th style="width: 10%;">{{ __('Out') }}</th>
                                            <th style="width: 10%;">{{ __('Charge') }}</th>
                                            <th style="width: 10%;">{{ __('Method') }}</th>
                                            <th style="width: 10%;">{{ __('Paid') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($parkings as $key => $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d M, Y', strtotime($item->created_at)) }} </td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{ $item->ticket }}</td>
                                                <td>{{ date('h:i A', strtotime($item->in_time)) }}</td>
                                                <td>{{ date('h:i A', strtotime($item->out_time)) }}</td>
                                                <td>{{ $item->charge }}</td>
                                                <td>{{ $item->method }}</td>
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
