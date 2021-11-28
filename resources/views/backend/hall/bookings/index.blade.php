@extends('backend.layouts.app')
@section('title', 'Hall List')
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
                    <!-- Content Header (Hall header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Hall List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('hall.bookings.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Hall') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">{{ __('Sl.') }}</th>
                                        <th style="width: 20%;">{{ __('Hall') }}</th>
                                        <th style="width: 25%;">{{ __('Booked By') }}</th>
                                        <th style="width: 10%;">{{ __('Type') }}</th>
                                        <th style="width: 15%;">{{ __('Duration') }}</th>
                                        <th style="width: 10%;">{{ __('Rent') }}</th>
                                        <th style="width: 10%;">{{ __('Paid') }}</th>
                                        <th style="width: 5%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($bookings as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->hall }}</td>
                                            <td>
                                                @if ($item->type == 'In House')
                                                    {{ $item->number }}
                                                @else
                                                    {{ __('Name') }}: {{ $item->name }} <br />
                                                    {{ __('Phone') }}: {{ $item->phone }} <br />
                                                    {{ __('E-mail') }}: {{ $item->email }} <br />
                                                    {{ __('Address') }}: {{ $item->address }}
                                                @endif
                                            </td>
                                            <td>{{ $item->booking_type }}</td>
                                            <td>
                                                @if ($item->booking_type == 'Daily')
                                                    {{ date('d M, Y', strtotime($item->start_date)) }} -
                                                    {{ date('d M, Y', strtotime($item->end_date)) }}
                                                @else
                                                    {{ date('h:i A', strtotime($item->start_time)) }} -
                                                    {{ date('h:i A', strtotime($item->end_time)) }}
                                                @endif
                                            </td>
                                            <td>{{ $item->rent }}</td>
                                            <td>{{ $item->paid }}</td>

                                            <td>
                                                <form action="{{ route('hall.bookings.destroy', [$item->id]) }}"
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
                                                        }"><span class="glyphicon glyphicon-trash"></span></a>
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

@section('footer')
@endsection
