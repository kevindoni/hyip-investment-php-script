@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
    <!-- email_verification_start -->
    <section class="contact_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-md-6 order-2 order-md-1 offset-3">
                    <div class="form_area p-4 shadow1 ">
                        <form action="{{ route('user.mailVerify') }}" method="post">
                            @csrf
                            <div class="form_title pb-2">
                                <h4>@lang('Enter Your Verification Code')</h4>
                            </div>
                            <div class="mb-4">
                                <input
                                    type="text"
                                    name="code"
                                    class="form-control"
                                    value="{{old('code')}}"
                                    placeholder="@lang('Enter Your Email Verification Code')"
                                    autocomplete="off">
                                @error('code')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                @error('error')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                            </div>

                            <button type="submit" class="btn custom_btn mt-30">@lang('Submit')</button>
                            <div class="pt-5 d-flex">
                                @lang("Didn't get Code? Click to")
                                <br>
                                <p class="ms-2"><a href="{{route('user.resendCode')}}?type=email">@lang('Resend code')</a></p>
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
