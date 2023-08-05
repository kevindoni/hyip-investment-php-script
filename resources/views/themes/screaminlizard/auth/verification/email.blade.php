@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
    <!-- Email verification -->
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center align-items-end">
                <div class="col-lg-5 col-md-8">
                    <div class="form-wrapper">
                        <div class="form-box">
                            <form action="{{ route('user.mailVerify') }}" method="post">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <h4 class="golden-text">@lang('Enter Your Code')</h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input type="text" name="code" class="form-control" value="{{old('code')}}"
                                               placeholder="@lang('Enter Your Code')" autocomplete="off"/>
                                        @error('code')<span
                                            class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                        @error('error')<span
                                            class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                    </div>


                                </div>
                                <button class="btn-custom w-100 mt-3">@lang('Submit')</button>

                                <div class="col-lg-12 text-center mt-2">
                                    <p class="text-center">@lang("Didn't get Code? Click to") <a href="{{route('user.resendCode')}}?type=email" class="golden-text"> @lang('Resend code')</a></p>

                                    @error('resend')
                                    <p class="text-danger mt-1">{{ trans($message) }}</p>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
