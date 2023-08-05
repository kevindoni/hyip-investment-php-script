@extends($theme.'layouts.app')
@section('title',__('Reset Password'))

@section('content')
    <!-- Two step verification -->
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
                            <form action="{{route('password.update')}}" method="post">
                                @csrf
                                @error('token')
                                <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                    {{ trans($message) }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                                <div class="row g-4">
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    <div class="col-12">
                                        <h4>@lang('New Password')</h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input type="password" name="password" class="form-control" placeholder="@lang('New Password')" autocomplete="off"/>
                                        @error('password')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                    </div>

                                    <div class="col-12">
                                        <h4>@lang('Confirm Password')</h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('Confirm Password')" autocomplete="off"/>
                                    </div>

                                </div>
                                <button class="btn-custom w-100" type="submit">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
