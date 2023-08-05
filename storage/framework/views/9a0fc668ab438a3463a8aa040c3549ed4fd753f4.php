<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" <?php if(session()->get('rtl') == 1): ?> dir="rtl" <?php endif; ?> >

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/bootstrap.min.css')); ?>"/>

    <?php echo $__env->yieldPushContent('css-lib'); ?>
    <!-- owl carousel -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/owl.theme.default.min.css')); ?>">

    <!-- select 2 -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/select2.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/fancybox.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/all.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($themeTrue.'css/style.css')); ?>">
    <script src="<?php echo e(asset($themeTrue.'js/modernizr.custom.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('style'); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="application/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="application/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- bottom navbar -->
<div class="bottom-nav fixed-bottom d-lg-none">
    <div class="link-item">
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#userSideMenu"
            aria-controls="userSideMenu"
        >
            <span class="icon"><i class="fal fa-bars-staggered"></i></span>
            <span class="text">Menu</span>
        </button>
    </div>
    <div class="link-item">
        <a href="plan.html">
            <span class="icon"><i class="fal fa-clipboard-list"></i></span>
            <span class="text">Plan</span>
        </a>
    </div>
    <div class="link-item active">
        <a href="index.html">
            <span class="icon"><i class="fal fa-house"></i></span>
            <span class="text">Home</span>
        </a>
    </div>
    <div class="link-item">
        <a href="contact.html">
            <span class="icon"><i class="fal fa-headset"></i></span>
            <span class="text">Contact</span>
        </a>
    </div>
    <div class="link-item">
        <a href="user-panel.html">
            <span class="icon"><i class="fal fa-user"></i></span>
            <span class="text">Profile</span>
        </a>
    </div>
</div>

<!-- bottom navbar 3 dot click sidebar -->
<div class="offcanvas offcanvas-start offcanvas-lg user-side-menu" tabindex="-1" id="userSideMenu"
     aria-labelledby="userSideMenu">
    <div class="offcanvas-header">
        <a class="navbar-brand" href="index.html"> <img src="<?php echo e(asset($themeTrue.'img/icon/logo.png')); ?>" alt=""></a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="menu-links">
            <li>
                <a class="nav-link" href="index.html">Home</a>
            </li>
            <li>
                <a class="nav-link" href="about.html">About us</a>
            </li>
            <li>
                <a class="nav-link" href="plan.html">Plan</a>
            </li>
            <li>
                <a class="nav-link" href="faq.html">FAQ</a>
            </li>
            <li>
                <a class="nav-link" href="blogs.html">Blogs</a>
            </li>
            <li>
                <a class="nav-link" href="contact.html">Contact</a>
            </li>
            <li>
                <a class="nav-link" href="login.html">Login</a>
            </li>
        </ul>
    </div>
</div>

