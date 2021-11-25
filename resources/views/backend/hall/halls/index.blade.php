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
                                <a href="{{ route('hall.halls.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Hall') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">{{ __('Sl.') }}</th>
                                        <th style="width: 15%;">{{ __('Name') }}</th>
                                        <th style="width: 15%;">{{ __('Category') }}</th>
                                        <th style="width: 15%;">{{ __('Capacity') }}</th>
                                        <th style="width: 15%;">{{ __('Board') }}</th>
                                        <th style="width: 15%;">{{ __('Stage') }}</th>
                                        <th style="width: 10%;">{{ __('Projector') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($halls as $key => $room)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $room->name }}</td>
                                            <td>{{ $room->category }}</td>
                                            <td>{{ $room->capacity }}</td>
                                            <td>
                                                @if ($room->board == 1)
                                                    {{ __('Available') }}
                                                @else
                                                    {{ __('Not Available') }}
                                                @endif

                                            </td>
                                            <td>
                                                @if ($room->stage == 1)
                                                    {{ __('Available') }}
                                                @else
                                                    {{ __('Not Available') }}
                                                @endif

                                            </td>
                                            <td>
                                                @if ($room->projector == 1)
                                                    {{ __('Available') }}
                                                @else
                                                    {{ __('Not Available') }}
                                                @endif

                                            </td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('hall.halls.edit', [$room->id]) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('hall.halls.destroy', [$room->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $room->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                    event.preventDefault();
                                                    getElementById('delete-form-{{ $room->id }}').submit();
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
