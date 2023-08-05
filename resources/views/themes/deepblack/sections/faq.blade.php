@if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])
    @if(0 < count($contentDetails['faq']))
        <section class="faq-section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header-text text-center">
                            <h5>@lang(@$faq->description->title)</h5>
                            <h2>@lang(@$faq->description->sub_title)</h2>
                            <p>@lang(@$faq->description->short_details)</p>
                        </div>
                    </div>
                </div>

                @if(isset($contentDetails['faq']))
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                                @foreach($contentDetails['faq'] as $k => $data)
                                    <div class="accordion-item mb-4">
                                        <h4 class="accordion-header mb-0 {{(session()->get('rtl') == 1) ? 'isRtl': ''}}"
                                            id="heading{{$k}}">
                                            <button
                                                class="accordion-button {{($k != 0) ? 'collapsed': '' }}"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{$k}}"
                                                aria-expanded="{{($k == 0) ? 'true' : 'false'}}"
                                                aria-controls="collapse{{$k}}"
                                            >
                                                @lang(@$data->description->title)
                                            </button>
                                        </h4>
                                        <div id="collapse{{$k}}"
                                             class="accordion-collapse collapse {{($k == 0) ? 'show' : ''}}"
                                             aria-labelledby="heading{{$k}}"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>
                                                    @lang(@$data->description->description)
                                                </p>
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
@endif
