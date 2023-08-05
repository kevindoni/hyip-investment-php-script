<!-- affiliate_area_stat -->
@if(isset($templates['news-letter-referral'][0]) && 0 < count($referralLevel) && $newsLetterReferral = $templates['news-letter-referral'][0])
    <section class="affiliate_area">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="section_left">
                        <div class="image_area">
                            <img src="{{ asset($themeTrue.'img/affiliate/referral_and_affiliate.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section_right">
                        <div class="section_header">
                            <span class="section_category">@lang('Affiliate program')</span>
                            <h2>@lang('Refer us to your friends!')</h2>
                            <p>
                                @lang("CryptoVest provide an adaptive and profitable affiliate program for long-term pertnership. You will receive referal commisiona from your pertner's deposit and also from his daily income.")
                            </p>
                            <p>
                                @lang('The affiliate program is working up to 3 refaral levels. To join to the affiliate program, you should have ac active deposit in the project.')
                            </p>
                        </div>
                        <ul class="refarel_list d-flex text-center justify-content-around mt-30 {{(session()->get('rtl') == 1) ? 'isRtl': 'noRtl'}}">
                            @foreach($referralLevel as $k => $data)
                                <li>
                                    <div class="image_area">
                                        <img src="{{ asset($themeTrue.'img/profile.png') }}" alt="">
                                    </div>
                                    <div class="text_area mt-20">
                                        <h2 class="mb-0"><span class="affiliate_counter">{{$data->percent}}</span>%</h2>
                                        <h6>@lang('level') {{$data->level}}</h6>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#" class="custom_btn mt-30">@lang('Join Now')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- affiliate_area_end -->
