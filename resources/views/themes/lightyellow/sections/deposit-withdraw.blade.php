@if(isset($templates['deposit-withdraw'][0]) && $depositWithdraw = $templates['deposit-withdraw'][0])
    @if( 0 < (count($deposits) + count($withdraws)))
        <section class="transection_statistics">
            <div class="container">
                <div class="row">
                    <div class="section_header text-center">
                        <span class="section_category">@lang(@$depositWithdraw->description->title)</span>
                        <h2>@lang(@$depositWithdraw->description->sub_title)</h2>
                        <p>@lang(@$depositWithdraw->description->short_title)</p>
                    </div>
                </div>

                <div class="row">
                    <ul class="nav nav-pills mb-3 d-flex justify-content-center mt-20" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#lastdeposit" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true"> @lang('LAST DEPOSITE' )</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#lastwithdrawal" type="button" role="tab" aria-controls="pills-profile"
                                    aria-selected="false"> @lang('LAST WITHDRAWAL') </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="lastdeposit" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="container">
                                <div class="row g-4 pt-30">
                                    @foreach($deposits->take(4) as $item)
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_card_area pb-3">
                                            <div class="card shadow2">
                                                <div class="card_body text-center">
                                                    <div class="image_area mb-2">
                                                        <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}" alt="@lang('doposit user image')"/>
                                                    </div>
                                                    <h5 class="card-title">{{optional($item->user)->fullname}}</h5>
                                                    <h3 class="mb-2">{{$basic->currency_symbol}} {{getAmount($item->amount)}}</h3>
                                                    <p class="card-text">{{dateTime($item->created_at)}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="lastwithdrawal" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            <div class="container">
                                <div class="row g-4 pt-30">
                                    @foreach($withdraws->take(4) as $item)
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single_card_area pb-3">
                                            <div class="card shadow2">
                                                <div class="card_body text-center">
                                                    <div class="image_area mb-2">
                                                        <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}" alt="@lang('withdrawal user image')"/>
                                                    </div>
                                                    <h5 class="card-title">{{optional($item->user)->fullname}}</h5>
                                                    <h3 class="mb-2"><small><sup>{{$basic->currency_symbol}}</sup></small>{{getAmount($item->amount)}}</h3>
                                                    <p class="card-text">{{dateTime($item->created_at)}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
