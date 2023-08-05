@if(isset($templates['investor'][0]) && $investor = $templates['investor'][0])
    @if(0 < count($investors))
        <section class="investor_area">
            <div class="container">
                <div class="row">
                    <div class="section_content">
                        <div class="section_header text-start text-center">
                            <span class="section_category">@lang(@$investor->description->title)</span>
                            <h2 class="cmn_title mb-30">@lang(@$investor->description->sub_title)</h2>
                            <p>@lang(@$investor->description->short_title)</p>
                        </div>
                    </div>
                </div>

                <div class="row  mt-50">
                    <div
                        class="owl-carousel owl-theme investor_carousel {{(session()->get('rtl') == 1) ? 'investors-rtl': 'investors'}}">
                        @foreach($investors->take(4) as $item)
                            <div class="item">
                                <div class="single_card_area p-2">
                                    <div class="card shadow1">
                                        <div class="card_body text-center">
                                            <div class="image_area mb-2">
                                                <img
                                                    src="{{getFile(config('location.user.path').optional($item->user)->image) }}"
                                                    alt="@lang('Investor Image Missing')"/>
                                            </div>
                                            <h4 class="card-title">@lang(optional($item->user)->username)</h4>
                                            <h6>@lang('Investor')</h6>
                                            <h3 class="mb-2 mt-3">@lang('Invest')
                                                : {{$basic->currency_symbol}}{{getAmount($item->totalAmount)}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
