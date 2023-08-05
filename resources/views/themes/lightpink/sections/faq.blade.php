@if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])
    @if(0 < count($contentDetails['faq']))
        <section class="faq_area">
            <div class="container">
                <div class="row">
                    <div class="section_header text-center">
                        <div class="section_subtitle faq_section_subtitle">@lang(@$faq->description->title)</div>
                        <h1>@lang(@$faq->description->sub_title)</h1>
                        <p class="m-auto para_text">@lang(@$faq->description->short_details)</p>
                    </div>
                </div>
                @if(isset($contentDetails['faq']))
                    <div class="row">
                        @foreach($contentDetails['faq'] as $k => $data)
                            <div class="col-md-12" data-aos="fade-left">
                                <div class="accordion_area mt-45">
                                    <div class="accordion_item shadow3">
                                        <button class="accordion_title">@lang(@$data->description->title)<i
                                                class="{{($k == 0) ? 'fa fa-minus': 'fa fa-plus' }}"></i></button>
                                        <p class="accordion_body {{($k == 0) ? 'show' : ''}}">
                                            @lang(@$data->description->description)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif
@endif
