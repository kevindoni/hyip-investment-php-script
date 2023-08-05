@if(isset($templates['investment'][0]) && $investment = $templates['investment'][0])
    <!-- plan start -->
    <section class="pricing-section">
        <div class="container">
            <div class="row">
                <div class="header-text text-center">
                    <h5>@lang(@$investment->description->title)</h5>
                    <h2>@lang(wordSplice($investment->description->sub_title)['withoutLastWord']) <span
                            class="text-stroke">@lang(wordSplice($investment->description->sub_title)['lastWord'])</span>
                    </h2>
                    <p class="mx-auto">
                        @lang(@$investment->description->short_details)
                    </p>
                </div>
            </div>

            <div class="row justify-content-center g-4 g-lg-5">
                @foreach($plans as $k => $data)
                    @php
                        $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-box">
                            <h4>@lang($data->name)</h4>
                            <h2 class="text-primary">{{$data->price}}</h2>
                            @if ($data->profit_type == 1)
                                <h6>{{getAmount($data->profit)}}{{'%'}} @lang('Every') {{trans($getTime->name)}}</h6>
                            @else
                                <h6><sup class="font-18">{{trans($basic->currency_symbol)}}</sup>{{getAmount($data->profit)}} @lang('Every') {{trans($getTime->name)}}</h6>
                            @endif

                            <ul>
                                <li>@lang('Profit For') {{($data->is_lifetime ==1) ? trans('Lifetime') : trans('Every').' '.trans($getTime->name)}}</li>
                                <li>@lang('Capital will back') : <span class="bg-{{($data->is_capital_back ==1) ? 'success':'danger'}}">{{($data->is_capital_back ==1) ? trans('Yes'): trans('No')}}</span></li>
                                @if($data->is_lifetime == 0)
                                    <li>@lang('Total') {{trans($data->profit*$data->repeatable)}} {{($data->profit_type == 1) ? '%': trans($basic->currency)}} +
                                        @if($data->is_capital_back == 1)
                                            <span class="bg-success">@lang('Capital')</span>
                                        @endif
                                    </li>

                                @else
                                    <li>@lang('Lifetime Earning')</li>
                                @endif

                            </ul>
                            <button class="btn-custom w-100 investNow" type="button" data-price="{{$data->price}}" data-resource="{{$data}}">@lang('Invest now')</button>
{{--                            data-bs-toggle="modal" data-bs-target="#investModal"--}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- plan end -->
@endif

<!-- Modal -->
<div class="modal fade addFundModal" id="investNowModal" tabindex="-1" data-bs-backdrop="static"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="investModalLabel">@lang('Invest Now')</h5>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4 class="title plan-name"></h4>
                    <p class="price-range"></p>
                    <p class="profit-details"></p>
                    <p class="profit-validity"></p>
                </div>
                <form class="login-form" id="invest-form" action="{{route('user.purchase-plan')}}" method="post">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="input-box col-12">
                            <select class="form-select" name="balance_type" aria-label="Default select example">
                                @auth
                                    <option
                                        value="balance">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                    <option
                                        value="interest_balance">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                @endauth
                                    <option value="checkout">@lang('Checkout')</option>
                            </select>
                        </div>
                        <div class="input-box col-12">
                            <div class="input-group">
                                <input type="text" class="invest-amount form-control" name="amount" id="amount" value="{{old('amount')}}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" autocomplete="off" placeholder="@lang('Enter amount')">
                                <button class="btn-custom input-group-text show-currency" type="button" id="button-addon2"></button>
                            </div>
                        </div>
                        <input type="hidden" name="plan_id" class="plan-id">

                        <div class="input-box modal-footer col-12">
                            <button class="btn-custom w-100">@lang('Invest Now')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        "use strict";
        (function ($) {
            $(document).on('click', '.investNow', function () {
                var planModal = new bootstrap.Modal(document.getElementById('investNowModal'))
                planModal.show()
                let data = $(this).data('resource');
                let price = $(this).data('price');
                let symbol = "{{trans($basic->currency_symbol)}}";
                let currency = "{{trans($basic->currency)}}";
                $('.price-range').text(`@lang('Invest'): ${price}`);

                if (data.fixed_amount == '0') {
                    $('.invest-amount').val('');
                    $('#amount').attr('readonly', false);
                } else {
                    $('.invest-amount').val(data.fixed_amount);
                    $('#amount').attr('readonly', true);
                }

                $('.profit-details').html(`@lang('Interest'): ${(data.profit_type == '1') ? `${data.profit} %` : `${data.profit} ${currency}`}`);
                $('.profit-validity').html(`@lang('Per') ${data.schedule} @lang('hours') ,  ${(data.is_lifetime == '0') ? `${data.repeatable} @lang('times')` : `@lang('Lifetime')`}`);
                $('.plan-name').text(data.name);
                $('.plan-id').val(data.id);
                $('.show-currency').text("{{config('basic.currency')}}");
            });

        })(jQuery);
    </script>

    @if(count($errors) > 0 )
        <script>
            @foreach($errors->all() as $key => $error)
            Notiflix.Notify.Failure("@lang($error)");
            @endforeach
        </script>
    @endif
@endpush
