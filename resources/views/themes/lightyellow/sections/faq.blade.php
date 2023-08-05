@if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])
    @if(0 < count($contentDetails['faq']))
        <section id="faq_area" class="faq_area">
            <div class="container">
                <div class="section_header">
                    <span class="section_category">@lang(@$faq->description->title)</span>
                    <h2>@lang(@$faq->description->sub_title)</h2>
                    <p>@lang(@$faq->description->short_details)</p>
                </div>
                @if(isset($contentDetails['faq']))
            <div class="row pt-md-5">
                <div class="col-md-8 order-2 ">
                    <div class="accordion_area">
                        <div class="accordion" id="accordionExample">
                            @foreach($contentDetails['faq'] as $k => $data)
                                <div class="accordion-item shadow1">
                                    <h2 class="accordion-header {{(session()->get('rtl') == 1) ? 'isRtl': ''}}" id="headingOne{{$k}}">
                                        <button class="accordion-button {{($k != 0) ? 'collapsed': '' }}" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne{{$k}}" aria-expanded="{{($k == 0) ? 'true' : 'false'}}" aria-controls="collapseOne{{$k}}">
                                            @lang(@$data->description->title)
                                        </button>
                                    </h2>
                                    <div id="collapseOne{{$k}}" class="accordion-collapse collapse {{($k == 0) ? 'show' : ''}}" aria-labelledby="headingOne{{$k}}"
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @lang(@$data->description->description)
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
            </div>
        </section>
    @endif
@endif
