@extends($extend_blade)
@section('title',trans('Plan'))

@section('content')

    <!-- INVESTMENT -->
    <section id="investment" class="secbg-1 @auth pt-0 @endauth">
        <div class="@auth container-fluid @else container @endauth">
            @guest
                @if(isset($templates['investment'][0]) && $investment = $templates['investment'][0])
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-container">
                        <h6 class="topheading">@lang(@$investment->description->title)</h6>
                        <h3 class="heading">@lang(@$investment->description->sub_title)</h3>
                        <p class="slogan">@lang(@$investment->description->short_details)</p>
                    </div>
                </div>
            </div>
                    @endif
            @endguest

            <div class="investment-wrapper">
                <div class="row">
                    @foreach($plans as $k => $data)
                        @php
                            $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();
                        @endphp


                        <div class="@auth col-md-6 col-lg-4 col-xl-3 @else col-md-6 col-lg-4 @endauth  ">
                            <div class="card-type-1 card align-items-start wow fadeInUp" data-wow-duration="1s"
                                 data-wow-delay="0.15s">
                                @if($data->badge)
                                    <div class="featured"><span>{{__($data->badge)}}</span></div>
                                @endif
                                <h4 class="h4">@lang($data->name)</h4>

                                <h4 class="h4 themecolor">
                                    {{$data->price}}
                                </h4>
                                <div class="d-flex align-items-baseline">
                                    <h4 class="h4"> {{getAmount($data->profit)}}{{($data->profit_type == 1) ? '%': trans($basic->currency)}}</h4>
                                    <h6 class="ml-5">@lang('Every') {{trans($getTime->name)}} </h6>
                                </div>
                                <hr class="hr">

                                <p class="text">@lang('Profit For')  {{($data->is_lifetime ==1) ? trans('Lifetime') : trans('Every').' '.trans($getTime->name)}}</p>
                                <p class="text">
                                    @lang('Capital will back') :
                                    <span class="badge badge-{{($data->is_capital_back ==1) ? 'success':'danger'}} px-2 py-1">{{($data->is_capital_back ==1) ? trans('Yes'): trans('No')}}</span>
                                </p>

                                <p class="text">
                                    @if($data->is_lifetime == 0)
                                        @lang('Total')   {{trans($data->profit*$data->repeatable)}} {{($data->profit_type == 1) ? '%': trans($basic->currency)}}
                                        @if($data->is_capital_back == 1)
                                            + <span class="badge badge-success">@lang('Capital')</span>
                                        @endif
                                    @else
                                        @lang('Lifetime Earning')
                                    @endif
                                </p>

                                <button class="btn-base text-uppercase mt-30 investNow" type="button"
                                        data-price="{{$data->price}}"
                                        data-resource="{{$data}}">@lang('Invest Now')</button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- /INVESTMENT -->


    <!-- MODAL-LOGIN -->
    <div id="modal-login">
        <div class="modal-wrapper">
            <div class="modal-login-body">
                <div class="btn-close">&times;</div>
                <div class="form-block pb-5">
                    <form class="login-form" id="invest-form" action="{{route('user.purchase-plan')}}" method="post">
                        @csrf
                        <div class="signin ">
                            <h3 class="title mb-30 plan-name"></h3>

                            <p class="text-success text-center price-range font-20"></p>
                            <p class="text-success text-center profit-details font-18"></p>
                            <p class="text-success text-center profit-validity pb-3 font-18"></p>


                            <div class="form-group  mb-30">
                                <strong class="text-white mb-2 d-block">@lang('Select wallet')</strong>
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
                                <button class="btn-login login-auth-btn" type="submit"><span>@lang('Invest Now')</span>
                                </button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection


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
