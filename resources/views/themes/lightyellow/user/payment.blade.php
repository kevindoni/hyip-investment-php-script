@extends($theme.'layouts.user')
@section('title',trans('Payment'))
@section('content')

    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
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
                            <button
                                data-id="{{$gateway->id}}"
                                data-name="{{$gateway->name}}"
                                data-currency="{{$gateway->currency}}"
                                data-gateway="{{$gateway->code}}"
                                data-min_amount="{{getAmount($gateway->min_amount, $basic->fraction_number)}}"
                                data-max_amount="{{getAmount($gateway->max_amount,$basic->fraction_number)}}"
                                data-percent_charge="{{getAmount($gateway->percentage_charge,$basic->fraction_number)}}"
                                data-fix_charge="{{getAmount($gateway->fixed_charge, $basic->fraction_number)}}"
                                class="gold-btn addFund add__fund__pay__now__btn mt-2"
                                data-bs-toggle="modal" data-bs-target="#addFundModal">@lang('Pay Now')
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    @push('loadModal')
        <div class="modal fade addFundModal" id="addFundModal" tabindex="-1" aria-labelledby="addListingmodal" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal-header-custom">
                        <h4 class="modal-title method-name text-white"></h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times text-white" aria-hidden="true"></i>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="payment-form">
                                @if(0 == $totalPayment)
                                    <p class="darkblue-text depositLimit lebelFont"></p>
                                    <p class="darkblue-text depositCharge lebelFont"></p>
                                @endif

                                <input type="hidden" class="gateway" name="gateway" value="">


                                <div class="form-group mb-30 mt-3">
                                    <div class="box">
                                        <h5 class="darkblue-text-bold">@lang('Amount')</h5>
                                        <div class="input-group">
                                            <div class="input-group mb-3 cutom__referal_input__group">
                                                <input type="text" class="form-control amount" name="amount" @if($totalPayment != null) value="{{$totalPayment}}" readonly @endif>
                                                <button class="input-group-text btn-custom copy__referal_btn copytext show-currency" type="button"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <pre class="text-danger errors"></pre>
                                </div>
                            </div>

                            <div class="payment-info text-center">
                                <img id="loading" src="{{asset('assets/admin/images/loading.gif')}}" alt="@lang('loader')" class="w-15"/>
                            </div>

                            <div class="mb-3 d-none" id="noOfListing">
                                <label for="message-text" class="col-form-label">@lang('No. of available listing')</label>
                                <input type="text" class="form-control total_no_of_listing_field"  readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary addCreateListingRoute btn-custom-rounded checkCalc">@lang('Next')</button>
                        </div>
                    </form>
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
                        <li class="list-group-item bg-transparent list-text darkblue-text customborder">
                            @lang('Amount'):
                            <strong>${data.amount} </strong>
                        </li>
                        <li class="list-group-item bg-transparent list-text darkblue-text customborder">@lang('Charge'):
                                <strong>${data.charge}</strong>
                        </li>
                        <li class="list-group-item bg-transparent list-text darkblue-text customborder">
                            @lang('Payable'): <strong> ${data.payable}</strong>
                        </li>
                        <li class="list-group-item bg-transparent darkblue-text list-text customborder">
                            @lang('Conversion Rate'): <strong>${data.conversion_rate}</strong>
                        </li>
                        <li class="list-group-item bg-transparent list-text darkblue-text customborder">
                            <strong>${data.in}</strong>
                        </li>

                        ${(data.isCrypto == true) ? `
                        <li class="list-group-item bg-transparent list-text darkblue-text customborder">
                            ${data.conversion_with}
                        </li>
                        ` : ``}

                        <li class="list-group-item mt-2">
                            <a href="${data.payment_url}" class="btn add__fund__pay__now__btn addFund">@lang('Pay Now')</a>
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


