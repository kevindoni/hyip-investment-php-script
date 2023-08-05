@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    <!-- about section -->
{{--    <section class="about-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row g-4 justify-content-between">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="header-text mb-5">--}}
{{--                        <h5>@lang($aboutUs->description->title)</h5>--}}
{{--                        <h2 class="mb-4">@lang(wordSplice($aboutUs->description->sub_title)['withoutLastWord']) <span class="text-stroke">@lang(wordSplice($aboutUs->description->sub_title)['lastWord'])</span></h2>--}}
{{--                    </div>--}}
{{--                    <p>--}}
{{--                        @lang(@$aboutUs->description->short_title)--}}
{{--                        <br />--}}
{{--                        @lang(@$aboutUs->description->short_description)--}}
{{--                    </p>--}}

{{--                    <a class="btn-custom mt-4 text-dark" href="{{route('about')}}" target="_blank">Know more</a>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 {{(session()->get('rtl') == 1) ? 'pe-md-5': 'ps-md-5'}}">--}}
{{--                    <div class="img-box">--}}
{{--                        <img src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}" alt="@lang('about image')" class="img-fluid" />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


    <!-- about section -->
    <section class="about-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="header-text mb-5">
                        <h5>About us</h5>
                        <h2 class="mb-4">Welcome to <span class="text-stroke">HyipPro</span></h2>
                    </div>
                    <p>
                        PlansHyipPro is an investment company, whose tea working on making money from the volatility of
                        cryptocurrencies and offer great returns to our clients. Icon Missing Secure investments The
                        phrasal sequence of the Lorem Ipsum text is now so widespread that many the starting sequence.
                    </p>
                    <p>
                        Alias temporibus nemo voluptatum, deleniti dicta cum laboriosam adipisci consequuntur placeat sit
                        vero.
                    </p>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ea pariatur quis laboriosam natus cumque
                        omnis repellendus vitae!
                    </p>
                    <a href="about.html" class="btn-custom mt-4">Know More</a>
                </div>
                <div class="col-lg-6">
                    <div class="img-box">
                        <img src="{{ asset($themeTrue.'img/about.jpg') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


