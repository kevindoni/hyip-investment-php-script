@if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])
    @if(0 < count($contentDetails['faq']))
        <section id="faq-section">
            <div class="overlay pt-150 pb-150">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-10">
                            <div class="section-header">
                                <h4 class="sub-title">@lang(@$faq->description->title)</h4>
                                <h3 class="title">@lang(@$faq->description->sub_title)</h3>
                                <p class="area-para">@lang(@$faq->description->short_details)</p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content mb-30-none" id="myTabContentFaq">
                                <div class="tab-pane fade show active wow fadeInUp" id="basicarea" role="tabpanel"
                                     aria-labelledby="basic-tab">
                                    <div id="basic" class="accordion">
                                        @if(isset($contentDetails['faq']))
                                            @foreach($contentDetails['faq'] as $k => $data)
                                                <div class="card card-rounded">
                                                    <div class="card-header" id="faq{{$k}}">
                                                        <a href="#"
                                                           class="btn btn-header-link {{($k == 0) ? '' : 'collapsed'}}"
                                                           data-toggle="collapse" data-target="#faq1{{$k}}"
                                                           aria-expanded="true"
                                                           aria-controls="faqbasic1{{$k}}">@lang(@$data->description->title)</a>
                                                    </div>
                                                    <div id="faq1{{$k}}" class="collapse {{($k == 0) ? 'show' : ''}}"
                                                         aria-labelledby="faq{{$k}}" data-parent="#basic">
                                                        <div class="card-body ">
                                                            @lang(@$data->description->description)
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
