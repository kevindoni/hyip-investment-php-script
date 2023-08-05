@if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
<section class="testimonial-section">
    <div class="container">
       <div class="row">
          <div class="col">
             <div class="header-text text-center">
                <h5>@lang($testimonial->description->title)</h5>
                <h2>@lang($testimonial->description->sub_title)</h2>
                <p>@lang($testimonial->description->short_title)</p>
             </div>
          </div>
       </div>

       @if(isset($contentDetails['testimonial']))
        <div class="{{(session()->get('rtl') == 1) ? 'client-testimonials-rtl': 'client-testimonials'}} owl-carousel">
                @foreach($contentDetails['testimonial'] as $key => $data)
                    <div class="review-box">
                        <img class="quote" src="{{asset($themeTrue.'img/icon/quote.png')}}" alt="@lang('quote img')" />
                        <div class="img-box">
                            <img class="img-fluid" src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="@lang('testimonial img')" />
                        </div>
                        <div class="text-box">
                            <h4 class="golden-text">@lang(@$data->description->name)</h4>
                            <span>@lang(@$data->description->designation)</span>
                            <p>@lang(@$data->description->description)</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif
