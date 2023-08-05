@extends('admin.layouts.app')
@section('title')
    @lang('Basic Controls')
@endsection
@section('content')

    <div class="alert alert-warning my-5 m-0 m-md-4" role="alert">
        <i class="fas fa-info-circle mr-2"></i> @lang("If you get 500(server error) for some reason, please turn on <b>Debug Mode</b> and try again. Then you can see what was missing in your system.")
    </div>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <form method="post" action="" class="needs-validation base-form">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Site Title')</label>
                        <input type="text" name="site_title"
                               value="{{ old('site_title') ?? $control->site_title ?? 'Site Title' }}"
                               class="form-control ">

                        @error('site_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(config('basic.theme') != 'deepblack')
                        <div class="form-group col-md-3">
                            <label class="font-weight-bold">@lang('Base Color')</label>
                            <input type="color" name="base_color"
                                   value="{{ old('base_color') ?? $control->base_color ?? '#6777ef' }}"
                                   required="required" class="form-control ">
                            @error('base_color')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        @if(in_array(config('basic.theme'),['lightpink','lightyellow']))

                            <div class="form-group col-md-3">
                                <label class="font-weight-bold">@lang('Base Light Color')</label>
                                <input type="color" name="base_light_color"
                                       value="{{ old('base_light_color') ?? $control->base_light_color ?? '#6777ef' }}"
                                       required="required" class="form-control ">
                                @error('base_light_color')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label class="font-weight-bold">@lang('Secondary Color')</label>
                                <input type="color" name="secondary_color"
                                       value="{{ old('secondary_color') ?? $control->secondary_color ?? '#6777ef' }}"
                                       required="required" class="form-control ">
                                @error('secondary_color')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label class="font-weight-bold">@lang('Heading Color')</label>
                                <input type="color" name="heading_color"
                                       value="{{ old('heading_color') ?? $control->heading_color ?? '#6777ef' }}"
                                       required="required" class="form-control ">
                                @error('heading_color')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    @endif


                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('APP TIMEZONE')</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="time_zone">
                            <option hidden>{{ old('time_zone', $control->time_zone)?? 'Select Time Zone' }}</option>
                            @foreach ($control->time_zone_all as $time_zone_local)
                                <option value="{{ $time_zone_local }}">@lang($time_zone_local)</option>
                            @endforeach
                        </select>

                        @error('time_zone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Base Currency')</label>
                        <input type="text" name="currency" value="{{ old('currency') ?? $control->currency ?? 'USD' }}"
                               required="required" class="form-control ">

                        @error('currency')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Currency Symbol')</label>
                        <input type="text" name="currency_symbol"
                               value="{{ old('currency_symbol') ?? $control->currency_symbol ?? '$' }}"
                               required="required" class="form-control ">

                        @error('currency_symbol')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Fraction number')</label>
                        <input type="text" name="fraction_number"
                               value="{{ old('fraction_number') ?? $control->fraction_number ?? '2' }}"
                               required="required" class="form-control ">
                        @error('fraction_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Paginate Per Page')</label>
                        <input type="text" name="paginate" value="{{ old('paginate') ?? $control->paginate ?? '2' }}"
                               required="required" class="form-control ">
                        @error('paginate')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Minimum Transfer')</label>
                        <input type="text" name="min_transfer"
                               value="{{ old('min_transfer') ?? $control->min_transfer ?? '1' }}"
                               required="required" class="form-control ">
                        @error('min_transfer')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Maximum Transfer')</label>
                        <input type="text" name="max_transfer"
                               value="{{ old('max_transfer') ?? $control->max_transfer ?? '1000' }}"
                               required="required" class="form-control ">
                        @error('max_transfer')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Transfer Charge')</label>
                        <div class="input-group mb-3">
                            <input type="text" name="transfer_charge"
                                   value="{{ old('transfer_charge') ?? $control->transfer_charge ?? '1' }}"
                                   required="required" class="form-control ">

                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        @error('transfer_charge')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Bonus Amount')</label>
                        <div class="input-group mb-3">
                            <input type="text" name="bonus_amount"
                                   value="{{ old('bonus_amount') ?? $control->bonus_amount ?? '0' }}"
                                   required="required" class="form-control ">

                            <div class="input-group-append">
                                <span class="input-group-text">{{trans($control->currency_symbol)}}</span>
                            </div>
                        </div>
                        @error('bonus_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-3 ">
                        <label class="font-weight-bold">@lang('Joining bonus')</label>
                        <div class="custom-switch-btn">
                            <input type='hidden' value='1' name='joining_bonus'>
                            <input type="checkbox" name="joining_bonus" class="custom-switch-checkbox"
                                   id="joining_bonus"
                                   value="0" <?php if ($control->joining_bonus == 0):echo 'checked'; endif ?> >
                            <label class="custom-switch-checkbox-label" for="joining_bonus">
                                <span class="custom-switch-checkbox-inner"></span>
                                <span class="custom-switch-checkbox-switch"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-sm-6 col-md-4 col-lg-3 ">
                        <label class="text-dark">@lang('Strong Password')</label>
                        <div class="custom-switch-btn">
                            <input type='hidden' value='1' name='strong_password'>
                            <input type="checkbox" name="strong_password" class="custom-switch-checkbox"
                                   id="strong_password"
                                   value="0" {{($control->strong_password == 0) ? 'checked' : ''}} >
                            <label class="custom-switch-checkbox-label" for="strong_password">
                                <span class="custom-switch-checkbox-inner"></span>
                                <span class="custom-switch-checkbox-switch"></span>
                            </label>
                        </div>
                    </div>


                    <div class="form-group col-sm-6 col-md-4 col-lg-3 ">
                        <label class="text-dark">@lang('Registration')</label>
                        <div class="custom-switch-btn">
                            <input type='hidden' value='1' name='registration'>
                            <input type="checkbox" name="registration" class="custom-switch-checkbox"
                                   id="registration"
                                   value="0" {{($control->registration == 0) ? 'checked' : ''}} >
                            <label class="custom-switch-checkbox-label" for="registration">
                                <span class="custom-switch-checkbox-inner"></span>
                                <span class="custom-switch-checkbox-switch"></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-lg-3 col-md-6">
                        <label class="d-block">@lang('Cron Set Up Pop Up')</label>
                        <div class="custom-switch-btn">
                            <input type='hidden' value='1' name='cron_set_up_pop_up'>
                            <input type="checkbox" name="cron_set_up_pop_up" class="custom-switch-checkbox"
                                   id="cron_set_up_pop_up"
                                   value="0" <?php if ($control->is_active_cron_notification == 0):echo 'checked'; endif ?> >
                            <label class="custom-switch-checkbox-label" for="cron_set_up_pop_up">
                                <span class="custom-switch-checkbox-inner"></span>
                                <span class="custom-switch-checkbox-switch"></span>
                            </label>
                        </div>
                    </div>


                    <div class="form-group col-sm-3 ">
                        <label class="font-weight-bold">@lang('Debug Mode')</label>
                        <div class="custom-switch-btn">
                            <input type='hidden' value='1' name='error_log'>
                            <input type="checkbox" name="error_log" class="custom-switch-checkbox"
                                   id="error_log"
                                   value="0" <?php if ($control->error_log == 0):echo 'checked'; endif ?> >
                            <label class="custom-switch-checkbox-label" for="error_log">
                                <span class="custom-switch-checkbox-inner"></span>
                                <span class="custom-switch-checkbox-switch"></span>
                            </label>
                        </div>
                    </div>

                </div>


                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><span><i
                            class="fas fa-save pr-2"></i> @lang('Save Changes')</span></button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        "use strict";
        $(document).ready(function () {
            $('select').select2({
                selectOnClose: true
            });
        });
    </script>
@endpush
