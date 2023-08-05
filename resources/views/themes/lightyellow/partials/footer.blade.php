<!-- footer_area_start -->
<div class="footer_area pt-100">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer_widget">
                    <div class="widget_logo">
                        <h5><a href="{{url('/')}}" class="site_logo"><img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt=""></a></h5>
                        @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                            <p class="pb-3">
                                @lang(strip_tags(@$contact->description->footer_short_details))
                            </p>
                        @endif
                    </div>
                    @if(isset($contentDetails['social']))
                        <div class="social_area">
                            <ul class="">
                                @foreach($contentDetails['social'] as $data)
                                    <li><a href="{{@$data->content->contentMedia->description->link}}" target="_blank"><i class="{{@$data->content->contentMedia->description->icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer_widget ps-md-5">
                    <h5>{{trans('Useful Links')}}</h5>
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
                        <li>
                            <a href="{{route('contact')}}">@lang('Contact')</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 pt-sm-0 pt-3">
                <div class="footer_widget">
                    <h5>@lang('Our Services')</h5>
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
                    @endisset
                </div>
            </div>
            @if(isset($templates['news-letter'][0]) && $newsLetter = $templates['news-letter'][0])
                <div class="col-lg-4 col-md-4 col-sm-6 pt-sm-0 pt-3">
                    <div class="footer_widget">
                        <h5>@lang(@$newsLetter->description->title)
                        </h5>
                        <p>@lang(@$newsLetter->description->sub_title)
                        </p>
                        <form action="{{route('subscribe')}}" method="post">
                            @csrf
                            <input type="email" name="email" class="form-control" placeholder="@lang('Email Address')">
                            <button type="submit" class="custom_btn"><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- copy_right_area_start -->
        <div class="copy_right_area pt-100 text-center">
            <div class="container">
                <div class="row">
                    <hr class="pb-3">
                    <div class="col-sm-12">
                        <p>@lang('Copyright') &copy; {{date('Y')}} @lang($basic->site_title) @lang('All Rights Reserved')</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- copy_right_area_end -->
    </div>
</div>
<!-- footer_area_end -->
