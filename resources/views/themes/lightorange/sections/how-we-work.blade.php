@if(isset($templates['how-we-work'][0]) && $howWeWork = $templates['how-we-work'][0])
    <!-- work process start -->
    <section id="work-process-section" class="pt-150 pb-150">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-12">
                    <div class="section-header">
                        <h4 class="sub-title">@lang(@$howWeWork->description->title)</h4>
                        <h3 class="title">@lang(@$howWeWork->description->sub_title)</h3>
                        <p class="area-para">@lang(@$howWeWork->description->short_details)</p>
                    </div>
                </div>
            </div>

            <div class="text-bottom">
                <div class="row justify-content-center text-center wow fadeInUpBig">
                    @if(isset($contentDetails['how-we-work']))
                    @foreach($contentDetails['how-we-work'] as $k =>  $item)
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="single-item">
                                <span class="number">{{sprintf("%02d", ++$k)}}</span>
                                <div class="img-area">
                                    <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('how-we-work-image')">
                                </div>
                                <div class="title-area">
                                    <h3 class="color-one pb-4">@lang(@$item->description->title)</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- work process end -->
@endif
