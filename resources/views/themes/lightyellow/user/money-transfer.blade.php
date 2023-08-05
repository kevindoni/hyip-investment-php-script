@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')

    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <h3 class="mb-0">@lang('Balance Transfer')</h3>
                </div>

                <div class="search-bar my-search-bar p-0">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-box">
                                    <label for="email" class="darkblue-text-bold">@lang('Receiver Email Address')</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email" value="{{old('email')}}" placeholder="@lang('Receiver Email Address')"
                                    />
                                    @error('email')
                                    <div class="error text-danger">@lang($message) </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-box">
                                    <label for="email" class="darkblue-text-bold">@lang('Amount')</label>
                                    <input
                                        type="text"
                                        id="amount"
                                        class="form-control"
                                        name="amount" value="{{old('amount')}}" placeholder="@lang('Enter Amount')"  onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                    />
                                    @error('amount')
                                    <div class="error text-danger">@lang($message) </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-box col-lg-6 col-md-6 col-sm-12">
                                <label for="" class="darkblue-text-bold"
                                >@lang('Select Wallet')</label
                                >
                                <select name="wallet_type" id="wallet_type" class="form-control js-example-basic-single">
                                    <option value="" selected disabled class="text-white bg-dark">{{trans('Select Wallet')}}</option>
                                    <option value="balance" class="text-white bg-dark">{{trans('Main balance')}}</option>
                                    <option value="interest_balance" class="text-white bg-dark">{{trans('Interest Balance')}}</option>
                                </select>
                                @error('wallet_type')
                                <div class="error text-danger">@lang($message) </div>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="input-box">
                                    <label for="email" class="darkblue-text-bold">@lang('Enter Password')</label>
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password" value="{{old('password')}}" placeholder="@lang('Your Password')"
                                    />
                                    @error('password')
                                    <div class="error text-danger">@lang($message) </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <button class="btn-custom" type="submit">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict'
        $(".js-example-basic-single").select2({
            width: '100%',
        });
    </script>
@endpush
