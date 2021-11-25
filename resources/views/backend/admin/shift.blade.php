@extends('backend.layouts.app')
@section('title', 'Shift')
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
                        <h3 class="box-title">Shift</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="box-body">
                        @include('includes.error')
                        <br>
                        @if (!isset($shift))
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.shifts.store') }}" method="post"
                                        class="form-horizontal">
                                        @csrf
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="name">{{ __('Name') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Name') }}" name="name"
                                                        value="{{ old('name') }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group bootstrap-timepicker ">
                                                <div class="col-md-12">
                                                    <label for="start">{{ __('Shift Start') }}</label>
                                                    <input type="text" class="form-control timepicker"
                                                        placeholder="{{ __('Shift Start') }}" name="start"
                                                        value="{{ old('start') }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group bootstrap-timepicker">
                                                <div class="col-md-12">
                                                    <label for="end">{{ __('Shift End') }}</label>
                                                    <input type="text" class="form-control timepicker"
                                                        placeholder="{{ __('Shift End') }}" name="end"
                                                        value="{{ old('end') }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label for=""><br /></label>
                                            <button type="submit"
                                                class="btn btn-sm bg-teal form-control">{{ __('Save') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.shifts.update', $shift->id) }}" method="post"
                                        class="form-horizontal">
                                        @csrf
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="name">{{ __('Name') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Name') }}" name="name"
                                                        value="{{ $shift->name }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group bootstrap-timepicker ">
                                                <div class="col-md-12">
                                                    <label for="start">{{ __('Shift Start') }}</label>
                                                    <input type="text" class="form-control timepicker"
                                                        placeholder="{{ __('Shift Start') }}" name="start"
                                                        value="{{ $shift->start }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group bootstrap-timepicker">
                                                <div class="col-md-12">
                                                    <label for="end">{{ __('Shift End') }}</label>
                                                    <input type="text" class="form-control timepicker"
                                                        placeholder="{{ __('Shift End') }}" name="end"
                                                        value="{{ $shift->end }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label for=""><br /></label>
                                            <button type="submit"
                                                class="btn btn-sm bg-teal form-control">{{ __('Update') }}</button>
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
                                            <th style="width: 55%">Name</th>
                                            <th style="width: 15%">Shift End</th>
                                            <th style="width: 15%">Shift Start</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shifts as $key => $shift)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $shift->name }}</td>
                                                <td>{{ date('h:i A', strtotime($shift->start)) }}</td>
                                                <td>{{ date('h:i A', strtotime($shift->end)) }}</td>
                                                <td>
                                                    <a class="btn btn-sm bg-teal"
                                                        href="{{ route('admin.shifts.edit', $shift->id) }}"><span
                                                            class="glyphicon glyphicon-edit"></span></a>
                                                    <form
                                                        action="{{ route('admin.shifts.destroy', $shift->id) }}"
                                                        method="post" style="display: none;"
                                                        id="delete-form-{{ $shift->id }}">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                    </form>
                                                    <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                    event.preventDefault();
                                                    getElementById('delete-form-{{ $shift->id }}').submit();
                                                    }else{
                                                    event.preventDefault();
                                                    }"><span class="glyphicon glyphicon-trash"></span></a>
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
        $('.timepicker').timepicker({
            showInputs: false
        })
    });
</script>
@endsection
