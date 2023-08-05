@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    <section id="about_area" class="about_area">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <div class="image_area">
                        <img class="img-fluid" src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}" width="576px" height="384px" alt="@lang('about image')"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section_content">
                        <div class="section_header">
                            <span class="section_category">@lang(@$aboutUs->description->title)</span>
                            <h2>@lang(@$aboutUs->description->sub_title)</h2>
                            <p>@lang(@$aboutUs->description->short_title)</p>
                            <p>@lang(@$aboutUs->description->short_description)</p>
                        </div>
                        <div class="button_area">
                            <a class="custom_btn mt-30" href="{{ route('about') }}">@lang('Learn more')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


