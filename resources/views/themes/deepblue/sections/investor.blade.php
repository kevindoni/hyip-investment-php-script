@if(isset($templates['investor'][0]) && $investor = $templates['investor'][0])

    <!-- INVESTOR -->
    <section id="investor">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-container">
                        <h6 class="topheading">@lang(@$investor->description->title)</h6>
                        <h3 class="heading">@lang(@$investor->description->sub_title)</h3>
                        <p class="slogan">@lang(@$investor->description->short_title)</p>
                    </div>
                </div>
            </div>

            <div class="carousel-container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.15s">
                <div class="{{(session()->get('rtl') == 1) ? 'carousel-investor-rtl': 'carousel-investor'}} owl-carousel owl-theme">
                    @if(isset($investors))
                    @foreach($investors->take(4) as $item)
                        <div class="item-carousel">
                            <div class="card align-items-center">
                                <div class="investor-fig">
                                    <div class="img-container">
                                        <img class="img-circle" src="{{getFile(config('location.user.path').optional($item->user)->image) }}"
                                             alt="@lang('Investor Image Missing')">
                                    </div>
                                </div>
                                <h5 class="h5 font-weight-medium mt-25">@lang(optional($item->user)->username)</h5>
                                <p class="text">@lang('Investor') </p>
                                <hr class="hr mt-20 mb-20">
                                <p class="text themecolor text-uppercase mb-10">@lang('Invest'): {{$basic->currency_symbol}}{{getAmount($item->totalAmount)}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </section>
    <!-- /INVESTOR -->
@endif
