@extends('backend.layouts.app')
@section('title', 'Package')
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
                            <h3 class="box-title">Package</h3>
                            <div class="box-tools pull-right">
                                <a href="#" class="btn btn-sm bg-green" data-toggle="modal" data-target="#myModal"><i
                                        class="fa fa-plus"></i> New Package</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">
                            @include('includes.error')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Sl.</th>
                                        <th style="width: 35%">Package</th>
                                        <th style="width: 35%">Duration</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->duration }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-teal" href="#" data-toggle="modal"
                                                    data-target="#edit-modal" data-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}" data-duration="{{ $item->duration }}" ><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('tour.packages.destroy', [$item->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $item->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" style="display: none;" onclick="if(confirm('Are You Sure To Delete?')){
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

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ __('New Package') }}</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tour.packages.store') }}" method="POST" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">{{ __('name') }}</label>
                            <div class="col-sm-9">
                                <input name="name" placeholder="{{ __('name') }}" class="form-control" required=""
                                    type="text" value="{{ old('name') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">{{ __('Duration') }}</label>
                            <div class="col-sm-9">
                                <input name="duration" placeholder="{{ __('Duration') }}" class="form-control"
                                    required="" type="text" value="{{ old('duration') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <center>
                                <button type="reset" class="btn btn-sm bg-red"
                                    data-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-sm bg-teal">{{ __('Save') }}</button>
                            </center>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="edit-modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Package Update</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label col-md-2">{{ __('Name') }}</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" placeholder="{{ __('Name') }}" class="form-control"
                                    required="" type="text" value="{{ old('name') }}" autocomplete="off">
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">{{ __('Duration') }}</label>
                            <div class="col-sm-9">
                                <input name="duration" id="duration" placeholder="{{ __('Duration') }}"
                                    class="form-control" required="" type="text" value="{{ old('duration') }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <center>
                                <button type="reset" class="btn btn-sm bg-red"
                                    data-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-sm bg-teal">{{ __('Update') }}</button>
                            </center>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $('#edit-modal').on("show.bs.modal", function(event) {

            var e = $(event.relatedTarget);
            var id = e.data('id');
            var name = e.data('name');
            var duration = e.data('duration');

            var action = '{{ URL::to('/tour/packages/update') }}';

            $("#edit-form").attr('action', action);
            $("#id").val(id);
            $("#name").val(name);
            $("#duration").val(duration);

        });
    </script>
@endsection