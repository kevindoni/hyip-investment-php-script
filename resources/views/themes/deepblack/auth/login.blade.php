@extends($theme.'layouts.app')
@section('title',__('Login'))

@section('content')

    <!-- login -->
    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="login-box">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="box mb-4">
                            <h4 class="golden-text">@lang('your email or username')</h4>
                            <div class="input-group">
                                <div class="img">
                                    <img src="{{asset($themeTrue.'img/icon/email2.png')}}" alt="@lang('email img')" />
                                </div>
                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    placeholder="@lang('Email Or Username')"
                                />
                            </div>
                            @error('username')<span class="text-danger float-left">@lang($message)</span>@enderror
                            @error('email')<span class="text-danger float-left">@lang($message)</span>@enderror
                        </div>

                        <div class="box mb-4">
                            <h4 class="golden-text">
                                @lang('Your password')
                                <a href="{{ route('password.request') }}" class="golden-text"
                                >@lang('Forget password?')</a>
                            </h4>
                            <div class="input-group">
                                <div class="img">
                                    <img src="{{asset($themeTrue.'img/icon/padlock.png')}}" alt="@lang('password img')" />
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="@lang('Password')"
                                />
                            </div>
                            @error('password')
                                <span class="text-danger mt-1">@lang($message)</span>
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

                        <div class="mb-4 bottom">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                    id="flexCheckDefault"
                                />
                                <label
                                    class="form-check-label"
                                    for="flexCheckDefault"
                                >
                                    @lang('Remember me')
                                </label>
                            </div>
                            <span class="text-end">
                                <p>
                                @lang('New User?')
                                <a href="{{ route('register') }}" class="golden-text">@lang('Register')</a>
                                </p>
                            </span>
                        </div>
                        <button class="gold-btn-block" type="submit">@lang('Sign in')</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
