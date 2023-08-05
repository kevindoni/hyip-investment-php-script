{{-- @extends($extend_blade) --}}
@extends($theme.'layouts.app')
@section('title',trans('Plan'))

@section('content')
    @include($theme.'sections.investment')
    @include($theme.'sections.deposit-withdraw')

    @include($theme.'sections.we-accept')
    @include($theme.'sections.faq')

@endsection

