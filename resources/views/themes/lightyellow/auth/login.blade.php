@extends($theme.'layouts.app')
@section('title',__('Login'))

@section('content')
    <!-- login_area_start -->
    <section class="contact_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-md-6 ms-auto order-2 order-md-1">
                    <div class="form_area p-4 shadow1 ">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form_title pb-2">
                                <h3>@lang('Log In')</h3>
                            </div>
                            <div class="mb-4">
                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="@lang('Username or Email')">
                                @error('username')<span class="text-danger float-left">@lang($message)</span>@enderror
                                @error('email')<span class="text-danger float-left">@lang($message)</span>@enderror
                            </div>


                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                       placeholder="@lang('Password')">
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

                            <div class="mb-3 form-check d-flex justify-content-between">
                                <div class="check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleCheck1">@lang('Remember me')</label>
                                </div>
                                <div class="forgot">
                                    <a href="{{ route('password.request') }}">@lang('Forgot password?')</a>
                                </div>
                            </div>
                            <button type="submit" class="btn custom_btn mt-30">@lang('Log In')</button>
                            <div class="pt-5 d-flex">
                                @lang("Don't have an account?")
                                <br>
                                <h6 class="ms-2"><a href="{{ route('register') }}">@lang('Register')</a></h6>
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
    <!-- login_area_end -->
@endsection
