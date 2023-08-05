@extends('admin.layouts.app')
@section('title',trans('Investments').': '.$user->username )
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



    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="{{route('admin.investments.search')}}" method="get">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="user_name" value="{{@request()->user_name}}" class="form-control get-username"
                                       placeholder="@lang('Username')">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" class="form-control" name="datetrx" id="datepicker"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <table class="categories-show-table table table-hover table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>@lang('SL')</th>
                    <th>@lang('Username')</th>
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

                        <td data-label="@lang('Username')">
                            <a href="{{route('admin.user-edit',$invest->user_id)}}" target="_blank">
                                @lang(optional($invest->user)->username)
                            </a>
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
                    <tr>
                        <td class="text-center text-danger" colspan="8">@lang('No Data Found')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $investments->links('partials.pagination') }}
        </div>

    </div>
@endsection
