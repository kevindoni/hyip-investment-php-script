@if(isset($templates['investor'][0]) && $investor = $templates['investor'][0])
    @if(0 < count($investors))
    <section class="investor-section">
        <div class="container">
           <div class="row">
              <div class="col">
                 <div class="header-text text-center">
                    <h5>@lang(@$investor->description->title)</h5>
                    <h2>@lang(@$investor->description->sub_title)</h2>
                    <p>@lang(@$investor->description->short_title)</p>
                 </div>
              </div>
           </div>
           <div class="{{(session()->get('rtl') == 1) ? 'investors-rtl': 'investors'}} owl-carousel">
            @foreach($investors->take(4) as $item)
              <div class="investor-box">
                 <div class="img-box">
                    <img class="img-fluid" src="{{getFile(config('location.user.path').optional($item->user)->image) }}" alt="@lang('Investor Image Missing')" />
                 </div>
                 <div class="text-box">
                    <h4 class="golden-text">@lang(optional($item->user)->username)</h4>
                    <span>@lang('Investor')</span>
                    <h3 class="amount golden-text">@lang('Invest'): {{$basic->currency_symbol}}{{getAmount($item->totalAmount)}}</h3>
                 </div>
              </div>
            @endforeach
           </div>
        </div>
    </section>
    @endif
@endif
