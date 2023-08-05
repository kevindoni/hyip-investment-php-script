@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
    <!-- Two step verification -->
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center align-items-end">
                <div class="col-lg-5 col-md-8">
                    <div class="form-wrapper">
                        <div class="form-box">
                            <form action="{{ route('user.twoFA-Verify') }}" method="post">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <h4 class="golden-text">@lang('Enter Your Code')</h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input type="text" name="code" class="form-control" value="{{old('code')}}" placeholder="@lang('Enter Your Code')" autocomplete="off"/>
                                        @error('code')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                        @error('error')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                    </div>
                                </div>
                                <button class="btn-custom w-100 mt-3" type="submit">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
