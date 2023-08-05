@if(isset($templates['deposit-withdraw'][0]) && $depositWithdraw = $templates['deposit-withdraw'][0])
    <section class="transaction_area">
    <div class="container">
        <div class="row">
            <div class="section_header text-center mb-30">
                <div class="section_subtitle m-auto not_hidden_charge">@lang(@$depositWithdraw->description->title)</div>
                <h1>@lang(@$depositWithdraw->description->sub_title)</h1>
                <p class="para_text m-auto">@lang(@$depositWithdraw->description->short_title)</p>
            </div>
        </div>
        <div class="row">
            <ul class="nav nav-pills mb-50 d-flex justify-content-center mt-20" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active bottom-right-radius-0" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#lastdeposit" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">@lang('Last Deposit')</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link bottom-left-radius-0" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#lastwithdrawal" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">@lang('Last Withdrawal')</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="lastdeposit" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <div class="transaction_table">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr class="">
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Amount')</th>
                                        <th scope="col">@lang('Gateway')</th>
                                        <th scope="col">@lang('Date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deposits as $item)
                                        <tr>
                                            <th scope="row">
                                                <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}" alt="@lang('Image Missing')">
                                                <span class="ms-2">{{optional($item->user)->fullname}}</span>
                                            </th>
                                            <td>{{$basic->currency_symbol}} {{getAmount($item->amount)}}</td>
                                            <td>{{optional($item->gateway)->name}}</td>
                                            <td>{{dateTime($item->created_at)}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="lastwithdrawal" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="transaction_table">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                <tr class="margin_bottom">
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Amount')</th>
                                    <th scope="col">@lang('Gateway')</th>
                                    <th scope="col">@lang('Date')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdraws as $item)
                                    <tr>
                                        <th scope="row">
                                            <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}" alt="@lang('Image Missing')">
                                            <span class="ms-2">{{optional($item->user)->fullname}}</span>
                                        </th>
                                        <td>{{$basic->currency_symbol}} {{getAmount($item->amount)}}</td>
                                        <td>{{optional($item->method)->name}}</td>
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
    </div>
</section>
@endif
<!-- transaction_area_end -->
