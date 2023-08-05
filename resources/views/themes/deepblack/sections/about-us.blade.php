@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    <section class="about-section">
        <div class="container">
        <div class="row">
            <div class="col">
                <div class="header-text text-center">
                    <h5>@lang(@$aboutUs->description->title)</h5>
                    <h2>@lang(@$aboutUs->description->sub_title)</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="img-box">
                    <img class="img-fluid" src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}" width="576px" height="384px" alt="@lang('about image')"/>
                </div>
            </div>
            <div class="col-md-6 {{(session()->get('rtl') == 1) ? 'pe-md-5': 'ps-md-5'}}">
                <div class="text-box">
                    <p>
                        @lang(@$aboutUs->description->short_title)
                    <br />
                    <br />
                        @lang(@$aboutUs->description->short_description)
                    </p>
                </div>
            </div>
        </div>
        </div>
    </section>
@endif


