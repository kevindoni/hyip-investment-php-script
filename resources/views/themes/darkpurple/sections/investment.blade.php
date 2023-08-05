<!-- pricing section -->
{{--<section class="pricing-section">--}}
{{--    <div class="container">--}}
{{--        @if(isset($templates['investment'][0]) && $investment = $templates['investment'][0])--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="header-text text-center">--}}
{{--                        <h5>@lang(@$investment->description->title)</h5>--}}
{{--                        <h2>@lang(@$investment->description->sub_title)</h2>--}}
{{--                        <p>@lang(@$investment->description->short_details)</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row g-4 g-lg-5 justify-content-center">--}}
{{--                @foreach($plans as $k => $data)--}}
{{--                    @php--}}
{{--                        $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();--}}
{{--                    @endphp--}}


{{--                    @if($data)--}}
{{--                        <div class="col-lg-4 col-md-6">--}}
{{--                            <div--}}
{{--                                class="pricing-box"--}}
{{--                                data-aos="fade-up"--}}
{{--                                data-aos-duration="1000"--}}
{{--                                data-aos-anchor-placement="center-bottom">--}}
{{--                                <h4 class="text-capitalize">@lang($data->name)</h4>--}}
{{--                                <h2>{{$data->price}}</h2>--}}
{{--                                @if ($data->profit_type == 1)--}}
{{--                                    <h5>{{getAmount($data->profit)}}{{'%'}} <small--}}
{{--                                            class="small-font">@lang('Every') {{trans($getTime->name)}}</small></h5>--}}
{{--                                @else--}}
{{--                                    <h5>--}}
{{--                                        <small><sup>{{trans($basic->currency_symbol)}}</sup></small>{{getAmount($data->profit)}}--}}
{{--                                        <small class="small-font">@lang('Every') {{trans($getTime->name)}}</small></h5>--}}
{{--                                @endif--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <i class="far fa-chevron-double-right"></i> @lang('Profit For')  {{($data->is_lifetime ==1) ? trans('Lifetime') : trans('Every').' '.trans($getTime->name)}}--}}
{{--                                        <span class="badge">@lang('Yes')</span>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <i class="far fa-chevron-double-right"></i> @lang('Capital will back')--}}
{{--                                        <small><span--}}
{{--                                                class="badge">{{($data->is_capital_back ==1) ? trans('Yes'): trans('No')}}</span></small>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        @if($data->is_lifetime == 0)--}}
{{--                                            <i class="far fa-chevron-double-right"></i> {{trans($data->profit*$data->repeatable)}} {{($data->profit_type == 1) ? '%': trans($basic->currency)}}--}}
{{--                                            +--}}
{{--                                            @if($data->is_capital_back == 1)--}}
{{--                                                <span class="badge">@lang('Capital')</span>--}}
{{--                                            @endif--}}
{{--                                        @else--}}
{{--                                            <span class="badge">@lang('Lifetime Earning')</span>--}}
{{--                                        @endif--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <button type="button" class="btn-custom investNow" data-price="{{$data->price}}"--}}
{{--                                        data-resource="{{$data}}">--}}
{{--                                    @lang('Invest Now')--}}
{{--                                </button>--}}
{{--                                <span class="feature text-capitalize">@lang(\Illuminate\Support\Str::limit($data->badge, 8))</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            <!-- Modal -->--}}
{{--            <div class="modal fade addFundModal" id="investNowModal" tabindex="-1" aria-labelledby="planModalLabel"--}}
{{--                 aria-hidden="true" data-bs-backdrop="static">--}}
{{--                <div class="modal-dialog modal-dialog-centered modal-md">--}}
{{--                    <form action="{{route('user.purchase-plan')}}" method="post" id="invest-form" class="login-form">--}}
{{--                        @csrf--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h4 class="modal-title" id="planModalLabel">@lang('Invest Now')</h4>--}}
{{--                                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                                    <i class="fal fa-times"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}

{{--                                <h2 class="title text-center plan-name"></h2>--}}
{{--                                <p class="text-center price-range font-20"></p>--}}
{{--                                <p class="text-center profit-details font-18"></p>--}}
{{--                                <p class="text-center profit-validity pb-3 font-18"></p>--}}

{{--                                <div class="row g-4">--}}
{{--                                    <div class="input-box col-12">--}}
{{--                                        <h6 class="mb-2 golden-text d-block modal_text_level">@lang('Select wallet')</h6>--}}
{{--                                        <select class="form-select" name="balance_type">--}}
{{--                                            @auth--}}
{{--                                                <option--}}
{{--                                                    value="balance">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>--}}
{{--                                                <option--}}
{{--                                                    value="interest_balance">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>--}}
{{--                                            @endauth--}}
{{--                                            <option value="checkout">@lang('Checkout')</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="input-box col-12">--}}
{{--                                        <h6 class="mb-2 golden-text d-block modal_text_level">@lang('Amount')</h6>--}}
{{--                                        <div class="input-group mb-3">--}}
{{--                                            <input--}}
{{--                                                type="text" class="invest-amount form-control" name="amount" id="amount"--}}
{{--                                                value="{{old('amount')}}"--}}
{{--                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"--}}
{{--                                                autocomplete="off"--}}
{{--                                                placeholder="@lang('Enter amount')" required>--}}
{{--                                            <button class="gold-btn show-currency input-group-text btn-custom-2"--}}
{{--                                                    id="basic-addon2" type="button"></button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <input type="hidden" name="plan_id" class="plan-id">--}}
{{--                                <button type="submit" class="btn-custom">@lang('Invest Now')</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</section>--}}



<!-- pricing section -->
<section class="pricing-section">
    <div class="container">
        <div class="row">
            <div class="header-text text-center">
                <h5>Investon History</h5>
                <h2>Investment <span class="text-stroke">Plans</span></h2>
                <p class="mx-auto">
                    Help agencies to define their new business ofjectives and then create professional software.
                </p>
            </div>
        </div>
        <div class="row justify-content-center g-4 g-lg-5">
            <div class="col-lg-4 col-md-6">
                <div class="pricing-box">
                    <h4>Business Plan</h4>
                    <h2 class="text-primary">$69 - $999</h2>
                    <h6>6% Every Day</h6>
                    <ul>
                        <li>Profit For Every Day <span class="bg-success">Yes</span></li>
                        <li>Capital will back <span class="bg-danger">No</span></li>
                        <li>Capital will back <span class="bg-danger">No</span></li>
                    </ul>
                    <button
                        class="btn-custom w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#investModal"
                    >
                        Invest now
                    </button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="pricing-box">
                    <h4>Starter Pack</h4>
                    <h2 class="text-primary">$50 - $400</h2>
                    <h6>6% Every Day</h6>
                    <ul>
                        <li>Profit For Every Day <span class="bg-success">Yes</span></li>
                        <li>Capital will back <span class="bg-danger">No</span></li>
                        <li>Capital will back <span class="bg-danger">No</span></li>
                    </ul>
                    <button
                        class="btn-custom w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#investModal"
                    >
                        Invest now
                    </button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="pricing-box">
                    <h4>Business Plan</h4>
                    <h2 class="text-primary">$69 - $999</h2>
                    <h6>6% Every Day</h6>
                    <ul>
                        <li>Profit For Every Day <span class="bg-success">Yes</span></li>
                        <li>Capital will back <span class="bg-danger">No</span></li>
                        <li>Capital will back <span class="bg-danger">No</span></li>
                    </ul>
                    <button
                        class="btn-custom w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#investModal"
                    >
                        Invest now
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="investModal" tabindex="-1" aria-labelledby="investModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="investModalLabel">Search</h5>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3 align-items-end">
                        <div class="input-box col-12">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <div class="input-box col-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Amount">
                                <span class="input-group-text">USD</span>
                            </div>
                        </div>
                        <div class="input-box col-12">
                            <button class="btn-custom w-100"><i class="fal fa-wallet"></i>invest now</button>
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
@endpush

