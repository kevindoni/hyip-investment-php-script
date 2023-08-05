@if(isset($templates['investor'][0]) && $investor = $templates['investor'][0])

    @if(0 < count($investors))
<!-- INVESTOR -->
<section id="top-investor-section">
    <div class="overlay pt-150 pb-150">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="section-header">
                        <h4 class="sub-title">@lang(@$investor->description->title)</h4>
                        <h3 class="title">@lang(@$investor->description->sub_title)</h3>
                        <p class="area-para">@lang(@$investor->description->short_title)</p>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-md-center">
                @foreach($investors->take(4) as $item)
                <div class="col-lg-3 col-md-6 justify-content-center wow fadeInLeft mb-3">
                    <div class="single-item text-center">
                        <img src="{{getFile(config('location.user.path').optional($item->user)->image) }}"
                        alt="@lang('Investor Image Missing')" class="investor-img-circle">
                        <div class="text-area text-center">
                            <h2 class="title">@lang(optional($item->user)->username)</h2>
                            <p>@lang('Investor')</p>
                        </div>
                        <div class="icon-area">
                            @lang('Invest'): {{$basic->currency_symbol}}{{getAmount($item->totalAmount)}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- INVESTOR -->

    @endif
@endif
