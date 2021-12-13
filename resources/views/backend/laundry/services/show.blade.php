@extends('backend.layouts.app')

@section('title', 'Laundry Service Detail')
@section('content')
    <div class="content-wrapper" style="min-height: 1136.3px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ __('Dashboard') }}
                <small>Version 2.0</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="invoice">

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Serial #</th>
                                <th>Product</th>
                                <th>Wash Type</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->charge }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-9">
                    
                </div>
                <!-- /.col -->
                <div class="col-xs-3">

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Room:</th>
                                    <td>{{ $room->number }}</td>
                                </tr>
                                <tr>
                                    <th>Charge</th>
                                    <td>{{ $service->charge }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>{{ $service->method }}</td>
                                </tr>
                                <tr>
                                    <th>Paid:</th>
                                    <td>{{ $service->paid }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection
