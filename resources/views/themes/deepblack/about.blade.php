@extends($theme.'layouts.app')
@section('title',trans('About Us'))

@section('content')
    @include($theme.'sections.about-us')
    @include($theme.'sections.know-more-us')
    @include($theme.'sections.feature')
    @include($theme.'sections.how-it-work')
    @include($theme.'sections.we-accept')
@endsection
