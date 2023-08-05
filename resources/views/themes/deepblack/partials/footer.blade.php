<!-- footer -->
<footer class="footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="footer-box">
                        <a class="navbar-brand golden-text" href="{{url('/')}}">
                            {{config('basic.site_title')}}
                        </a>
                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                            <p>
                                @lang(strip_tags(@$contact->description->footer_short_details))
                            </p>
                        @endif
                        @if(isset($contentDetails['social']))
                            <div class="social-links">
                                @foreach($contentDetails['social'] as $data)
                                    <a href="{{@$data->content->contentMedia->description->link}}" target="_blank">
                                        <i class="{{@$data->content->contentMedia->description->icon}}"></i>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 {{(session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'}}">
                    <div class="footer-box">
                        <h4 class="golden-text">{{trans('Useful Links')}}</h4>
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
                            <li>
                                <a href="{{route('contact')}}">@lang('Contact')</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 {{(session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'}}">
                    <div class="footer-box">
                        <h4 class="golden-text">@lang('Our Services')</h4>
                        @isset($contentDetails['support'])
                            <ul>
                                @foreach($contentDetails['support'] as $data)
                                <li>
                                    <a href="{{route('getLink', [slug($data->description->title), $data->content_id])}}">@lang($data->description->title)</a>
                                </li>
                                @endforeach
                                <li>
                                    <a href="{{route('faq')}}">@lang('FAQ')</a>
                                </li>
                            </ul>
                        @endisset
                    </div>
                </div>

                @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                    <div class="col-md-6 col-lg-3">
                    <div class="footer-box">
                        <h4 class="golden-text">{{trans('Contact Us')}}</h4>
                        <ul>
                            <li>
                                <img src="{{asset($themeTrue.'img/icon/calling.png')}}" alt="@lang('phone')" />
                                <span>@lang(@$contact->description->phone)</span>
                            </li>
                            <li>
                                <img src="{{asset($themeTrue.'img/icon/email.png')}}" alt="@lang('email')" />
                                <span>@lang(@$contact->description->email)</span>
                            </li>
                            <li>
                                <img src="{{asset($themeTrue.'img/icon/location.png')}}" alt="@lang('address')" />
                                <span>@lang(@$contact->description->address)</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>

            <div class="row copyright">
                <div class="col-md-6">
                    <span>@lang('Copyright') &copy; {{date('Y')}} @lang($basic->site_title) @lang('All Rights Reserved')</span>
                </div>

                @php
                    $languageArray = json_decode($languages, true);
                @endphp

                <div class="col-md-6 language {{(session()->get('rtl') == 1) ? 'text-md-start': 'text-md-end'}}">
                    @foreach ($languageArray as $key => $lang)
                        <a href="{{route('language',$key)}}"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span> {{$lang}} </a>
                    @endforeach
                </div>
            </div>
        </div>

</footer>
