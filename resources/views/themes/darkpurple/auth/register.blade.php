@extends($theme.'layouts.app')
@section('title',__('Register'))


@section('content')
    <!-- Register section -->
    <section class="login-section">
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-6">
                    <div class="form-wrapper d-flex align-items-center h-100">
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

                            <div class="row g-4">
                                <div class="col-12">
                                    <h4>@lang('Register Here')</h4>
                                </div>
                                <div class="input-box col-12">
                                    <input type="text" name="firstname" class="form-control" value="{{old('firstname')}}" placeholder="@lang('First Name')">
                                    @error('firstname')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>

                                <div class="input-box col-12">
                                    <input type="text" name="lastname" class="form-control" value="{{old('lastname')}}" placeholder="@lang('Last Name')">
                                    @error('lastname')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>

                                <div class="input-box col-12">
                                    <input type="text" name="username" class="form-control" value="{{old('username')}}" placeholder="@lang('Username')"/>
                                    @error('username')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>

                                <div class="input-box col-12">
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('Email Address')"/>
                                    @error('email')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>

                                <div class="input-box col-12">
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

                                <div class="input-box col-12">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('Password')"/>
                                    @error('password')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>

                                <div class="input-box col-12">
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

                                <div class="col-12">
                                    <div class="links">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                @lang('I agree to the terms and conditions.')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-custom">@lang('Register')</button>
                            <div class="bottom">
                                @lang('Already have an account?')

                                <a href="{{ route('login') }}">@lang('Log In')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
