@if(isset($templates['investor'][0]) && $investor = $templates['investor'][0])
    @if(0 < count($investors))
        <section class="investor_area">
            <div class="container">
                <div class="row">
                    <div class="section_header mb-50 text-center text-sm-start">
                        <div class="section_subtitle">@lang(@$investor->description->title)</div>
                        <h1>@lang(@$investor->description->sub_title)</h1>
                        <p class="para_text">@lang(@$investor->description->short_title)</p>
                    </div>
                </div>
                <div class="row {{(session()->get('rtl') == 1) ? 'investors-rtl': 'investors'}}">
                    @foreach($investors->take(4) as $item)
                        <div class="col-lg-3 col-sm-6">
                            <div class="cmn_box3 box1">
                                <div class="cmn_icon3 icon1">
                                    <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}"
                                         alt="@lang('Investor Image Missing')">
                                </div>
                                <div class="team_details mt-40 text-center pb-15 ">
                                    <h5 class="">@lang(optional($item->user)->username)</h5>
                                    <p>@lang('Invest')
                                        : {{$basic->currency_symbol}}{{getAmount($item->totalAmount)}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif
<!-- investor_area_end -->
