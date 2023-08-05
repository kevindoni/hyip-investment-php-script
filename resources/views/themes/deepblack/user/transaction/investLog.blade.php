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

    <!-- Invest history -->
    <section class="transaction-history mt-5 pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2>{{trans('Invest History')}}</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="table-parent table-responsive">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('SL')</th>
                                    <th scope="col">@lang('Plan')</th>
                                    <th scope="col">@lang('Return Interest')</th>
                                    <th scope="col">@lang('Received Amount')</th>
                                    <th scope="col">@lang('Upcoming Payment')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($investments as $key => $invest)
                                <tr>
                                    <td>{{loopIndex($investments) + $key}}</td>
                                    <td>
                                        {{optional(@$invest->plan)->name}}
                                        <br> {{getAmount($invest->amount).' '.trans($basic->currency)}}
                                    </td>
                                    <td>
                                        {{getAmount($invest->profit)}} {{trans($basic->currency)}}
                                        {{($invest->period == '-1') ? trans('For Lifetime') : 'per '. trans($invest->point_in_text)}}
                                        <br>
                                        {{($invest->capital_status == '1') ? '+ '.trans('Capital') :''}}
                                    </td>
                                    <td>
                                        {{$invest->recurring_time}} x {{ $invest->profit }} =  {{getAmount($invest->recurring_time*$invest->profit) }} {{trans($basic->currency)}}
                                    </td>
                                    <td>
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
                </div>
            </div>
        </div>
    </section>
@endsection
