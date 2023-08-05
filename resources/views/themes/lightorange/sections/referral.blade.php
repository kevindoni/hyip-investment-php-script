@if(isset($templates['news-letter-referral'][0]) && 0 < count($referralLevel) && $newsLetterReferral = $templates['news-letter-referral'][0])
    <!-- affiliate partner start -->
    <section id="affiliate-partner">
        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="left-area d-flex">
                            <img src="{{asset('assets/themes/lightorange/images/Affiliate-Partner.png')}}" alt="@lang('affiliate image')">
                            <span class="border"></span>
                            <div class="text-area">
                                <h3>@lang(@$newsLetterReferral->description->referral_title)</h3>
                                <h2>@lang(@$newsLetterReferral->description->referral_sub_title)</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-end align-items-center justify-cen">
                        <div class="right-area">
                            <a class="cmn-btn" href="{{ route('register') }}">{{trans('join us now')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="referral-commisson">
            <div class="px-5">
                <div class="referral-box">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-12">
                            <div class="section-header">
                                <h4 class="sub-title">@lang(@$newsLetterReferral->description->sub_title)</h4>
                                <h3 class="title">@lang(@$newsLetterReferral->description->title)</h3>
                            </div>
                        </div>
                    </div>
                    <div class="commission-box">
                        <div class="row d-flex justify-content-between">
                            @foreach($referralLevel as $data)
                            <div class="col-lg-4 col-md-4 wow fadeInLeftBig pb-4">
                                <div class="single-item justify-content-center d-flex">
                                    <div class="left-item">
                                        <div class="icon-box">
                                            <img src="{{asset('assets/themes/lightorange/images/referrel.png')}}" alt="@lang('referrel image')">
                                        </div>
                                    </div>
                                    <div class="right-area">
                                        <p>{{trans('Level')}} {{$data->level}} {{trans('Instant')}}</p>
                                        <span class="number"><strong class="themecolor">{{$data->percent}}%</strong></span>
                                        <p>@lang('Bonus Reward')</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- affiliate partner end -->
@endif
