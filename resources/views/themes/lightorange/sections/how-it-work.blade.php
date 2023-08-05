@if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
    <section id="about-us-section" class="pt-150 pb-150">
        <img class="img-1 zoomInOutInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-1.png')}}" alt="@lang('ellipse-1-image')">
        <img class="img-2 zoomInOutInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-2.png')}}" alt="@lang('ellipse-2-image')">
        <img class="img-3 zoomInOut2sInfinite" src="{{asset('assets/themes/lightorange/images/home/ellipse-3.png')}}" alt="@lang('ellipse-3-image')">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 d-flex align-items-center justify-content-md-center wow fadeInLeftBig">
                    <div class="video-area">
                        <div class="content d-flex justify-content-center align-items-center">
                            <img src="{{getFile(config('location.content.path').@$howItWork->templateMedia()->image)}}" alt="@lang('how-it-work-image')">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig">
                    <div class="right-area">
                        <div class="section-head">
                            <h3 class="title font-weight-bold">@lang(@$howItWork->description->title)</h3>
                        </div>
                        <div class="single-item">
                            @if(isset($contentDetails['how-it-work']))
                            @foreach($contentDetails['how-it-work'] as $k =>  $item)
                                <div class="btn-top d-flex">
                                    <div class="icon-area">
                                        <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('how-it-work-image')">
                                        {{-- <h5 style="color:#33406A">{{++$k}}</h5> --}}
                                    </div>
                                    <div class="text-area">
                                        <h5 class="font-weight-bold" style="color:#33406A">@lang(@$item->description->title)</h5>
                                        <div style="color:#526288">@lang(@$item->description->short_description)</div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
