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

                        <form class="login-form" action="{{ route('password.email') }}"  method="post">
                            @csrf
                            <div class="signin">
                                <h3 class="title mb-30">@lang('Reset Password')</h3>

                                <div class="form-group mb-30">
                                    <input class="form-control" type="email" name="email" value="{{old('email')}}"
                                           placeholder="@lang('Enter your Email Address')">

                                    @error('email')<span class="text-danger  mt-1">{{ trans($message) }}</span>@enderror
                                </div>


                                <div class="btn-area">
                                    <button class="btn-login login-auth-btn" type="submit"><span>@lang('Send Password Reset Link')</span></button>
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

