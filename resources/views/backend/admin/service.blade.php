@extends('backend.layouts.app')
@section('title', 'Service')
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
                            <h3 class="box-title">Service</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">
                            @include('includes.error')
                            <br>
                            @if (!isset($service))
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('admin.services.store') }}" method="post"
                                            class="form-horizontal">
                                            @csrf

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="name">{{ __('Services') }}</label>
                                                        <select name="service_id" id="service_id"
                                                            class="form-control select2" style="width: 100%" required>
                                                            @foreach ($services as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if (old('service_id') == $item->id) {{ 'selected' }} @endif>{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="name">{{ __('Charge Apply') }}</label>
                                                        <select name="charge" id="charge" class="form-control" required
                                                            style="width: 100%">
                                                            <option value="0" @if (old('charge') == '0') {{ 'selected' }} @endif>{{ __('No') }}
                                                            </option>
                                                            <option value="1" @if (old('charge') == '1') {{ 'selected' }} @endif>{{ __('Yes') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="charge_amount">{{ __('Amount') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Amount') }}" name="charge_amount"
                                                            value="{{ old('charge_amount') }}" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="reset"
                                                        class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-sm bg-teal">{{ __('Save') }}</button>
                                                </center>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('admin.services.update', $service->id) }}" method="post"
                                            class="form-horizontal">
                                            @csrf
                                            @method('PUT')

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="name">{{ __('Services') }}</label>
                                                        <select name="service_id" id="service_id"
                                                            class="form-control select2" style="width: 100%" required>
                                                            @foreach ($services as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if ($service->service_id == $item->id) {{ 'selected' }} @endif>{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="name">{{ __('Charge Apply') }}</label>
                                                        <select name="charge" id="charge" class="form-control" required
                                                            style="width: 100%">
                                                            <option value="0" @if ($service->charge == '0') {{ 'selected' }} @endif>{{ __('No') }}
                                                            </option>
                                                            <option value="1" @if ($service->charge == '1') {{ 'selected' }} @endif>{{ __('Yes') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="charge_amount">{{ __('Amount') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Amount') }}" name="charge_amount"
                                                            value="{{ $service->charge_amount }}" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="reset"
                                                        class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-sm bg-teal">{{ __('Update') }}</button>
                                                </center>

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
                                                <th style="width: 20%">Charge Apply</th>
                                                <th style="width: 10%">Amount</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hotelService as $key => $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $item->service }}</td>
                                                    <td> 
                                                        @if ($item->charge == 1)
                                                            {{ 'Yes' }}
                                                        @else
                                                            {{ 'No' }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->charge_amount }}</td>
                                                    <td>
                                                        <a class="btn btn-sm bg-teal"
                                                            href="{{ route('admin.services.edit', $item->id) }}"><span
                                                                class="glyphicon glyphicon-edit"></span></a>
                                                        <form action="{{ route('admin.services.destroy', $item->id) }}"
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
                                                                                }"><span
                                                                class="glyphicon glyphicon-trash"></span></a>
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
