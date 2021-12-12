@extends('backend.layouts.app')
@section('title', 'Laundry Charge Update')
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
                    <!-- Content Header (hall header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Laundry Charge Update') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('laundry.charges.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Laundry Charge List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('laundry.charges.update', $charge->id) }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Product') }}</label>
                                                <select name="laundry_product_id" class="form-control select2" id="laundry_product_id"
                                                    required="" style="width: 100%">
                                                    @foreach ($products as $item)
                                                        <option value="{{ $item->id }}" @if ($charge->laundry_product_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Wash Type') }}</label>
                                                <select name="type" class="form-control" id="type" style="width: 100%"
                                                    required=''>
                                                    <option value="Normal" @if ($charge->type == 'Normal') {{ 'selected' }}

                                                        @endif>{{ __('Normal') }}</option>
                                                    <option value="Dry" @if ($charge->type == 'Dry') {{ 'selected' }}

                                                        @endif>{{ __('Dry') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Charge') }}</label>
                                                <input name="charge" placeholder="{{ __('Charge') }}"
                                                    class="form-control" type="numeric" value="{{ $charge->charge }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-blue">{{ __('Update') }}</button>
                                    </center>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
