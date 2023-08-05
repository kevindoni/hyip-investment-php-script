@extends($theme.'layouts.user')
@section('title')
    @lang('Transaction')
@endsection

@section('content')

    <!-- main -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h3 class="ms-2 mb-0 mt-2">{{trans('Transaction')}}</h3>
                </div>
            </div>
        </div>
        <div class="main row">
            <div class="col-12">
                <!-- table -->
                <div class="table-parent table-responsive mt-4">
                    <div class="table-search-bar">
                        <div>
                            <form action="{{ route('user.transaction.search') }}" method="get">
                                <div class="row g-3 align-items-end">
                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <input type="text" name="transaction_id" value="{{@request()->transaction_id}}" class="form-control" placeholder="@lang('Search for Transaction ID')" />
                                    </div>

                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <input type="text" name="remark" value="{{@request()->remark}}" class="form-control" placeholder="@lang('Remark')" />
                                    </div>

                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <input type="text" class="form-control datepicker" name="datetrx"
                                               placeholder="@lang('Select a date')"  autocomplete="off" readonly/>
                                    </div>

                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <button class="btn-custom w-100" type="submit"><i class="fal fa-search"></i> @lang('Search')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th scope="col">@lang('SL No.')</th>
                                <th scope="col">@lang('Transaction ID')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Remarks')</th>
                                <th scope="col">@lang('Time')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td data-label="@lang('SL No.')">{{loopIndex($transactions) + $loop->index}}</td>
                                <td data-label="@lang('Transaction ID')">@lang($transaction->trx_id)</td>
                                <td data-label="@lang('Amount')">
                                    <span class="fontBold text-{{($transaction->trx_type == "+") ? 'success': 'danger'}}">{{($transaction->trx_type == "+") ? '+': '-'}}{{getAmount($transaction->amount, config('basic.fraction_number')). ' ' . trans(config('basic.currency'))}}</span>
                                </td>
                                <td data-label="@lang('Remarks')"> @lang($transaction->remarks) </td>
                                <td data-label="@lang('Time')">{{ dateTime($transaction->created_at, 'd M Y h:i A') }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">{{__('No Data Found!')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $transactions->appends($_GET)->links($theme.'partials.pagination') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset($themeTrue.'js/bootstrap-datepicker.js')}}"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $(".datepicker").datepicker({
                autoclose: true,
                clearBtn: true,
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush
