@extends('backend.layouts.app')
@section('title', 'Parking Charge')
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
                            <h3 class="box-title">Parking Charge</h3>
                            <div class="box-tools pull-right">

                                <a href="#" class="btn btn-sm bg-green" data-toggle="modal" data-target="#myModal"><i
                                        class="fa fa-plus"></i> New Parking Charge</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">
                            @include('includes.error')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Sl.</th>
                                        <th style="width: 30%">Category</th>
                                        <th style="width: 20%">Type</th>
                                        <th style="width: 20%">Charge</th>
                                        <th style="width: 15%">Action</th>
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


                                                <a class="btn btn-sm bg-teal" href="#" data-toggle="modal"
                                                    data-target="#edit-modal" data-id="{{ $item->id }}"
                                                    data-category="{{ $item->category }}" data-type="{{ $item->type }}"
                                                    data-charge="{{ $item->charge }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('parking.charges.destroy', $item->id) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $item->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href=""
                                                    onclick="if(confirm('Are You Sure To Delete?')){ event.preventDefault(); getElementById('delete-form-{{ $item->id }}').submit();  } else { event.preventDefault(); }"><span
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

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Parking Charge</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('parking.charges.store') }}" method="POST" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">Category</label>
                            <div class="col-sm-9">
                                <select name="category" class="form-control select2" required style="width: 100%">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" @if (old('category') == $item->id) {{ 'selected' }} @endif>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Type</label>
                            <div class="col-sm-9">
                                <select name="type" class="form-control" required style="width: 100%">
                                    <option value="Hourly" @if (old('type') == 'Hourly') {{ 'selected' }} @endif>{{ __('Hourly') }}</option>
                                    <option value="Daily" @if (old('type') == 'Daily') {{ 'selected' }} @endif>{{ __('Daily') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Charge</label>
                            <div class="col-sm-9">
                                <input name="charge" placeholder="Charge" class="form-control" required="" type="number"
                                    value="{{ old('charge') }}" autocomplete="off">
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
                    <h4 class="modal-title">Parking Charge Update</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label col-md-2">Category</label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-control select2" required style="width: 100%">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" @if (old('category') == $item->id) {{ 'selected' }} @endif>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Type</label>
                            <div class="col-sm-9">
                                <select name="type" id="type" class="form-control" required style="width: 100%">
                                    <option value="Hourly" @if (old('type') == 'Hourly') {{ 'selected' }} @endif>{{ __('Hourly') }}</option>
                                    <option value="Daily" @if (old('type') == 'Daily') {{ 'selected' }} @endif>{{ __('Daily') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Charge</label>
                            <div class="col-sm-9">
                                <input name="charge" placeholder="Charge" class="form-control" required="" type="number"
                                    value="{{ old('charge') }}" autocomplete="off" id="charge">
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
            var category = e.data('category');
            var type = e.data('type');
            var charge = e.data('charge');

            var action = '{{ URL::to('parking/charges/update') }}';

            $("#edit-form").attr('action', action);
            $("#id").val(id);
            $("#category").val(category);
            $("#category").trigger('change');
            $("#type").val(type);
            $("#charge").val(charge);

        });
    </script>
@endsection
