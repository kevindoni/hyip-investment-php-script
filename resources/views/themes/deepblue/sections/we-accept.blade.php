<!-- PAYMENT-METHOD -->
<section id="payment-method">
    <div class="container">

        @if(isset($templates['we-accept'][0]) && $weAccept = $templates['we-accept'][0])
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-container">
                        <h6 class="topheading">@lang(@$weAccept->description->title)</h6>
                        <h3 class="heading">@lang(@$weAccept->description->sub_title)</h3>
                        <p class="slogan">@lang(@$weAccept->description->short_details)</p>
                    </div>
                </div>
            </div>
        @endif


        <div class="carousel-container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.15s">
            <div class="{{(session()->get('rtl') == 1) ? 'carousel-payment-rtl': 'carousel-payment'}}  owl-carousel owl-theme">
                @foreach($gateways as $gateway)
                <div class="item-carousel">
                    <div class="payment-fig">
                        <img src="{{getFile(config('location.gateway.path').@$gateway->image)}}" alt="{{@$gateway->name}}">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- /PAYMENT-METHOD -->
