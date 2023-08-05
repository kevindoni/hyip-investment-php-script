<!-- footer_area_start -->
<section class="footer_area">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-sm-6">
                <div class="footer_widget">
                    <div class="widget_logo">
                        <h5><a href="{{url('/')}}" class="site_logo"><img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="{{config('basic.site_title')}}"></a></h5>
                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                            <p class="">@lang(strip_tags(@$contact->description->footer_short_details))</p>
                        @endif
                    </div>
                    @if(isset($contentDetails['social']))
                        <div class="social_area mt-50">
                            <ul class="">
                                @foreach($contentDetails['social'] as $data)
                                <li><a href="{{@$data->content->contentMedia->description->link}}" target="_blank"><i class="{{@$data->content->contentMedia->description->icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 col-sm-6 {{(session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'}}">
                <div class="footer_widget ps-lg-5">
                    <h5>@lang('Links') <span class="highlight"></span></h5>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">@lang('Home')</a>
                        </li>
                        <li>
                            <a href="{{route('about')}}">@lang('About')</a>
                        </li>
                        <li>
                            <a href="{{route('plan')}}">@lang('Plan')</a>
                        </li>
                        <li>
                            <a href="{{route('blog')}}">@lang('Blog')</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 pt-sm-0 pt-3 ps-lg-5 {{(session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'}}">
                <div class="footer_widget">
                    <h5>@lang('Our Services') <span class="highlight"></span></h5>
                    @isset($contentDetails['support'])
                        <ul>
                            @foreach($contentDetails['support'] as $data)
                                <li>
                                    <a href="{{route('getLink', [slug($data->description->title), $data->content_id])}}">@lang($data->description->title)</a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{route('faq')}}">@lang('FAQ')</a>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
            @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                <div class="col-lg-3 col-sm-6 pt-sm-0 pt-3">
                    <div class="footer_widget">
                        <h5>@lang('Contact Us') <span class="highlight"></span></h5>
                        <p>@lang(@$contact->description->address)</p>
                        <p>@lang(@$contact->description->email)</p>
                        <p>@lang(@$contact->description->phone)</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- footer_area_end -->

<!-- copy_right_area_start -->
<div class="copy_right_area text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p>@lang('Copyright') &copy; {{date('Y')}} @lang($basic->site_title) @lang('All Rights Reserved') </p>
            </div>
        </div>
    </div>
</div>
<!-- copy_right_area_end -->
