@if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
    @push('style')
        <style>
            .how-it-work::before {
                background-image: url({{getFile(config('location.content.path').@$howItWork->templateMedia()->image)}});
            }
        </style>
    @endpush
    <section class="how-it-work">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="video-box">
                    <a class="play-vdo" href="{{ @optional($howItWork->templateMedia())->youtube_link }}" data-fancybox="video" target="_blank">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="work-process">
                    <h2 class="mb-5">@lang('How it works')</h2>
                    @if(isset($contentDetails['how-it-work']))
                        @foreach($contentDetails['how-it-work'] as $k =>  $item)
                            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-anchor-placement="center-bottom">
                                <div class="count">
                                    <h2>{{++$k}}<span>@lang('.')</span></h2>
                                </div>
                                <div class="text">
                                    <h4>@lang(@$item->description->title)</h4>
                                    <p>@lang(@$item->description->short_description)</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
