@extends($theme.'layouts.app')
@section('title',trans('About Us'))

@section('content')
    @include($theme.'sections.about-us')
    @include($theme.'sections.how-it-work')
    @include($theme.'sections.referral')
    @include($theme.'sections.we-accept')
@endsection
