@extends($theme.'layouts.user')
@section('title', trans($title))

@section('content')

<!-- investment plans -->
<section class="payment-gateway mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>@lang($title)</h2>
             </div>
          </div>
       </div>

       <div class="row">
            @foreach($gateways as $key => $gateway)
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="gateway-box">
                        <img
                            class="img-fluid gateway"
                            src="{{ getFile(config('location.withdraw.path').$gateway->image)}}"
                            alt="{{$gateway->name}}"
                        >
                            <button type="button"
                                    data-id="{{$gateway->id}}"
                                    data-name="{{$gateway->name}}"
                                    data-min_amount="{{getAmount($gateway->minimum_amount, $basic->fraction_number)}}"
                                    data-max_amount="{{getAmount($gateway->maximum_amount,$basic->fraction_number)}}"
                                    data-percent_charge="{{getAmount($gateway->percent_charge,$basic->fraction_number)}}"
                                    data-fix_charge="{{getAmount($gateway->fixed_charge, $basic->fraction_number)}}"

                                    @if($payoutSettings->saturday == 0 && $today == 'saturday')
                                        data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                        data-offday="{{ $today }}"
                                        data-days="{{ $payoutSettings }}"
                                        class="gold-btn notifyOffDay"
                                    @elseif($payoutSettings->sunday == 0 && $today == 'sunday')
                                        data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                        data-offday="{{ $today }}"
                                        data-days="{{ $payoutSettings }}"
                                    class="gold-btn notifyOffDay"
                                    @elseif($payoutSettings->monday == 0 && $today == 'monday')
                                        data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                        data-offday="{{ $today }}"
                                        data-days="{{ $payoutSettings }}"
                                        class="gold-btn notifyOffDay"
                                    @elseif($payoutSettings->tuesday == 0 && $today == 'tuesday')
                                        data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                        data-offday="{{ $today }}"
                                        data-days="{{ $payoutSettings }}"
                                        class="gold-btn notifyOffDay"
                                    @elseif($payoutSettings->wednesday == 0 && $today == 'wednesday')
                                        data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                        data-offday="{{ $today }}"
                                        data-days="{{ $payoutSettings }}"
                                        class="gold-btn notifyOffDay"
                                    @elseif($payoutSettings->thursday == 0 && $today == 'thursday')
                                        data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                        data-offday="{{ $today }}"
                                        data-days="{{ $payoutSettings }}"
                                        class="gold-btn notifyOffDay"
                                    @elseif($payoutSettings->friday == 0 && $today == 'friday')
                                        data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                        data-offday="{{ $today }}"
                                        data-days="{{ $payoutSettings }}"
                                        class="gold-btn notifyOffDay"
                                    @else
                                        data-bs-toggle="modal" data-bs-target="#addFundModal"
                                        class="gold-btn addFund"
                                    @endif>
                                @lang('PAYOUT NOW')
                            </button>
                    </div>
                </div>
            @endforeach
       </div>
    </div>
</section>


    @push('loadModal')
        <div id="addFundModal" class="modal fade addFundModal" tabindex="-1" role="dialog" data-bs-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content form-block">
                    <div class="modal-header">
                        <h4 class="modal-title method-name golden-text"></h4>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            class="btn-close"
                            aria-label="Close"
                        >
                            <img src="{{asset($themeTrue.'img/icon/cross.png')}}" alt="@lang('modal dismiss')" />
                        </button>
                    </div>

                    <form action="{{route('user.payout.moneyRequest')}}" method="post">
                        @csrf
                    <div class="modal-body">
                        <div class="payment-form ">
                            <p class="depositLimit"></p>
                            <p class="depositCharge"></p>

                            <div class="form-group my-3">
                                <h5 class="mb-2 golden-text d-block modal_text_level">@lang('Select wallet')</h5>
                                <select class="form-control" name="wallet_type">
                                    <option
                                        value="balance" class="bg-dark text-white">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                    <option value="interest_balance" class="bg-dark text-white">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                </select>
                            </div>

                            <input type="hidden" class="gateway" name="gateway" value="">

                            <div class="form-group mb-30 mt-3">
                                <div class="box">
                                    <h5 class="golden-text">@lang('Amount')</h5>
                                    <div class="input-group">
                                        <input
                                            type="text" class="amount form-control" name="amount"
                                        />
                                        <button class="gold-btn show-currency"></button>
                                    </div>
                                </div>
                                @error('amount')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="submit" class="btn gold-btn ">@lang('Next')</button>
                    </div>

                    </form>

                </div>
            </div>
        </div>

        <div id="payoutOffDayModal" class="modal fade addFundModal" tabindex="-1" role="dialog" data-bs-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content form-block">
                    <div class="modal-header">
                        <h4 class="modal-title method-name golden-text">@lang('Payout Information')</h4>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            class="btn-close"
                            aria-label="Close"
                        >
                            <img src="{{asset($themeTrue.'img/icon/cross.png')}}" alt="@lang('modal dismiss')" />
                        </button>
                    </div>

                    <form action="{{route('user.payout.moneyRequest')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="payment-form ">
                                <span class="withdrawClose"></span> <span class="toDay text-danger"></span>
                                <p class="openDays mt-3"> @lang('Opening Days :')
                                    <span class="saturday badge bg-primary custom-size"></span>
                                    <span class="sunday badge bg-success custom-size"></span>
                                    <span class="monday badge bg-info custom-size"></span>
                                    <span class="tuesday badge bg-warning custom-size"></span>
                                    <span class="wednesday badge bg-success custom-size"></span>
                                    <span class="thursday badge bg-primary custom-size"></span>
                                    <span class="friday badge bg-info custom-size"></span>
                                </p>
                            </div>
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
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            @foreach($errors->all() as $key => $error)
            Notiflix.Notify.Failure("@lang($error)");
            @endforeach
        </script>
    @endif

    <script>
        "use strict";
        var id, minAmount, maxAmount, baseSymbol, fixCharge, percentCharge, currency, gateway;

        $('.notifyOffDay').on('click', function (){
            let today = $(this).data('offday');
            let days = $(this).data('days');
            if (days.saturday != 0){
                $('.saturday').text('Saturday');
            }
            if (days.sunday != 0){
                $('.sunday').text('Sunday');
            }
            if (days.monday != 0){
                $('.monday').text('Monday');
            }
            if (days.tuesday != 0){
                $('.tuesday').text('Tuesday');
            }
            if (days.wednesday != 0){
                $('.wednesday').text('Wednesday');
            }
            if (days.thursday != 0){
                $('.thursday').text('Thursday');
            }
            if (days.friday != 0){
                $('.friday').text('Friday');
            }


            $('.withdrawClose').text(`@lang('Payment withdrawal closes on ')`);
            $('.toDay').text(`${today}`);

        })

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

