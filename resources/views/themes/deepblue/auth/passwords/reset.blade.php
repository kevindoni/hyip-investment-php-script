@extends($theme.'layouts.app')
@section('title','Reset Password')


@section('content')

    <section id="about-us" class="about-page secbg-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="form-block py-5">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                {{ trans(session('status')) }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form class="login-form" action="{{route('password.update')}}"   method="post">
                            @csrf

                            @error('token')
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                {{ trans($message) }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror


                            <div class="signin">
                                <h3 class="title mb-30">@lang('Reset Password')</h3>

                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">



                                <div class="form-group mb-20">
                                    <input class="form-control" type="password" name="password" placeholder="@lang('New Password')">
                                    @error('password')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group mb-20">
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="@lang('Confirm Password')">
                                </div>


                                <div class="btn-area">
                                    <button class="btn-login login-auth-btn" type="submit"><span>@lang('Submit')</span></button>
                                </div>

                                <div class="login-query mt-30 text-center">
                                    <a href="{{ route('register') }}">@lang("Don't have any account? Sign Up")</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
