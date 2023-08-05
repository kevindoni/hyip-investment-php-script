@if(isset($contentDetails['feature']))
    @if(0 < count($contentDetails['feature']))
        <section class="feature-section">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    @foreach($contentDetails['feature'] as $feature)
                        <div class="col-md-6 col-lg-3">
                        <div
                            class="feature-box"
                            data-aos="fade-up"
                            data-aos-duration="1000"
                            data-aos-anchor-placement="center-bottom"
                        >
                            <div class="d-flex">
                                <div class="icon-box">
                                    <img src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}" alt="@lang('feature image')"/>
                                </div>
                                <h2>@lang(@$feature->description->information)</h2>
                            </div>
                            <h4>@lang(@$feature->description->title)</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif
