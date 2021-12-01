@extends('backend.layouts.app')
@section('title', 'New Booking')
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
                    <!-- Content Header (Booking header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Booking') }}</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('tour.tours.store') }}" class="form-horizontal" method="POST"
                                enctype="multipart/form-data" id="booking-form">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Guide') }}</label>
                                                    <select name="guide_id" id="guide_id" class="form-control select2"
                                                        required style="width: 100%">
                                                        @foreach ($guides as $item)
                                                            <option value="{{ $item->id }}" @if (old('guide_id') == $item->id) {{ 'selected' }} @endif>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Type') }}</label>
                                                    <select name="type" id="type" class="form-control" required
                                                        style="width: 100%" onchange="showHidePackage(this.value)">
                                                        <option value="">{{ __('Select Tour Type') }}</option>
                                                        <option value="Daily" @if (old('type') == 'Daily') {{ 'selected' }} @endif>{{ __('Daily') }}
                                                        </option>
                                                        <option value="Hourly" @if (old('type') == 'Hourly') {{ 'selected' }} @endif>
                                                            {{ __('Hourly') }}
                                                        </option>
                                                        <option value="Package" @if (old('type') == 'Package') {{ 'selected' }} @endif>
                                                            {{ __('Package') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="package" style="display: none">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Package') }}</label>
                                                    <select name="package_id" id="package_id" class="form-control"
                                                        style="width: 100%" onchange="getChargeByPackage(this.value)">
                                                        <option value="">{{ __('Select Package') }}
                                                        </option>
                                                        @foreach ($packages as $item)
                                                            <option value="{{ $item->id }}" @if (old('package_id') == $item->id) {{ 'selected' }} @endif>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="inputCheckOut">Duration</label>
                                                    <input type="text" class="form-control" id="duration"
                                                        placeholder="Duration" name="duration" autocomplete="off"
                                                        value="{{ old('duration') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Charge') }}</label>
                                                    <input name="charge" placeholder="{{ __('Charge') }}"
                                                        class="form-control" type="text" value="{{ old('charge') }}"
                                                        autocomplete="off" required="" id="charge">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group table-responsive">

                                                <table class="table" style="width: 100%;">

                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">Sl.</th>
                                                            <th style="width: 15%;">Room</th>
                                                            <th style="width: 15%;">Parson</th>
                                                            <th style="width: 45%;">Names</th>
                                                            <th style="width: 15%;">Paid</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <input type="hidden" name="showrowid" id="showrowid" value="1">
                                                        <?php for ($i=0; $i < sizeof($rooms) ; $i++) { ?>
                                                        <tr id="trid<?= $i ?>" style="<?php if ($i > 0) {
    echo 'display: none';
} ?>">
                                                            <td>{{ $i + 1 }}</td>

                                                            <td>

                                                                <select name="room_id[]" id="room_id<?= $i ?>"
                                                                    class="form-control select2" style="width: 100%">
                                                                    <option value="">{{ __('Select Room Number') }}
                                                                    </option>
                                                                    @foreach ($rooms as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            @if (old('room_id.' . $i) == $item->id) {{ 'selected' }} @endif>
                                                                            {{ $item->number }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </td>

                                                            <td>

                                                                <input type="number" name="person[]" class="form-control"
                                                                    id="person<?= $i ?>" placeholder="person"
                                                                    value="{{ old('person.' . $i) }}" autocomplete="off">

                                                            </td>

                                                            <td>

                                                                <input type="text" name="names[]" class="form-control"
                                                                    id="names<?= $i ?>" placeholder="names"
                                                                    value="{{ old('names.' . $i) }}" autocomplete="off">

                                                            </td>

                                                            <td>

                                                                <input type="number" name="paid[]" class="form-control"
                                                                    id="paid<?= $i ?>" placeholder="Paid"
                                                                    value="{{ old('paid.' . $i) }}" autocomplete="off">

                                                            </td>

                                                        </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <center>
                                            <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                            <button type="button" onclick="saveBooking()"
                                                class="btn btn-sm bg-blue">{{ __('Save') }}</button>
                                        </center>
                                    </div>
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

@section('footer')
    <script>
        function makerowvisible() {
            var nextrownumber = $("#showrowid").val();
            $("#trid" + Number(nextrownumber)).show();
            $("#showrowid").val(Number(nextrownumber) + 1);
        }

        $(document).keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                makerowvisible();
            }
        });

        function saveBooking() {
            $('#booking-form').submit();
        }

        function showHidePackage(type) {
            if (type == 'Package') {
                $('#package').show();
            } else {
                $('#package').hide();

                var guide_id = $('#guide_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                });

                $.ajax({

                    url: "{{ route('tour.get.charge.by.type') }}",
                    method: 'POST',
                    data: {
                        'type': type,
                        'guide_id': guide_id,
                    },

                    success: function(data) {
                        $('#charge').val(data);
                    },

                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        }

        function getChargeByPackage(package_id) {

            var guide_id = $('#guide_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });

            $.ajax({

                url: "{{ route('tour.get.charge.by.package') }}",
                method: 'POST',
                data: {
                    'package_id': package_id,
                    'guide_id': guide_id,
                },

                success: function(data2) {
                    var data = JSON.parse(data2);
                    $('#charge').val(data.charge);
                    $('#duration').val(data.duration);
                },

                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
