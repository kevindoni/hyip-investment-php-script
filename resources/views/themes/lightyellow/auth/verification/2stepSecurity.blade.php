@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
    <!-- two-factor-security start -->
        <section class="contact_area">
            <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-md-6 order-2 order-md-1 offset-3">
                    <div class="form_area p-4 shadow1 ">
                        <form action="{{ route('user.twoFA-Verify') }}" method="post">
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
                                    placeholder="@lang('Enter Your Two Factor Security Code')"
                                    autocomplete="off">

                                @error('code')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                @error('error')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                            </div>

                            <button type="submit" class="btn custom_btn mt-30">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    <!-- two-factor-security end -->
@endsection
