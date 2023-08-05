@extends($theme.'layouts.app')
@section('title','419')


@section('content')
<section class="error-page wow fadeInUp mb-5 pb-5">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-12 text-center my-5">
                <span class="golden-text opps d-block">@lang('419')</span>
                <div class="sub_title golden-text mb-4 lead">@lang("Sorry, your session has expired")</div>
                <a class="gold-btn" href="{{url('/')}}" >@lang('Back To Home')</a>
            </div>
        </div>
    </div>
</section>
@endsection
