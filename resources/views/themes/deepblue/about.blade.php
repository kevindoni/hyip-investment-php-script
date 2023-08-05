@extends($theme.'layouts.app')
@section('title',trans('About Us'))

@section('content')
    @include($theme.'sections.why-chose-us')
    @include($theme.'sections.about-us')

    @include($theme.'sections.news-letter')
    @include($theme.'sections.investor')

    @include($theme.'sections.faq')
    @include($theme.'sections.we-accept')


@endsection
