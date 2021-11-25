@extends('backend.layouts.app')
@section('title', 'Hotel Rule')
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
                    <!-- Content Header (House Rule header) -->
                    <div class="box box-danger box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('House Rule') }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.rules.update', [$rule->id]) }}" method="POST"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Minimum stay') }}</label>
                                            <select name="minimum_stay" id="minimum_stay" class="form-control" required=""
                                                style="width: 100%">
                                                <option value="1 night" @if ($rule->minimum_stay == '1 night') {{ 'selected' }} @endif> {{ __('1 night') }} </option>
                                                <option value="More than 1 night" @if ($rule->minimum_stay == 'More than 1 night') {{ 'selected' }} @endif>{{ __('More than 1 night') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Security') }}</label>
                                            <select name="security" id="security" class="form-control" required=""
                                                style="width: 100%">
                                                <option value="On site" @if ($rule->security == 'On site') {{ 'selected' }} @endif> {{ __('On site') }} </option>
                                                <option value="None" @if ($rule->security == 'None') {{ 'selected' }} @endif>{{ __('None') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('On site staff') }}</label>
                                            <select name="on_site_staff" id="on_site_staff" class="form-control"
                                                required="" style="width: 100%">
                                                <option value="Yes" @if ($rule->on_site_staff == 'Yes') {{ 'selected' }} @endif> {{ __('Yes') }} </option>
                                                <option value="No" @if ($rule->on_site_staff == 'No') {{ 'selected' }} @endif>{{ __('No') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Housekeeping') }}</label>
                                            <select name="house_keeping" id="house_keeping" class="form-control" required=""
                                                style="width: 100%">
                                                <option value="Included in room rate" @if ($rule->house_keeping == 'Included in room rate') {{ 'selected' }} @endif> {{ __('Included in room rate') }}
                                                </option>
                                                <option value="Additional Fee" @if ($rule->house_keeping == 'Additional Fee') {{ 'selected' }} @endif>{{ __('Additional Fee') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Housekeeping frequency') }}</label>
                                            <select name="house_keeping_frequency" id="house_keeping_frequency"
                                                class="form-control" required="" style="width: 100%">
                                                <option value="Daily" @if ($rule->house_keeping_frequency == 'Daily') {{ 'selected' }} @endif> {{ __('Daily') }} </option>
                                                <option value="Weekly" @if ($rule->house_keeping_frequency == 'Weekly') {{ 'selected' }} @endif>{{ __('Weekly') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Front desk') }}</label>
                                            <select name="front_desk" id="front_desk" class="form-control" required=""
                                                style="width: 100%">
                                                <option value="24-hour staffing" @if ($rule->front_desk == '24-hour staffing') {{ 'selected' }} @endif> {{ __('24-hour staffing') }} </option>
                                                <option value="Limited hours staffing" @if ($rule->front_desk == 'Limited hours staffing') {{ 'selected' }} @endif>{{ __('Limited hours staffing') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Extra People') }}</label>
                                            <select name="extra_people" id="extra_people" class="form-control" required=""
                                                style="width: 100%">
                                                <option value="Extra Chagrge" @if ($rule->extra_people == 'Extra Chagrge') {{ 'selected' }} @endif> {{ __('Extra Chagrge') }} </option>
                                                <option value="No Charge" @if ($rule->extra_people == 'No Charge') {{ 'selected' }} @endif>{{ __('No Charge') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Security Deposit') }}</label>
                                            <input type="text" name="security_deposite" class="form-control" placeholder="{{ __('Security Deposit') }}" value="{{ $rule->security_deposite }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Cancellation') }}</label>
                                            <select name="cancellation" id="cancellation" class="form-control" required=""
                                                style="width: 100%">
                                                <option value="Strict" @if ($rule->cancellation == 'Strict') {{ 'selected' }} @endif> {{ __('Strict') }} </option>
                                                <option value="Easy" @if ($rule->cancellation == 'Easy') {{ 'selected' }} @endif>{{ __('Easy') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn-sm bg-green">{{ __('Update') }}</button>
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

@endsection
