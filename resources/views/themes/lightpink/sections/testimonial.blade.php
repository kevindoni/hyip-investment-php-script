@if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
    <section class="testimonial_area shape1">
    <div class="container">
        <div class="row">
            <div class="section_header mb-30 text-center text-sm-start">
                <span class="section_subtitle">@lang(@$testimonial->description->title)</span>
                <h1 class="">@lang(@$testimonial->description->sub_title)</h1>
            </div>
        </div>
        @if(isset($contentDetails['testimonial']))
            <div class="row">
                <div class="owl-carousel owl-theme testimonial_carousel {{(session()->get('rtl') == 1) ? 'testimonial_carousel-rtl': 'testimonial_carousel'}}">
                    @foreach($contentDetails['testimonial'] as $key => $data)
                        <div class="item mt-70">
                        <div class="cmn_box box1 custom_zindex shadow2">
                            <div class="cmn_icon icon1">
                                <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="@lang('testimonial img')">
                            </div>
                            <div class="text_area  mt-20">
                                <div class="quote_area">
                                    <i class="fas fa-quote-left fa-2x"></i>
                                </div>
                                <h4 class="mt-20">@lang(@$data->description->name)</h4>
                                <p>@lang(@$data->description->description)</p>
                                <div class="quote_area ms-auto">
                                    <i class="fas fa-quote-right fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endif
