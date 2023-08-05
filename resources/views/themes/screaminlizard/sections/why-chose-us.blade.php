@if(isset($templates['why-chose-us'][0]) && $whyChoseUs = $templates['why-chose-us'][0])
    <!-- why choose us start -->
    <section class="feature-section">
        <div class="container">
            <div class="row">
                <div class="header-text text-center">
                    <h5>@lang($whyChoseUs->description->title)</h5>
                    <h3>@lang(wordSplice($whyChoseUs->description->sub_title, 2)['withoutLastWord']) <span
                            class="text-stroke">@lang(wordSplice($whyChoseUs->description->sub_title, -2)['lastWord'])</span>
                    </h3>
                    <p class="mx-auto">
                        @lang($whyChoseUs->description->short_details)
                    </p>
                </div>
            </div>
            @if(isset($contentDetails['why-chose-us']))
                <div class="row g-4 g-lg-5">
                    @foreach($contentDetails['why-chose-us'] as $item)
                        <div class="col-lg-6 col-md-6">
                            <div class="feature-box">
                                <div class="icon-box">
                                    <img src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('why-choose-us image')"/>
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
    <!-- why choose us end -->
@endif
