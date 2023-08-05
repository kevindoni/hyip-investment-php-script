@extends($theme.'layouts.app')
@section('title','404')


@section('content')
    <section id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12 text-center py-5 my-5">
                    <span class="title display-1 d-block">{{trans('Opps!')}}</span>
                    <div class="sub_title mb-4 lead">{{trans('The page you are looking for was not found.')}}</div>
                    <a class="linear-btn btn-base text-white" href="{{url('/')}}" >@lang('Back To Home')</a>
                </div>
            </div>
        </div>
    </section>
@endsection
