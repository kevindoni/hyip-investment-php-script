@extends($theme.'layouts.app')
@section('title',__('Login'))

@section('content')

    <!-- login start -->
    <section id="login-section">
        <img class="img img-4 zoomInOutInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-4.png')}}" alt="@lang('ellipse-4-image')">
        <img class="img img-3 zoomInOut2sInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-3.png')}}" alt="@lang('ellipse-5-image')">
        <img class="img img-6 zoomInOut2sInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-6.png')}}" alt="@lang('ellipse-6-image')">
        <img class="img img-7 zoomInOutInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-7.png')}}" alt="@lang('ellipse-7-image')">

        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row d-flex justify-content-center ">
                    <div class="col-lg-6">
                        <div class="card-area">
                            <h2 class="mb-30 color-one font-weight-bolder">@lang('Sign Your Account')</h2>
                            <form class="login-form wow fadeInUp" action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <input type="text" class="username" name="username" placeholder="@lang('Email Or Username')">
                                            @error('username')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                                            @error('email')<span class="text-danger mt-1">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <input type="password" name="password" placeholder="@lang('Password')">
                                            @error('password')
                                                <span class="text-danger mt-1">{{ $message }}</span>
                                            @enderror
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
                                            <div class="input-checkbox d-flex justify-content-between">
                                                <label class="box-area">@lang('Remember me')
                                                    <input id="remember" type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="forgot-area">
                                                <a class="forgot" href="{{ route('password.request') }}">@lang("Forgot password?")</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 btn-area">
                                        <button type="submit" class="cmn-btn">@lang('Login')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login end -->
@endsection
