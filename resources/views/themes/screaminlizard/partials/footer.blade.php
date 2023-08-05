<!-- footer section -->
<footer class="footer-section">
    <div class="overlay">
        <div class="container">
            <div class="row gy-5 gy-lg-0">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box">
                        <a class="navbar-brand" href="{{ route('home') }}"> <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="" /></a>
                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                            <p class="company-bio">
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


                @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-box">
                            <h4>{{trans('get in touch')}}</h4>
                            <ul>
                                <li>
                                    <span>@lang(@$contact->description->email)</span>
                                </li>

                                <li>
                                    <span>@lang(@$contact->description->phone)</span>
                                </li>

                                <li>
                                    <span>@lang(@$contact->description->address)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="col-md-6 col-lg-3 {{(session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'}}">
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
                                <a href="{{route('blog')}}">@lang('Blog')</a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}">@lang('Contact')</a>
                            </li>
                        </ul>
                    </div>
                </div>

                @if(isset($templates['news-letter'][0]) && $newsLetter = $templates['news-letter'][0])
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-box">
                            <h4>@lang($newsLetter->description->title)</h4>
                            <form action="{{route('subscribe')}}" method="post">
                                @csrf
                                <div class="input-box">
                                    <input type="email" name="email" class="form-control" placeholder="@lang('Email Address')" autocomplete="off"/>
                                    <button type="submit" class="btn-action-icon"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            @endif

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
    </div>
</footer>
