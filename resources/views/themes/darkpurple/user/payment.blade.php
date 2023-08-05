@extends($theme.'layouts.user')
@section('title')
    @lang('Payment')
@endsection

@section('content')

    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">@lang('Payment')</h3>
                </div>
            </div>

            <div class="row g-4 mb-4">
                @foreach($gateways as $key => $gateway)
                    <div class="col-xl-2 col-md-6">
                        <div class="dashboard-box p-3">
                            <img
                                class="img-fluid gateway"
                                src="{{ getFile(config('location.gateway.path').$gateway->image)}}"
                                alt="{{$gateway->name}}"
                            >
                            <button type="button"
                                    data-id="{{$gateway->id}}"
                                    data-name="{{$gateway->name}}"
                                    data-currency="{{$gateway->currency}}"
                                    data-gateway="{{$gateway->code}}"
                                    data-min_amount="{{getAmount($gateway->min_amount, $basic->fraction_number)}}"
                                    data-max_amount="{{getAmount($gateway->max_amount,$basic->fraction_number)}}"
                                    data-percent_charge="{{getAmount($gateway->percentage_charge,$basic->fraction_number)}}"
                                    data-fix_charge="{{getAmount($gateway->fixed_charge, $basic->fraction_number)}}"
                                    class="btn-custom mt-2 addFund "
                                    data-bs-toggle="modal" data-bs-target="#addFundModal">@lang('Pay Now')
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    @push('loadModal')
        <div id="addFundModal" class="modal fade addFundModal" tabindex="-1" role="dialog" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header modal-header-custom">
                        <h4 class="modal-title method-name text-white"></h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times text-white" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div class="modal-body ">
                        <div class="payment-form ">
                            @if(0 == $totalPayment)
                                <p class="golden-text depositLimit lebelFont"></p>
                                <p class="golden-text depositCharge lebelFont"></p>
                            @endif

                            <input type="hidden" class="gateway" name="gateway" value="">

                            <div class="form-group mb-30">
                                <label class="darkblue-text-bold">@lang('Plan Name')</label>
                                <input type="text" class=" form-control darkpurple__input__group__fixed bg-dark" value="{{$plan->name}}" readonly>
                            </div>


                            <div class="form-group mb-30 mt-3">
                                <div class="box">
                                    <h5 class="darkblue-text-bold">@lang('Amount')</h5>
                                    <div class="input-group">
                                        <div class="input-group mb-3 cutom__referal_input__group">
                                            <input type="text"
                                                   class="form-control amount darkpurple__input__group__fixed bg-dark"
                                                   name="amount" @if($totalPayment != null) value="{{$totalPayment}}" readonly @endif>
                                            <button
                                                class="input-group-text btn-custom copy__referal_btn copytext show-currency bg-transparent"
                                                type="button"></button>
                                        </div>
                                    </div>
                                </div>
                                <pre class="text-danger errors"></pre>
                            </div>
                        </div>

                        <div class="payment-info text-center">
                            <img id="loading" src="{{asset('assets/admin/images/loading.gif')}}" alt="@lang('loader')"
                                 class="w-15"/>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button"
                                class="btn btn-custom text-white addCreateListingRoute btn-custom-rounded checkCalc">@lang('Next')</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush


@endsection



@push('script')

    <script>
        $('#loading').hide();
        "use strict";
        var id, minAmount, maxAmount, baseSymbol, fixCharge, percentCharge, currency, amount, gateway;
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

            $('.method-name').text(`@lang('Payment By') ${$(this).data('name')} - ${currency}`);
            $('.show-currency').text("{{config('basic.currency')}}");
            $('.gateway').val(currency);

            // amount
        });


        $(".checkCalc").on('click', function () {
            $('.payment-form').addClass('d-none');

            $('#loading').show();
            $('.modal-backdrop.fade').addClass('show');
            amount = $('.amount').val();
            $.ajax({
                url: "{{route('user.addFund.request')}}",
                type: 'POST',
                data: {
                    amount,
                    gateway
                },
                success(data) {

                    $('.payment-form').addClass('d-none');
                    $('.checkCalc').closest('.modal-footer').addClass('d-none');

                    var htmlData = `
                     <ul class="list-group text-center">
                        <li class="list-group-item bg-transparent list-text customborder">
                            <img src="${data.gateway_image}"
                                style="max-width:100px; max-height:100px; margin:0 auto;"/>
                        </li>
                        <li class="list-group-item bg-transparent list-text text-white customborder">
                            @lang('Amount'):
                            <strong>${data.amount} </strong>
                        </li>
                        <li class="list-group-item bg-transparent list-text text-white customborder">@lang('Charge'):
                                <strong>${data.charge}</strong>
                        </li>
                        <li class="list-group-item bg-transparent list-text text-white customborder">
                            @lang('Payable'): <strong> ${data.payable}</strong>
                        </li>
                        <li class="list-group-item bg-transparent text-white list-text customborder">
                            @lang('Conversion Rate'): <strong>${data.conversion_rate}</strong>
                        </li>
                        <li class="list-group-item bg-transparent list-text text-white customborder">
                            <strong>${data.in}</strong>
                        </li>

                        ${(data.isCrypto == true) ? `
                        <li class="list-group-item bg-transparent list-text text-white customborder">
                            ${data.conversion_with}
                        </li>
                        ` : ``}

                        <li class="mt-2 list-group-item bg-transparent">
                            <a href="${data.payment_url}" class="btn btn-custom after__pay__now text-white addFund">@lang('Pay Now')</a>
                        </li>
                        </ul>`;

                    $('.payment-info').html(htmlData)
                },
                complete: function () {
                    $('#loading').hide();
                },
                error(err) {
                    var errors = err.responseJSON;
                    for (var obj in errors) {
                        $('.errors').text(`${errors[obj]}`)
                    }

                    $('.payment-form').removeClass('d-none');
                }
            });
        });


        $('.close').on('click', function (e) {
            $('#loading').hide();
            $('.payment-form').removeClass('d-none');
            $('.checkCalc').closest('.modal-footer').removeClass('d-none');
            $('.payment-info').html(``)
            $('.amount').val(``);
            $("#addFundModal").modal("hide");
        });

    </script>
@endpush

