@if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
    <section class="how_we_work_area">
        <div class="container">
            <div class="row">
            <div class="section_header text-center mb-50">
                <span class="section_category">@lang(@$howItWork->description->sub_title)</span>
                <h2 class="mb-10">@lang(@$howItWork->description->title)</h2>
                <p>@lang(@$howItWork->description->short_details)</p>
            </div>
        </div>
            <div class="row gy-5">
                @foreach($contentDetails['how-it-work'] as $k =>  $item)
                    <div class="col-md-3">
                        <div class="item text-center">
                            <div class="image_area">
                                <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('how-it-work-image')">
                            </div>
                            <div class="text_area mt-30">
                                <h5>@lang(@$item->description->title)</h5>
                                <p>@lang(@$item->description->short_description)</p>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
    </section>
@endif
