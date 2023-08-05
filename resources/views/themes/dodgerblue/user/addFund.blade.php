@extends($theme.'layouts.user')
@section('title')
    @lang('Add Fund')
@endsection

@section('content')

    <!-- main -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h3 class="ms-2 mb-0 mt-2">{{trans('Add Fund')}}</h3>
                </div>
            </div>
        </div>

        <section class="payment-gateway mt-4">
            <div class="container-fluid">
                <div class="row">
                    @foreach($gateways as $key => $gateway)
                        <div class="col-xl-2 col-lg-2 col-sm-6 mb-4">
                            <div class="card-box">
                                <div class="gateway-box">
                                    <img class="img-fluid gateway"
                                         src="{{ getFile(config('location.gateway.path').$gateway->image)}}"
                                         alt="{{$gateway->name}}">
                                    <button type="button"
                                            data-id="{{$gateway->id}}"
                                            data-name="{{$gateway->name}}"
                                            data-currency="{{$gateway->currency}}"
                                            data-gateway="{{$gateway->code}}"
                                            data-min_amount="{{getAmount($gateway->min_amount, $basic->fraction_number)}}"
                                            data-max_amount="{{getAmount($gateway->max_amount,$basic->fraction_number)}}"
                                            data-percent_charge="{{getAmount($gateway->percentage_charge,$basic->fraction_number)}}"
                                            data-fix_charge="{{getAmount($gateway->fixed_charge, $basic->fraction_number)}}"
                                            class="gold-btn addFund"
                                            data-bs-toggle="modal" data-bs-target="#addFundModal">@lang('Pay Now')
                                    </button>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </section>
    </div>


    @push('loadModal')
        <!-- Modal -->
        <div class="modal fade addFundModal" id="addFundModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content form-block">
                    <div class="modal-header">
                        <h4 class="modal-title method-name golden-text"></h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="payment-form">
                            @if(0 == $totalPayment)
                                <p class="golden-text depositLimit lebelFont"></p>
                                <p class="golden-text depositCharge lebelFont"></p>
                            @endif
                            <input type="hidden" class="gateway" name="gateway" value="">

                            <form action="">
                                <div class="row g-3 align-items-end">
                                    <div class="input-box col-12">
                                        <h5 class="text-white">@lang('Amount')</h5>
                                        <div class="input-group">
                                            <input type="text" class="amount form-control" name="amount"
                                                   @if($totalPayment != null) value="{{$totalPayment}}" readonly @endif/>
                                            <button class="btn-custom show-currency"></button>
                                        </div>
                                        <pre class="text-danger errors"></pre>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="payment-info text-center">
                            <img id="loading" src="{{asset('assets/admin/images/loading.gif')}}" alt="@lang('loader')"
                                 class="w-15"/>
                        </div>

                        <div class="input-box col-12 modal-footer">
                            <button class="btn-custom w-100 checkCalc" type="button"><i class="fal fa-angle-right"></i>@lang('Next')</button>
                        </div>
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
                        <li class="list-group-item bg-transparent text-white list-text customborder">
                            <img src="${data.gateway_image}"
                                style="max-width:100px; max-height:100px; margin:0 auto;"/>
                        </li>
                        <li class="list-group-item bg-transparent text-white list-text customborder">
                            @lang('Amount'):
                            <strong>${data.amount} </strong>
                        </li>
                        <li class="list-group-item bg-transparent text-white list-text customborder">@lang('Charge'):
                                <strong>${data.charge}</strong>
                        </li>
                        <li class="list-group-item bg-transparent text-white list-text customborder">
                            @lang('Payable'): <strong> ${data.payable}</strong>
                        </li>
                        <li class="list-group-item bg-transparent text-white list-text customborder">
                            @lang('Conversion Rate'): <strong>${data.conversion_rate}</strong>
                        </li>
                        <li class="list-group-item bg-transparent text-white list-text customborder">
                            <strong>${data.in}</strong>
                        </li>

                        ${(data.isCrypto == true) ? `
                        <li class="list-group-item bg-transparent text-white list-text customborder">
                            ${data.conversion_with}
                        </li>
                        ` : ``}

                        <li class="list-group-item bg-transparent">
                        <a href="${data.payment_url}" class="btn btn-custom addFund">@lang('Pay Now')</a>
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

