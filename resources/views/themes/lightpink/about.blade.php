@extends($theme.'layouts.app')
@section('title',trans('About Us'))

@section('content')
    @include($theme.'sections.about-us')
    @include($theme.'sections.feature')
    @include($theme.'sections.testimonial')
    @include($theme.'sections.why-chose-us')
    @include($theme.'sections.how-it-work')
    @include($theme.'sections.investor')
    @include($theme.'sections.faq')
    @include($theme.'sections.we-accept')
@endsection
