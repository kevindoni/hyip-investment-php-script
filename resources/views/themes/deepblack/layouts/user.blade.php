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

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'assets/bootstrap/bootstrap.min.css')}}" />

    @stack('css-lib')

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'assets/plugins/owlcarousel/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'assets/plugins/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'assets/plugins/owlcarousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'assets/plugins/aos/aos.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'assets/plugins/radial-progress/radialprogress.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'assets/jquery/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'scss/flags.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'scss/style.css')}}">
    <script src="{{asset($themeTrue.'js/modernizr.custom.js')}}"></script>

@stack('style')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="application/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="application/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body  @if(session()->get('rtl') == 1) class="rtl" @endif>
    <div class="wrapper">
        <!------ sidebar ------->
        @include($theme.'partials.sidebar')

        <!------- Nav + Content ---------->
        <div id="content">
           <div class="overlay">
              <!----- navbar ------>
              <nav class="navbar navbar-expand-lg fixed-top">
                 <div class="container-fluid">
                    <a class="navbar-brand golden-text" href="{{route('home')}}">
                        <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}"
                             alt="{{config('basic.site_title')}}">
                    </a>
                    <button
                       type="button"
                       id="sidebarCollapse"
                       class="sidebar-toggler p-0"
                    >
                       <img src="{{asset($themeTrue.'img/icon/hamburger.png')}}" alt="@lang('hamburger image')"/>
                    </button>

                    <span class="navbar-text" id="pushNotificationArea">
                       <!---- notification panel ---->
                       @include($theme.'partials.pushNotify')

                       <!---- user panel ---->
                       <div class="notification-panel user-panel">
                            <button class="dropdown-toggle">
                                <img src="{{getFile(config('location.user.path').auth()->user()->image)}}" class="user-image" alt="@lang('user img')" />
                            </button>
                            <ul class="notification-dropdown user-dropdown">
                                <li>
                                    <a class="dropdown-item" href="{{route('user.home')}}">
                                        <img src="{{asset($themeTrue.'img/icon/layout.png')}}" alt="@lang('Dashboard')"/>
                                        <span class="golden-text">{{trans('Dashboard')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        <img src="{{asset($themeTrue.'img/icon/profile.png')}}" alt="@lang('My Profile')"/>
                                        <span class="golden-text">@lang('My Profile')</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('user.twostep.security')}}">
                                        <img src="{{asset($themeTrue.'/img/icon/padlock.png')}}" alt="@lang('2FA Security')"/>
                                        <span class="golden-text">@lang('2FA Security')</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        <img src="{{asset($themeTrue.'/img/icon/log-out.png')}}" alt="@lang('Logout')"/>
                                        <span class="golden-text">@lang('Logout')</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                       </div>
                    </span>
                 </div>
              </nav>

              <!------------- others main dashboard body content ------------>
              @yield('content')

           </div>
        </div>
    </div>


     <!-- scroll top icon -->
    <a href="#" class="scroll-top">
        <img src="{{asset($themeTrue.'img/icon/up-arrow2.png')}}" alt="@lang('scroll to top')" />
    </a>

    <!-- start preloader -->
    <div id="preloader">
        <img src="{{asset($themeTrue.'img/bitcoin.gif')}}" alt="@lang('preloader')" class="loader" />
    </div>
    <!-- end preloader -->


@stack('loadModal')

<script src="{{asset($themeTrue.'assets/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($themeTrue.'assets/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset($themeTrue.'assets/jquery/jquery-ui.js')}}"></script>
<script src="{{asset($themeTrue.'assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset($themeTrue.'assets/plugins/counterup/jquery.waypoints.min.js')}}"></script>
<script src="{{asset($themeTrue.'assets/plugins/counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset($themeTrue.'assets/plugins/aos/aos.js')}}"></script>
<script src="{{asset($themeTrue.'assets/plugins/radial-progress/radialprogress.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery.flagstrap.min.js')}}"></script>
<script src="{{asset($themeTrue.'assets/fontawesome/fontawesome.min.js')}}"></script>

@stack('extra-js')

<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
<script src="{{asset('assets/global/js/pusher.min.js')}}"></script>
<script src="{{asset('assets/global/js/vue.min.js')}}"></script>
<script src="{{asset('assets/global/js/axios.min.js')}}"></script>
<!-- custom script -->
<script src="{{asset($themeTrue.'js/script.js')}}"></script>


<script>
    'use strict';

    // dashboard sidebar
    document.getElementById("sidebarCollapse").addEventListener("click", () => {
        document.getElementById("sidebar").classList.toggle("active");
        document.getElementById("content").classList.toggle("active");
    });

    // for datepicker
    $(function () {
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $("#salutation").selectmenu();
    });

    @auth
    @if(config('basic.push_notification') == 1)
        let pushNotificationArea = new Vue({
        el: "#pushNotificationArea",
        data: {
            items: [],
        },
        beforeMount() {
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
    @endif
    @endauth
</script>

@stack('script')


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
