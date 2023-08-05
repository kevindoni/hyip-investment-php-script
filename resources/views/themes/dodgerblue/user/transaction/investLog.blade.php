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


    <!-- main -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h3 class="ms-2 mb-0 mt-2">{{trans('Invest History')}}</h3>
                </div>
            </div>
        </div>
        <div class="main row">
            <div class="col-12">
                <!-- table -->
                <div class="table-parent table-responsive mt-4">
                    <table class="table table-striped">
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
                                <td data-label="SL No.">{{loopIndex($investments) + $key}}</td>
                                <td data-label="Plan">
                                    {{optional(@$invest->plan)->name}}
                                    <br> {{getAmount($invest->amount).' '.trans($basic->currency)}}
                                </td>
                                <td data-label="Return Interest">
                                    {{getAmount($invest->profit)}} {{trans($basic->currency)}}
                                    {{($invest->period == '-1') ? trans('For Lifetime') : 'per '. trans($invest->point_in_text)}}
                                    <br>
                                    {{($invest->capital_status == '1') ? '+ '.trans('Capital') :''}}
                                </td>
                                <td data-label="Received Amount">
                                    {{$invest->recurring_time}} x {{ $invest->profit }} =  {{getAmount($invest->recurring_time*$invest->profit) }} {{trans($basic->currency)}}
                                </td>

                                <td data-label="Upcoming Payment">
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
                            <tr>
                                <td colspan="100%" class="text-center">{{trans('No Data Found!')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
