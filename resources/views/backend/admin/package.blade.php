@extends('backend.layouts.app')
@section('title', 'Packages')
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
                        <h3 class="box-title">Packages</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="box-body">
                        @include('includes.error')
                        <br>
                        @if (!isset($package))
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.packages.store') }}" method="post"
                                        class="form-horizontal">
                                        @csrf
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <label>{{ __('Name') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Name') }}" name="name"
                                                        value="{{ old('name') }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <label>{{ __('Discount Percentage') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Discount Percentage') }}" name="percent"
                                                        value="{{ old('percent') }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
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
                                    <form action="{{ route('admin.packages.update', $package->id) }}" method="post"
                                        class="form-horizontal">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <label>{{ __('Name') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Name') }}" name="name"
                                                        value="{{ $package->name }}" autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <label>{{ __('Discount Percentage') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Discount Percentage') }}" name="percent"
                                                        value="{{ $package->percent }}" autocomplete="off"
                                                        required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for=""><br /></label>
                                            <button type="submit"
                                                class="btn btn-sm bg-teal form-control">{{ __('Update') }}</button>
                                        </div>
                                        <div class="col-md-2"></div>
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
                                            <th style="width: 60%">Name</th>
                                            <th style="width: 20%">Name</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($packages as $key => $package)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $package->name }}</td>
                                                <td>{{ $package->percent }}</td>
                                                <td>
                                                    <a class="btn btn-sm bg-teal"
                                                        href="{{ route('admin.packages.edit', $package->id) }}"><span
                                                            class="glyphicon glyphicon-edit"></span></a>
                                                    <form
                                                        action="{{ route('admin.packages.destroy', $package->id) }}"
                                                        method="post" style="display: none;"
                                                        id="delete-form-{{ $package->id }}">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                    </form>
                                                    <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                    event.preventDefault();
                                                    getElementById('delete-form-{{ $package->id }}').submit();
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
