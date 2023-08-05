@extends($theme.$layout)
@section('title', trans($title))
@section('content')
    <!-- main -->
    <section class="payment-gateway mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2>@lang($title)</h2>
                    </div>
                </div>
            </div>
            <div class="row profile-setting">
                <div class="col-md-3">
                    <div class="card text-center">
                        <ul class="list-group">
                            <li class="list-group-item font-weight-bold bg-darkBlack">
                                <img
                                    src="{{getFile(config('location.withdraw.path').optional($withdraw->method)->image)}}"
                                    class="card-img-top w-50" alt="{{optional($withdraw->method)->name}}">
                            </li>
                            <li class="list-group-item font-weight-bold list-text bg-custom-primary  text-white">@lang('Request Amount')
                                :
                                <span
                                    class="float-right text-danger text-white">{{@$basic->currency_symbol}}{{getAmount($withdraw->amount)}} </span>
                            </li>
                            <li class="list-group-item font-weight-bold list-text bg-custom-primary  text-white">@lang('Charge Amount')
                                :
                                <span
                                    class="float-right text-danger text-white">{{@$basic->currency_symbol}}{{getAmount($withdraw->charge)}} </span>
                            </li>
                            <li class="list-group-item font-weight-bold list-text bg-custom-primary  text-white">@lang('Total Payable')
                                :
                                <span
                                    class="float-right text-danger text-white">{{@$basic->currency_symbol}}{{getAmount($withdraw->net_amount)}} </span>
                            </li>
                            @if($layout != 'layouts.payment')
                                <li class="list-group-item font-weight-bold list-text bg-custom-primary  text-white">@lang('Available Balance')
                                    :
                                    <span
                                        class="float-right text-danger text-white">{{@$basic->currency_symbol}}{{$remaining}} </span>
                                </li>
                            @endif
                            <div id="showInfo">

                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-type-1 bg-custom-primary">
                        <div class="card-header custom-header text-center borderBottom">
                            <h3 class="golden-text card-title pt-2">@lang('Additional Information To Withdraw Confirm')</h3>
                        </div>

                        <div class="card-body edit-area bg-darkBlue">
                            <form @if($layout == 'layouts.payment') action="{{route('user.payout.submit',$billId)}}"
                                  @else action="{{ route('user.payout.submit.flutterwave',$withdraw->trx_id) }}"
                                  @endif method="post" enctype="multipart/form-data"
                                  class="form-row text-left preview-form">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="form-group input-box search-currency-dropdown">
                                            <label for="from_wallet">@lang('Select Transfer')</label>
                                            <select id="from_wallet" name="transfer_name"
                                                    class="form-control form-control-sm bank">
                                                <option value="" disabled=""
                                                        selected="">@lang('Select Transfer')</option>
                                                @foreach($payoutMethod->banks as $bank)
                                                    <option
                                                        value="{{$bank}}" {{old('transfer_name') == $bank ?'selected':''}}>{{$bank}}</option>
                                                @endforeach
                                            </select>
                                            @error('transfer_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if($payoutMethod->supported_currency)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="form-group input-box search-currency-dropdown">
                                                <label for="from_wallet">@lang('Select Bank Currency')</label>
                                                <select id="from_wallet" name="currency_code"
                                                        class="form-control form-control-sm transfer-currency">
                                                    <option value="" disabled=""
                                                            selected="">@lang('Select Currency')</option>
                                                    @foreach($payoutMethod->supported_currency as $singleCurrency)
                                                        <option
                                                            value="{{$singleCurrency}}"
                                                            @foreach($payoutMethod->convert_rate as $key => $rate)
                                                                @if($singleCurrency == $key) data-rate="{{$rate}}" @endif
                                                            @endforeach {{old('currency_code') == $singleCurrency ?'selected':''}}>{{$singleCurrency}}</option>
                                                    @endforeach
                                                </select>
                                                @error('currency_code')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row input-box dynamic-bank mx-1 d-none">
                                    <label>@lang('Select Bank')</label>
                                    <select id="dynamic-bank" name="bank"
                                            class="form-control form-control-sm">
                                    </select>
                                    @error('bank')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="row dynamic-input mt-4">

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn-custom mt-3 w-100">
                                            <span>@lang('Confirm Now')</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('css-lib')

@endpush
@push('extra-js')

@endpush
@push('script')
    <script type="text/javascript">
        var bankName = null;
        var payAmount = '{{$withdraw->amount}}'
        var baseCurrency = "{{config('basic.currency')}}"
        var transferName = "{{old('transfer_name')}}";
        if (transferName) {
            getBankForm(transferName);
        }

        $(document).on("change", ".transfer-currency", function () {
            let currencyCode = $(this).val();
            let rate = $(this).find(':selected').data('rate');
            let getAmount = parseFloat(rate) * parseFloat(payAmount);
            var output = null;
            $('#showInfo').html('');
            output = `<li class="list-group-item font-weight-bold list-text bg-custom-primary  text-white">@lang('Exchange rate') :
                        <span
                            class="float-right text-white">1 ${baseCurrency} = ${rate} ${currencyCode}</span>
                    </li>
                    <li class="list-group-item font-weight-bold list-text bg-custom-primary  text-white">@lang('You will get:') :
                        <span
                            class="float-right text-white">${getAmount} ${currencyCode}</span>
                    </li>`

            $('#showInfo').html(output);
        })

        $(document).on("change", ".bank", function () {
            bankName = $(this).val();
            $('.dynamic-bank').addClass('d-none');
            getBankForm(bankName);
        })

        function getBankForm(bankName) {
            $.ajax({
                url: "{{route('user.payout.getBankFrom')}}",
                type: "post",
                data: {
                    bankName,
                },
                success: function (response) {
                    console.log(response)
                    if (response.bank != null) {
                        showBank(response.bank.data)
                    }
                    showInputForm(response.input_form)
                }
            });
        }

        function showBank(bankLists) {
            $('#dynamic-bank').html(``);
            var options = `<option disabled selected>@lang("Select Bank")</option>`;
            for (let i = 0; i < bankLists.length; i++) {
                options += `<option value="${bankLists[i].code}">${bankLists[i].name}</option>`;
            }

            $('.dynamic-bank').removeClass('d-none');
            $('#dynamic-bank').html(options);
        }

        function showInputForm(form_fields) {
            $('.dynamic-input').html(``);
            var output = "";

            for (let field in form_fields) {
                let newKey = field.replace('_', ' ');
                output += `<div class="input-box col-md-6 mt-3">
                         <label>${newKey}</label>
				         <input type="text" name="${field}" value="" class="form-control" required>
			          </div>`
            }
            $('.dynamic-input').html(output);
        }

    </script>

    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp
        <script>
            "use strict";
            @foreach ($errors as $error)
            Notiflix.Notify.Failure("{{ trans($error) }}");
            @endforeach
        </script>
    @endif
@endpush

