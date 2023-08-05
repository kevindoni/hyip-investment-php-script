@if(isset($templates['hero'][0]) && $hero = $templates['hero'][0])
    @push('style')
        <style>
            .home-section {
                background-image: url({{getFile(config('location.content.path').@$hero->templateMedia()->background_image)}}) !important;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>
    @endpush

    <!-- home section -->
    <section class="home-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-7">
                    <div class="text-box">
                        <h5 class="my-4">@lang(@$hero['description']->short_description)</h5>
                        <h1>@lang(@$hero['description']->title) @lang(wordSplice($hero['description']->sub_title)['withoutLastWord']) <span class="text-stroke"> @lang(wordSplice($hero['description']->sub_title)['lastWord'])</span></h1>
                        <div class="d-flex align-items-center mt-5">
                            <a class="btn-custom text-white" href="{{ $hero->templateMedia()->button_link }}" target="_blank">@lang(@$hero['description']->button_name)</a>
                        </div>
                    </div>
                </div>
                @if(isset($contentDetails['feature']))
                    @if(0 < count($contentDetails['feature']))
                        <div class="col-lg-5">
                            <div class="countings">
                                @foreach($contentDetails['feature'] as $feature)
                                    <div class="box">
                                        <h3>@lang(@$feature->description->information)</h3>
                                        <h5>@lang(@$feature->description->title)</h5>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>
@endif


