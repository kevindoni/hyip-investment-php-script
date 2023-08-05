
<!-- Header_area_start -->
<div class="header_area fixed-to" id="header_top">
    <!-- Header_top_area_start -->
    <div class="header_top_area" >
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-7 text-center">
                    <div class="header_top_left  d-none d-sm-block">
                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                            <ul class="d-flex justify-content-md-start justify-content-center">
                                <li><i class="fa-solid fa-envelope"></i> <a href="mailto:@lang(@$contact->description->email)">@lang(@$contact->description->email)</a> </li>
                                <li><i class="fa-solid fa-phone"></i> <a href="tel:@lang(@$contact->description->phone)">@lang(@$contact->description->phone)</a> </li>
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-5 ">
                    <div
                        class="header_top_right d-flex justify-content-md-end justify-content-center align-items-center">
                        <div class="language_select_area">
                            <div class="dropdown">
                                <button class="custom_dropdown dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                     eng
                                </button>
                                @php
                                    $languageArray = json_decode($languages, true);
                                @endphp
                                <ul class="dropdown-menu">
                                    @foreach ($languageArray as $key => $lang)
                                        <li><a class="dropdown-item" href="{{route('language',$key)}}"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span> {{$lang}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if(isset($contentDetails['social']))
                            <div class="login_area">
                                <ul class="social_area d-flex">
                                    @foreach($contentDetails['social'] as $data)
                                        <li><a href="{{@$data->content->contentMedia->description->link}}" target="_blank" class="{{session()->get('trans') == $key ? 'lang_active' : ''}}"><i class="{{@$data->content->contentMedia->description->icon}}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header_top_area_end -->

    <!-- Nav_area_start -->
    <div class="nav_area">
        <nav class="navbar navbar-expand-lg">
            <div class="container custom_nav">
                <a class="logo" href="{{url('/')}}"><img src="{{getFile(config('location.logoIcon.path').'logo.png')}}"
                                              alt="{{config('basic.site_title')}}"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="bars"><i class="fa-solid fa-bars-staggered"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto text-center align-items-center align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{Request::routeIs('home') ? 'active' : ''}}" href="{{route('home')}}">@lang('Home')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::routeIs('about') ? 'active' : ''}}" href="{{route('about')}}">@lang('About')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::routeIs('plan') ? 'active' : ''}}" href="{{route('plan')}}">@lang('Plan')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::routeIs('blog') ? 'active' : ''}}" href="{{route('blog')}}">@lang('Blog')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::routeIs('faq') ? 'active' : ''}}" href="{{route('faq')}}">@lang('FAQ')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::routeIs('contact') ? 'active' : ''}}" href="{{route('contact')}}">@lang('Contact')</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="login_btn" href="{{ route('login') }}"><i class="fa-regular fa-user"></i> @lang('Login')</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="login_btn" href="{{ route('user.home') }}"><i class="fa-regular fa-user"></i> @lang('Dashboard')</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Nav_area_end -->
</div>
<!-- Header_area_end -->
