
<style>
    .banner_area {
        background: linear-gradient(90deg, {{hex2rgba(config('basic.base_color'),0.8)}} 0, {{hex2rgba(config('basic.secondary_color'),0.9)}}  100%), url({{getFile($themeTrue.'img/lightPink.jpg')}}) no-repeat;
        background-size: 100% 100%;
        background-position: center;
        position: relative;
    }
</style>
@if(!request()->routeIs('home'))
    <!-- banner_area_start -->
    <div class="banner_area">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <div class="text_area">
                        <h3>
                            @yield('title')
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <div class="breadcrumb_area">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner_area_end -->
@endif
