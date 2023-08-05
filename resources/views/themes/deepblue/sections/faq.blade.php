<!-- FAQ -->
<section id="faq">
    <div class="container">
        @if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-container">
                        <h6 class="topheading">@lang(@$faq->description->title)</h6>
                        <h3 class="heading">@lang(@$faq->description->sub_title)</h3>
                        <p class="slogan">@lang(@$faq->description->short_details)</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="faq-wrapper">
            <div class="faq-accordion">
                @if(isset($contentDetails['faq']))
                    @foreach($contentDetails['faq'] as $k => $data)
                        <div class="faq-card card">
                            <div class="card-header">
                                <button class="btn-faq rotate-icon">
                                    @lang(@$data->description->title)
                                </button>
                            </div>
                            <div class="card-body {{($k == 0) ? 'preview' : ''}} ">
                                <div class="faq-content">
                                    <p class="text">
                                        @lang(@$data->description->description)
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
<!-- /FAQ -->
