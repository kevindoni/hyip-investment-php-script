<div id="sidebar">
    <a class="navbar-brand golden-text" href="{{route('home')}}">{{config('basic.site_title')}}</a>
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
            <h5 class="mb-0"> @lang('Interest Balance') <span> {{ $basic->currency_symbol }}{{ @$user->interest_balance }}</span></h5>
            <span class="tag">{{ $basic->currency }}</span>
        </div>
        <div class="d-flex justify-content-between mt-1">
            <a class="gold-btn btn" href="{{ route('user.addFund') }}"><i class="fa fa-wallet"></i> @lang('Deposit')</a>
            <a class="gold-btn btn" href="{{ route('plan') }}"><i class="fa fa-usd"></i> @lang('Invest')</a>
        </div>
    </div>
    <ul class="pb-4">
       <!-- list item -->
       <li class="{{menuActive('user.home')}}">
          <a href="{{route('user.home')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/layout.png')}}" alt="@lang('Dashboard')"/>@lang('Dashboard')
          </a>
       </li>
	   <li class="{{menuActive(['plan'])}}">
          <a href="{{route('plan')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/growth-graph.png')}}" alt="@lang('invest history')"/>@lang('Plan')
          </a>
        </li>


        <li class="{{menuActive(['user.invest-history'])}}">
          <a href="{{route('user.invest-history')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/growth-graph.png')}}" alt="@lang('invest history')"/>@lang('invest history')
          </a>
        </li>

       <li class="{{menuActive(['user.addFund', 'user.addFund.confirm'])}}">
          <a href="{{route('user.addFund')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/money-bag.png')}}" alt="@lang('Add Fund')"/>@lang('Add Fund')
          </a>
       </li>
       <li class="{{menuActive(['user.fund-history', 'user.fund-history.search'])}}">
          <a href="{{route('user.fund-history')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/fund.png')}}" alt="@lang('Fund History')"/>@lang('Fund History')
          </a>
       </li>
       <li class="{{menuActive(['user.money-transfer'])}}">
          <a href="{{route('user.money-transfer')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/money-transfer.png')}}" alt="@lang('transfer')"/>@lang('transfer')
          </a>
       </li>
       <li class="{{menuActive(['user.transaction', 'user.transaction.search'])}}">
          <a href="{{route('user.transaction')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/transaction.png')}}" alt="@lang('transaction')"/>@lang('transaction')
          </a>
       </li>
       <li class="{{menuActive(['user.payout.money','user.payout.preview'])}}">
          <a href="{{route('user.payout.money')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/payout.png')}}" alt="@lang('payout')"/>@lang('payout')
          </a>
       </li>
       <li class="{{menuActive(['user.payout.history','user.payout.history.search'])}}">
          <a href="{{route('user.payout.history')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/pay-history.png')}}" alt="@lang('payout history')"/>@lang('payout history')
          </a>
       </li>
       <li class="{{menuActive(['user.referral'])}}">
          <a href="{{route('user.referral')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/refferal.png')}}" alt="@lang('my referral')"/>@lang('my referral')
          </a>
       </li>
       <li class="{{menuActive(['user.referral.bonus', 'user.referral.bonus.search'])}}">
          <a href="{{route('user.referral.bonus')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/bonus.png')}}" alt="@lang('referral bonus')"/>@lang('referral bonus')
          </a>
       </li>

        <li class="{{menuActive(['user.badges'])}}">
            <a href="{{route('user.badges')}}" class="sidebar-link">
                <img src="{{asset($themeTrue.'img/icon/refferal.png')}}" alt="@lang('badge icon')"/>@lang('Badges')
            </a>
        </li>

        <li class="{{menuActive(['user.ticket.list', 'user.ticket.create', 'user.ticket.view'])}}">
            <a href="{{route('user.ticket.list')}}" class="sidebar-link">
                <img src="{{asset($themeTrue.'img/icon/support.png')}}" alt="@lang('support ticket')"/>@lang('support ticket')
            </a>
        </li>

       <li class="{{menuActive(['user.profile'])}}">
          <a href="{{route('user.profile')}}" class="sidebar-link">
             <img src="{{asset($themeTrue.'img/icon/setting.png')}}" alt="@lang('profile settings')"/>@lang('profile settings')
          </a>
       </li>

    </ul>
 </div>
