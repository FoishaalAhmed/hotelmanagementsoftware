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
                        <i class="fa fa-globe"></i> Tour Detail
                        <small class="pull-right">Date: {{ date('d/m/Y') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <center>
                        <h1>Tour Info</h1>
                    </center>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Guide') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Package') }}</th>
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Charge') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>{{ $tour->name }}</td>
                            <td>{{ $tour->type }}</td>
                            <td>{{ $tour->package }}</td>
                            <td>{{ $tour->duration }}</td>
                            <td>{{ $tour->charge }}</td>
                        </tbody>
                    </table>
                    <br />
                    <center>
                        <h1>User Info</h1>
                    </center>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Room</th>
                                <th>Person</th>
                                <th>Name</th>
                                <th>Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->number }}</td>
                                    <td>{{ $item->person }} </td>
                                    <td>{{ $item->names }}</td>
                                    <td>{{ $item->paid }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->

        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection
