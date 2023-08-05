@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    <!-- about_area_start -->
    <section id="about_area" class="about_area">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="section_content">
                        <div class="section_header">
                            <div class="section_subtitle">@lang(@$aboutUs->description->title)</div>
                            <h1>@lang(@$aboutUs->description->sub_title)</h1>
                            <p>@lang(@$aboutUs->description->short_title)</p>
                        </div>
                        <div class="button_area">
                            <a class="custom_btn mt-30 top-right-radius-0" href="{{ route('about') }}">@lang('Learn more')</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="image_area animation1">
                        <img class="img-fluid" src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}" width="576px" height="384px" alt="@lang('about image')">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about_area_end -->
@endif


