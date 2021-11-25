@extends('backend.layouts.app')
@section('title', 'New Parking')
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
                    <!-- Content Header (Parking header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-bParking">
                            <h3 class="box-title">{{ __('New Parking') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('parking.parkings.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Parking List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('parking.parkings.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data" id="orderForm">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Room') }}</label>
                                                <select name="room_id" class="form-control select2" id="room_id"
                                                    style="width: 100%;">
                                                    <option value="">{{ __('Select Room') }}</option>
                                                    @foreach ($rooms as $key => $room)
                                                        <option value="{{ $room->id }}" @if (old('room_id') == $room->id) {{ 'selected' }}  @endif>
                                                            {{ $room->number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Category') }}</label>
                                                <select name="category_id" class="form-control select2" id="category_id"
                                                    style="width: 100%;" required="" onchange="getChargeType(this.value)">
                                                    <option value="">{{ __('Select Vehicle Category') }}</option>
                                                    @foreach ($categories as $key => $category)
                                                        <option value="{{ $category->id }}" @if (old('category_id') == $category->id) {{ 'selected' }}  @endif>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Type') }}</label>
                                                <select name="charge_id" class="form-control select2" id="charge_id"
                                                    style="width: 100%;" required="">
                                                    <option value="">{{ __('Select Vehicle Category') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Vehicle') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Vehicle') }}" value="{{ old('vehicle') }}"
                                                    autocomplete="off" required="" id="vehicle" name="vehicle">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Registration Number') }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('Registration Number') }}"
                                                    value="{{ old('registration_number') }}" autocomplete="off"
                                                    required="" id="registration_number" name="registration_number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Remark</label>
                                                <textarea name="remark" id="remark" class="form-control" rows="3"
                                                    placeholder="Remark">{{ old('remark') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-blue">{{ __('Save') }}</button>
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

@section('footer')
    <script>
        $(function() {
            $('.timepicker').timepicker({
                showInputs: false
            })
        });

        function getChargeType(category) {

            var division = $('#category_id option:selected').text();

            $.ajaxSetup({

                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }

            });

            $.ajax({

                url: "{{ route('get.charge.type', app()->getLocale()) }}",
                method: 'POST',
                data: {
                    'category': category,
                },

                success: function(data2) {

                    var data = JSON.parse(data2);

                    $('#charge_id').find('option').remove().end().append("<option value=''>Select " +
                        division + "\'s Charge Type</option>");

                    $.each(data, function(i, item) {
                        $("#charge_id").append($('<option>', {
                            value: this.id,
                            text: this.type,
                        }));
                    });

                },

                error: function(error) {

                    console.log(error);
                }


            });
        }
    </script>
@endsection
