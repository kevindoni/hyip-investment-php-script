@if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
    @push('style')
        <style>
            #banner-wrap::before {
                background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%), url({{getFile(config('location.content.path').@$howItWork->templateMedia()->image)}});
            }
        </style>
    @endpush

    <!-- BANNER-WRAP -->
    <section id="banner-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-6">
                    <div class="youtube-wrapper wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.15s">
                        <div class="btn-container">
                            <div class="btn-play grow-play">
                                <i class="icofont-ui-play"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 offset-md-1 col-md-5">
                    <div class="wrapper wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h3 class="h3 mb-30">@lang(@$howItWork->description->title)</h3>
                        <div class="vertical-timeline">
                            @if(isset($contentDetails['how-it-work']))
                            @foreach($contentDetails['how-it-work'] as $k =>  $item)
                                <div class="media align-items-center mb-20">
                                    <div class="media-counter"><span>{{++$k}}</span></div>
                                    <div class="media-body ml-20">
                                        <h6 class="media-title mb-10">@lang(@$item->description->title)</h6>
                                        <p class="text">
                                            @lang(@$item->description->short_description)
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                                @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /BANNER-WRAP -->
@endif

@push('extra-content')
    @if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])

    <!-- MODAL-VIDEO -->
    <div id="modal-video">
        <div class="modal-wrapper">
            <div class="modal-content">
                <div class="btn-close">&times;</div>
                <div class="modal-container">
                    <iframe width="100%" height="100%"
                            src="{{@optional($howItWork->templateMedia())->youtube_link}}"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- /MODAL-VIDEO -->
    @endif
@endpush
