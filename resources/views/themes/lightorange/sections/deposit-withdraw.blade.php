@if(isset($templates['deposit-withdraw'][0]) && $depositWithdraw = $templates['deposit-withdraw'][0])

    @if( 0 < (count($deposits) +count($withdraws)))
        <!-- START DEPOSIT-WITHDRAW -->
        <section id="transaction-section">
            <div class="overlay pt-150 pb-150">
                <img class="img-4 zoomInOutInfinite"
                     src="{{asset('assets/themes/lightorange/images/home/ellipse-4.png')}}"
                     alt="@lang('ellipse-4-image')">
                <img class="img-5 zoomInOut2sInfinite"
                     src="{{asset('assets/themes/lightorange/images/home/ellipse-5.png')}}"
                     alt="@lang('ellipse-5-image')">
                <img class="img-6 zoomInOut2sInfinite"
                     src="{{asset('assets/themes/lightorange/images/home/ellipse-6.png')}}"
                     alt="@lang('ellipse-6-image')">
                <img class="img-7 zoomInOutInfinite"
                     src="{{asset('assets/themes/lightorange/images/home/ellipse-7.png')}}"
                     alt="@lang('ellipse-7-image')">


                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-9">
                            <div class="section-header">
                                <h4 class="sub-title">@lang(@$depositWithdraw->description->title)</h4>
                                <h3 class="title">@lang(@$depositWithdraw->description->sub_title)</h3>
                                <p class="area-para">@lang(@$depositWithdraw->description->short_title)</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs" id="myTabTrans" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="deposite-tab" data-toggle="tab" href="#deposite"
                                       role="tab" aria-controls="deposite" aria-selected="true">{{trans('Deposit')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab"
                                       aria-controls="withdraw" aria-selected="false">{{trans('Withdraw')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-12">
                            <div class="tab-content" id="myTabContentTrans">
                                <div class="tab-pane fade show active" id="deposite" role="tabpanel"
                                     aria-labelledby="deposite-tab">
                                    <div class="table-responsive wow fadeInUpBig">
                                        <table class="table">
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
                                                    <th scope="row">
                                                        <img
                                                            src="{{getFile(config('location.user.path').optional($item->user)->image) }}"
                                                            class="deposit-img-circle"
                                                            alt="@lang('doposit user image')"><span>{{optional($item->user)->fullname}}</span>
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

                                <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
                                    <div class="table-responsive">
                                        <table class="table">
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
                                                    <th scope="row"><img
                                                            src="{{getFile(config('location.user.path').optional($item->user)->image) }}"
                                                            alt="@lang('doposit user image')"
                                                            class="deposit-img-circle"><span>{{optional($item->user)->fullname}}</span>
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
            </div>
        </section>
        <!-- END DEPOSIT-WITHDRAW -->
    @endif
@endif
