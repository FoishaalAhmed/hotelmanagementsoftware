@extends('backend.layouts.app')
@section('title', 'Booking Vat')
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
                            <h3 class="box-title">Booking Vat</h3>
                            <div class="box-tools pull-right">

                                <a href="#" class="btn btn-sm bg-green" data-toggle="modal" data-target="#myModal"><i
                                        class="fa fa-plus"></i> New Booking Vat</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">
                            @include('includes.error')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Sl.</th>
                                        <th style="width: 70%">Vat</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($vat)
                                        <tr>
                                            <td>{{ 1 }}</td>
                                            <td>{{ $vat->vat }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-teal" href="#" data-toggle="modal"
                                                    data-target="#edit-modal" data-id="{{ $vat->id }}"
                                                    data-vat="{{ $vat->vat }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('admin.booking-vats.destroy', $vat->id) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $vat->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                event.preventDefault();
                                                getElementById('delete-form-{{ $vat->id }}').submit();
                                                }else{
                                                event.preventDefault();
                                                }"><span class="glyphicon glyphicon-trash"></span></a>
                                            </td>
                                        </tr>
                                    @endif
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
                    <h4 class="modal-title">New Vat</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.booking-vats.store') }}" method="POST" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">Vat</label>
                            <div class="col-sm-9">
                                <input name="vat" placeholder="Vat" class="form-control" required="" type="text"
                                    value="{{ old('vat') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <center>
                                <button type="reset" class="btn btn-sm bg-red" data-dismiss="modal">Reset</button>
                                <button type="submit" class="btn btn-sm bg-teal">Save</button>
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
                    <h4 class="modal-title">Vat Update</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label col-md-2">Vat</label>
                            <div class="col-sm-9">
                                <input name="vat" id="vat" placeholder="Vat" class="form-control" required="" type="text"
                                    value="{{ old('vat') }}" autocomplete="off">
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <center>
                                <button type="reset" class="btn btn-sm bg-red" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-sm bg-teal">Update</button>
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
            var vat = e.data('vat');

            var action = '{{ URL::to('admin/booking-vats/update') }}';

            $("#edit-form").attr('action', action);
            $("#id").val(id);
            $("#vat").val(vat);

        });
    </script>
@endsection
