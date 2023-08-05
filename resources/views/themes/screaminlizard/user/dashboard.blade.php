@extends($theme.'layouts.user')
@section('title',trans('Dashboard'))
@section('content')
    <!-- main -->
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="row g-4">
                    <!-- card boxes -->
                    <div class="col-12 d-none d-lg-block">
                        <div class="row g-4">
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($walletBalance, config('basic.fraction_number'))}}</h4>
                                        <i class="fal fa-dollar-sign"></i>
                                    </div>
                                    <p class="mb-0">@lang('Main Balance')</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($interestBalance, config('basic.fraction_number'))}}</h4>
                                        <i class="fal fa-hand-holding-usd"></i>
                                    </div>
                                    <p class="mb-0">@lang('Interest Balance')</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($totalDeposit, config('basic.fraction_number'))}}</h4>
                                        <i class="fal fa-box-usd"></i>
                                    </div>
                                    <p class="mb-0">@lang('Total Deposit')</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($totalInterestProfit, config('basic.fraction_number'))}}</h4>
                                        <i class="fal fa-envelope-open-dollar"></i>
                                    </div>
                                    <p class="mb-0">@lang('Total Earn')</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($roi['totalInvestAmount'])}}</h4>
                                        <i class="fal fa-funnel-dollar"></i>
                                    </div>
                                    <p class="mb-0">@lang('Total Invest')</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($totalPayout)}}</h4>
                                        <i class="fal fa-money-check-alt"></i>
                                    </div>
                                    <p class="mb-0">@lang('Total Payout')</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{$ticket}}</h4>
                                        <i class="fal fa-ticket"></i>
                                    </div>
                                    <p class="mb-0">@lang('Total Ticket')</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($depositBonus + $investBonus)}}</h4>
                                        <i class="fal fa-usd-circle"></i>
                                    </div>
                                    <p class="mb-0">@lang('Total Referral Bonus')</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- card boxes with slider -->
                    <div class="col-12 d-lg-none">
                        <div class="row g--4 g-0 card-box-wrapper owl-carousel card-boxes">
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($walletBalance, config('basic.fraction_number'))}}</h4>
                                    <i class="fal fa-dollar-sign"></i>
                                </div>
                                <p class="mb-0">@lang('Main Balance')</p>
                            </div>
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($interestBalance, config('basic.fraction_number'))}}</h4>
                                    <i class="fal fa-hand-holding-usd"></i>
                                </div>
                                <p class="mb-0">@lang('Interest Balance')</p>
                            </div>
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($totalDeposit, config('basic.fraction_number'))}}</h4>
                                    <i class="fal fa-box-usd"></i>
                                </div>
                                <p class="mb-0">@lang('Total Deposit')</p>
                            </div>
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($totalInterestProfit, config('basic.fraction_number'))}}</h4>
                                    <i class="fal fa-envelope-open-dollar"></i>
                                </div>
                                <p class="mb-0">@lang('Total Earn')</p>
                            </div>
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($roi['totalInvestAmount'])}}</h4>
                                    <i class="fal fa-funnel-dollar"></i>
                                </div>
                                <p class="mb-0">@lang('Total Invest')</p>
                            </div>
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($totalPayout)}}</h4>
                                    <i class="fal fa-money-check-alt"></i>
                                </div>
                                <p class="mb-0">@lang('Total Payout')</p>
                            </div>
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4>{{$ticket}}</h4>
                                    <i class="fal fa-ticket"></i>
                                </div>
                                <p class="mb-0">@lang('Total Ticket')</p>
                            </div>
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4>{{trans(config('basic.currency_symbol'))}}{{getAmount($depositBonus + $investBonus)}}</h4>
                                    <i class="fa-light fa-file-chart-pie"></i>
                                </div>
                                <p class="mb-0">@lang('Total Referral Bonus')</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                        <div class="card-box refferal-box">
                            <h5>Your refferal link</h5>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{route('register.sponsor',[Auth::user()->username])}}"
                                    id="sponsorURL"
                                    disabled=""/>
                                <button id="copyBtn" onclick="copyText('sponsorURL')" class="btn text-white">
                                    @lang('Copy Link')
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <div class="card-box refferal-box">
                                <h5>@lang('Total Referral Bonus')</h5>
                            <div class="d-flex justify-content-between">
                                <h4>{{trans($basic->currency_symbol)}} {{$lastBonus}}</h4>
                                <i class="fal fa-usd-circle"></i>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="row g-4">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="card-box refferal-box">
                            <h5>Transaction Analytics</h5>
                            <div class="chart-information">
                                <div class="progress-wrapper">
                                    <div
                                        id="container"
                                        class="apexcharts-canvas"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="card-box refferal-box">
                            <div class="chart-information">
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
                </div>
            </div>
        </div>
    </div>
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
