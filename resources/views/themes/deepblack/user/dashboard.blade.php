@extends($theme.'layouts.user')
@section('title',trans('Dashboard'))
@section('content')

    <!---- other balances ----->
    <section class="statistic-section mt-5 pt-5 pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2>@lang('dashboard')</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/fund.png')}}" alt="@lang('Main Balance')"/>
                        </div>
                        <h4>@lang('Main Balance')</h4>
                        <h2>
                            <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($walletBalance, config('basic.fraction_number'))}}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/money-bag.png')}}" alt="@lang('Interest Balance')"/>
                        </div>
                        <h4>@lang('Interest Balance')</h4>
                        <h2>
                            <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($interestBalance, config('basic.fraction_number'))}}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/invest.png')}}" alt="@lang('Total Deposit')"/>
                        </div>
                        <h4>@lang('Total Deposit')</h4>
                        <h2>
                            <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($totalDeposit, config('basic.fraction_number'))}}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/pay-history.png')}}" alt="@lang('Total Earn')"/>
                        </div>
                        <h4>@lang('Total Earn')</h4>
                        <h2>
                            <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($totalInterestProfit, config('basic.fraction_number'))}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---- charts ----->
    <section class="chart-information mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="progress-wrapper">
                        <div
                            id="container"
                            class="apexcharts-canvas"
                        ></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="progress-wrapper progress-wrapper-circle">
                        <div class="progress-container d-flex flex-column flex-sm-row justify-content-around">
                            <div class="circular-progress cp_1">
                                <svg
                                    class="radial-progress"
                                    data-percentage="{{getPercent($roi['totalInvest'], $roi['completed'])}}"
                                    viewBox="0 0 80 80"
                                >
                                    <circle
                                        class="incomplete"
                                        cx="40"
                                        cy="40"
                                        r="35"
                                    ></circle>
                                    <circle
                                        class="complete"
                                        cx="40"
                                        cy="40"
                                        r="35"
                                        style="
                                    stroke-dashoffset: 39.58406743523136;
                                    "
                                    ></circle>
                                    <text
                                        class="percentage"
                                        x="50%"
                                        y="53%"
                                        transform="matrix(0, 1, -1, 0, 80, 0)"
                                    >
                                        {{getPercent($roi['totalInvest'], $roi['completed'])}} %
                                    </text>
                                </svg>
                                <h4 class="golden-text mt-4 text-center">
                                    @lang('Invest Completed')
                                </h4>
                            </div>

                            <div class="circular-progress cp_3">
                                <svg
                                    class="radial-progress"
                                    data-percentage="{{100 - getPercent($roi['expectedProfit'], $roi['returnProfit'])}}"
                                    viewBox="0 0 80 80"
                                >
                                    <circle
                                        class="incomplete"
                                        cx="40"
                                        cy="40"
                                        r="35"
                                    ></circle>
                                    <circle
                                        class="complete"
                                        cx="40"
                                        cy="40"
                                        r="35"
                                        style="
                                    stroke-dashoffset: 39.58406743523136;
                                    "
                                    ></circle>
                                    <text
                                        class="percentage"
                                        x="50%"
                                        y="53%"
                                        transform="matrix(0, 1, -1, 0, 80, 0)"
                                    >
                                        {{100 - getPercent($roi['expectedProfit'], $roi['returnProfit'])}} %
                                    </text>
                                </svg>

                                <h4 class="golden-text mt-4 text-center">
                                    @lang('ROI Speed')
                                </h4>
                            </div>

                            <div class="circular-progress cp_2">
                                <svg
                                    class="radial-progress"
                                    data-percentage="{{getPercent($roi['expectedProfit'], $roi['returnProfit'])}}"
                                    viewBox="0 0 80 80"
                                >
                                    <circle
                                        class="incomplete"
                                        cx="40"
                                        cy="40"
                                        r="35"
                                    ></circle>
                                    <circle
                                        class="complete"
                                        cx="40"
                                        cy="40"
                                        r="35"
                                        style="
                                    stroke-dashoffset: 147.3406954533613;
                                    "
                                    ></circle>
                                    <text
                                        class="percentage"
                                        x="50%"
                                        y="53%"
                                        transform="matrix(0, 1, -1, 0, 80, 0)"
                                    >
                                        {{getPercent($roi['expectedProfit'], $roi['returnProfit'])}} %
                                    </text>
                                </svg>

                                <h4 class="golden-text mt-4 text-center">
                                    @lang('ROI Redeemed')
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!----- account balances ----->
    <section class="statistic-section mt-5 pt-5 pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2 class="text-center">@lang('Account Statistics')</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/money-bag.png')}}" alt="@lang('Total Invest')"/>
                        </div>
                        <h4>@lang('Total Invest')</h4>
                        <h2>
                            <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($roi['totalInvestAmount'])}}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/payout.png')}}" alt="@lang('Total Payout')"/>
                        </div>
                        <h4>@lang('Total Payout')</h4>
                        <h2>
                            <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($totalPayout)}}
                        </h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/support.png')}}" alt="@lang('Total Ticket')"/>
                        </div>
                        <h4>@lang('Total Ticket')</h4>
                        <h2>{{$ticket}}</h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/bonus.png')}}" alt="@lang('Total Referral Bonus')"/>
                        </div>
                        <h4>@lang('Total Referral Bonus')</h4>
                        <h2>
                            <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($depositBonus + $investBonus)}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!----- refferal-information ----->
    <section class="refferal-link mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-{{($latestRegisteredUser) ? '12':'6'}}">
                    <div class="box">
                        <h4 class="golden-text">@lang('Referral Link')</h4>
                        <div class="input-group">
                            <input
                                type="text"
                                value="{{route('register.sponsor',[Auth::user()->username])}}"
                                class="form-control"
                                id="sponsorURL"
                                readonly
                            />
                            <button class="gold-btn copytext" id="copyBoard" onclick="copyFunction()"><i
                                    class="fa fa-copy mx-1"></i>@lang('copy link')</button>
                        </div>
                    </div>
                </div>

                @if($latestRegisteredUser)
                    <div class="col-md-6 mb-4 mb-md-0 refferal-information mt-5">
                        <div class="box">
                            <div class="img-box">
                                <img src="{{asset($themeTrue.'img/icon/handshake.png')}}" alt="@lang('handshake img')"/>
                            </div>
                            <div>
                                <h4 class="golden-text">@lang('Latest Registered Partner')</h4>
                                <p>{{$latestRegisteredUser->username}} <span class="pe-2">@lang('Email')
                            : {{$latestRegisteredUser->email}}</span></p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-6 refferal-information {{($latestRegisteredUser) ? 'mt-5':''}}">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{asset($themeTrue.'img/icon/deposit.png')}}" alt="@lang('Referral Bonus img')"/>
                        </div>
                        <div>
                            <h4 class="golden-text">@lang('The last Referral Bonus')</h4>
                            <p>{{trans($basic->currency_symbol)}} {{$lastBonus}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@push('script')

    <script src="{{asset($themeTrue.'js/apexcharts.js')}}"></script>


    <script>
        "use strict";

        var options = {
            theme: {
                mode: 'dark',
            },

            series: [
                {
                    name: "{{trans('Investment')}}",
                    color: 'rgba(247, 147, 26, 1)',
                    data: {!! $monthly['investment']->flatten() !!}
                },
                {
                    name: "{{trans('Payout')}}",
                    color: 'rgba(240, 16, 16, 1)',
                    data: {!! $monthly['payout']->flatten() !!}
                },
                {
                    name: "{{trans('Deposit')}}",
                    color: 'rgba(255, 72, 0, 1)',
                    data: {!! $monthly['funding']->flatten() !!}
                },
                {
                    name: "{{trans('Deposit Bonus')}}",
                    color: 'rgba(39, 144, 195, 1)',
                    data: {!! $monthly['referralFundBonus']->flatten() !!}
                },
                {
                    name: "{{trans('Investment Bonus')}}",
                    color: 'rgba(136, 203, 245, 1)',
                    data: {!! $monthly['referralInvestBonus']->flatten() !!}
                }
            ],
            chart: {
                type: 'bar',
                // height: ini,
                background: '#000',
                toolbar: {
                    show: false
                }

            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: {!! $monthly['investment']->keys() !!},

            },
            yaxis: {
                title: {
                    text: ""
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                colors: ['#000'],
                y: {
                    formatter: function (val) {
                        return "{{trans($basic->currency_symbol)}}" + val + ""
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#container"), options);
        chart.render();

        function copyFunction() {
            var copyText = document.getElementById("sponsorURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success(`Copied: ${copyText.value}`);
        }
    </script>
@endpush
