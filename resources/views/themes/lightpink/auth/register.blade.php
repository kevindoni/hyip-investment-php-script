@extends($theme.'layouts.app')
@section('title',__('Register'))

@section('content')
    <!-- login_signup_area_start -->
    <section class="login_signup_area">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 col-md-5">
                    <div class="login_signup_banner">
                        <div class="image_area animation1">
                            <img src="{{ asset($themeTrue.'img/login/1.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-7">
                    <div class="login_signup_form p-4">
                        <div class="section_header text-center">
                            <h4 class="pt-30 pb-30">@lang('Create New Account')</h4>
                        </div>
                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            @if(session()->get('sponsor') != null)
                                <div class="col-md-12">
                                    <div class="form-group mb-30">
                                        <label>@lang('Sponsor Name')</label>
                                        <input type="text" name="sponsor" class="form-control" id="sponsor"
                                               placeholder="{{trans('Sponsor By') }}"
                                               value="{{session()->get('sponsor')}}" readonly>
                                    </div>
                                </div>
                            @endif

                            <p>@lang('First Name')</p>
                            <div class="input-group mb-3">
                                <input type="text" name="firstname" class="form-control" value="{{old('firstname')}}" placeholder="@lang('First Name')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-regular fa-pen-to-square"></i></span>
                            </div>
                            @error('firstname')<span class="text-danger mt-1 mb-2">@lang($message)</span>@enderror

                            <p>@lang('Last Name')</p>
                            <div class="input-group mb-3">
                                <input type="text" name="lastname" class="form-control" value="{{old('lastname')}}" placeholder="@lang('Last Name')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-regular fa-pen-to-square"></i></span>
                            </div>
                            @error('lastname')<span class="text-danger mt-1">@lang($message)</span>@enderror

                            <p>@lang('Username')</p>
                            <div class="input-group mb-3">
                                <input type="text" name="username" class="form-control" value="{{old('username')}}" placeholder="@lang('User Name')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-regular fa-pen-to-square"></i></span>
                            </div>
                            @error('username')<span class="text-danger mt-1">@lang($message)</span>@enderror

                            <p>@lang('Email Address')</p>
                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('Email Address')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-regular fa-envelope"></i></span>
                            </div>
                            @error('email')<span class="text-danger mt-1">@lang($message)</span>@enderror


                            <div class="input-group mb-3">
                                @php
                                    $country_code = (string) @getIpInfo()['code'] ?: null;
                                    $myCollection = collect(config('country'))->map(function($row) {
                                        return collect($row);
                                    });
                                    $countries = $myCollection->sortBy('code');
                                @endphp

                                <select name="phone_code" class="form-control country_code dialCode-change register_phone_select">
                                    @foreach(config('country') as $value)
                                        <option value="{{$value['phone_code']}}"
                                                data-name="{{$value['name']}}"
                                                data-code="{{$value['code']}}"
                                            {{$country_code == $value['code'] ? 'selected' : ''}}
                                        > {{$value['name']}} ({{$value['phone_code']}})
                                        </option>
                                    @endforeach
                                </select>
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-globe-americas"></i></span>

                                <input type="text" name="phone" class="form-control dialcode-set" value="{{old('phone')}}" placeholder="@lang('Phone Number')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-phone"></i></span>

                            </div>
                            @error('phone')
                            <span class="text-danger mt-1">@lang($message)</span>
                            @enderror

                            <input type="hidden" name="country_code" value="{{old('country_code')}}" class="text-dark">

                            <p>@lang('Password')</p>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="@lang('Password')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-lock"></i></span>
                            </div>
                            @error('password')<span class="text-danger mt-1">@lang($message)</span>@enderror

                            <p>@lang('Confirm password')</p>
                            <div class="input-group mb-3">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('Confirm Password')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-lock"></i></span>
                            </div>
                            @error('password_confirmation')<span class="text-danger mt-1">@lang($message)</span>@enderror

                            @if(basicControl()->reCaptcha_status_registration)
                                <div class="col-md-6 box mb-4 form-group">
                                    {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                    {!! NoCaptcha::display($basic->theme == 'deepblack' ? ['data-theme' => 'dark'] : []) !!}
                                    @error('g-recaptcha-response')
                                    <span class="text-danger mt-1">@lang($message)</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3 form-check d-flex justify-content-between">
                                <div class="check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">@lang('I agree to the terms and
                                    conditions.')</label>
                                </div>
                            </div>
                            <button type="submit" class="btn custom_btn mt-30 w-100">@lang('Register')</button>
                            <div class="pt-5 d-flex">
                                @lang('Already have an account?')
                                <br>
                                <h6 class="ms-2"><a href="{{ route('login') }}">@lang('Login')</a></h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login_signup_area_end -->
@endsection


@push('script')
    <script>
        "use strict";
        $(document).ready(function () {
            setDialCode();
            $(document).on('change', '.dialCode-change', function () {
                setDialCode();
            });
            function setDialCode() {
                let currency = $('.dialCode-change').val();
                $('.dialcode-set').val(currency);
            }
        });

    </script>
@endpush
