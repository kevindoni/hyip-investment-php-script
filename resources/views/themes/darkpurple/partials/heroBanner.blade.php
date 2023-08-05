
<!-- home section -->
@if(isset($templates['hero'][0]) && $hero = $templates['hero'][0])
{{--    @push('style')--}}
{{--        <style>--}}
{{--            .home-section {--}}
{{--                height: 100vh;--}}
{{--                background: url({{getFile(config('location.content.path').@$hero->templateMedia()->background_image)}});--}}
{{--                background-size: cover;--}}
{{--                background-position: center;--}}
{{--                position: relative;--}}
{{--                z-index: 1;--}}
{{--                overflow-x: hidden;--}}
{{--            }--}}
{{--        </style>--}}
{{--    @endpush--}}
{{--    <section class="home-section">--}}
{{--        <div class="overlay h-100">--}}
{{--            <div class="container h-100">--}}
{{--                <div class="row h-100 align-items-center">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="text-box">--}}
{{--                            <h1>@lang(@$hero['description']->title) @lang(@$hero['description']->sub_title)</h1>--}}
{{--                            <p>@lang(@$hero['description']->short_description)</p>--}}
{{--                            <a class="btn-custom mt-4" href="{{@$hero->templateMedia()->button_link}}" target="_blank">--}}
{{--                                @lang(@$hero['description']->button_name)--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 d-none d-lg-block">--}}
{{--                        <div class="img-box">--}}
{{--                            <img src="{{getFile(config('location.content.path').@$hero->templateMedia()->image)}}" alt="@lang('hero image')" class="img-fluid img-1" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}



<!-- home section -->
<section class="home-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-7">
                <div class="text-box">
                    <h5 class="my-4">A Profitable platform for high-margin investment</h5>
                    <h1>Best Investments Plan For <span class="text-stroke">WorldWide</span></h1>
                    <div class="d-flex align-items-center mt-5">
                        <button class="btn-custom">Get started</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="countings">
                    <div class="box">
                        <h3>25609</h3>
                        <h5>All Members</h5>
                    </div>
                    <div class="box">
                        <h3>12.5M</h3>
                        <h5>Average Investment</h5>
                    </div>
                    <div class="box">
                        <h3>200</h3>
                        <h5>Countries Supported</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endif


