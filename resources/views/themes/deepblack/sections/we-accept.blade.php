@if(isset($templates['we-accept'][0]) && $weAccept = $templates['we-accept'][0])
    <section class="partner-section">
        <div class="container">
           <div class="row">
              <div class="col">
                 <div class="{{(session()->get('rtl') == 1) ? 'partners-rtl': 'partners'}} owl-carousel">
                    @foreach($gateways as $gateway)
                        <img src="{{getFile(config('location.gateway.path').@$gateway->image)}}" class="image-partners" alt="{{@$gateway->name}}"/>
                    @endforeach
                 </div>
              </div>
           </div>
        </div>
     </section>
@endif