<!-- main top navbar big device -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>"> <img
                src="<?php echo e(getFile(config('location.logoIcon.path').'logo.png')); ?>" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('home') ? 'active' : ''); ?>" aria-current="page"
                       href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('about') ? 'active' : ''); ?>"
                       href="<?php echo e(route('about')); ?>"><?php echo app('translator')->get('About'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('plan') ? 'active' : ''); ?>"
                       href="<?php echo e(route('plan')); ?>"><?php echo e(trans('Plan')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('blog') ? 'active' : ''); ?>"
                       href="<?php echo e(route('blog')); ?>"><?php echo app('translator')->get('Blog'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('faq') ? 'active' : ''); ?>"
                       href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('FAQ'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('contact') ? 'active' : ''); ?>"
                       href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a>
                </li>
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>">
                            <?php echo app('translator')->get('Login'); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
        <!-- navbar text -->
        <div class="navbar-text" id="pushNotificationArea">
            <?php if(auth()->guard()->check()): ?>
                <!-- notification panel -->
                <div class="d-none d-lg-block">
                    <?php echo $__env->make($theme.'partials.pushNotify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                <div class="notification-panel user-panel">
               <span class="profile">
                  <img src="<?php echo e(getFile(config('location.user.path').auth()->user()->image)); ?>" class="img-fluid"
                       alt="<?php echo app('translator')->get('user img'); ?>"/>
               </span>
                    <ul class="user-dropdown">
                        <li>
                            <a href="<?php echo e(route('user.home')); ?>"> <i class="fal fa-border-all"
                                                                 aria-hidden="true"></i> <?php echo app('translator')->get('Dashboard'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.profile')); ?>"> <i class="fal fa-user"></i> <?php echo app('translator')->get('My Profile'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.twostep.security')); ?>"> <i
                                    class="fal fa-key"></i> <?php echo app('translator')->get('2FA Security'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"> <i
                                    class="fal fa-sign-out-alt"></i> <?php echo app('translator')->get('Log Out'); ?> </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>


<?php echo $__env->make($theme.'partials.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make($theme.'partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldPushContent('extra-content'); ?>


<script src="<?php echo e(asset($themeTrue.'js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset($themeTrue.'js/jquery-3.6.0.min.js')); ?>"></script>
<script src="<?php echo e(asset($themeTrue.'js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset($themeTrue.'js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset($themeTrue.'js/fancybox.umd.js')); ?>"></script>
<script src="<?php echo e(asset($themeTrue.'js/socialSharing.js')); ?>"></script>
<script src="<?php echo e(asset($themeTrue.'js/apexcharts.min.js')); ?>"></script>


<?php echo $__env->yieldPushContent('extra-js'); ?>

<script src="<?php echo e(asset('assets/global/js/notiflix-aio-2.7.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/pusher.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/vue.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/js/axios.min.js')); ?>"></script>
<!-- custom script -->
<script src="<?php echo e(asset($themeTrue.'js/data.js')); ?>"></script>
<script src="<?php echo e(asset($themeTrue.'js/script.js')); ?>"></script>

<?php echo $__env->yieldPushContent('script'); ?>


<script>
    "use strict";
    var root = document.querySelector(':root');
    root.style.setProperty('--primary', '<?php echo e(config('basic.base_color')??'#9ff550'); ?>');
</script>

<?php if(auth()->guard()->check()): ?>
    <?php if(config('basic.push_notification') == 1): ?>
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
                        axios.get("<?php echo e(route('user.push.notification.show')); ?>")
                            .then(function (res) {
                                app.items = res.data;
                            })
                    },
                    readAt(id, link) {
                        let app = this;
                        let url = "<?php echo e(route('user.push.notification.readAt', 0)); ?>";
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
                        let url = "<?php echo e(route('user.push.notification.readAll')); ?>";
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
                        let pusher = new Pusher("<?php echo e(env('PUSHER_APP_KEY')); ?>", {
                            encrypted: true,
                            cluster: "<?php echo e(env('PUSHER_APP_CLUSTER')); ?>"
                        });
                        let channel = pusher.subscribe('user-notification.' + "<?php echo e(Auth::id()); ?>");
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
    <?php endif; ?>
<?php endif; ?>

<?php if(session()->has('success')): ?>
    <script>
        Notiflix.Notify.Success("<?php echo app('translator')->get(session('success')); ?>");
    </script>
<?php endif; ?>

<?php if(session()->has('error')): ?>
    <script>
        Notiflix.Notify.Failure("<?php echo app('translator')->get(session('error')); ?>");
    </script>
<?php endif; ?>

<?php if(session()->has('warning')): ?>
    <script>
        Notiflix.Notify.Warning("<?php echo app('translator')->get(session('warning')); ?>");
    </script>
<?php endif; ?>

<?php echo $__env->make('plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH D:\xammp\htdocs\hyip8\project\resources\views/themes/dodgerblue/layouts/app.blade.php ENDPATH**/ ?>