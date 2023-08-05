@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection
@section('content')
    <!-- POLICY -->
    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header-text text-center">
                        <h5>@lang('Welcome To Our')</h5>
                        <h2>@lang(@$title)</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-4 getLink-details">
                    <p>@lang(@$description)</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /POLICY -->
@endsection
