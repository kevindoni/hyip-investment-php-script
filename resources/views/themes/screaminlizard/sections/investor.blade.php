@if(isset($templates['investor'][0]) && $investor = $templates['investor'][0])
    @if(0 < count($investors))
        <section class="top-investor">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="header-text text-center">
                            <h5>@lang(@$investor->description->title)</h5>
                            <h3>@lang(wordSplice($investor->description->sub_title, -2)['withoutLastWord']) <span
                                    class="text-stroke">@lang(wordSplice($investor->description->sub_title, -2)['lastWord'])</span>
                            </h3>
                            <p class="mx-auto">
                                @lang(@$investor->description->short_title)
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div
                            class="investor-wrapper {{(session()->get('rtl') == 1) ? 'investors-rtl': 'investors'}} owl-carousel">
                            @foreach($investors->take(4) as $item)
                                <div class="investor-box">
                                    <div class="img-box">
                                        <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}" class="img-fluid"
                                             alt="@lang('Investor Image Missing')"/>
                                    </div>
                                    <div class="text-box">
                                        <h5>@lang(optional($item->user)->username)</h5>
                                        <h6 class="title">@lang('Investor')</h6>
                                        <h4>@lang('Invested'): {{$basic->currency_symbol}}{{getAmount($item->totalAmount)}}</h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
