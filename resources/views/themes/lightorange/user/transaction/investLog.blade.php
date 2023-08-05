@extends($theme.'layouts.user')
@section('title',trans('Invest History'))
@section('content')
    <script>
        "use strict"
        function getCountDown(elementId, seconds) {
            var times = seconds;
            var x = setInterval(function () {
                var distance = times * 1000;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById(elementId).innerHTML = days + "d: " + hours + "h " + minutes + "m " + seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "COMPLETE";
                }
                times--;
            }, 1000);
        }
    </script>

    @push('navigator')
        <!-- PAGE-NAVIGATOR -->
        <section id="page-navigator">
            <div class="container-fluid">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"
                                                       class="cursor-inherit">{{trans('Invest History')}}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- /PAGE-NAVIGATOR -->
    @endpush




    <section id="dashboard">
        <div class="dashboard-wrapper add-fund pb-50">
            <div class="row">
                <div class="col-md-12">
                    <div class="card secbg">
                        <div class="card-body ">

                            <div class="table-responsive">
                                <table class="table table table-hover table-striped text-white " id="service-table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>@lang('SL')</th>
                                        <th>@lang('Plan')</th>
                                        <th >@lang('Return Interest')</th>
                                        <th>@lang('Received Amount')</th>
                                        <th>@lang('Upcoming Payment')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($investments as $key => $invest)
                                        <tr>

                                            <td data-label="@lang('SL')">
                                                {{loopIndex($investments) + $key}}
                                            </td>

                                            <td data-label="@lang('Plan')">
                                                {{trans(optional($invest->plan)->name)}}
                                                <br> {{getAmount($invest->amount).' '.trans($basic->currency)}}
                                            </td>

                                            <td data-label="@lang('Return Interest')" class="text-capitalize">
                                                {{getAmount($invest->profit)}} {{trans($basic->currency)}}
                                                {{($invest->period == '-1') ? trans('For Lifetime') : 'per '. trans($invest->point_in_text)}}

                                                <br>
                                                {{($invest->capital_status == '1') ? '+ '.trans('Capital') :''}}
                                            </td>
                                            <td data-label="@lang('Received Amount')">
                                                {{$invest->recurring_time}} x {{ $invest->profit }} =  {{getAmount($invest->recurring_time*$invest->profit) }} {{trans($basic->currency)}}
                                            </td>

                                            <td data-label="@lang('Upcoming Payment')">
                                                @if($invest->status == 1)
                                                    <p id="counter{{$invest->id}}" class="mb-2"></p>
                                                    <script>getCountDown("counter{{$invest->id}}", {{\Carbon\Carbon::parse($invest->afterward)->diffInSeconds()}});</script>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"  style="width: {{$invest->nextPayment}}"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$invest->nextPayment}}</div>
                                                    </div>
                                                @else
                                                    <span class="badge badge-success">@lang('Completed')</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @empty

                                        <tr class="text-center">
                                            <td colspan="100%">{{trans('No Data Found!')}}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

                            </div>


                            {{ $investments->appends($_GET)->links($theme.'partials.pagination') }}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
