@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')

<!-- Fund history -->
<section class="transaction-history profile-setting mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>{{trans($page_title)}}</h2>
             </div>
          </div>
       </div>

        <div class="edit-area">
            <form class="form-row" action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="email" class="golden-text">@lang('Receiver Email Address')</label>
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

                    <div class="col-md-12 mb-4">
                        <label for="amount" class="golden-text">@lang('Amount')</label>
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

                    <div class="col-md-12 mb-4">
                        <label for="" class="golden-text"
                            >@lang('Select Wallet')</label
                        >
                        <select
                            class="form-select"
                            name="wallet_type" id="wallet_type"
                            aria-label="Default select example"
                        >
                            <option value="" selected disabled class="text-white bg-dark">{{trans('Select Wallet')}}</option>
                            <option value="balance" class="text-white bg-dark">{{trans('Main balance')}}</option>
                            <option value="interest_balance" class="text-white bg-dark">{{trans('Interest Balance')}}</option>
                        </select>
                        @error('wallet_type')
                            <div class="error text-danger">@lang($message) </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="password" class="golden-text">@lang('Enter Password')</label>
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
                <button type="submit" class="gold-btn">@lang('Submit')</button>
            </form>
        </div>

    </div>
 </section>



@endsection
