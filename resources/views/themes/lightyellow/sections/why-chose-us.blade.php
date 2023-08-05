@if(isset($templates['why-chose-us'][0]) && $whyChoseUs = $templates['why-chose-us'][0])
    <section class="service_area">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <div class="section_header">
                    <span class="section_category">@lang($whyChoseUs->description->title)</span>
                    <h2 class="">@lang($whyChoseUs->description->sub_title)</h2>
                    <p class="mt-3">@lang($whyChoseUs->description->short_details)</p>
                    <a class="custom_btn mt-30" href="{{ route('plan') }}">@lang('Discover More')</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-sm-6">
                        @foreach($contentDetails['why-chose-us'] as $key => $item)
                            @if($key == 0)
                                <div class="single_card_area pt-100 pb-3">
                                    <div class="card shadow1">
                                        <div class="card_body">
                                            <div class="image_area mb-4">
                                                <img class="img-center" src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('why-choose-us image')" />
                                            </div>
                                            <h5 class="card-title pb-3">@lang(@$item->description->title)</h5>
                                            <p class="card-text pb-2">@lang(@$item->description->information)</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($key%2 == 0 && $key != 0 && $key < 4)
                                <div class="single_card_area pb-3">
                                    <div class="card shadow1">
                                        <div class="card_body">
                                            <div class="image_area mb-4">
                                                <img class="img-center" src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('why-choose-us image')" />
                                            </div>
                                            <h5 class="card-title pb-3">@lang(@$item->description->title)</h5>
                                            <p class="card-text pb-2">@lang(@$item->description->information)</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="col-sm-6">
                        @foreach($contentDetails['why-chose-us'] as $key => $item)
                            @if($key%2 != 0  && $key < 4)
                                <div class="single_card_area pb-3">
                                    <div class="card shadow1">
                                        <div class="card_body">
                                            <div class="image_area mb-4">
                                                <img class="img-center" src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('why-choose-us image')" />
                                            </div>
                                            <h5 class="card-title pb-3">@lang(@$item->description->title)</h5>
                                            <p class="card-text pb-2">@lang(@$item->description->information)</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
