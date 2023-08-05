@extends('admin.layouts.app')
@section('title', trans($page_title))
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <form method="post" action="{{route('admin.payout.settings.action')}}" class="form-row align-items-center " enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-1 col-xl-1 col-12">
                    <label class="d-block">@lang('Monday')</label>
                    <input data-toggle="toggle" id="monday" data-onstyle="primary" data-offstyle="secondary" data-on="On" data-off="Off" data-width="100%" type="checkbox" name="monday" @if($withdrawSettings->monday) checked @endif>
                </div>

                <div class="form-group col-md-1 col-xl-1 col-12">
                    <label class="d-block">@lang('Tuesday')</label>
                    <input data-toggle="toggle" id="tuesday" data-onstyle="primary" data-offstyle="secondary" data-on="On" data-off="Off" data-width="100%" type="checkbox" name="tuesday" @if($withdrawSettings->tuesday) checked @endif>
                </div>

                <div class="form-group col-md-1 col-xl-1 col-12">
                    <label class="d-block">@lang('Wednesday')</label>
                    <input data-toggle="toggle" id="wednesday" data-onstyle="primary" data-offstyle="secondary" data-on="On" data-off="Off" data-width="100%" type="checkbox" name="wednesday" @if($withdrawSettings->wednesday) checked @endif>
                </div>

                <div class="form-group col-md-1 col-xl-1 col-12">
                    <label class="d-block">@lang('Thursday')</label>
                    <input data-toggle="toggle" id="thursday" data-onstyle="primary" data-offstyle="secondary" data-on="On" data-off="Off" data-width="100%" type="checkbox" name="thursday" @if($withdrawSettings->thursday) checked @endif>
                </div>

                <div class="form-group col-md-1 col-xl-1 col-12">
                    <label class="d-block">@lang('Friday')</label>
                    <input data-toggle="toggle" id="friday" data-onstyle="primary" data-offstyle="secondary" data-on="On" data-off="Off" data-width="100%" type="checkbox" name="friday" @if($withdrawSettings->friday) checked @endif>
                </div>

                <div class="form-group col-md-1 col-xl-1 col-12">
                    <label class="d-block">@lang('Saturday')</label>
                    <input data-toggle="toggle" id="saturday" data-onstyle="primary" data-offstyle="secondary" data-on="On" data-off="Off" data-width="100%" type="checkbox" name="saturday" @if($withdrawSettings->saturday) checked @endif>
                </div>

                <div class="form-group col-md-1 col-xl-1 col-12">
                    <label class="d-block">@lang('Sunday')</label>
                    <input data-toggle="toggle" id="sunday" data-onstyle="primary" data-offstyle="secondary" data-on="On" data-off="Off" data-width="100%" type="checkbox" name="sunday" @if($withdrawSettings->sunday) checked @endif>
                </div>

                <div class="form-group col-md-2 col-xl-2 col-12">
                    <button type="submit"
                            class="btn btn-primary btn-block  btn-rounded mx-2 mt-4">
                        <span>@lang('Save Changes')</span></button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <script>
        "use strict";
        $(document).ready(function () {
            $('select').select2({
                width: '100%'
            });
        });
    </script>
@endpush
