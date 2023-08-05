@if(isset($contentDetails['feature']))
    @if(0 < count($contentDetails['feature']))
        <!-- Feature_area_start -->
        <section class="feature_area mt-5 mt-lg-0">
            <div class="container">
                <div class="row g-5 justify-content-center">
                    @foreach($contentDetails['feature'] as $feature)
                        <div class="col-lg-4 col-md-6 mb-5">
                        <div class="cmn_box box1 text-center custom_zindex shadow2">
                            <div class="cmn_icon icon1">
                                <img src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}" alt="@lang('feature image')">
                            </div>
                            <h4 class="pt-50">@lang(@$feature->description->information)</h4>
                            <h5 class="">@lang(@$feature->description->title)</h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif
