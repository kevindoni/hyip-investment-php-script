@extends($theme.'layouts.app')
@section('title',__('Register'))


@section('content')
    <!-- signup_area_start -->
    <section class="contact_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-md-6 ms-auto order-2 order-md-1">
                    <div class="form_area p-4 shadow1 ">
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

                            <div class="form_title pb-2">
                                <h3>@lang('Register')</h3>
                            </div>

                            <div class="mb-4">
                                <input type="text" name="firstname" class="form-control" value="{{old('firstname')}}" placeholder="@lang('First Name')">
                                @error('firstname')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            <div class="mb-4">
                                <input type="text" name="lastname" class="form-control" value="{{old('lastname')}}" placeholder="@lang('Last Name')">
                                @error('lastname')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>
                            <div class="mb-4">
                                <input type="text" name="username" class="form-control" value="{{old('username')}}" placeholder="@lang('Username')"/>
                                @error('username')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>
                            <div class="mb-4">
                                <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('Email Address')"/>
                                @error('email')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            <div class="mb-4">
                                @php
                                    $country_code = (string) @getIpInfo()['code'] ?: null;
                                    $myCollection = collect(config('country'))->map(function($row) {
                                        return collect($row);
                                    });
                                    $countries = $myCollection->sortBy('code');
                                @endphp
                                <div class="form-group mb-1">
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
                                </div>

                                <input type="text" name="phone" class="form-control dialcode-set" value="{{old('phone')}}" placeholder="@lang('Phone Number')">
                                @error('phone')
                                <span class="text-danger mt-1">@lang($message)</span>
                                @enderror
                            </div>

                            <input type="hidden" name="country_code" value="{{old('country_code')}}" class="text-dark">

                            <div class="mb-4">
                                <input type="password" name="password" class="form-control" placeholder="@lang('Password')"/>
                                @error('password')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            <div class="mb-4">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('Confirm Password')"/>
                                @error('password_confirmation')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            @if(basicControl()->reCaptcha_status_registration)
                                <div class="col-md-6 box mb-4 form-group">
                                    {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                    {!! NoCaptcha::display($basic->theme == 'deepblack' ? ['data-theme' => 'dark'] : []) !!}
                                    @error('g-recaptcha-response')
                                    <span class="text-danger mt-1">@lang($message)</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">@lang('I agree to the terms and
                                    conditions.')</label>
                            </div>
                            <button type="submit" class="btn custom_btn mt-30">@lang('Register')</button>
                            <div class="pt-5 d-flex">
                                @lang('Already have an account?')
                                <br>
                                <h6 class="ms-2"><a href="{{ route('login') }}">@lang('Log In')</a></h6>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 order-1 order-md-2">
                    <div class="image_area">
                        <img src="{{ asset($themeTrue.'img/login/1.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- signup_area_end -->
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
