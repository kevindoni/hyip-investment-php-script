@if(isset($templates['know-more-us'][0]) && $knowMoreUs = $templates['know-more-us'][0])
    <section class="statistic-section">
        <div class="container">
        <div class="row">
            <div class="col">
                <div class="header-text text-center">
                    <h5>@lang(@$knowMoreUs->description->title)</h5>
                    <h2>@lang(@$knowMoreUs->description->sub_title)</h2>
                    <p>@lang(@$knowMoreUs->description->short_details)</p>
                </div>
            </div>
        </div>
        <div class="row statistic-section">
            @if(isset($contentDetails['know-more-us']))
            @foreach($contentDetails['know-more-us']->take(4) as $k =>  $item)
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="800"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="img-box">
                        <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('know-more-us-image')">
                        </div>
                        <h4>@lang(@$item->description->title)</h4>
                        <h2><span class="counter">@lang(@$item->description->number)</span></h2>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        </div>
    </section>
@endif
