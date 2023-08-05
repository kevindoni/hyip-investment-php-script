@if(isset($templates['we-accept'][0]) && $weAccept = $templates['we-accept'][0])
    <section class="payment_area shape2">
        <div class="container">
            <div class="row">
                <div class="section_header text-center mb-50">
                    <div class="section_subtitle mx-auto">PAYMENTS</div>
                    <h1>Payments Gateway</h1>
                </div>
                <div class="owl-carousel owl-theme payment_slider text-center {{(session()->get('rtl') == 1) ? 'partners-rtl': 'partners'}}">
                    @foreach($gateways as $gateway)
                        <div class="item">
                        <div class="image_area">
                            <img src="{{getFile(config('location.gateway.path').@$gateway->image)}}" alt="{{@$gateway->name}}">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
