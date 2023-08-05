@if(isset($templates['investor'][0]) && $investor = $templates['investor'][0])
    @if(0 < count($investors))
        <section class="investor-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-text text-center">
                            <h5>@lang(@$investor->description->title)</h5>
                            <h2>@lang(@$investor->description->sub_title)</h2>
                            <p>@lang(@$investor->description->short_title)</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="investors owl-carousel {{(session()->get('rtl') == 1) ? 'investors-rtl': 'investors'}}">
                            @foreach($investors->take(4) as $item)
                                <div class="investor-box">
                                <div class="img-box">
                                    <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}" alt="@lang('Investor Image Missing')" />
                                </div>
                                <div class="text-box">
                                    <h5>@lang(optional($item->user)->username)</h5>
                                    <span>@lang('Investor')</span>
                                    <h4>@lang('Invest'): {{$basic->currency_symbol}}{{getAmount($item->totalAmount)}}</h4>
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
