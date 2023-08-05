@extends($theme.'layouts.user')
@section('title', 'badges')

@section('content')
    <div class="container-fluid">
        <div class="row main">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <h3 class="mb-0">@lang('All Badges')</h3>
                </div>
                @if($allBadges)
                    <div class="badge-box-wrapper">
                        <div class="row g-4 mb-4">
                            @foreach($allBadges as $key => $badge)
                                <div class="col-xl-3 col-md-6 box">
                                <div class="badge-box">
                                    <img src="{{ getFile(config('location.rank.path').@$badge->rank_icon) }}" alt="" />
                                    <h3>@lang(@$badge->rank_lavel)</h3>
                                    <p>@lang($badge->description)</p>
                                    <div class="text-start">
                                        <h5>@lang('Minimum Invest'): <span>{{ @$basic->currency_symbol }}{{ @$badge->min_invest }}</span></h5>
                                        <h5>@lang('Minimum Deposit'): <span>{{ @$basic->currency_symbol }}{{ @$badge->min_deposit }}</span></h5>
                                        <h5>@lang('Minimum Earning'): <span>{{ @$basic->currency_symbol }}{{ @$badge->min_earning }}</span></h5>
                                    </div>
                                    <div class="lock-icon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
