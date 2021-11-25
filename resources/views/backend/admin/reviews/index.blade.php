@extends('backend.layouts.app')
@section('title', 'Reviews')
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
                    <!-- Content Header (Hotel header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Reviews') }}</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">{{ __('Sl.') }}</th>
                                        <th style="width: 20%;">{{ __('Name') }}</th>
                                        <th style="width: 25%;">{{ __('Review') }}</th>
                                        <th style="width: 10%;">{{ __('Status') }}</th>
                                        <th style="width: 10%;">{{ __('Photo') }}</th>
                                        <th style="width: 15%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->review }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    {{ 'Not Approved' }}
                                                @else
                                                    {{ 'Approved' }}
                                                @endif
                                            </td>
                                            

                                            <td>
                                                <img src="{{ asset($item->photo) }}" alt=""
                                                    style="width: 50px; height: 50px;">

                                            </td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <a class="btn btn-sm bg-blue"
                                                        href="{{ route('admin.reviews.status', [$item->id, 1]) }}">Approve</a>
                                                @else
                                                    <a class="btn btn-sm bg-blue"
                                                        href="{{ route('admin.reviews.status', [$item->id, 0]) }}">Disapprove</a>
                                                @endif

                                                <form action="{{ route('admin.reviews.destroy', [$item->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $item->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href=""
                                                    onclick="if(confirm('Are You Sure To Delete?')){ event.preventDefault(); getElementById('delete-form-{{ $item->id }}').submit(); } else { event.preventDefault(); }"><span
                                                        class="glyphicon glyphicon-trash"></span></a>
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
