@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')

    <!-- two-factor-security start -->
    <section class="login_signup_area">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 col-md-5">
                    <div class="login_signup_banner">
                        <div class="image_area animation1">
                            <img src="{{ asset($themeTrue.'img/login/1.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-7">
                    <div class="login_signup_form p-4">
                        <div class="section_header text-center">
                            <h4 class="pt-30 pb-30">@lang('Two Factor Security Verification')</h4>
                        </div>
                        <form action="{{ route('user.twoFA-Verify') }}" method="post">
                            @csrf

                            <p>@lang('Enter Your Verification Code')</p>
                            <div class="input-group mb-3">
                                <input type="text" name="code" class="form-control" value="{{old('code')}}" placeholder="@lang('Enter Your Two Factor Security Code')">
                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-code"></i></span>
                            </div>
                            @error('code')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                            @error('error')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror

                            <button type="submit" class="btn custom_btn mt-30 w-100">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- two-factor-security end -->
@endsection
