@extends($theme.'layouts.user')
@section('title', trans($title))
@push('navigator')
    <!-- PAGE-NAVIGATOR -->
    <section id="page-navigator">
        <div class="container-fluid">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">@lang($title)</a></li>
                </ol>
            </div>
        </div>
    </section>
    <!-- /PAGE-NAVIGATOR -->
@endpush
@section('content')

    <section id="dashboard">
        <div class="dashboard-wrapper add-fund pb-20">
            <div class="row feature-wrapper top-0 add-fund">
                @foreach($gateways as $key => $gateway)
                    <div class="col-xl-2 col-lg-3 col-md-4  col-sm-6 col-6 mb-30">
                        <div class="card card-type-1 text-center">

                            <div class="card-icon">
                                <img src="{{ getFile(config('location.withdraw.path').$gateway->image)}}"
                                     alt="{{$gateway->name}}" class="gateway">
                            </div>
                            <button type="button"
                                    data-id="{{$gateway->id}}"
                                    data-name="{{$gateway->name}}"
                                    data-min_amount="{{getAmount($gateway->minimum_amount, $basic->fraction_number)}}"
                                    data-max_amount="{{getAmount($gateway->maximum_amount,$basic->fraction_number)}}"
                                    data-percent_charge="{{getAmount($gateway->percent_charge,$basic->fraction_number)}}"
                                    data-fix_charge="{{getAmount($gateway->fixed_charge, $basic->fraction_number)}}"
                                    class="btn btn-danger btn-block  mt-2 colorbg-1 addFund"
                                    data-backdrop='static' data-keyboard='false'
                                    data-toggle="modal" data-target="#addFundModal">@lang('PAYOUT NOW')</button>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>





    @push('loadModal')
        <div id="addFundModal" class="modal fade addFundModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content form-block">
                    <div class="modal-header">
                        <h6 class="modal-title method-name"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="white-text">&times;</span>
                        </button>
                    </div>

                    <form action="{{route('user.payout.moneyRequest')}}" method="post">
                        @csrf

                    <div class="modal-body ">
                        <div class="payment-form ">
                            <p class="text-danger depositLimit"></p>
                            <p class="text-danger depositCharge"></p>

                            <div class="form-group mb-30">
                                <strong class="mb-2 d-block modal_text_level">@lang('Select wallet')</strong>
                                <select class="form-control" name="wallet_type">

                                        <option
                                            value="balance">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                        <option value="interest_balance">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                </select>
                            </div>

                            <input type="hidden" class="gateway" name="gateway" value="">

                            <div class="form-group mb-30">
                                <label>@lang('Amount')</label>
                                <div class="input-group input-group-lg">
                                    <input type="text" class="amount form-control" name="amount">
                                    <div class="input-group-append">
                                        <span class="input-group-text show-currency"></span>
                                    </div>
                                </div>
                                @error('amount')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="submit" class="btn btn-primary base-btn ">@lang('Next')</button>
                    </div>

                    </form>

                </div>
            </div>
        </div>
    @endpush


@endsection



@push('script')

    @if(count($errors) > 0 )
        <script>
            @foreach($errors->all() as $key => $error)
            Notiflix.Notify.Failure("@lang($error)");
            @endforeach
        </script>
    @endif

    <script>
        "use strict";

        var id, minAmount, maxAmount, baseSymbol, fixCharge, percentCharge, currency, gateway;

        $('.addFund').on('click', function () {
            id = $(this).data('id');
            gateway = $(this).data('gateway');
            minAmount = $(this).data('min_amount');
            maxAmount = $(this).data('max_amount');
            baseSymbol = "{{config('basic.currency_symbol')}}";
            fixCharge = $(this).data('fix_charge');
            percentCharge = $(this).data('percent_charge');
            currency = $(this).data('currency');
            $('.depositLimit').text(`@lang('Transaction Limit:') ${minAmount} - ${maxAmount}  ${baseSymbol}`);

            var depositCharge = `@lang('Charge:') ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' + percentCharge + ' % ' : ''}`;
            $('.depositCharge').text(depositCharge);
            $('.method-name').text(`@lang('Payout By') ${$(this).data('name')}`);
            $('.show-currency').text("{{config('basic.currency')}}");
            $('.gateway').val(id);
        });
        $('.close').on('click', function (e) {
            $('#loading').hide();
            $('.amount').val(``);
            $("#addFundModal").modal("hide");
        });

    </script>
@endpush

