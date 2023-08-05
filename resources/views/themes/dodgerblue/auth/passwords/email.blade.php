@extends($theme.'layouts.app')
@section('title',__('Reset Password'))

@section('content')
    <!-- login section -->
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center align-items-end">
                <div class="col-lg-5 col-md-8">
                    <div class="form-wrapper">
                        <div class="form-box">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                    {{ trans(session('status')) }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('password.email') }}" method="post">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <h4 class="golden-text">@lang('Enter Your Email Address')</h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('Enter Your Email Address')" autocomplete="off"/>
                                        @error('email')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                    </div>

                                </div>
                                <button class="btn-custom w-100">@lang('Send Password Reset Link')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

