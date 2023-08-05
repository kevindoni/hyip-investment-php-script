@extends($theme.'layouts.app')
@section('title',__('Register'))


@section('content')
    <!-- register start -->
    <section class="login-section register-section">
        <div class="container">
           <div class="row">
              <div class="col">
                 <div class="login-box">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="row">
                            @if(session()->get('sponsor') != null)
                                  <div class="col-md-12">
                                        <div class="box sponsorboxwidth">
                                            <h4 class="golden-text">@lang('Sponsor Name')</h4>
                                            <div class="input-group mb-4">
                                                <div class="img">
                                                    <img src="{{asset($themeTrue.'img/icon/bonus.png')}}" alt="@lang('sponsor img')" />
                                                </div>
                                                <input type="text" name="sponsor" id="sponsor" class="form-control" placeholder="{{trans('Sponsor By') }}" value="{{session()->get('sponsor')}}" readonly/>
                                            </div>
                                        </div>
                                  </div>
                            @endif

                            <div class="col-md-6">
                                <div class="box mb-4">
                                    <h4 class="golden-text">@lang('First Name')</h4>
                                    <div class="input-group">
                                        <div class="img">
                                            <img src="{{asset($themeTrue.'img/icon/edit.png')}}" alt="@lang('first name img')" />
                                        </div>
                                        <input type="text" name="firstname" class="form-control" value="{{old('firstname')}}" placeholder="@lang('First Name')"/>
                                    </div>
                                    @error('firstname')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box mb-4">
                                    <h4 class="golden-text">@lang('Last Name')</h4>
                                    <div class="input-group">
                                        <div class="img">
                                            <img src="{{asset($themeTrue.'img/icon/edit.png')}}" alt="@lang('lastname img')" />
                                        </div>
                                        <input type="text" name="lastname" class="form-control" value="{{old('lastname')}}" placeholder="@lang('Last Name')"/>
                                    </div>
                                    @error('lastname')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box mb-4">
                                    <h4 class="golden-text">@lang('Username')</h4>
                                    <div class="input-group">
                                        <div class="img">
                                            <img src="{{asset($themeTrue.'img/icon/edit.png')}}" alt="@lang('username img')" />
                                        </div>
                                        <input type="text" name="username" class="form-control" value="{{old('username')}}" placeholder="@lang('Username')"/>
                                    </div>
                                    @error('username')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box mb-4">
                                    <h4 class="golden-text">@lang('Email Address')</h4>
                                    <div class="input-group">
                                        <div class="img">
                                            <img src="{{asset($themeTrue.'img/icon/email2.png')}}" alt="@lang('email img')" />
                                        </div>
                                        <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('Email Address')"/>
                                    </div>
                                    @error('email')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>
                            </div>

                            <div class="col-md-12 phonenumber">
                                <div class="form-group mb-30">
                                    @php
                                        $country_code = (string) @getIpInfo()['code'] ?: null;
                                        $myCollection = collect(config('country'))->map(function($row) {
                                            return collect($row);
                                        });
                                        $countries = $myCollection->sortBy('code');
                                    @endphp

                                    <div class="box mb-4">
                                        <h4 class="golden-text">@lang('Phone Number')</h4>
                                        <div class="input-group">
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
                                            <input type="text" name="phone" class="form-control dialcode-set" value="{{old('phone')}}" placeholder="@lang('Phone Number')">
                                        </div>
                                        @error('phone')
                                            <span class="text-danger mt-1">@lang($message)</span>
                                        @enderror
                                    </div>


                                    <input type="hidden" name="country_code" value="{{old('country_code')}}" class="text-dark">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box mb-4">
                                    <h4 class="golden-text">@lang('Password')</h4>
                                    <div class="input-group">
                                        <div class="img">
                                            <img src="{{asset($themeTrue.'img/icon/padlock.png')}}" alt="@lang('password img')" />
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="@lang('Password')"/>
                                    </div>
                                    @error('password')<span class="text-danger mt-1">@lang($message)</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box mb-4">
                                    <h4 class="golden-text">@lang('Confirm Password')</h4>
                                    <div class="input-group">
                                        <div class="img">
                                            <img src="{{asset($themeTrue.'img/icon/padlock.png')}}" alt="@lang('Confirm Password img')" />
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('Confirm Password')"/>
                                    </div>
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

                            <div class="mb-4 col-md-12 logindiv">
                                <p>
                                    @lang('already User?')
                                    <a href="{{ route('login') }}" class="golden-text">@lang('login')</a>
                                </p>
                                <button type="submit" class="gold-btn">@lang('Sign Up')</button>
                            </div>
                        </div>
                    </form>
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
