@extends('backend.layouts.app')
@section('title', 'Coupon List')
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
                    <!-- Content Header (Coupon header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Coupon List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.coupons.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Coupon') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Sl.') }}</th>
                                        <th style="width: 20%;">{{ __('Code') }}</th>
                                        <th style="width: 20%;">{{ __('Amount') }}</th>
                                        <th style="width: 20%;">{{ __('Expire') }}</th>
                                        <th style="width: 20%;">{{ __('Status') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($coupons as $key => $coupon)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->amount }}</td>
                                            <td>{{ $coupon->expire }}</td>
                                            <td>
                                                @if ($coupon->status == 0)
                                                    {{ 'Inactive' }}
                                                @else
                                                    {{ 'Active' }}
                                                @endif
                                                
                                            </td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('admin.coupons.edit', [$coupon->id]) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('admin.coupons.destroy', [$coupon->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $coupon->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                event.preventDefault();
                                                getElementById('delete-form-{{ $coupon->id }}').submit();
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
