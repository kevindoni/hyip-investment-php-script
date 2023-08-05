@if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
    <section id="testmonial-section">
        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-10">
                        <div class="section-header">
                            <h4 class="sub-title">@lang($testimonial->description->title)</h4>
                            <h3 class="title">@lang($testimonial->description->sub_title)</h3>
                            <p class="area-para">@lang($testimonial->description->short_title)</p>
                        </div>
                    </div>
                </div>
                <div class=" {{(session()->get('rtl') == 1) ? 'testmonial-carousel-rtl': 'testmonial-carousel'}} wow fadeInUp">
                    @if(isset($contentDetails['testimonial']))
                        @foreach($contentDetails['testimonial'] as $key=>$data)
                            <div class="col">
                                <div class="single-item">
                                    <div class="top-area d-flex align-items-center">
                                        <img
                                            src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}"
                                            class="testmonial-img-circle" alt="@lang('testimonial image')">
                                        <div class="text-area">
                                            <h2>@lang(@$data->description->name)</h2>
                                            <p>@lang(@$data->description->designation)</p>
                                        </div>
                                    </div>
                                    <div class="bottom-area">
                                        <p><span>“</span>@lang(@$data->description->description)<span>”</span></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
