@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')
    @push('navigator')
        <!-- PAGE-NAVIGATOR -->
        <section id="page-navigator">
            <div class="container-fluid">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"
                                                       class="cursor-inherit">{{__($page_title)}}</a></li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- /PAGE-NAVIGATOR -->
    @endpush


    <section id="dashboard">
        <div class="dashboard-wrapper add-fund pb-50">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card secbg form-block br-4">
                        <div class="card-body">
                            <div class="card-body-inner">
                                <form class="form-row" action="" method="post">
                                    @csrf

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label>@lang('Receiver Email Address')</label>
                                            <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="@lang('Receiver Email Address')">
                                            @error('email')
                                            <div class="error text-danger">@lang($message) </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label>@lang('Amount')</label>
                                            <input class="form-control" type="text" name="amount" value="{{old('amount')}}" placeholder="@lang('Enter Amount')"  onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                            @error('amount')
                                            <div class="error text-danger">@lang($message) </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('Select Wallet')</label>
                                            <select name="wallet_type" id="wallet_type"  class="form-control form-control-lg">
                                                <option value="balance">{{trans('Main balance')}}</option>
                                                <option value="interest_balance">{{trans('Interest Balance')}}</option>
                                            </select>

                                            @error('wallet_type')
                                            <div class="error text-danger">@lang($message) </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label>@lang('Enter Password')</label>
                                            <input class="form-control" type="password" name="password" value="{{old('password')}}" placeholder="@lang('Your Password')" >
                                            @error('password')
                                            <div class="error text-danger">@lang($message) </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mt-3">
                                            <button type="submit"
                                                    class=" btn btn-rounded btn-primary base-btn btn-block">
                                                <span>@lang('Submit')</span></button>

                                        </div>
                                    </div>



                                </form>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
