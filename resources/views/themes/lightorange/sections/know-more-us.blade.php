@if(isset($templates['know-more-us'][0]) && $knowMoreUs = $templates['know-more-us'][0])

    <section id="investor-history-section">
        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-7">
                        <div class="section-header">
                            <h4 class="sub-title">@lang(@$knowMoreUs->description->title)</h4>
                            <h3 class="title">@lang(@$knowMoreUs->description->sub_title)</h3>
                            <p class="area-para">@lang(@$knowMoreUs->description->short_details)</p>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-md-center">
                    @if(isset($contentDetails['know-more-us']))
                    @foreach($contentDetails['know-more-us']->take(3) as $k =>  $item)
                    <div class="col-lg-4 col-md-4 wow fadeInLeftBig">
                        <div class="single-item justify-content-center d-flex">
                            <div class="left-item">
                                <div class="icon-box">
                                    <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('know-more-us-image')">
                                </div>
                            </div>
                            <div class="right-area">
                                <span class="number">@lang(@$item->description->number)</span>
                                <p>@lang(@$item->description->title)</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
