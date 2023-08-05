@if(isset($templates['request-a-call'][0]) && $requestACall = $templates['request-a-call'][0])
    <section id="contact-support-section">
        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8 wow fadeInLeftBig">
                        <div class="left-area d-flex">
                            <div class="icon-area">
                                <img src="{{asset($themeTrue.'images/icon/contact_icon_3.png')}}" alt="image">
                            </div>
                            <span class="border"></span>
                            <div class="text-area">
                                <h3>@lang(@$requestACall->description->title)</h3>
                                <h2 class="area-title">@lang(@$requestACall->description->sub_title)</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 call-support d-flex justify-content-end align-items-center wow fadeInRightBig">
                        <div class="right-area">
                            <a href="{{@$requestACall->templateMedia()->button_link}}" class="cmn-btn">@lang(@$requestACall->description->button_name)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
