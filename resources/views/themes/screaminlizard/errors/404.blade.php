@extends($theme.'layouts.app')
@section('title','404')

@section('content')
    <section class="error-page wow fadeInUp mb-5 pb-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12 text-center my-5">
                    <span class="golden-text opps d-block">{{trans('Opps!')}}</span>
                    <div class="sub_title golden-text mb-4 lead">{{trans('The page you are looking for was not found.')}}</div>
                    <a class="gold-btn" href="{{url('/')}}" >@lang('Back To Home')</a>
                </div>
            </div>
        </div>
    </section>
@endsection
