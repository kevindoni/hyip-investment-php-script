@if(isset($templates['deposit-withdraw'][0]) && $depositWithdraw = $templates['deposit-withdraw'][0])
    <section id="deposit-withdraw">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="heading-container">
                    <p class="topheading">@lang(@$depositWithdraw->description->title)</p>
                    <h3 class="heading">@lang(@$depositWithdraw->description->sub_title)</h3>
                    <p class="slogan">@lang(@$depositWithdraw->description->short_title)</p>
                </div>
            </div>
        </div>

        <ul id="pills-tab" role="tablist" class="nav nav-pills justify-content-center wow fadeInUp"
            data-wow-duration="1s" data-wow-delay="0.15s">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#deposit-tab" role="tab">
                    <span>{{trans('Deposit')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#withdraw-tab" role="tab">
                    <span>{{trans('Withdraw')}}</span>
                </a>
            </li>
        </ul>
        <div class="tab-content wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
            <div id="deposit-tab" class="tab-pane fade show active" role="tabpanel">
                <div class="statistics-wrapper">
                    <div class="data-table-container ">
                        <div class="data-table-header">
                            <div class="data-column">
                                <div class="data-column-header">
                                    <p class="text">@lang('Name')</p>
                                </div>
                            </div>
                            <div class="data-column">
                                <div class="data-column-header">
                                    <p class="text">@lang('Amount')</p>
                                </div>
                            </div>
                            <div class="data-column">
                                <div class="data-column-header">
                                    <p class="text">@lang('Gateway')</p>
                                </div>
                            </div>

                            <div class="data-column">
                                <div class="data-column-header">
                                    <p class="text">@lang('Date')</p>
                                </div>
                            </div>
                        </div>

                        <div class="data-table">
                            <div class="data-column">
                                @foreach($deposits as $item)
                                <div class="data-content-wrapper">
                                    <div class="media align-items-center">
                                        <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}" alt="@lang('Image Missing')">
                                        <p class="text ml-10">{{optional($item->user)->fullname}}</p>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                            <div class="data-column">
                                @foreach($deposits as $item)
                                <div class="data-content-wrapper">
                                    <p class="text">{{$basic->currency_symbol}} {{getAmount($item->amount)}}</p>
                                </div>
                                @endforeach

                            </div>

                            <div class="data-column">
                                @foreach($deposits as $item)
                                <div class="data-content-wrapper">
                                    <p class="text">{{optional($item->gateway)->name}}</p>
                                </div>
                                @endforeach
                            </div>

                            <div class="data-column">
                                @foreach($deposits as $item)
                                <div class="data-content-wrapper">
                                    <p class="text">{{dateTime($item->created_at)}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="withdraw-tab" class="tab-pane fade" role="tabpanel">
                <div class="statistics-wrapper">
                    <div class="data-table-container">
                        <div class="data-table-header">
                            <div class="data-column">
                                <div class="data-column-header">
                                    <p class="text">@lang('Name')</p>
                                </div>
                            </div>
                            <div class="data-column">
                                <div class="data-column-header">
                                    <p class="text">@lang('Amount')</p>
                                </div>
                            </div>
                            <div class="data-column">
                                <div class="data-column-header">
                                    <p class="text">@lang('Gateway')</p>
                                </div>
                            </div>

                            <div class="data-column">
                                <div class="data-column-header">
                                    <p class="text">@lang('Date')</p>
                                </div>
                            </div>
                        </div>

                        <div class="data-table">
                            <div class="data-column">

                                @foreach($withdraws as $item)
                                    <div class="data-content-wrapper">
                                        <div class="media align-items-center">
                                            <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}" alt="@lang('Image Missing')">
                                            <p class="text ml-10">{{optional($item->user)->fullname}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="data-column">
                                @foreach($withdraws as $item)
                                    <div class="data-content-wrapper">
                                        <p class="text">{{$basic->currency_symbol}} {{getAmount($item->amount)}}</p>
                                    </div>
                                @endforeach

                            </div>

                            <div class="data-column">
                                @foreach($withdraws as $item)
                                    <div class="data-content-wrapper">
                                        <p class="text">{{optional($item->method)->name}}</p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="data-column">
                                @foreach($withdraws as $item)
                                    <div class="data-content-wrapper">
                                        <p class="text">{{dateTime($item->created_at)}}</p>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
