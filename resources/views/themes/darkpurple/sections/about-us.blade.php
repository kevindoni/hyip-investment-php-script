@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    <section class="about-section">
    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-lg-6">
                <div
                    class="img-box"
                    data-aos="fade-right"
                    data-aos-duration="1000"
                    data-aos-anchor-placement="center-bottom"
                >
                    <img src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}" class="img-fluid" alt="@lang('about image')" />
                </div>
            </div>
            <div class="col-lg-6">
                <div
                    class="text-box"
                    data-aos="fade-left"
                    data-aos-duration="1000"
                    data-aos-anchor-placement="center-bottom"
                >
                    <div class="header-text">
                        <h5>@lang(@$aboutUs->description->title)</h5>
                        <h2>@lang(@$aboutUs->description->sub_title)</h2>
                    </div>
                    <p>
                        <i
                        >@lang(@$aboutUs->description->short_title)</i
                        >
                    </p>
                    <p>
                        @lang(@$aboutUs->description->short_description)
                    </p>
                    <a class="btn-custom mt-4" href="{{ route('about') }}">@lang('Know More')</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif


