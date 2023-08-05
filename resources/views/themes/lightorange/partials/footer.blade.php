
<!-- footer-section start -->
    <footer id="inner-footer-section">
        <div class="wrapper-top">
            <div class="clip"></div>
            <div class="footer-top-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-top pt-150 pb-150">
                                <div class="row text-center">
                                    <div class="col-lg-12">
                                        @if(isset($contentDetails['social']))
                                            <div class="social-icon">
                                                <ul class="icon-area d-flex justify-content-center">
                                                    @foreach($contentDetails['social'] as $data)
                                                    <li class="social-nav">
                                                        <a href="{{@$data->content->contentMedia->description->link}}">
                                                            <i class="{{@$data->content->contentMedia->description->icon}}"></i>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if(isset($newsLetter['news-letter'][0]) && $newsLetter = $newsLetter['news-letter'][0])
                                            <div class="footer-text">
                                                <h2 class="sub-title">@lang(@$newsLetter->description->sub_title)</h2>
                                                <h2 class="title">@lang(@$newsLetter->description->title)</h2>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                        <div class="col-lg-6 mt-2">
                                            <form action="{{route('subscribe')}}" method="post">
                                                <div class="subscribe d-flex">
                                                    @csrf
                                                    <input type="email" name="email" type="email" class="text-dark" placeholder="@lang('Email Address')">
                                                    <button class="subscribe-btn" type="submit">{{trans('Subscribe')}}</button>

                                                </div>
                                            </form>
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-bottom">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 col-md-4 justify-cen d-flex justify-content-start">
                            <div class="left-area">
                                <a class="site-logo site-title" href="{{url('/')}}">
                                    <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}"
                                    alt="{{config('basic.site_title')}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 justify-cen d-flex justify-content-end align-items-center">
                            <ul class="d-flex">

                                <li>
                                    <a href="{{route('home')}}"> @lang('Home')</a>
                                </li>
                                <li>
                                    <a href="{{route('about')}}"> @lang('About')</a>
                                </li>
                                <li>
                                    <a href="{{route('faq')}}"> @lang('FAQ')</a>
                                </li>
                                @isset($contentDetails['support'])
                                @foreach($contentDetails['support'] as $data)
                                    <li>
                                        <a href="{{route('getLink', [slug($data->description->title), $data->content_id])}}">
                                            @lang($data->description->title)
                                        </a>
                                    </li>
                                @endforeach
                            @endisset
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bottom-area text-center">
                                <p>@lang('Copyright') &copy; {{date('Y')}} @lang($basic->site_title) @lang('All Rights Reserved')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- footer-section end -->
