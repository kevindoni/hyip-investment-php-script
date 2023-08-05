
@if(0 < count($plans))
@if(isset($templates['investment'][0]) && $investment = $templates['investment'][0])
<section id="plan-section">
    <div class="overlay pt-150 pb-150">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-7">
                    <div class="section-header">
                        <h4 class="sub-title">@lang(@$investment->description->title)</h4>
                        <h3 class="title">@lang(@$investment->description->sub_title)</h3>
                        <p class="area-para">@lang(@$investment->description->short_details)</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <ul class="nav nav-tabs d-flex justify-content-center" id="myTabPlan" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show bg-transparent" id="plangrid-tab" data-toggle="tab" href="#plangrid" role="tab" aria-controls="plangrid" aria-selected="true">
                            <i class="fas fa-th"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg-transparent" id="planlist-tab" data-toggle="tab" href="#planlist" role="tab" aria-controls="planlist" aria-selected="false">
                        <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>


                <div class="tab-content" id="myTabContentPlan">
                    <div class="tab-pane fade show active" id="plangrid" role="tabpanel" aria-labelledby="plangrid-tab">
                        @foreach($plans->chunk(3) as $key => $planColumns)
                        <div class="row d-flex justify-content-md-center mb-5">
                            @php
                            $i = 0;
                            @endphp
                            @foreach($planColumns as $k => $data)

                                @php
                                    $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();
                                @endphp
                                <div class="col-lg-4 col-md-6 wow  mb-40
                                    @if($i == 0) fadeInLeftBig @elseif($i == 1) fadeInUp @elseif($i == 2) fadeInRightBig @endif ">
                                    <div class="single-item text-center  mb-40">
                                        <div class="icon-area">
                                            <img src="{{asset('assets/themes/lightorange/images/plan.png')}}" alt="@lang('plan image')">
                                        </div>
                                        <div class="mid-area">
                                            <div class="title-area">
                                                <h2 class="area-title">@lang($data->name)</h2>
                                            </div>
                                            <div class="amount">
                                                <span>{{$data->price}}</span>
                                            </div>
                                            <div class="percentage">
                                                <span>
                                                    @if ($data->profit_type == 1)
                                                        <span class="highlight">{{getAmount($data->profit)}}{{'%'}}</span>
                                                    @else
                                                        <span class="highlight"><small><sup>{{trans($basic->currency_symbol)}}</sup></small>{{getAmount($data->profit)}}</span>
                                                    @endif
                                                     @lang('Every') {{trans($getTime->name)}}
                                                </span>
                                            </div>

                                            <div class="min-max">
                                                <span>@lang('Profit For')  {{($data->is_lifetime ==1) ? trans('Lifetime') : trans('Every').' '.trans($getTime->name)}}</span><br>

                                                <span>
                                                    @lang('Capital will back') :
                                                    <span class="badge badge-{{($data->is_capital_back ==1) ? 'success':'danger'}} px-2 py-1 text-white">{{($data->is_capital_back ==1) ? trans('Yes'): trans('No')}}</span>
                                                </span><br>

                                                <span>
                                                    @if($data->is_lifetime == 0)
                                                        @lang('Total')   {{trans($data->profit*$data->repeatable)}} {{($data->profit_type == 1) ? '%': trans($basic->currency)}}
                                                        @if($data->is_capital_back == 1)
                                                            + <span class="badge badge-success text-white">@lang('Capital')</span>
                                                        @endif
                                                    @else
                                                        @lang('Lifetime Earning')
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="btn-area">
                                            <a href="javascript:void(0)" class="cmn-btn investNow" type="button"
                                                data-toggle="modal"
                                                data-target="#investNowModal"
                                                data-price="{{$data->price}}"
                                                data-resource="{{$data}}"
                                                >
                                                @lang('Invest Now')
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    ++$i;
                                @endphp
                            @endforeach

                        </div>
                        @endforeach
                    </div>


                    <div class="tab-pane fade" id="planlist" role="tabpanel" aria-labelledby="planlist-tab">
                        <div class="row">

                            @foreach($plans as $k => $data)
                            <div class="col-lg-12 mb-4">
                                @php
                                    $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();
                                @endphp
                                    <div class="list-single-item d-flex justify-content-between align-items-center">
                                        <div class="number-area">
                                            <span>{{$data->price}}</span>
                                        </div>
                                        <div class="btn-first">
                                            <a href="javascript:void(0)" class="cmn-btn">@lang($data->name)</a>
                                        </div>
                                        <div class="deposit-area d-flex">
                                            <img src="{{asset('assets/themes/lightorange/images/plan2.png')}}" alt="@lang('plan image')">
                                            <div class="min-max">
                                                <p>@lang('Profit For')  {{($data->is_lifetime ==1) ? trans('Lifetime') : trans('Every').' '.trans($getTime->name)}} </p>

                                                <p>@lang('Capital will back') :
                                                    <span class="badge badge-{{($data->is_capital_back ==1) ? 'success':'danger'}} px-2 py-1 text-white">{{($data->is_capital_back ==1) ? trans('Yes'): trans('No')}}</span></> </p>

                                                <p>@if($data->is_lifetime == 0)
                                                    @lang('Total') {{trans($data->profit*$data->repeatable)}} {{($data->profit_type == 1) ? '%': trans($basic->currency)}}
                                                    @if($data->is_capital_back == 1)
                                                        + <span class="badge badge-success text-white">@lang('Capital')</span>
                                                    @endif
                                                @else
                                                    @lang('Lifetime Earning')
                                                @endif </p>
                                            </div>
                                        </div>
                                        <div class="terms-area d-flex align-items-center ">
                                            <img src="{{asset('assets/themes/lightorange/images/plan3.png')}}" alt="@lang('plan image')">
                                            <div class="right-area">
                                                @if ($data->profit_type == 1)
                                                    <h3>{{getAmount($data->profit)}}{{'%'}}</h3>
                                                @else
                                                    <h3><small><sup>{{trans($basic->currency_symbol)}}</sup></small>{{getAmount($data->profit)}}</h3>
                                                @endif
                                                <p>@lang('Every') {{trans($getTime->name)}}</p>
                                            </div>
                                        </div>
                                        <div class="btn-last">
                                            <a href="javascript:void(0)" class="cmn-btn investNow" type="button"
                                                data-toggle="modal"
                                                data-target="#investNowModal"
                                                data-price="{{$data->price}}"
                                                data-resource="{{$data}}"
                                            >
                                            @lang('Invest Now')
                                        </a>
                                        </div>
                                    </div>
                            </div>

                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
