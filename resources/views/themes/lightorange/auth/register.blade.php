@extends($theme.'layouts.app')
@section('title','Register')


@section('content')
    <!-- register start -->
    <section id="login-section" class="register">
        <img class="img img-4 zoomInOutInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-4.png')}}" alt="@lang('ellipse-4-image')">
        <img class="img img-3 zoomInOut2sInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-3.png')}}" alt="@lang('ellipse-5-image')">
        <img class="img img-6 zoomInOut2sInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-6.png')}}" alt="@lang('ellipse-6-image')">
        <img class="img img-7 zoomInOutInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-7.png')}}" alt="@lang('ellipse-7-image')">

        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row d-flex justify-content-center ">
                    <div class="col-lg-9">
                        <div class="card-area">
                            <h2 class="mb-30">@lang('Create New Account')</h2>
                            <form class="login-form wow fadeInUp" action="{{ route('register') }}" method="post">
                                @csrf
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

                                    <div class="col-lg-6">
                                        <div class="form-group mb-30">
                                            <input type="text" class="username" name="firstname"
                                            value="{{old('firstname')}}" placeholder="@lang('First Name')">

                                            @error('firstname')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-30">
                                            <input type="text" class="username" name="lastname"
                                            value="{{old('lastname')}}" placeholder="@lang('Last Name')">

                                            @error('lastname')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-30">
                                            <input type="text" class="email" name="username"
                                            value="{{old('username')}}" placeholder="@lang('Username')">

                                            @error('username')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-30">
                                            <input type="text" name="email" value="{{old('email')}}" placeholder="@lang('Email Address')">
                                            @error('email')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
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
                                                    <select name="phone_code" class="form-control country_code dialCode-change" style="height: calc(2.5em + .75rem + 2px);">
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
                                                <input type="text" name="phone" class="form-control dialcode-set" value="{{old('phone')}}" placeholder="@lang('Your Phone Number')" style="height: calc(2.5em + .75rem + 2px);">
                                            </div>


                                            @error('phone')
                                            <span class="text-danger mt-1">{{ $message }}</span>
                                            @enderror

                                            <input type="hidden" name="country_code" value="{{old('country_code')}}"
                                                   class="text-dark">
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group mb-30">
                                            <input type="password" name="password" placeholder="@lang('Password')">
                                            @error('password')
                                                <span class="text-danger mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-30">
                                            <input type="password" name="password_confirmation" placeholder="@lang('Confirm Password')">
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


                                    <div class="col-lg-12">
                                        <div class="form-group d-flex justify-content-between d-none">
                                            <div class="form-group d-flex justify-content-between d-none">
                                                <div class="input-checkbox d-flex justify-content-between">
                                                    <label class="box-area">@lang('I agree terms & conditions')
                                                        <input type="checkbox" checked="checked" required>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="forgot-area">
                                                <a class="forgot" href="{{ route('password.request') }}">@lang("Already have an account? Login")</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 btn-area">
                                        <button type="submit" class="cmn-btn">@lang('Sign Up')</button>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- register end -->
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
