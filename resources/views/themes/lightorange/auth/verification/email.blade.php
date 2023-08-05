@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
<div class="overlay pt-150 pb-150">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card-area">
                    <h2 class="mb-30 color-one font-weight-bolder">@lang($page_title)</h2>

                    <form class="login-form wow fadeInUp" action="{{route('user.mailVerify')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-30">
                                    <input type="text" class="username" name="code" value="{{old('code')}}"
                                    placeholder="@lang('Code')" autocomplete="off">

                                    @error('code')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                    @error('error')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-lg-12 btn-area">
                                <button type="submit" class="linear-btn btn-block">@lang('Submit')</button>
                            </div>

                            <div class="col-lg-12 login-query mt-30 text-center">
                                <p class="text-center">@lang('Didn\'t get Code? Click to') <a href="{{route('user.resendCode')}}?type=email"  class="text-info"> @lang('Resend code')</a></p>

                                @error('resend')
                                <p class="text-danger  mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
