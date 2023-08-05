
<div id="sidebar" class="">
    <div class="sidebar-top">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}"
                 alt="{{config('basic.site_title')}}">
        </a>
        <button
            class="sidebar-toggler d-md-none"
            onclick="toggleSideMenu()"
        >
            <i class="fal fa-times"></i>
        </button>
    </div>

    @php
        $user = \Illuminate\Support\Facades\Auth::user();
        $user_rankings = \App\Models\Ranking::where('rank_lavel', $user->last_lavel)->first();
    @endphp

    @if($user->last_lavel != null && $user_rankings)
        <div class="level-wrapper">
            <div class="level-box">
                <h4>@lang(@$user_rankings->rank_lavel)</h4>
                <p>@lang(@$user_rankings->rank_name)</p>
                <img src="{{ getFile(config('location.rank.path').@$user_rankings->rank_icon) }}" alt="@lang('level image')" class="level-badge" />
            </div>
        </div>
    @endif

    <div class="wallet-wrapper">
        <div class="wallet-box d-none d-lg-block">
            <h4>@lang('Account Balance')</h4>
            <h5> @lang('Main Balance') <span>{{ $basic->currency_symbol }}{{ @$user->balance }}</span></h5>
            <h5 class="mb-0"> @lang('Interest Balance') <span>{{ $basic->currency_symbol }}{{ @$user->interest_balance }}</span></h5>
            <span class="tag">{{ $basic->currency }}</span>
        </div>
        <div class="d-flex justify-content-between mt-1">
            <a class="btn-custom" href="{{ route('user.addFund') }}"><i class="fal fa-wallet"></i> @lang('Deposit')</a>
            <a class="btn-custom" href="{{ route('plan') }}"><i class="fal fa-usd-circle"></i> @lang('Invest')</a>
        </div>
    </div>

    <ul class="main tabScroll">
        <li>
            <a class="{{menuActive('user.home')}}" href="{{route('user.home')}}"
            > <i class="fal fa-border-all"></i> @lang('Dashboard')</a
            >
        </li>
        <li>
            <a href="{{route('plan')}}" class="sidebar-link {{menuActive(['plan'])}}">
                <i class="fal fa-layer-group"></i> @lang('Plan')
            </a>
        </li>

        <li>
            <a href="{{route('user.invest-history')}}" class="sidebar-link {{menuActive(['user.invest-history'])}}">
                <i class="fal fa-file-medical-alt"></i> @lang('invest history')
            </a>
        </li>

        <li>
            <a href="{{route('user.addFund')}}" class="sidebar-link {{menuActive(['user.addFund', 'user.addFund.confirm'])}}">
                <i class="far fa-funnel-dollar"></i> @lang('Add Fund')
            </a>
        </li>
        <li>
            <a href="{{route('user.fund-history')}}" class="sidebar-link {{menuActive(['user.fund-history', 'user.fund-history.search'])}}">
                <i class="far fa-search-dollar"></i> @lang('Fund History')
            </a>
        </li>
        <li >
            <a href="{{route('user.money-transfer')}}" class="sidebar-link {{menuActive(['user.money-transfer'])}}">
                <i class="far fa-money-check-alt"></i> @lang('transfer')
            </a>
        </li>
        <li>
            <a href="{{route('user.transaction')}}" class="sidebar-link {{menuActive(['user.transaction', 'user.transaction.search'])}}">
                <i class="far fa-sack-dollar"></i> @lang('transaction')
            </a>
        </li>
        <li>
            <a href="{{route('user.payout.money')}}" class="sidebar-link {{menuActive(['user.payout.money','user.payout.preview'])}}">
                <i class="fal fa-hand-holding-usd"></i> @lang('payout')
            </a>
        </li>
        <li>
            <a href="{{route('user.payout.history')}}" class="sidebar-link {{menuActive(['user.payout.history','user.payout.history.search'])}}">
                <i class="far fa-badge-dollar"></i> @lang('payout history')
            </a>
        </li>
        <li>
            <a href="{{route('user.referral')}}" class="sidebar-link {{menuActive(['user.referral'])}}">
                <i class="fal fa-retweet-alt"></i> @lang('my referral')
            </a>
        </li>
        <li class="{{menuActive(['user.referral.bonus', 'user.referral.bonus.search'])}}">
            <a href="{{route('user.referral.bonus')}}" class="sidebar-link">
                <i class="fal fa-money-bill"></i> @lang('referral bonus')
            </a>
        </li>

        <li>
            <a href="{{route('user.badges')}}" class="sidebar-link {{menuActive(['user.badges'])}}">
                <i class="fal fa-badge"></i>@lang('Badges')
            </a>
        </li>

        <li>
            <a href="{{route('user.profile')}}" class="sidebar-link {{menuActive(['user.profile'])}}">
                <i class="fal fa-user"></i> @lang('profile settings')
            </a>
        </li>
        <li>
            <a href="{{route('user.ticket.list')}}" class="sidebar-link {{menuActive(['user.ticket.list', 'user.ticket.create', 'user.ticket.view'])}}">
                <i class="fal fa-user-headset"></i> @lang('support ticket')
            </a>
        </li>
    </ul>
</div>
