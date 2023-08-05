@extends($theme.'layouts.app')
@section('title',__('Login'))

@section('content')
    <!-- login section -->
    <section class="login-section">
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-6">
                    <div class="form-wrapper d-flex align-items-center h-100">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <h4>@lang('Login here')</h4>
                                </div>
                                <div class="input-box col-12">
                                    <input type="text"
                                           name="username"
                                           class="form-control"
                                           id="exampleInputEmail1"
                                           aria-describedby="emailHelp" placeholder="@lang('Username or Email')" />
                                    @error('username')<span class="text-danger float-left">@lang($message)</span>@enderror
                                    @error('email')<span class="text-danger float-left">@lang($message)</span>@enderror
                                </div>
                                <div class="input-box col-12">
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                           placeholder="@lang('Password')" />
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

                                <div class="col-12">
                                    <div class="links">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <label class="form-check-label" for="flexCheckDefault"> @lang('Remember me') </label>
                                        </div>
                                        <a href="{{ route('password.request') }}">@lang('Forgot password?')</a>
                                    </div>
                                </div>
                            </div>

                            <button class="btn-custom">@lang('Log In')</button>
                            <div class="bottom">
                                @lang("Don't have an account?")

                                <a href="{{ route('register') }}">@lang('Create account')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
