<!-- navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"> <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}"
                                                          alt="{{config('basic.site_title')}}"/></a>
        <button
            class="navbar-toggler p-0"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('home') ? 'active' : ''}}"
                       href="{{route('home')}}">@lang('Home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('about') ? 'active' : ''}}"
                       href="{{route('about')}}">@lang('About Us')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('plan') ? 'active' : ''}}"
                       href="{{route('plan')}}">@lang('Plan')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('blog') ? 'active' : ''}}"
                       href="{{route('blog')}}">@lang('Blogs')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('faq') ? 'active' : ''}}"
                       href="{{route('faq')}}">@lang('FAQ')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('contact') ? 'active' : ''}}"
                       href="{{route('contact')}}">@lang('Contact')</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{Request::routeIs('login') ? 'active' : ''}}"
                           href="{{ route('login') }}">@lang('Login')</a>
                    </li>
                @endguest
            </ul>
        </div>

        @auth
                <span class="navbar-text">

            @if(config('basic.push_notification') == 1)
               <!-- notification panel -->
                <div class="notification-panel" id="pushNotificationArea">
                    <button class="dropdown-toggle">
                        <i class="far fa-bell"></i>
                        <span v-if="items.length > 0" class="count" v-cloak>@{{items.length}}</span>
                    </button>
                    <ul :class="(items.length > 0)?'notification-dropdown':'no-notification-dropdown'">
                        <div v-if="items.length > 0" class="dropdown-box">
                            <li v-for="(item, index) in items" @click.prevent="readAt(item.id, item.description.link)">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fal fa-bell"></i>
                                    <div class="text">
                                        <p v-cloak v-html="item.description.text" class="notification-heading"></p>
                                        <span class="time" v-cloak>@{{ item.formatted_date }}</span>
                                    </div>
                                </a>
                            </li>
                        </div>
                        <div class="clear-all fixed-bottom">
                            <a href="javascript:void(0)" v-if="items.length > 0"
                               @click.prevent="readAll">@lang('Clear all')</a>
                            <a href="javascript:void(0)" v-if="items.length == 0"
                               @click.prevent="readAll">@lang('You have no notifications')</a>
                        </div>
                    </ul>
                </div>
            @endif
                <!-- user panel -->
               <div class="user-panel">
                  <span class="profile">
                     <img src="{{getFile(config('location.user.path').auth()->user()->image)}}" alt="@lang('user img')"
                          class="img-fluid"/>
                  </span>
                  <ul class="user-dropdown">
                      <li>
                            <a href="{{route('user.home')}}"><i class="fal fa-border-all" aria-hidden="true"></i> {{trans('Dashboard')}}</a>
                      </li>

                      <li>
                        <a href="{{ route('user.profile') }}"><i class="far fa-user"></i> @lang('My Profile')</a>
                      </li>

                      <li>
                        <a href="{{route('user.twostep.security')}}"><i
                                class="far fa-key"></i> @lang('2FA Security')</a>
                      </li>
                      <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="far fa-sign-out-alt"></i>
                             @lang('Logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                      </li>
                  </ul>
               </div>
            </span>
            @endauth
    </div>
</nav>
