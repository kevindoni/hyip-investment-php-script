<section class="plan_area">
    <div class="container">
        @if(isset($templates['investment'][0]) && $investment = $templates['investment'][0])
            <div class="row">
                <div class="section_header mb-50 m-initial text-center">
                    <span class="section_category">@lang(@$investment->description->title)</span>
                    <h2 class="">@lang(@$investment->description->sub_title)</h2>
                    <p>@lang(@$investment->description->short_details)</p>
                </div>
            </div>

            <div class="row g-xl-5 g-md-4 g-5 align-items-center">
                @foreach($plans as $k => $data)
                    @php
                        $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();
                        $afterExplode = explode("-",$data->price);
                    @endphp

                @if($getTime)
                    <div class="col-lg-4 col-md-6">
                        <a>
                            <div class="box shadow1">
                                <div class="text_box">
                                    <div class="plan_title mb-20">@lang($data->name)</div>
                                    @if ($data->profit_type == 1)
                                        <div class="plan_header">{{getAmount($data->profit)}}{{'% '}}</div>
                                    @else
                                        <div
                                            class="plan_header">{{trans($basic->currency_symbol)}} {{getAmount($data->profit)}}</div>
                                    @endif
                                    <div class="plan_text my-2">@lang('Profit For')  {{($data->is_lifetime ==1) ? trans('Lifetime') : trans('Every').' '.trans($getTime->name)}}</div>
                                </div>
                                @if(count($afterExplode) > 1)
                                    <div class="invest_box d-flex justify-content-between">
                                        <div class="invest">
                                            <p>@lang('Min. Invest')</p>
                                            <div class="plan_title">
                                                {{ $afterExplode[0] }}
                                            </div>
                                        </div>
                                        <div class="invest">
                                            <p>@lang("Max. Invest")</p>
                                            <div class="plan_title">
                                                {{ $afterExplode[1] }}
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                    </div>
                                @else
                                    <div class="invest_box d-flex justify-content-center">
                                        <div class="invest">
                                            <p>@lang('Fixed Invest')</p>
                                            <div class="plan_title">
                                                {{  $data->price }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="btn_area mt-50 mb-3">
                                    <button type="button"
                                            class="custom_btn d-inline investNow custom__invest__btn__color"
                                            data-price="{{$data->price}}"
                                            data-resource="{{$data}}">@lang('Invest Now')</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>

            <!-- Plan_modal_start -->
            <div class="plan_modal">
                <!-- Modal -->
                <div class="modal fade" id="investNowModal" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true"
                     data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow1">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">@lang('Invest Now')</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                        src="{{ asset($themeTrue.'img/modal/cancel.png') }}" alt=""></button>
                            </div>
                            <form class="text-start mt-20 login-form" id="invest-form"
                                  action="{{route('user.purchase-plan')}}" method="post">
                                @csrf
                                <div class="modal-body pt-0">
                                    <div class="plan_title plan-name text-center"></div>
                                    <div class="plan_text price-range text-center"></div>
                                    <div class="plan_text profit-details text-center"></div>
                                    <div class="plan_text profit-validity text-center mb-4"></div>

                                    <div class="mb-3">
                                        <h6 for="select" class="form-label">@lang('Select Wallet')</h6>
                                        <select class="form-select" aria-label="Default select example"
                                                name="balance_type">
                                            @auth
                                                <option
                                                    value="balance"
                                                    class="bg-dark text-white">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                                <option
                                                    value="interest_balance"
                                                    class="bg-dark text-white">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                            @endauth
                                            <option value="checkout"
                                                    class="bg-dark text-white">@lang('Checkout')</option>
                                        </select>
                                    </div>
                                    <h6 for="amount" class="form-label">@lang('Amount')</h6>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control invest-amount" name="amount" id="amount"
                                               value="{{old('amount')}}"
                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                               autocomplete="off"
                                               placeholder="@lang('Enter amount')"
                                        >
                                        <button class="custom_btn show-currency" id="basic-addon2"></button>
                                    </div>
                                    <input type="hidden" name="plan_id" class="plan-id">
                                    <button type="submit" class="custom_btn w-100">@lang('Invest Now')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Plan_modal_end -->

        @endif
        @if(isset($templates['we-accept'][0]) && $weAccept = $templates['we-accept'][0])
            <div class="payment_method mt-100">
                <div class="row">
                    <div class="section_header text-center mb-20">
                        <h3>@lang('We Accept')</h3>
                    </div>

                    <div class="owl-carousel owl-theme payment_slider text-center">
                        @foreach($gateways as $gateway)
                            <div class="item align-items-center d-flex flex-column">
                                <img src="{{getFile(config('location.gateway.path').@$gateway->image)}}"
                                     class="image-partners" alt="{{@$gateway->name}}"/>
                                <div class="text_area">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

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

