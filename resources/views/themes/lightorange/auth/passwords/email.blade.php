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

                            <form class="login-form wow fadeInUp" action="{{ route('password.email') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-30">
                                            <input type="email" class="username" name="email" value="{{old('email')}}"
                                            placeholder="@lang('Enter your Email Address')">

                                            @error('email')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 btn-area">
                                        <button type="submit" class="cmn-btn">@lang('Send Password Reset Link')</button>
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

