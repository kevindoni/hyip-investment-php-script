@if(isset($templates['why-chose-us'][0]) && $whyChoseUs = $templates['why-chose-us'][0])
    <section class="why_choose_investment shape1">
        <div class="container">
            <div class="row">
                <div class="section_header mb-50 text-center text-sm-start">
                    <div class="section_subtitle">@lang($whyChoseUs->description->title)</div>
                    <h1>@lang($whyChoseUs->description->sub_title)</h1>
                    <p class="para_text">@lang($whyChoseUs->description->short_details)</p>
                </div>
            </div>
            @if(isset($contentDetails['why-chose-us']))
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="section_left">
                            <div class="image_area animation1">
                                <img src="{{ $themeTrue.'img/why_choose_investment/img.jpg' }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="seciton_right cmn_scroll">
                            @foreach($contentDetails['why-chose-us'] as $key => $item)
                                <div class="cmn_box2 box1 d-flex shadow3 flex-column flex-sm-row">
                                    <span class="number">{{ ++$key }}</span>
                                    <div class="image_area border1">
                                        <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('why-choose-us image')">
                                    </div>
                                    <div class="text_area">
                                        <h5>@lang(@$item->description->title)</h5>
                                        <p>@lang(@$item->description->information)</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endif
<!-- why_choose_investment_plan_area_end -->
