@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
    <!-- email_verification_start -->
    <section class="login-section">
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-6">
                    <div class="form-wrapper d-flex align-items-center h-100">
                        <form action="{{ route('user.mailVerify') }}" method="post">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <h4>@lang('Enter Your Verification Code')</h4>
                                </div>
                                <div class="input-box col-12">
                                    <input type="text"
                                           name="code"
                                           class="form-control"
                                           value="{{old('code')}}"
                                           placeholder="@lang('Enter Your Email Verification Code')"
                                           autocomplete="off" />
                                    @error('code')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                    @error('error')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                </div>
                                <div class="input-box col-12">
                                    <button class="btn-custom" type="submit">@lang('Submit')</button>
                                </div>
                            </div>
                            <div class="bottom">
                                @lang("Didn't get Code? Click to")

                                <a href="{{route('user.resendCode')}}?type=email">@lang('Resend code')</a>
                                @error('resend')
                                <p class="text-danger mt-1">{{ trans($message) }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- email_verification_end -->
@endsection



