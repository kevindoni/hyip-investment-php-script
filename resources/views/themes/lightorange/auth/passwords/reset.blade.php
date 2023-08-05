@extends($theme.'layouts.app')
@section('title','Reset Password')


@section('content')

    <section id="login-section">
        <img class="img img-4 zoomInOutInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-4.png')}}" alt="@lang('ellipse-4-image')">
        <img class="img img-3 zoomInOut2sInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-3.png')}}" alt="@lang('ellipse-5-image')">
        <img class="img img-6 zoomInOut2sInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-6.png')}}" alt="@lang('ellipse-6-image')">
        <img class="img img-7 zoomInOutInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-7.png')}}" alt="@lang('ellipse-7-image')">

        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="card-area">
                            <h2 class="mb-30 color-one font-weight-bolder">@lang('Reset Password')</h2>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                    {{ trans(session('status')) }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="login-form wow fadeInUp" action="{{route('password.update')}}" method="post">
                                @csrf

                                @error('token')
                                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                        {{ trans($message) }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror

                                <div class="row">
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <input type="password" class="username" name="password" placeholder="@lang('New Password')">
                                            @error('password')
                                                <span class="text-danger mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <input type="password" name="password_confirmation" placeholder="@lang('Confirm Password')">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 btn-area">
                                        <button type="submit" class="cmn-btn">@lang('Submit')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
