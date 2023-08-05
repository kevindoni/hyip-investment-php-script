@extends($theme.'layouts.user')
@section('title', trans($title))

@section('content')

    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">@lang('Payout Money')</h3>
                </div>
            </div>

            <div class="row g-4 mb-4">
                @foreach($gateways as $key => $gateway)
                    <div class="col-xl-2 col-md-6">
                        <div class="dashboard-box p-3">
                            <img
                                class="img-fluid gateway"
                                src="{{ getFile(config('location.withdraw.path').$gateway->image)}}"
                                alt="{{$gateway->name}}"
                            >
                            <button
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
                                class="gold-btn add__fund__pay__now__btn mt-2 notifyOffDay"
                                @elseif($payoutSettings->sunday == 0 && $today == 'sunday')
                                    data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                data-offday="{{ $today }}"
                                data-days="{{ $payoutSettings }}"
                                class="gold-btn add__fund__pay__now__btn mt-2 notifyOffDay"
                                @elseif($payoutSettings->monday == 0 && $today == 'monday')
                                    data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                data-offday="{{ $today }}"
                                data-days="{{ $payoutSettings }}"
                                class="gold-btn add__fund__pay__now__btn mt-2 notifyOffDay"
                                @elseif($payoutSettings->tuesday == 0 && $today == 'tuesday')
                                    data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                data-offday="{{ $today }}"
                                data-days="{{ $payoutSettings }}"
                                class="gold-btn add__fund__pay__now__btn mt-2 notifyOffDay"
                                @elseif($payoutSettings->wednesday == 0 && $today == 'wednesday')
                                    data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                data-offday="{{ $today }}"
                                data-days="{{ $payoutSettings }}"
                                class="gold-btn add__fund__pay__now__btn mt-2 notifyOffDay"
                                @elseif($payoutSettings->thursday == 0 && $today == 'thursday')
                                    data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                data-offday="{{ $today }}"
                                data-days="{{ $payoutSettings }}"
                                class="gold-btn add__fund__pay__now__btn mt-2 notifyOffDay"
                                @elseif($payoutSettings->friday == 0 && $today == 'friday')
                                    data-bs-toggle="modal" data-bs-target="#payoutOffDayModal"
                                data-offday="{{ $today }}"
                                data-days="{{ $payoutSettings }}"
                                class="gold-btn add__fund__pay__now__btn mt-2 notifyOffDay"
                                @else
                                    data-bs-toggle="modal" data-bs-target="#addFundModal"
                                    class="gold-btn addFund add__fund__pay__now__btn mt-2"
                                @endif

                            >@lang('PAYOUT NOW')
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('loadModal')
        <div class="modal fade" id="addFundModal" tabindex="-1" aria-labelledby="addListingmodal" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal-header-custom">
                        <h4 class="modal-title method-name text-white"></h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times text-white" aria-hidden="true"></i>
                        </button>
                    </div>
                    <form action="{{route('user.payout.moneyRequest')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="payment-form">
                                    <p class="darkblue-text depositLimit"></p>
                                    <p class="darkblue-text depositCharge"></p>

                                <input type="hidden" class="gateway" name="gateway" value="">

                                <div class="form-group mb-30 mt-3">
                                    <div class="box input-box">
                                        <h5 class="darkblue-text-bold">@lang('Select Walet')</h5>
                                        <select class="form-select" name="wallet_type" aria-label="Default select example">
                                            <option value="balance" >@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                            <option value="interest_balance" >@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mb-30 mt-3">
                                    <div class="box">
                                        <h5 class="darkblue-text-bold">@lang('Amount')</h5>
                                        <div class="input-group">
                                            <div class="input-group mb-3 cutom__referal_input__group">
                                                <input type="text" class="form-control amount darkpurple__input__group__fixed" name="amount">
                                                <button class="input-group-text btn-custom copy__referal_btn copytext show-currency bg-transparent" type="button"></button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('amount')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-custom btn-custom-rounded text-white">@lang('Next')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="payoutOffDayModal" tabindex="-1" aria-hidden="true" aria-labelledby="addListingmodal" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-custom">
                        <h4 class="modal-title text-white">@lang('Payout Information')</h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times text-white" aria-hidden="true"></i>
                        </button>
                    </div>
                    <form action="{{route('user.payout.moneyRequest')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="payment-form">
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

