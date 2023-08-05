@if(isset($templates['know-more-us'][0]) && $knowMoreUs = $templates['know-more-us'][0])
    <section class="statistics_area">
        <div class="container">
            <div class="col">
                <div class="header-text text-center">
                    <h5>@lang(@$knowMoreUs->description->title)</h5>
                    <h2 class="mb-2">@lang(@$knowMoreUs->description->sub_title)</h2>
                    <p class="mb-5">@lang(@$knowMoreUs->description->short_details)</p>
                </div>
            </div>
            <div class="row g-5">
                    @if(isset($contentDetails['know-more-us']))
                        @foreach($contentDetails['know-more-us']->take(3) as $k =>  $item)
                            <div class="col-lg-4 col-sm-6">
                                <div class="card statistics_card text-center shadow2">
                                    <div class="image_area">
                                        <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('know-more-us-image')" />
                                    </div>
                                    <div class="text_area">
                                        <h3 class="mt-40">@lang(@$item->description->title)</h3>
                                        <h6>@lang(@$item->description->number)</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

            </div>
        </div>
    </section>
@endif
