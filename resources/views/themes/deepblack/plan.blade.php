{{-- @extends($extend_blade) --}}
@extends($theme.'layouts.app')
@section('title',trans('Plan'))

@section('content')
    @include($theme.'sections.investment')
    @include($theme.'sections.deposit-withdraw')
    @include($theme.'sections.faq')
    @include($theme.'sections.we-accept')
@endsection

