<!-- nav_area_start -->
<div id="nav_area" class="nav_area shadow1">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand site_logo" href="{{url('/')}}"><img src="{{getFile(config('location.logoIcon.path').'logo.png')}}"
                                                                     alt="{{config('basic.site_title')}}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar">
                <span class="bars"><i class="fa fa-bars"></i></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                 aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title site_logo" id="offcanvasNavbarLabel"></h5>
                    <button type="button" class="btn_close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="far fa-times"></i></button>
                </div>
                <div class="offcanvas-body fs-6">
                    <ul class="navbar-nav ms-auto pe-3 align-items-center">
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
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::routeIs('faq') ? 'active' : ''}}" href="{{route('faq')}}">@lang('FAQ')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::routeIs('contact') ? 'active' : ''}}" href="{{route('contact')}}">@lang('Contact')</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link login_btn" href="{{ route('login') }}">@lang('Login')</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link login_btn" href="{{route('user.home')}}">@lang('Dashboard')</a>
                            </li>
                        @endguest
                    </ul>
                    <ul class="navbar-nav justify-content-end  pe-3 align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <img src="{{ asset($themeTrue.'img/lang/translation.png') }}" alt=""> Lang
                            </a>
                            @php
                                $languageArray = json_decode($languages, true);
                            @endphp
                            <ul class="dropdown-menu shadow1" class="language">
                                @foreach ($languageArray as $key => $lang)

                                <li ><a class="dropdown-item {{session()->get('trans') == $key ? 'lang_active' : ''}}" href="{{route('language',$key)}}"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span> {{$lang}}</a></li>
                                @endforeach
                                <li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- nav_area_end -->
