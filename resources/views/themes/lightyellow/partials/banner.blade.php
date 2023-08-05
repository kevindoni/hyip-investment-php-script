<!-- PAGE-BANNER -->
<style>
    .banner_area {
        background-image: url({{getFile(config('location.logo.path').'pertial_banner.jpg')}}) !important;
    }
</style>

@if(!request()->routeIs('home'))
    <section class="banner_area">
        <div class="container">
            <div class="row">
                <div class="banner_title">
                    <h2>@yield('title')</h2>
                    <h6><a href="">@lang('Home')</a><i class="fa fa-arrow-right"></i> <Span>@yield('title')</Span></h6>
                </div>
            </div>
        </div>
    </section>
@endif
