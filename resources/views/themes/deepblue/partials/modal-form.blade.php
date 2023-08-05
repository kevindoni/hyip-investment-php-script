<!-- MODAL-LOGIN -->
<div id="modal-login">
    <div class="modal-wrapper">
        <div class="modal-login-body">
            <div class="btn-close">&times;</div>
            <div class="form-block">
                <form class="login-form" id="login-form" action="{{route('loginModal')}}" method="post">
                    @csrf
                    <div class="signin">
                        <h3 class="title mb-30">@lang('Login')</h3>

                        <div class="form-group mb-30">
                            <input  autocomplete="off" class="form-control" type="text" name="username" placeholder="@lang('Username')">
                            <span class="text-danger emailError"></span>
                            <span class="text-danger usernameError"></span>
                        </div>

                        <div class="form-group mb-20">
                            <input  autocomplete="off" class="form-control" type="password" name="password" placeholder="@lang('Password')">
                            <span class="text-danger passwordError"></span>
                        </div>

                        <div
                            class="remember-me d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between mb-30">
                            <div class="checkbox custom-control custom-checkbox mt-10">
                                <input  autocomplete="off" id="remember" type="checkbox" class="custom-control-input"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">@lang('Remember Me')</label>
                            </div>
                            <a class="btn-forget mt-10" href="javascript:void(0)">@lang("Forgot password?")</a>
                        </div>

                        <div class="btn-area">
                            <button class="btn-login login-auth-btn" type="submit"><span>@lang('Login')</span></button>
                        </div>

                        <div class="login-query mt-30 text-center">
                            <a class="btn-signup" href="javascript:void(0)">@lang("Don't have any account? Sign Up")</a>
                        </div>
                    </div>
                </form>


                <form class="login-form" id="reset-form" method="post" action="{{route('password.email')}}">
                    @csrf
                    <div class="reset-password">
                        <h3 class="title mb-30">@lang("Reset Password")</h3>
                        <div class="form-group mb-30">
                            <input  autocomplete="off" class="form-control" type="email" name="email" value="{{old('email')}}"
                                   placeholder="@lang('Enter your Email Address')">
                            <span class="text-danger emailError"></span>
                        </div>

                        <div class="btn-area">
                            <button class="btn-login login-recover-auth-btn" type="submit">
                                <span>@lang('Send Password Reset Link')</span></button>
                        </div>
                        <div class="login-query mt-30 text-center">
                            <a class="btn-login-back "
                               href="javascript:void(0)">@lang("Already have any account? Login")</a>
                        </div>
                    </div>
                </form>


                <form class="login-form" id="signup-form" action="{{route('register')}}" method="post">
                    @csrf
                    <div class="register">
                        <h3 class="title mb-30">@lang('SIGN UP FORM')</h3>

                        <div class="form-group mb-30">
                            <input  autocomplete="off" class="form-control" type="text" name="firstname" value="{{old('firstname')}}"
                                   placeholder="@lang('First Name')">
                            <span class="text-danger firstnameError"></span>
                        </div>

                        <div class="form-group mb-30">
                            <input  autocomplete="off" class="form-control " type="text" name="lastname" value="{{old('lastname')}}"
                                   placeholder="@lang('Last Name')">
                            <span class="text-danger lastnameError"></span>
                        </div>

                        <div class="form-group mb-30">
                            <input  autocomplete="off" class="form-control " type="text" name="username" value="{{old('username')}}"
                                   placeholder="@lang('Username')">
                            <span class="text-danger usernameError"></span>
                        </div>

                        <div class="form-group mb-30">
                            <input  autocomplete="off" class="form-control" type="text" name="email" value="{{old('email')}}"
                                   placeholder="@lang('Email Address')">
                            <span class="text-danger emailError"></span>
                        </div>


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
                                        @foreach($countries as $value)
                                            <option value="{{$value['phone_code']}}"
                                                    data-name="{{$value['name']}}"
                                                    data-code="{{$value['code']}}"
                                                {{$country_code == $value['code'] ? 'selected' : ''}}
                                            > {{$value['name']}} ({{$value['phone_code']}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input  autocomplete="off" type="text" name="phone" class="form-control dialcode-set" value="{{old('phone')}}"
                                       placeholder="@lang('Your Phone Number')">
                            </div>

                            <span class="text-danger phoneError"></span>

                            <input  autocomplete="off" type="hidden" name="country_code" value="{{old('country_code')}}" class="text-dark">
                        </div>


                        <div class="form-group mb-30">
                            <input  autocomplete="off" class="form-control" type="password" name="password" value="{{old('password')}}"
                                   placeholder="@lang('Password')">
                            <span class="text-danger passwordError"></span>
                        </div>

                        <div class="form-group mb-30">
                            <input  autocomplete="off" class="form-control" type="password" name="password_confirmation"
                                   placeholder="@lang('Confirm Password')">
                        </div>

                        <div class="btn-area">
                            <button class="btn-login login-signup-auth-btn" type="submit"><span>@lang('Sign Up')</span>
                            </button>
                        </div>
                        <div class="login-query mt-30 text-center">
                            <a class="btn-login-back"
                               href="javascript:void(0)">@lang("Already have an account? Login")</a>
                        </div>
                    </div>

                </form>
            </div>


            <div class="connectivity wow fadeIn" data-wow-duration="1s" data-wow-delay="0.35s">

            </div>
        </div>
    </div>
</div>
<!-- /MODAL-LOGIN -->



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
