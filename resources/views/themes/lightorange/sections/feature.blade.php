@if(isset($contentDetails['feature']))
    @if(0 < count($contentDetails['feature']))
        <section id="profit-deposited" class="pt-150 pb-150">
            <div class="container">
                <div class="row d-flex justify-content-md-center">
                    @foreach($contentDetails['feature'] as $feature)
                        <div class="col-lg-4 col-md-6 mb-md-4 wow fadeInLeft">
                            <div class="single-item text-center">
                                <div class="icon-area">
                                    <img
                                        src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}"
                                        alt="@lang('feature image')">
                                </div>
                                <div class="number">
                                    <span>@lang(@$feature->description->information)</span>
                                </div>
                                <div class="title-area">
                                    <h2 class="area-title">@lang(@$feature->description->title)</h2>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif
