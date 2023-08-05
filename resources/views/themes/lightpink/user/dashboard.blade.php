@extends($theme.'layouts.user')
@section('title',trans('Dashboard'))
@section('content')
    <!-- main -->
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5>@lang('Main Balance')</h5>
                            <h3>
                                <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($walletBalance, config('basic.fraction_number'))}}
                            </h3>
                            <i class="far fa-funnel-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-2">
                            <h5>@lang('Interest Balance')</h5>
                            <h3>
                                <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($interestBalance, config('basic.fraction_number'))}}
                            </h3>
                            <i class="far fa-hand-holding-usd"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-3">
                            <h5>@lang('Total Deposit')</h5>
                            <h3>
                                <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($totalDeposit, config('basic.fraction_number'))}}
                            </h3>
                            <i class="fal fa-box-usd"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-4">
                            <h5>@lang('Total Earn')</h5>
                            <h3>
                                <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($totalInterestProfit, config('basic.fraction_number'))}}
                            </h3>
                            <i class="far fa-badge-dollar"></i>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5>@lang('Total Invest')</h5>
                            <h3>
                                <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($roi['totalInvestAmount'])}}
                            </h3>
                            <i class="far fa-search-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-2">
                            <h5>@lang('Total Payout')</h5>
                            <h3>
                                <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($totalPayout)}}
                            </h3>
                            <i class="fal fa-usd-circle"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-4">
                            <h5>@lang('Total Referral Bonus')</h5>
                            <h3>
                                <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($depositBonus + $investBonus)}}
                            </h3>
                            <i class="fal fa-lightbulb-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-3">
                            <h5>@lang('Total Ticket')</h5>
                            <h3>{{$ticket}}</h3>
                            <i class="fal fa-ticket"></i>
                        </div>
                    </div>
                </div>

                <!-- charts -->
                <section class="chart-information">
                    <div class="row">
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
                </section>

                <div class="row g-4 mb-4">
                    @if(auth()->user()->rank)
                        <div class="col-xl-3 col-md-6">
                            <div class="dashboard-box box-2">
                                <h5>@lang(optional(auth()->user()->rank)->rank_lavel)</h5>
                                <h3>@lang(optional(auth()->user()->rank)->rank_name)</h3>
                                <i class="fal fa-box-open"></i>
                            </div>
                        </div>
                    @endif

                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-2">
                            <h5>@lang('The Last Referral Bonus')</h5>
                            <h3>
                                <small><sup>{{trans(config('basic.currency_symbol'))}}</sup></small>{{getAmount($lastBonus, config('basic.fraction_number'))}}
                            </h3>
                            <i class="fal fa-box-open"></i>
                        </div>
                    </div>
                    <div class="{{auth()->user()->rank ? 'col-xl-6':'col-xl-9'}}  col-md-12">
                        <div class="dashboard-box">
                            <h5>@lang('Referral Link')</h5>
                            <div class="input-group mb-3 cutom__referal_input__group">
                                <input type="text" class="form-control"
                                       value="{{route('register.sponsor',[Auth::user()->username])}}" id="sponsorURL"
                                       readonly>
                                <button class="input-group-text btn-custom copy__referal_btn copytext" id="copyBoard"
                                        onclick="copyFunction()">@lang('copy link')</button>
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
                mode: "light",
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
