@if(isset($templates['why-chose-us'][0]) && $whyChoseUs = $templates['why-chose-us'][0])
    <section class="why-choose-us">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-text text-center">
                    <h5>@lang($whyChoseUs->description->title)</h5>
                    <h2>@lang($whyChoseUs->description->sub_title)</h2>
                    <p>@lang($whyChoseUs->description->short_details)</p>
                </div>
            </div>
        </div>
        @if(isset($contentDetails['why-chose-us']))
            <div class="row g-4 justify-content-center">
                @foreach($contentDetails['why-chose-us'] as $item)
                    <div class="col-md-6">
                    <div
                        class="box"
                        data-aos="fade-up"
                        data-aos-duration="1000"
                        data-aos-anchor-placement="center-bottom"
                    >
                        <div class="icon-box">
                            <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('why-choose-us image')" />
                        </div>
                        <div class="text-box">
                            <h4>@lang(@$item->description->title)</h4>
                            <p>
                                @lang(@$item->description->information)
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif
