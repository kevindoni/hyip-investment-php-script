@if(isset($templates['we-accept'][0]) && $weAccept = $templates['we-accept'][0])
    <!-- payment gateway -->
    <section class="payment-gateway">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="gateways {{(session()->get('rtl') == 1) ? 'partners-rtl': 'partners'}} owl-carousel">
                        @foreach($gateways as $gateway)
                            <div class="box">
                                <img src="{{getFile(config('location.gateway.path').@$gateway->image)}}" alt="{{@$gateway->name}}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
