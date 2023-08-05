@extends($theme.'layouts.app')
@section('title',trans('Plan'))

@section('content')
    @include($theme.'sections.investment')
    @include($theme.'sections.why-chose-us')
    @include($theme.'sections.investor')
    @include($theme.'sections.deposit-withdraw')
    @include($theme.'sections.testimonial')
    @include($theme.'sections.faq')
    @include($theme.'sections.we-accept')
@endsection

