@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')

<!-- POLICY -->
<section id="contact-section">
    <div class="overlay pb-150">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="section-header py-5 my-5">
                        <h4 class="sub-title">@lang('Welcome To Our')</h4>
                        <h4 class="title">@lang(@$title)</h4>
                        <div class="getLinkDescription">
                            @lang(@$description)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /POLICY -->

@endsection
