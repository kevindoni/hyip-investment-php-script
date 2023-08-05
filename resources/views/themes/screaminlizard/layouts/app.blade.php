<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    @include('partials.seo')

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/bootstrap.min.css')}}"/>

    @stack('css-lib')
    <!-- owl carousel -->
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/owl.theme.default.min.css')}}">

    <!-- select 2 -->
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/select2.min.css')}}">

    <script src="{{asset($themeTrue.'js/fontawesomepro.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/style.css')}}">
    <script src="{{asset($themeTrue.'js/modernizr.custom.js')}}"></script>

    @stack('style')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="application/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="application/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"> <img
                src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt=""/></a>
        <button class="navbar-toggler p-0 " type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fal fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('home') ? 'active' : ''}}" aria-current="page"
                       href="{{route('home')}}">@lang('Home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('about') ? 'active' : ''}}"
                       href="{{route('about')}}">@lang('About')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('plan') ? 'active' : ''}}"
                       href="{{route('plan')}}">{{trans('Plan')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('blog') ? 'active' : ''}}"
                       href="{{route('blog')}}">@lang('Blog')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('faq') ? 'active' : ''}}"
                       href="{{route('faq')}}">@lang('FAQ')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('contact') ? 'active' : ''}}"
                       href="{{route('contact')}}">@lang('Contact')</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            @lang('Login')
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
        <!-- navbar text -->

        <span class="navbar-text" id="pushNotificationArea">
             @auth
                <!-- notification panel -->
            <div class="d-none d-lg-block">
                @include($theme.'partials.pushNotify')
            </div>
            @endauth

            @auth
                 <!-- user panel -->
                <div class="notification-panel user-panel">
                   <span class="profile">
                      <img src="{{getFile(config('location.user.path').auth()->user()->image)}}" class="img-fluid" alt="@lang('user img')"/>
                   </span>
                   <ul class="user-dropdown">
                      <li>
                         <a href="{{route('user.home')}}"> <i class="fal fa-border-all" aria-hidden="true"></i> @lang('Dashboard') </a>
                      </li>
                      <li>
                         <a href="{{ route('user.profile') }}"> <i class="fal fa-user"></i> @lang('My Profile') </a>
                      </li>
                      <li>
                         <a href="{{route('user.twostep.security')}}"> <i class="fal fa-key"></i> @lang('2FA Security') </a>
                      </li>
                      <li>
                         <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> <i class="fal fa-sign-out-alt"></i> @lang('Log Out') </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                      </li>
                   </ul>
                </div>
            @endauth
        </span>
    </div>
</nav>


@include($theme.'partials.banner')

@yield('content')

@include($theme.'partials.footer')

@stack('extra-content')


<script src="{{asset($themeTrue.'js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/owl.carousel.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/select2.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/apexcharts.min.js')}}"></script>


@stack('extra-js')

<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
<script src="{{asset('assets/global/js/pusher.min.js')}}"></script>
<script src="{{asset('assets/global/js/vue.min.js')}}"></script>
<script src="{{asset('assets/global/js/axios.min.js')}}"></script>
<!-- custom script -->
<script src="{{asset($themeTrue.'js/data.js')}}"></script>
<script src="{{asset($themeTrue.'js/script.js')}}"></script>

@stack('script')


<script>
    "use strict";
    var root = document.querySelector(':root');
    root.style.setProperty('--primary', '{{config('basic.base_color')??'#9ff550'}}');
</script>

@auth
    @if(config('basic.push_notification') == 1)
        <script>
            'use strict';
            let pushNotificationArea = new Vue({
                el: "#pushNotificationArea",
                data: {
                    items: [],
                },
                mounted() {
                    this.getNotifications();
                    this.pushNewItem();
                },
                methods: {
                    getNotifications() {
                        let app = this;
                        axios.get("{{ route('user.push.notification.show') }}")
                            .then(function (res) {
                                app.items = res.data;
                            })
                    },
                    readAt(id, link) {
                        let app = this;
                        let url = "{{ route('user.push.notification.readAt', 0) }}";
                        url = url.replace(/.$/, id);
                        axios.get(url)
                            .then(function (res) {
                                if (res.status) {
                                    app.getNotifications();
                                    if (link != '#') {
                                        window.location.href = link
                                    }
                                }
                            })
                    },
                    readAll() {
                        let app = this;
                        let url = "{{ route('user.push.notification.readAll') }}";
                        axios.get(url)
                            .then(function (res) {
                                if (res.status) {
                                    app.items = [];
                                }
                            })
                    },
                    pushNewItem() {
                        let app = this;
                        // Pusher.logToConsole = true;
                        let pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                            encrypted: true,
                            cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
                        });
                        let channel = pusher.subscribe('user-notification.' + "{{ Auth::id() }}");
                        channel.bind('App\\Events\\UserNotification', function (data) {
                            app.items.unshift(data.message);
                        });
                        channel.bind('App\\Events\\UpdateUserNotification', function (data) {
                            app.getNotifications();
                        });
                    }
                }
            });
        </script>
    @endif
@endauth

@if (session()->has('success'))
    <script>
        Notiflix.Notify.Success("@lang(session('success'))");
    </script>
@endif

@if (session()->has('error'))
    <script>
        Notiflix.Notify.Failure("@lang(session('error'))");
    </script>
@endif

@if (session()->has('warning'))
    <script>
        Notiflix.Notify.Warning("@lang(session('warning'))");
    </script>
@endif

@include('plugins')

</body>

</html>
