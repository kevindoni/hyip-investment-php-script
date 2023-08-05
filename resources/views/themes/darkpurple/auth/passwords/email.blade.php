@extends($theme.'layouts.app')
@section('title',__('Reset Password'))

@section('content')
    <!-- login section -->
    <section class="login-section">
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-6">
                    <div class="form-wrapper d-flex align-items-center h-100">
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <h4>@lang('Recover Password')</h4>
                                </div>
                                <div class="input-box col-12">
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           value="{{old('email')}}"
                                           placeholder="@lang('Enter Your Email Address')" />
                                    @error('email')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                </div>
                                <div class="input-box col-12">
                                    <button class="btn-custom" type="submit">@lang('Submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
