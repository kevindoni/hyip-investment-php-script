@if(isset($templates['investment'][0]) && $investment = $templates['investment'][0])
    <section class="plan_area shape3">
        <div class="container">
            <div class="row">
                <div class="section_header mb-30 text-center text-sm-start">
                    <div class="section_subtitle">@lang(@$investment->description->title)</div>
                    <h1>@lang(@$investment->description->sub_title)</h1>
                    <p>
                        @lang(@$investment->description->short_details)
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="pills-home-tab"
                         tabindex="0">
                        <div class="container">
                            <div class="row g-4 pt-30 justify-content-center">
                                @foreach($plans as $k => $data)
                                    @php
                                        $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();
                                    @endphp
                                    @if($data)
                                        <div class="col-lg-4 col-sm-6 mb-70">
                                            <div class="cmn_box box1 shadow3">
                                                <div class="price top-left-radius-0">@lang($data->name)</div>
                                                <div class="image_area">
                                                    <img src="" alt="">
                                                </div>
                                                <h3>{{$data->price}}</h3>
                                                @if ($data->profit_type == 1)
                                                    <h4>
                                                        <span>{{getAmount($data->profit)}}{{'%'}} </span> @lang('Every') {{trans($getTime->name)}}
                                                    </h4>
                                                @else
                                                    <h4><span
                                                            class="golden-text"><small><sup>{{trans($basic->currency_symbol)}}</sup></small>{{getAmount($data->profit)}} <small
                                                                class="small-font">@lang('Every') {{trans($getTime->name)}}</small></span>
                                                    </h4>
                                                @endif
                                                <p>@lang('Capital will back') : <small><span
                                                            class="badge-small badge bg-{{($data->is_capital_back ==1) ? 'success':'danger'}}">{{($data->is_capital_back ==1) ? trans('Yes'): trans('No')}}</span></small>
                                                </p>
                                                @if($data->is_lifetime == 0)
                                                    <p> @lang('Total') {{trans($data->profit*$data->repeatable)}} {{($data->profit_type == 1) ? '%': trans($basic->currency)}}

                                                        @if($data->is_capital_back == 1)
                                                            + <span
                                                                class="badge badge_bg2 px-2 py-1 rounded-pill">@lang('Capital')</span>
                                                        @endif
                                                    </p>
                                                @else
                                                    <p> @lang('Lifetime Earning') </p>
                                                @endif

                                                <div class="btn_area">
                                                    <button type="button"
                                                            class="custom_btn mt-50 top-right-radius-0 investNow"
                                                            data-price="{{$data->price}}"
                                                            data-resource="{{$data}}">@lang('Invest Now')</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plan_modal_start -->
    <div class="plan_modal">
        <!-- Modal -->
        <div class="modal fade" id="investNowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow1">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">@lang('Invest Now')</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                src="{{ asset($themeTrue.'img/modal/cancel.png') }}" alt="@lang('not found')"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal_title plan-name"></div>
                        <p class="modal_text price-range"></p>
                        <p class="modal_text profit-details"></p>
                        <p class="modal_text profit-validity"></p>
                        <form class="text-start mt-20 login-form" id="invest-form"
                              action="{{route('user.purchase-plan')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <h6 for="select" class="form-label">@lang('Select wallet')</h6>
                                <select class="form-select" aria-label="Default select example" name="balance_type">
                                    @auth
                                        <option
                                            value="balance">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                        <option
                                            value="interest_balance">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                    @endauth
                                    <option value="checkout">@lang('Checkout')</option>
                                </select>
                            </div>
                            <h6 for="select" class="form-label">@lang('Amount')</h6>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control invest-amount" name="amount" id="amount"
                                       value="{{old('amount')}}"
                                       onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                       autocomplete="off"
                                       placeholder="@lang('Enter amount')">
                            </div>
                            <input type="hidden" name="plan_id" class="plan-id">
                            <button type="submit" class="custom_btn w-100">@lang('Invest Now')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Plan_modal_end -->
@endif
<!-- plan_area_end -->

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
@endpush
