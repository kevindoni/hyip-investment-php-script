@if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])
    @if(0 < count($contentDetails['faq']))
        <!-- faq section -->
        <section class="faq-section">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-4">
                        <div class="header-text">
                            <h3>@lang(wordSplice($faq->description->title)['withoutLastWord']) <span
                                    class="text-stroke">@lang(wordSplice($faq->description->title)['lastWord'])</span>
                            </h3>
                            <p class="mt-4 mb-5">
                                @lang(@$faq->description->sub_title)
                            </p>
                            <div class="mail-to">
                                @lang(@$faq->description->short_details)
                            </div>
                        </div>
                    </div>
                    @if(isset($contentDetails['faq']))
                        <div class="col-lg-8 ps-lg-5">
                            <div class="accordion" id="accordionExample">
                                @foreach($contentDetails['faq'] as $k => $data)
                                    <div class="accordion-item">
                                        <h4 class="accordion-header {{(session()->get('rtl') == 1) ? 'isRtl': ''}}" id="heading{{$k++}}">

                                            <button
                                                class="accordion-button {{($k != 1) ? 'collapsed': '' }}"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{$k}}"
                                                aria-expanded="{{($k == 1) ? 'true' : 'false'}}"
                                                aria-controls="collapse{{$k}}"
                                            >

                                                @lang(@$data->description->title)<span class="index">{{ $k < 10 ? '0'.$k : $k}}</span>
                                            </button>
                                        </h4>
                                        <div
                                            id="collapse{{$k}}"
                                            class="accordion-collapse collapse {{($k == 1) ? 'show' : ''}}"
                                            aria-labelledby="heading{{$k}}"
                                            data-bs-parent="#accordionExample"
                                        >
                                            <div class="accordion-body">
                                                @lang(@$data->description->description)
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
@endif
