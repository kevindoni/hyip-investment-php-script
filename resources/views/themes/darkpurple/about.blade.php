@extends($theme.'layouts.app')
@section('title',trans('About Us'))

@section('content')
    @include($theme.'sections.about-us')
    @include($theme.'sections.why-chose-us')
    @include($theme.'sections.testimonial')
    @include($theme.'sections.investor')
@endsection
