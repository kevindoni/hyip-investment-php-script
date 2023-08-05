@if(isset($templates['news-letter-referral'][0]) && 0 < count($referralLevel) && $newsLetterReferral = $templates['news-letter-referral'][0])
    <!-- referral section -->
{{--    <section class="referral-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row ">--}}
{{--                <div class="header-text text-center">--}}
{{--                    <h5>@lang('Bonus')</h5>--}}
{{--                    <h2><span class="text-stroke">@lang(wordSplice($newsLetterReferral->description->title, -2)['withoutLastWord'])</span> @lang(wordSplice($newsLetterReferral->description->title, -2)['lastWord']) </h2>--}}
{{--                    <p class="mx-auto">@lang(@$newsLetterReferral->description->sub_title)</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row g-4 justify-content-center">--}}
{{--                @foreach($referralLevel as $k => $data)--}}
{{--                    <div class="col-lg-4 col-md-6">--}}
{{--                        <div class="referral-box">--}}
{{--                            <h3 class="level">@lang('Level') <span class="text-stroke">{{$data->level}}</span></h3>--}}
{{--                            <h3 class="text-primary">{{$data->percent}}%</h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <!-- referral section -->
    <section class="referral-section">
        <div class="container">
            <div class="row">
                <div class="header-text text-center">
                    <h5>Bonus</h5>
                    <h2><span class="text-stroke">Referral</span> bonus level</h2>
                    <p class="mx-auto">Get on first level referral commission</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="referral-box">
                        <h3 class="level">Level <span class="text-stroke">01</span></h3>
                        <h3 class="text-primary">15%</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="referral-box">
                        <h3 class="level">Level <span class="text-stroke">02</span></h3>
                        <h3 class="text-primary">30%</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="referral-box">
                        <h3 class="level">Level <span class="text-stroke">03</span></h3>
                        <h3 class="text-primary">60%</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
