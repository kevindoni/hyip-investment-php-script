@extends($theme.'layouts.app')
@section('title',trans('Home'))

@section('content')
    @include($theme.'partials.heroBanner')

    @include($theme.'sections.feature')
    @include($theme.'sections.about-us')

    @include($theme.'sections.why-chose-us')
    @include($theme.'sections.investment')
    @include($theme.'sections.how-it-work')
    @include($theme.'sections.deposit-withdraw')
    @include($theme.'sections.testimonial')
    @include($theme.'sections.investor')
    @include($theme.'sections.news-letter')
    @include($theme.'sections.blog')

    @include($theme.'sections.faq')
    @include($theme.'sections.we-accept')
@endsection
