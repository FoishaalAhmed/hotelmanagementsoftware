@extends('backend.layouts.app')
@section('title', 'Laundry Charge List')
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
                    <!-- Content Header (Laundry Charge header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Laundry Charge List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('laundry.charges.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Laundry Charge') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Sl.') }}</th>
                                        <th style="width: 50%;">{{ __('Product') }}</th>
                                        <th style="width: 15%;">{{ __('Type') }}</th>
                                        <th style="width: 15%;">{{ __('Charge') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($charges as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->charge }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('laundry.charges.edit', [$item->id]) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('laundry.charges.destroy', [$item->id]) }}" method="post"
                                                    style="display: none;" id="delete-form-{{ $item->id }}">
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
