<!-- TOPBAR -->
<section id="topbar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="topbar-contact">
                    <div class="d-flex flex-wrap justify-content-between">
                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                            <ul class="topbar-contact-list d-flex flex-wrap  justify-content-between justify-content-lg-start">
                                <li><i class="icofont-envelope"></i><span
                                        class="ml-5">@lang(@$contact->description->email)</span></li>
                                <li class="ml-sm-3 ml-0"><i class="icofont-android-tablet"></i><span
                                        class="ml-5">@lang(@$contact->description->phone)</span></li>
                            </ul>
                        @endif
                        <div class="d-md-none">
                            @if(isset($contentDetails['social']))
                                <div class="topbar-social">
                                    @foreach($contentDetails['social'] as $k => $data)
                                    <a @if($k == 0)class="pl-0" @endif href="{{@$data->content->contentMedia->description->link}}"><i class="{{@$data->content->contentMedia->description->icon}}"></i></a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="topbar-content d-flex align-items-center justify-content-between justify-content-md-end">
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

                    @if(isset($contentDetails['social']))
                    <div class="topbar-social d-none d-md-block">
                        @foreach($contentDetails['social'] as $k => $data)
                            <a @if($k == 0)class="pl-0" @endif href="{{@$data->content->contentMedia->description->link}}"><i class="{{@$data->content->contentMedia->description->icon}}"></i></a>
                        @endforeach
                    </div>
                    @endif
                    <div class="login-signup d-md-none">
                        <a href="javascript:void(0)">@lang('Login')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /TOPBAR -->
