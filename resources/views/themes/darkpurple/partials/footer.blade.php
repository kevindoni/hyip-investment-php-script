<!-- footer section -->
<footer class="footer-section">
    <div class="overlay">
        <div class="container">
            <div class="row gy-5 gy-lg-0">
                <div class="col-lg-3 col-md-6 pe-lg-5">
                    <div class="footer-box">
                        <a class="navbar-brand" href="{{url('/')}}"> <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="{{config('basic.site_title')}}" /></a>
                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                            <p class="company-bio">
                                @lang(strip_tags(@$contact->description->footer_short_details))
                            </p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 {{(session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'}}">
                    <div class="footer-box">
                        <h4>{{trans('Useful Links')}}</h4>
                        <ul>
                            <li>
                                <a href="{{route('home')}}">@lang('Home')</a>
                            </li>
                            <li>
                                <a href="{{route('about')}}">@lang('About')</a>
                            </li>
                            <li>
                                <a href="{{route('plan')}}">@lang('Plan')</a>
                            </li>
                            <li>
                                <a href="{{route('blog')}}">@lang('Blog')</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                    <div class="col-lg-3 col-md-6 {{(session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'}}">
                        <div class="footer-box">
                            <h4>{{trans('Contact Us')}}</h4>
                            <ul>
                                <li>@lang('Address'): <span>@lang(@$contact->description->address)</span></li>
                                <li>@lang('Email'): <span>@lang(@$contact->description->email)</span></li>
                                <li>@lang('Phone'): <span>@lang(@$contact->description->phone)</span></li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if(isset($contentDetails['social']))
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-box">
                            <h4>@lang('Follow us on')</h4>
                            <div class="social-links">
                                @foreach($contentDetails['social'] as $data)
                                    <a href="{{@$data->content->contentMedia->description->link}}" target="_blank" class="facebook">
                                        <i class="{{@$data->content->contentMedia->description->icon}}"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="d-flex copyright justify-content-between">
                <div>
                    <span> @lang('Copyright') &copy; {{date('Y')}} @lang($basic->site_title) @lang('All Rights Reserved') </span>
                </div>
                @php
                    $languageArray = json_decode($languages, true);
                @endphp
                <div class="{{(session()->get('rtl') == 1) ? 'text-md-start': 'text-md-end'}}">
                    @foreach ($languageArray as $key => $lang)
                        <a href="{{route('language',$key)}}" class="language">{{$lang}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>
