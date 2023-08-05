<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
{{--<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >--}}
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    @include('partials.seo')

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/all.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/fontawesome.min.css')}}"/>

    @stack('css-lib')

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/style.css')}}">
    <script src="{{asset($themeTrue.'js/modernizr.custom.js')}}"></script>
    @stack('style')

    <script type="application/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="application/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>

<body onload="preloder_function()" class="">

<!-- preloader_area_start -->
<div id="preloader">
</div>
<!-- preloader_area_end -->

<header id="header-section">
    <div class="overlay">
        <!-- TOPBAR -->
        @include($theme.'partials.topbar')
        <!-- /TOPBAR -->
    </div>
</header>

@include($theme.'partials.banner')

@yield('content')

@include($theme.'partials.footer')

@stack('extra-content')

<a href="#" class="scroll_up">
    <i class="fas fa-arrow-up"></i>
</a>

<script src="{{asset($themeTrue.'js/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/owl.carousel.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery.counterup.min.js')}}"></script>

@stack('extra-js')

<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
<script src="{{asset('assets/global/js/pusher.min.js')}}"></script>
<script src="{{asset('assets/global/js/vue.min.js')}}"></script>
<script src="{{asset('assets/global/js/axios.min.js')}}"></script>
<!-- custom script -->
<script src="{{asset($themeTrue.'js/main.js')}}"></script>
@stack('script')

<script>
    var root = document.querySelector(':root');
    root.style.setProperty('--theme_color', '{{config('basic.base_color')??'#ff007a'}}');
    root.style.setProperty('--btn_bg1', '{{config('basic.base_color')??'#ff007a'}}');

    root.style.setProperty('--theme_light_color', '{{config('basic.base_light_color')??'#ff3178'}}');
    root.style.setProperty('--bright_pink', '{{config('basic.base_light_color')??'#ff3178'}}');

    root.style.setProperty('--theme_secondary_color', '{{config('basic.secondary_color')??'#8037c6'}}');
    root.style.setProperty('--heading_color', '{{config('basic.heading_color')??'#001064'}}');
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
