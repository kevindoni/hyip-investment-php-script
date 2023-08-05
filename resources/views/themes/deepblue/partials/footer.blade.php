<!-- FOOTER -->
<footer id="footer">
    <div class="container">
        <div class="row responsive-footer">
            <div class="col-sm-6 col-lg-4">
                <div class="footer-links wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.15s">
                    <div class="footer-brand">
                        <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="...">

                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                            <p class="text mt-30 mb-30">
                                @lang(strip_tags(@$contact->description->footer_short_details))
                            </p>
                        @endif
                    </div>
                    @if(isset($contentDetails['social']))
                    <div class="footer-social mt-5">
                        @foreach($contentDetails['social'] as $data)
                            <a class="social-icon facebook" href="{{@$data->content->contentMedia->description->link}}">
                                <i class="{{@$data->content->contentMedia->description->icon}}"></i>
                            </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="footer-links  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                    <h5 class="h5">{{trans('Useful Links')}}</h5>
                    <ul class="">
                        <li>
                            <a href="{{route('home')}}"><i class="icofont-thin-right"></i> @lang('Home')</a>
                        </li>
                        <li>
                            <a href="{{route('about')}}"><i class="icofont-thin-right"></i> @lang('About Us')</a>
                        </li>
                        <li>
                            <a href="{{route('blog')}}"><i class="icofont-thin-right"></i> @lang('Blog')</a>
                        </li>
                        <li>
                            <a href="{{route('faq')}}"><i class="icofont-thin-right"></i> @lang('FAQ')</a>
                        </li>


                        @isset($contentDetails['support'])
                            @foreach($contentDetails['support'] as $data)
                                <li>
                                    <a href="{{route('getLink', [slug($data->description->title), $data->content_id])}}"><i class="icofont-thin-right"></i> @lang($data->description->title)</a>
                                </li>
                            @endforeach
                        @endisset
                    </ul>
                </div>
            </div>


            @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                <div class="col-sm-6 col-lg-4">
                    <div class="footer-address  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.45s">
                        <h5 class="h5">{{trans('Contact')}}</h5>
                        <ul>
                            <li class="d-flex align-items-center mb-10">
                                <i class="icofont-android-tablet"></i>
                                <span class="ml-10">@lang(@$contact->description->phone)</span>
                            </li>
                            <li class="d-flex align-items-center mb-10">
                                <i class="icofont-envelope"></i>
                                <span class="ml-10">@lang(@$contact->description->email)</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="icofont-map-pins"></i>
                                <span class="ml-10">@lang(@$contact->description->address)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

        </div>
    </div>


    <div class="copy-rights">
        <div class="container">
            <p class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.35s">
                @lang('Copyright') &copy; {{date('Y')}} @lang($basic->site_title) @lang('All Rights Reserved')</p>
        </div>
    </div>

</footer>
<!-- /FOOTER -->


