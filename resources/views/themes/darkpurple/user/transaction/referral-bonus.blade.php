@extends($theme.'layouts.user')
@section('title',trans($title))

@push('css-lib')
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/bootstrap-datepicker.css') }}" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <h3>{{trans($title)}}</h3>
                </div>

                <div class="search-bar">
                    <form action="{{ route('user.referral.bonus.search') }}" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="input-box">
                                    <input
                                        type="text"
                                        name="search_user"
                                        value="{{@request()->search_user}}"
                                        class="form-control"
                                        placeholder="@lang('Search User')"
                                    />
                                </div>
                            </div>

                            <div class="input-box col-lg-4 col-md-4 col-sm-12">
                                <input type="text" class="form-control datepicker" name="datetrx" autocomplete="off" readonly placeholder="@lang('Select a date')" value="{{ old('datetrx', request()->datetrx) }}">
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <button class="btn-custom w-100" type="submit">@lang('Search')</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('SL No.')</th>
                            <th>@lang('Bonus From')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Remarks')</th>
                            <th>@lang('Time')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>{{loopIndex($transactions) + $loop->index}}</td>
                                <td>{{optional(@$transaction->bonusBy)->fullname}}</td>
                                <td>
                                    <span class="font-weight-bold text-success">{{getAmount($transaction->amount, config('basic.fraction_number')). ' ' . trans(config('basic.currency'))}}</span>
                                </td>
                                <td>@lang($transaction->remarks)</td>
                                <td>{{ dateTime($transaction->created_at, 'd M Y h:i A') }}</td>
                            </tr>

                        @empty
                            <tr class="text-center">
                                <td colspan="100%">{{__('No Data Found!')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $transactions->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css-lib')
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/bootstrap-datepicker.css') }}" />
@endpush

@push('script')
    <script src="{{ asset($themeTrue.'js/bootstrap-datepicker.js') }}"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $( ".datepicker" ).datepicker({
            });
        });
    </script>
@endpush


