@if(isset($contentDetails['feature']))
    @if(0 < count($contentDetails['feature']))
        <!-- statistics_area_start -->
        <section class="statistics_area">
        <div class="container">
            <div class="row g-5">
                @foreach($contentDetails['feature'] as $feature)

                    <div class="col-lg-4 col-sm-6">
                        <div class="card statistics_card text-center shadow2">
                            <div class="image_area">
                                <img src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}" alt="@lang('feature image')" />
                            </div>
                            <div class="text_area">
                                <h3 class="mt-40">@lang(@$feature->description->information)</h3>
                                <h6>@lang(@$feature->description->title)</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</section>
    @endif
@endif
<!-- statistics_area_end -->
