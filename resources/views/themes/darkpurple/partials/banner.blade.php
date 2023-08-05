<!-- banner section -->
<style>
    .banner-section {
        background-image: url({{getFile(config('location.logo.path').'partials_darkpurple_banner.png')}}) !important;
    }
</style>
@if(!request()->routeIs('home'))
    <section class="banner-section">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h3>@yield('title')</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
