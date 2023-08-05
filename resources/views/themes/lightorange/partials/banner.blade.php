<!-- PAGE-BANNER -->
@if(!request()->routeIs('home'))
    <section id="inner-banner">
        <div class="overlay bg_img">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="banner-content">
                            <div class="banner-text text-center">
                                <h2 class="title">@yield('title')</h2>
                            </div>
                            <div class="breadcrumb-area">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb d-flex justify-content-center">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('Home')}}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- /PAGE-BANNER -->
@endif
