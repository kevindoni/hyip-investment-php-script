@if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
    <!-- testimonial section -->
    <section class="testimonial-section">
        <div class="overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="header-text">
                            <h5>@lang($testimonial->description->title)</h5>
                            <h3>@lang(wordSplice($testimonial->description->sub_title)['withoutLastWord']) <span
                                    class="text-stroke">@lang(wordSplice($testimonial->description->sub_title)['lastWord'])</span>
                            </h3>
                        </div>
                    </div>
                    @if(isset($contentDetails['testimonial']))
                        <div class="col-lg-8">
                            <div class="testimonial-wrapper">
                                <div
                                    class="testimonials {{(session()->get('rtl') == 1) ? 'client-testimonials-rtl': 'client-testimonials'}} owl-carousel">
                                    @foreach($contentDetails['testimonial'] as $key => $data)
                                        <div class="review-box">
                                            <div class="text">
                                                <img class="quote" src="{{ asset($themeTrue.'img/icon/quote.png') }}"
                                                     alt=""/>
                                                <p>
                                                    @lang(@$data->description->description)
                                                </p>
                                                <div class="user-box">
                                                    <div class="img">
                                                        <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}"
                                                             alt="@lang('testimonial img')"/>
                                                    </div>
                                                    <div class="text">
                                                        <h5>@lang(@$data->description->name)</h5>
                                                        <h6 class="title">@lang(@$data->description->designation)</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
