@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
<section class="login-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="login-box">
                <form action="{{ route('user.twoFA-Verify') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box mb-4">
                                <h4 class="golden-text">@lang('Enter Your Code')</h4>
                                <div class="input-group">
                                    <div class="img">
                                        <img src="{{asset($themeTrue.'img/icon/padlock.png')}}" alt="@lang('email img')" />
                                    </div>
                                    <input
                                        type="text"
                                        name="code"
                                        class="form-control"
                                        value="{{old('code')}}"
                                        placeholder="@lang('Enter Your Code')"
                                        autocomplete="off"
                                    />
                                </div>
                                @error('code')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                @error('error')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="gold-btn-block" type="submit">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
