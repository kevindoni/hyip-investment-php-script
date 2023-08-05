@extends($theme.'layouts.app')
@section('title',__('Login'))

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

                            <h4 class="pt-30 pb-30">@lang('login your account')</h4>
                        </div>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <p>@lang('Email Address')</p>
                            <div class="input-group mb-3">
                                <input type="text"
                                       name="username"
                                       class="form-control"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="@lang('Username or Email')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-regular fa-envelope"></i></span>
                            </div>
                            @error('username')<span class="text-danger float-left">@lang($message)</span>@enderror
                            @error('email')<span class="text-danger float-left">@lang($message)</span>@enderror

                            <p>@lang('Password')</p>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                       placeholder="@lang('Password')">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-lock"></i></span>
                            </div>
                            @error('password')
                            <span class="text-danger mt-1">@lang($message)</span>
                            @enderror

                            @if(basicControl()->reCaptcha_status_login)
                                <div class="box mb-4 form-group">
                                    {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                    {!! NoCaptcha::display($basic->theme == 'deepblack' ? ['data-theme' => 'dark'] : []) !!}
                                    @error('g-recaptcha-response')
                                    <span class="text-danger mt-1">@lang($message)</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3 form-check d-flex justify-content-between">
                                <div class="check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleCheck1">@lang('Remember me')</label>
                                </div>
                                <div class="forgot">
                                    <a href="{{ route('password.request') }}">@lang('Forgot password?')</a>
                                </div>
                            </div>
                            <button type="submit" class="btn custom_btn mt-30 w-100">@lang('Log In')</button>
                            <div class="pt-5 d-flex">
                                @lang("Don't have an account?")
                                <br>
                                <h6 class="ms-2"><a href="{{ route('register') }}">@lang('Register')</a></h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login_signup_area_end -->
@endsection
