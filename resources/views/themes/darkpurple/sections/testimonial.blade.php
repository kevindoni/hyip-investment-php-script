<!-- testimonial section -->
@if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
    <section class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-text text-center">
                    <h5>@lang(@$testimonial->description->title)</h5>
                    <h2>@lang(@$testimonial->description->sub_title)</h2>
                </div>
            </div>
        </div>
        @if(isset($contentDetails['testimonial']))
            <div class="row">
                <div class="col">
                    <div class="testimonials owl-carousel {{(session()->get('rtl') == 1) ? 'testimonial_carousel-rtl': 'testimonial_carousel'}}">
                        @foreach($contentDetails['testimonial'] as $key => $data)
                            <div class="review-box">
                                <div class="text">
                                    <p>
                                        @lang(@$data->description->description)
                                    </p>
                                    <div class="quote">
                                        <img src="{{ asset($themeTrue.'img/icon/quote-2.png') }}"/>
                                    </div>
                                </div>
                                <div class="top">
                                    <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="@lang('testimonial img')"/>
                                    <div>
                                        <h4>@lang(@$data->description->name)</h4>
                                        <a class="organization" href="">@lang(@$data->description->designation)</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
            </div>
        @endif
    </div>
</section>
@endif
