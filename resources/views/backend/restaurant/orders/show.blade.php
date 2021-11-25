@extends('backend.layouts.app')
@section('title', 'Sale Details')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ __('Dashboard') }}
                <small>Version 1.0</small>
            </h1>
        </section>
        <div class="pad margin no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <h4><i class="fa fa-info"></i> Note:</h4>
                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>
        </div>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> Invoice
                        <small class="pull-right">Date: {{ date('d/m/Y') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #{{ $order->invoice }}</b><br>
                    <b>Order Date:</b> {{ date('d/m/Y', strtotime($order->date)) }}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Item</th>
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
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
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

                    <div class="table-responsive" style="text-align: right">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>{{ $order->subtotal }}</td>
                            </tr>
                            <tr>
                                <th>Vat</th>
                                <td>{{ $order->vat }}</td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td>{{ $order->discount }}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>{{ $order->total }}</td>
                            </tr>
                            <tr>
                                <th>Method:</th>
                                <td>{{ $order->method }}</td>
                            </tr>
                            <tr>
                                <th>Paid:</th>
                                <td> {{ $order->paid }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            {{-- <div class="row no-print">
                <div class="col-xs-12">
                    <a href="{{ route('print.publication.sale.A4', $sale->id) }}" target="_blank"
                        class="btn btn-default"><i class="fa fa-print"></i> A4 Print</a>
                    <a href="{{ route('print.publication.sale.80mm', $sale->id) }}" target="_blank"
                        class="btn btn-default"><i class="fa fa-print"></i> 80mm Print</a>

                </div>
            </div> --}}
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection
