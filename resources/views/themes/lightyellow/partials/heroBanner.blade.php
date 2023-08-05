@if(isset($templates['hero'][0]) && $hero = $templates['hero'][0])
    <div id="header_area" class="header_area">
        <div class="hero_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 order-2 order-md-1 pt-5 pt-md-0">
                        <div class="section_header">
                            <h1 class="mb-50">@lang(@$hero['description']->title) @lang(@$hero['description']->sub_title)</h1>
                            <p class="slider_subtitle mb-50">@lang(@$hero['description']->short_description)
                            </p>
                        </div>
                        <div class="btn_area mb-30">
                            <a href="{{@$hero->templateMedia()->button_link}}" class="custom_btn">
                                @lang(@$hero['description']->button_name)
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 order-1 order-md-2">
                        <div class="image_area">
                            <img src="{{getFile(config('location.content.path').@$hero->templateMedia()->image)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



















{{--@if(isset($templates['hero'][0]) && $hero = $templates['hero'][0])--}}

{{--@push('style')--}}
{{--    <style>--}}
{{--        .home-banner {--}}
{{--            height: 105vh;--}}
{{--            background: url({{getFile(config('location.content.path').@$hero->templateMedia()->background_image)}});--}}
{{--            background-size: cover;--}}
{{--            background-position: center top;--}}
{{--            overflow: hidden;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}
{{--    <!-- home banner -->--}}
{{--    <section class="home-banner">--}}
{{--        <div class="overlay h-100 pt-5">--}}
{{--            <div class="container h-100">--}}
{{--                <div class="row h-100 pt-5 align-items-center justify-content-around">--}}
{{--                    <div class="col-lg-7">--}}
{{--                        <div class="text-box">--}}
{{--                            <h1>--}}
{{--                                @lang(@$hero['description']->title) <br />--}}
{{--                                <span>@lang(@$hero['description']->sub_title)</span>--}}
{{--                            </h1>--}}
{{--                            <p>@lang(@$hero['description']->short_description)</p>--}}
{{--                            <a href="{{@$hero->templateMedia()->button_link}}" class="gold-btn">--}}
{{--                                @lang(@$hero['description']->button_name)--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div--}}
{{--                    class="col-lg-5 text-right d-none d-lg-block animate__animated animate__bounce animate__delay-2s"--}}
{{--                    >--}}
{{--                    <img src="{{getFile(config('location.content.path').@$hero->templateMedia()->image)}}" alt="@lang('hero image')" class="img-fluid" />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endif--}}


