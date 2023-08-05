@extends($theme.'layouts.app')
@section('title','Register')


@section('content')
    <section id="about-us" class="about-page secbg-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-block py-5">
                        <form class="login-form" action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="signin">
                                <h3 class="title mb-30">@lang('SIGN UP FORM')</h3>

                                <div class="row">
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

                                    <div class="col-md-6">
                                        <div class="form-group mb-30">
                                            <input class="form-control" type="text" name="firstname"
                                                   value="{{old('firstname')}}" placeholder="@lang('First Name')">
                                            @error('firstname')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-30">
                                            <input class="form-control " type="text" name="lastname"
                                                   value="{{old('lastname')}}" placeholder="@lang('Last Name')">
                                            @error('lastname')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-30">
                                            <input class="form-control " type="text" name="username"
                                                   value="{{old('username')}}" placeholder="@lang('Username')">
                                            @error('username')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group mb-30">
                                            <input class="form-control" type="text" name="email"
                                                   value="{{old('email')}}" placeholder="@lang('Email Address')">
                                            @error('email')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-30">
                                            @php
                                                $country_code = (string) @getIpInfo()['code'] ?: null;
                                                $myCollection = collect(config('country'))->map(function($row) {
                                                    return collect($row);
                                                });
                                                $countries = $myCollection->sortBy('code');
                                            @endphp

                                            <div class="input-group ">
                                                <div class="input-group-prepend w-50">
                                                    <select name="phone_code" class="form-control country_code dialCode-change">
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
                                                <input type="text" name="phone" class="form-control dialcode-set"
                                                       value="{{old('phone')}}"
                                                       placeholder="@lang('Your Phone Number')">
                                            </div>


                                            @error('phone')
                                            <span class="text-danger mt-1">{{ $message }}</span>
                                            @enderror

                                            <input type="hidden" name="country_code" value="{{old('country_code')}}"
                                                   class="text-dark">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <input class="form-control" type="password" name="password"
                                                   placeholder="@lang('Password')">
                                            @error('password')
                                            <span class="text-danger mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <input class="form-control" type="password" name="password_confirmation"
                                                   placeholder="@lang('Confirm Password')">
                                        </div>
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
                                </div>



                                <div class="btn-area">
                                    <button class="btn-login login-auth-btn" type="submit"><span>@lang('Sign Up')</span>
                                    </button>
                                </div>

                                <div class="login-query mt-30 text-center">
                                    <a href="{{ route('login') }}">@lang("Already have an account? Login")</a>
                                </div>
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
