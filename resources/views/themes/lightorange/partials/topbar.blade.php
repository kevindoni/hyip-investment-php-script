<!-- TOPBAR -->
    <div class="header-top d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 d-flex justify-content-start align-items-center justify-cen order-div">
                    <div class="header-left">
                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                        <ul class="d-flex justify-content-between">
                            <li class="header-left-list">
                                <p class="header-left-area">
                                    <span class="header-left-icon">
                                        <i class="icofont-email"></i>
                                        <a href="mailto:@lang(@$contact->description->email)">@lang(@$contact->description->email)</a>
                                    </span>
                                </p>
                            </li>
                            <li class="header-left-list">
                                <p class="header-left-area">
                                    <span class="header-left-icon">
                                        <i class="icofont-android-tablet"></i>
                                        <a href="tel:@lang(@$contact->description->phone)">@lang(@$contact->description->phone)</a>
                                    </span>
                                </p>
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex justify-content-end justify-cen">
                    <div class="language-select-list d-flex flex-wrap">
                        <div class="language-wrapper">
                            <div class="control-plugin">
                                <div class="language"
                                     data-input-name="country3"
                                     data-selected-country="{{app()->getLocale() ? : 'US'}}"
                                     data-button-size="btn-sm"
                                     data-button-type="btn-info"
                                     data-scrollable="true"
                                     data-scrollable-height="250px"
                                     data-countries='{{$languages}}'>
                                </div>
                            </div>
                        </div>
                    </div>

                    @guest
                        <div class="header-right-area">
                            <div class="header-right d-flex flex-wrap align-items-baseline">
                                <div class="header-action d-flex justify-content-between">
                                    <a href="{{ route('login') }}">
                                        <i class="icofont-user-alt-4"></i>@lang('Login')
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="header-right-area">
                            <div class="header-right d-flex flex-wrap align-items-baseline">
                                <div class="header-action d-flex justify-content-between">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                      <i class="icofont-power"></i>@lang('Logout')
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
<!-- /TOPBAR -->
