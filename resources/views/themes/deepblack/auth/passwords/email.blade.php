@extends($theme.'layouts.app')
@section('title',__('Reset Password'))

@section('content')
    <!-- login -->
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
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box mb-4">
                                        <h4 class="golden-text">@lang('Enter Your Email Address')</h4>
                                        <div class="input-group">
                                            <div class="img">
                                                <img src="{{asset($themeTrue.'img/icon/email2.png')}}" alt="@lang('email img')" />
                                            </div>
                                            <input
                                                type="email"
                                                name="email"
                                                class="form-control"
                                                value="{{old('email')}}"
                                                placeholder="@lang('Enter Your Email Address')"
                                            />
                                        </div>
                                        @error('email')<span class="text-danger mt-1">{{ trans($message) }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button class="gold-btn-block" type="submit">@lang('Send Password Reset Link')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

