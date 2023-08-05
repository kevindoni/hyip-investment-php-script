
    <!-- INVESTMENT-PLAN -->
    <section id="investment-plan">
        <div class="container">
            @if(isset($templates['why-chose-us'][0]) && $whyChoseUs = $templates['why-chose-us'][0])

            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-container">
                        <h6 class="topheading">@lang($whyChoseUs->description->title)</h6>
                        <h3 class="heading">@lang($whyChoseUs->description->sub_title)</h3>
                        <p class="slogan">@lang($whyChoseUs->description->short_details)</p>
                    </div>
                </div>
            </div>
            @endif


            @if(isset($contentDetails['why-chose-us']))
            <div class="investment-plan-wrapper">
                <div class="row">
                    @foreach($contentDetails['why-chose-us'] as $item)
                        <div class="col-md-6">
                            <div class="card-type-1 card align-items-start wow fadeInLeft" data-wow-duration="1s"
                                 data-wow-delay="0.15s">
                                <div class="media">
                                    <div class="card-icon">
                                        <img
                                            src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}"
                                            alt="...">
                                    </div>
                                    <div class="media-body ml-20">
                                        <h5 class="mb-15">@lang(@$item->description->title)</h5>
                                        <p class="text">
                                            @lang(@$item->description->information)
                                        </p>
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
    <!-- /INVESTMENT-PLAN -->
