@extends($theme.'layouts.user')
@section('title',trans($title))
@section('content')

<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>{{trans($title)}}</h2>
             </div>
          </div>
       </div>

       <form action="{{ route('user.referral.bonus.search') }}" method="get">
          <div class="row select-transaction">
             <div class="col-md-6 col-lg-4">
                <div class="input-group mb-4">
                   <div class="img">
                      <img src="{{asset($themeTrue.'img/icon/edit.png')}}" alt="@lang('edit img')" />
                   </div>
                   <input
                       type="text"
                       name="search_user"
                       value="{{@request()->search_user}}"
                       class="form-control"
                       placeholder="@lang('Search User')"
                   />
                </div>
             </div>
             <div class="col-md-6 col-lg-4">
                <div class="input-group mb-4">
                   <div class="img">
                      <img src="{{asset($themeTrue.'img/icon/chevron.png')}}" alt="@lang('chevron img')" />
                   </div>
                   <input type="text" class="form-control" name="datetrx" id="datepicker" placeholder="@lang('Select a date')" autocomplete="off" readonly/>
                </div>
             </div>
             <div class="col-md-6 col-lg-4">
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

                {{ $transactions->appends($_GET)->links($theme.'partials.pagination') }}

             </div>
          </div>
       </div>
    </div>
 </section>

@endsection
