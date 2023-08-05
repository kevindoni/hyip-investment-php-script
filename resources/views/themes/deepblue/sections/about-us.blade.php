@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])

    <!-- ABOUT-US -->
    <section id="about-us">
        <div class="container">
            <div class="heading-container">
                <h6 class="topheading">@lang(@$aboutUs->description->title)</h6>
                <h3 class="heading">@lang(@$aboutUs->description->sub_title)</h3>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="wrapper d-flex justify-content-center justify-content-xl-start  wow fadeInLeft"
                         data-wow-duration="1s" data-wow-delay="0.35s">
                        <div class="d-flex position-relative">
                            <div class="about-fig">
                                <img src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}" alt="Image Missing">
                            </div>
                            <div class="about-overlay-fig">
                                <img class="img-fill" src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}" alt="Image Missing">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="d-flex align-items-center h-fill">
                        <div class="text-wrapper wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">
                            <h6 class="h6 text-center text-xl-left">
                                @lang(@$aboutUs->description->short_title)
                            </h6>
                            <div class="about-feature mt-30 d-flex flex-column align-items-center align-items-l-start">
                                @lang(@$aboutUs->description->short_description)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /ABOUT-US -->
@endif


