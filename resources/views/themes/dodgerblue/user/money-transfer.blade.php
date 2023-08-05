@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')
    <!-- main -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h3 class="ms-2 mb-0 mt-2">{{trans($page_title)}}</h3>
                </div>
            </div>
        </div>
        <div class="main row">
            <div class="col-12">
                <!-- table -->
                <div class="table-parent table-responsive mt-4">
                    <div class="table-search-bar">
                        <div>
                            <form action="" method="post">
                                @csrf
                                <div class="row g-3 align-items-end">
                                    <div class="input-box col-lg-6 col-md-6 col-xl-6 col-12">
                                        <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="@lang('Receiver Email Address')"/>
                                        @error('email')
                                        <div class="error text-danger">@lang($message) </div>
                                        @enderror
                                    </div>

                                    <div class="input-box col-lg-6 col-md-6 col-xl-6 col-12">
                                        <input class="form-control" type="text" name="amount" value="{{old('amount')}}" placeholder="@lang('Enter Amount')"  onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" />
                                        @error('amount')
                                            <div class="error text-danger">@lang($message) </div>
                                        @enderror
                                    </div>

                                    <div class="input-box col-lg-6 col-md-6 col-xl-6 col-12">
                                        <select class="js-example-basic-single form-control" name="wallet_type" id="wallet_type">
                                            <option disabled selected>@lang('Select Wallet')</option>
                                            <option value="balance">{{trans('Main balance')}}</option>
                                            <option value="interest_balance">{{trans('Interest Balance')}}</option>
                                        </select>
                                        @error('wallet_type')
                                            <div class="error text-danger">@lang($message) </div>
                                        @enderror
                                    </div>

                                    <div class="input-box col-lg-6 col-md-6 col-xl-6 col-12">
                                        <input class="form-control" type="password" name="password" value="{{old('password')}}" placeholder="@lang('Your Password')"/>
                                        @error('password')
                                        <div class="error text-danger">@lang($message) </div>
                                        @enderror
                                    </div>

                                    <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                        <button class="btn-custom w-100" type="submit"><i class="fal fa-dollar-sign"></i>@lang('Transfer')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
