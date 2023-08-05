@if(isset($templates['news-letter-referral'][0]) && 0 < count($referralLevel) && $newsLetterReferral = $templates['news-letter-referral'][0])
    <section class="referrel_area shape2">
        <div class="container">
            <div class="row">
                <div class="section_header text-center mb-50 ">
                    <div class="section_subtitle">@lang('Referral Bonus Level')</div>
                    <h1 class="cmn_title">@lang('Get On First Level Refferal Commission')</h1>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach($referralLevel as $k => $data)
                    <div class="col-lg-4 col-sm-6">
                        <div
                            class="cmn_box box1 shadow3 d-flex flex-row justify-content-center justify-content-sm-start">
                            <div class="cmn_icon icon2">
                                <img src="{{ asset($themeTrue.'img/referral/save-money.png') }}" alt="">
                            </div>
                            <div class="text_area text-center">
                                <h5>@lang('level') {{$data->level}}</h5>
                                <h2><span class="refarrel_counter">{{$data->percent}}</span>%</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
<!-- referrel_area_end -->