<!-- plan start end -->
@endif


<!-- INVEST-NOW MODAL -->
<div class="modal fade" id="investNowModal" tabindex="-1" data-backdrop="static"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Invest Now')</h5>
          <button type="button" class="close btn-close-investment" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-dark">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-block">
                <form class="login-form" id="invest-form" action="{{route('user.purchase-plan')}}" method="post">
                    @csrf
                    <div class="signin ">
                        <h3 class="title plan-name"></h3>

                        @if($basic->theme == 'lightorange')
                            <p class="text-center price-range font-20 planDetails"></p>
                            <p class="text-center profit-details font-18 planDetails"></p>
                            <p class="text-center profit-validity pb-3 font-18 planDetails"></p>
                        @else
                            <p class="text-success text-center price-range font-20"></p>
                            <p class="text-success text-center profit-details font-18"></p>
                            <p class="text-success text-center profit-validity pb-3 font-18"></p>
                        @endif

                        <div class="form-group mb-30">
                            <strong class="mb-2 d-block modal_text_level">@lang('Select wallet')</strong>
                            <select class="form-control" name="balance_type">
                                @auth
                                    <option
                                        value="balance">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                    <option
                                        value="interest_balance">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                @endauth
                                <option value="checkout">@lang('Checkout')</option>
                            </select>
                        </div>

                        <div class="form-group mb-30">
                            <input type="text" class="form-control invest-amount" id="amount" name="amount"
                                   value="{{old('amount')}}"
                                   onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                   autocomplete="off">
                        </div>
                        <input type="hidden" name="plan_id" class="plan-id">

                        <div class="btn-area mb-30">
                            <button type="submit" class="linear-btn btn-block">@lang('Invest Now')</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>
      </div>
    </div>
  </div>
<!-- INVEST-NOW MODAL -->

@endif

@if($basic->theme == 'lightorange')
    @push('script')
        <script>
            "use strict";
            (function ($) {
                $(document).on('click', '.investNow', function () {
                    $("#investNowModal").toggleClass("modal-open");
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

                    $('.profit-details').html(`<strong> @lang('Interest'): ${(data.profit_type == '1') ? `${data.profit} %` : `${data.profit} ${currency}`}  </strong>`);
                    $('.profit-validity').html(`<strong>  @lang('Per') ${data.schedule} @lang('hours') ,  ${(data.is_lifetime == '0') ? `${data.repeatable} @lang('times')` : `@lang('Lifetime')`} </strong>`);
                    $('.plan-name').text(data.name);
                    $('.plan-id').val(data.id);
                });



                $(".btn-close-investment").on('click',function(){
                    $("#investNowModal").removeClass("modal-open");
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
@else
    @push('script')
        <script>
            "use strict";
            (function ($) {
                $(document).on('click', '.investNow', function () {
                    $("#modal-login").toggleClass("modal-open");
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

                    $('.profit-details').html(`<strong> @lang('Interest'): ${(data.profit_type == '1') ? `${data.profit} %` : `${data.profit} ${currency}`}  </strong>`);
                    $('.profit-validity').html(`<strong>  @lang('Per') ${data.schedule} @lang('hours') ,  ${(data.is_lifetime == '0') ? `${data.repeatable} @lang('times')` : `@lang('Lifetime')`} </strong>`);
                    $('.plan-name').text(data.name);
                    $('.plan-id').val(data.id);
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
@endif
