@extends($theme.'layouts.app')
@section('title','500')


@section('content')
<section class="error-page wow fadeInUp mb-5 pb-5">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-12 text-center my-5">
                <span class="golden-text opps d-block">@lang('Internal Server Error')</span>
                <div class="sub_title golden-text mb-4 lead">@lang("The server encountered an internal error misconfiguration and was unable to complate your request. Please contact the server administrator.")</div>
                <a class="gold-btn" href="{{url('/')}}" >@lang('Back To Home')</a>
            </div>
        </div>
    </div>
</section>
@endsection
