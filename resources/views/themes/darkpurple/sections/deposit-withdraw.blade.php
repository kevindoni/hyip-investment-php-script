@if(isset($templates['deposit-withdraw'][0]) && $depositWithdraw = $templates['deposit-withdraw'][0])
    <section class="deposit-withdraw-section">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <div class="header-text text-center">
                    <h5>@lang(@$depositWithdraw->description->title)</h5>
                    <h2>@lang(@$depositWithdraw->description->sub_title)</h2>
                    <p>@lang(@$depositWithdraw->description->short_title)</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="deposit-switcher">
                    <button tab-id="tab1" class="tab active">{{trans('Deposit')}}</button>
                    <button tab-id="tab2" class="tab">{{trans('Withdraw')}}</button>
                </div>
                <div id="tab1" class="content active">
                    <div class="table-parent table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Gateway')</th>
                                <th scope="col">@lang('Date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $item)
                                <tr>
                                <td>{{optional($item->user)->fullname}}</td>
                                <td>{{$basic->currency_symbol}} {{getAmount($item->amount)}}</td>
                                <td>
                                    <span class="currency">
                                       <img src="{{getFile(config('location.gateway.path').optional($item->gateway)->image) }}" alt="" />
                                       {{optional($item->gateway)->name}}
                                    </span>
                                </td>
                                <td>{{dateTime($item->created_at)}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="tab2" class="content">
                    <div class="table-parent table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Gateway')</th>
                                <th scope="col">@lang('Date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($withdraws as $item)
                                <tr>
                                    <td>{{optional($item->user)->fullname}}</td>
                                    <td>{{$basic->currency_symbol}} {{getAmount($item->amount)}}</td>
                                    <td>
                                        <span class="currency">
                                           <img src="{{getFile(config('location.withdraw.path').optional($item->method)->image) }}" alt="" />
                                          {{optional($item->method)->name}}
                                        </span>
                                    </td>
                                    <td>{{dateTime($item->created_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endif
