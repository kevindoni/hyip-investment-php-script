@extends($theme.'layouts.app')
@section('title',__('Login'))


@section('content')
    <section id="about-us" class="about-page secbg-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-block py-5">
                        <form class="login-form" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="signin">
                                <h3 class="title mb-30">@lang('Login Form')</h3>

                                <div class="form-group mb-30">
                                    <input class="form-control" type="text" name="username" placeholder="@lang('Email Or Username')">
                                    @error('username')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                    @error('email')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group mb-20">
                                    <input class="form-control" type="password" name="password" placeholder="@lang('Password')">
                                    @error('password')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if(basicControl()->reCaptcha_status_login)
                                    <div class="box mb-4 form-group">
                                        {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                        {!! NoCaptcha::display($basic->theme == 'deepblack' ? ['data-theme' => 'dark'] : []) !!}
                                        @error('g-recaptcha-response')
                                            <span class="text-danger mt-1">@lang($message)</span>
                                        @enderror
                                    </div>
                                @endif

                                <div
                                    class="remember-me d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between mb-30">
                                    <div class="checkbox custom-control custom-checkbox mt-10">
                                        <input id="remember" type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">@lang('Remember Me')</label>
                                    </div>
                                    <a class="text-white mt-10"  href="{{ route('password.request') }}">@lang("Forgot password?")</a>
                                </div>

                                <div class="btn-area">
                                    <button class="btn-login login-auth-btn" type="submit"><span>@lang('Login')</span></button>
                                </div>

                                <div class="login-query mt-30 text-center">
                                    <a  href="{{ route('register') }}">@lang("Don't have any account? Sign Up")</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="connectivity wow fadeIn" data-wow-duration="1s" data-wow-delay="0.35s">
                        <div class="d-flex align-items-center justify-content-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
