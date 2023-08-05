@extends($theme.'layouts.app')
@section('title',__('Reset Password'))


@section('content')
<section class="login-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="login-box">
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

                        <div class="row">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="col-md-12">
                                <div class="box mb-4">
                                    <h4 class="golden-text">@lang('New Password')</h4>
                                    <div class="input-group">
                                        <div class="img">
                                            <img src="{{asset($themeTrue.'img/icon/padlock.png')}}" alt="@lang('password img')" />
                                        </div>
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            placeholder="@lang('New Password')"
                                        />
                                    </div>
                                    @error('password')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box mb-4">
                                    <h4 class="golden-text">@lang('Confirm Password')</h4>
                                    <div class="input-group">
                                        <div class="img">
                                            <img src="{{asset($themeTrue.'img/icon/padlock.png')}}" alt="@lang('password img')" />
                                        </div>
                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            class="form-control"
                                            placeholder="@lang('Confirm Password')"
                                        />
                                    </div>
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
