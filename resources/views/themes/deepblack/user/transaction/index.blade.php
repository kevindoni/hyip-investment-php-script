@extends($theme.'layouts.user')
@section('title')
    @lang('Transaction')
@endsection

@section('content')

    <section class="transaction-history mt-5 pt-5">
        <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h2>@lang('Transaction')</h2>
                </div>
            </div>
        </div>

        <form action="{{ route('user.transaction.search') }}" method="get">
            <div class="row select-transaction">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group mb-4">
                        <div class="img">
                            <img src="{{asset($themeTrue.'img/icon/edit.png')}}" alt="@lang('edit img')" />
                        </div>
                        <input
                            type="text"
                            name="transaction_id"
                            value="{{@request()->transaction_id}}"
                            class="form-control"
                            placeholder="@lang('Search for Transaction ID')"
                        />
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="input-group mb-4">
                        <div class="img">
                            <img src="{{asset($themeTrue.'img/icon/edit.png')}}" alt="@lang('edit img')"/>
                        </div>
                        <input type="text" name="remark" value="{{@request()->remark}}" class="form-control" placeholder="@lang('Remark')">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="input-group mb-4">
                        <div class="img">
                            <img src="{{asset($themeTrue.'img/icon/chevron.png')}}" alt="@lang('chevron img')" />
                        </div>
                        <input type="text" class="form-control" name="datetrx"
                        id="datepicker" placeholder="@lang('Select a date')" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <button type="submit" class="gold-btn search-btn mb-4">
                        @lang('Search')
                    </button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col">
                <div class="table-parent table-responsive">
                    <table class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th>@lang('SL No.')</th>
                                <th>@lang('Transaction ID')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Remarks')</th>
                                <th>@lang('Time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{loopIndex($transactions) + $loop->index}}</td>
                                    <td>@lang($transaction->trx_id)</td>
                                    <td>
                                        <span
                                        class="fontBold text-{{($transaction->trx_type == "+") ? 'success': 'danger'}}">{{($transaction->trx_type == "+") ? '+': '-'}}{{getAmount($transaction->amount, config('basic.fraction_number')). ' ' . trans(config('basic.currency'))}}</span>
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

                    {{ $transactions->appends($_GET)->links($theme.'partials.pagination') }}

                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
