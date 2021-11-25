@extends('backend.layouts.app')
@section('title', 'Room discount List')
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
                    <!-- Content Header (discount header) -->
                    <div class="box box-purple box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Room discount List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.room-discounts.create') }}"
                                    class="btn btn-sm bg-green"><i class="fa fa-plus"></i>
                                    {{ __('New Room discount') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Sl.') }}</th>
                                        <th style="width: 20%;">{{ __('Room') }}</th>
                                        <th style="width: 20%;">{{ __('Discount') }}</th>
                                        <th style="width: 20%;">{{ __('Start Date') }}</th>
                                        <th style="width: 20%;">{{ __('End Date') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomDiscounts as $key => $discount)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $discount->number }}</td>
                                            <td>{{ $discount->discount }}%</td>
                                            <td>{{ date('d M, Y', strtotime($discount->start_date)) }}</td>
                                            <td>{{ date('d M, Y', strtotime($discount->end_date)) }}</td>

                                            <td>
                                                <a class="btn btn-sm bg-purple"
                                                    href="{{ route('admin.room-discounts.edit', [$discount->id]) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form
                                                    action="{{ route('admin.room-discounts.destroy', [$discount->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $discount->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                    event.preventDefault();
                                                    getElementById('delete-form-{{ $discount->id }}').submit();
                                                    }else{
                                                    event.preventDefault();
                                                    }"><span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
