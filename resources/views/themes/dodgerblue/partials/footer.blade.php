<!-- footer section -->
{{--<footer class="footer-section">--}}
{{--    <div class="overlay">--}}
{{--        <div class="container">--}}
{{--            <div class="row gy-5 gy-lg-0">--}}
{{--                <div class="col-lg-3 col-md-6">--}}
{{--                    <div class="footer-box">--}}
{{--                        <a class="navbar-brand" href="{{ route('home') }}"> <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="" /></a>--}}
{{--                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])--}}
{{--                            <p class="company-bio">--}}
{{--                                @lang(strip_tags(@$contact->description->footer_short_details))--}}
{{--                            </p>--}}
{{--                        @endif--}}

{{--                        @if(isset($contentDetails['social']))--}}
{{--                            <div class="social-links">--}}
{{--                                @foreach($contentDetails['social'] as $data)--}}
{{--                                    <a href="{{@$data->content->contentMedia->description->link}}" target="_blank">--}}
{{--                                        <i class="{{@$data->content->contentMedia->description->icon}}"></i>--}}
{{--                                    </a>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])--}}
{{--                    <div class="col-md-6 col-lg-3">--}}
{{--                        <div class="footer-box">--}}
{{--                            <h4>{{trans('get in touch')}}</h4>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <span>@lang(@$contact->description->email)</span>--}}
{{--                                </li>--}}

{{--                                <li>--}}
{{--                                    <span>@lang(@$contact->description->phone)</span>--}}
{{--                                </li>--}}

{{--                                <li>--}}
{{--                                    <span>@lang(@$contact->description->address)</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <div class="col-md-6 col-lg-3 {{(session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'}}">--}}
{{--                    <div class="footer-box">--}}
{{--                        <h4>{{trans('Useful Links')}}</h4>--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <a href="{{route('home')}}">@lang('Home')</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{route('about')}}">@lang('About')</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{route('blog')}}">@lang('Blog')</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{route('contact')}}">@lang('Contact')</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                @if(isset($templates['news-letter'][0]) && $newsLetter = $templates['news-letter'][0])--}}
{{--                    <div class="col-lg-3 col-md-6">--}}
{{--                        <div class="footer-box">--}}
{{--                            <h4>@lang($newsLetter->description->title)</h4>--}}
{{--                            <form action="{{route('subscribe')}}" method="post">--}}
{{--                                @csrf--}}
{{--                                <div class="input-box">--}}
{{--                                    <input type="email" name="email" class="form-control" placeholder="@lang('Email Address')" autocomplete="off"/>--}}
{{--                                    <button type="submit" class="btn-action-icon"><i class="fas fa-paper-plane"></i></button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--            @endif--}}

{{--            <div class="row copyright">--}}
{{--                <div class="col-md-6">--}}
{{--                    <span>@lang('Copyright') &copy; {{date('Y')}} @lang($basic->site_title) @lang('All Rights Reserved')</span>--}}
{{--                </div>--}}

{{--                @php--}}
{{--                    $languageArray = json_decode($languages, true);--}}
{{--                @endphp--}}

{{--                <div class="col-md-6 language {{(session()->get('rtl') == 1) ? 'text-md-start': 'text-md-end'}}">--}}
{{--                    @foreach ($languageArray as $key => $lang)--}}
{{--                        <a href="{{route('language',$key)}}"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span> {{$lang}} </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}


<!-- footer section -->
<footer class="footer-section">
    <div class="overlay">
        <div class="container">
            <div class="row gy-5 gy-lg-0">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box">
                        <a class="navbar-brand" href="index.html"> <img src="{{ asset($themeTrue.'img/icon/logo.png') }}" alt=""></a>
                        <p class="company-bio">
                            We are a full service like readable english. Many desktop publishing packages and web page
                            editor now use lorem Ipsum sites still in their.
                        </p>
                        <div class="social-links">
                            <a href="https://www.facebook.com/" class="facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.facebook.com/" class="twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/" class="linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://www.facebook.com/" class="youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box">
                        <h4>get in touch</h4>
                        <ul>
                            <li>
                                <span>bugfinder.me@gmail.com</span>
                            </li>
                            <li>
                                <span>phone +44-20-4526-2356</span>
                            </li>
                            <li>
                                <span>House#01, Road#14, Sector#11, Dhaka 1230</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="home.html">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="plan.html">Plan</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box">
                        <h4>subscribe newsletter</h4>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Email Address">
                            <button class="btn-action-icon"><i class="fas fa-paper-plane"></i></button>
                        </div>
                        <p class="mt-3"><i class="fa-duotone fa-circle-check"></i> I agree to all terms and policies</p>
                    </div>
                </div>
            </div>
            <div class="d-flex copyright justify-content-between align-items-center">
                <div>
                    <span> All rights reserved © 2022 by<a href="">Bug Finder</a> </span>
                </div>
                <div class="language-dropdown-items">
                    <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img
                            src="{{ asset($themeTrue.'img/flag/usa.png') }}"
                            alt=""
                        >
                        <span>English</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start">
                        <li>
                            <a href="" class="dropdown-item">
                                <img
                                    src="{{ asset($themeTrue.'img/flag/pk.png') }}"
                                    alt=""
                                    class="img-fluid"
                                >
                                <span>Urdu</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <img src="{{ asset($themeTrue.'img/flag/es.png') }}" alt="">
                                <span>Spanish</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <img src="{{ asset($themeTrue.'img/flag/bd.png') }}" alt="">
                                <span>Bangla</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

