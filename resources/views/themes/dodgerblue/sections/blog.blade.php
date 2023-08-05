@if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
    @if(0 < count($contentDetails['blog']))
        <!-- blog section -->
{{--        <section class="blog-section">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="header-text text-center">--}}
{{--                            <h5>@lang(@$blog->description->title)</h5>--}}
{{--                            <h2>@lang(wordSplice($blog->description->sub_title)['withoutLastWord']) <span--}}
{{--                                    class="text-stroke">@lang(wordSplice($blog->description->sub_title)['lastWord'])</span>--}}
{{--                            </h2>--}}
{{--                            <p class="mx-auto">--}}
{{--                                @lang(@$blog->description->short_title)--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @if(isset($contentDetails['blog']))--}}
{{--                    <div class="row justify-content-center g-4 g-lg-5">--}}
{{--                        @foreach($contentDetails['blog']->take(3)->sortDesc() as $k => $data)--}}
{{--                            <div class="col-lg-4 col-md-6">--}}
{{--                                <div class="blog-box">--}}
{{--                                    <div class="img-box">--}}
{{--                                        <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" class="img-fluid"--}}
{{--                                             alt=""/>--}}
{{--                                    </div>--}}
{{--                                    <div class="text-box">--}}
{{--                                        <div class="date-author">--}}
{{--                                            <span>{{dateTime(@$data->created_at,'d M, Y')}}</span>--}}
{{--                                        </div>--}}
{{--                                        <h4>--}}
{{--                                            <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="text-white"--}}
{{--                                            >{{\Illuminate\Support\Str::limit(@$data->description->title,60)}}</a--}}
{{--                                            >--}}
{{--                                        </h4>--}}
{{--                                        <p>@lang(\Illuminate\Support\Str::limit(strip_tags(@$data->description->description), 120))</p>--}}
{{--                                        <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="read-more"--}}
{{--                                        >@lang('read more')--}}
{{--                                            <i class="fal fa-long-arrow-right"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </section>--}}

        <!-- blog section -->
        <section class="blog-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-text text-center">
                            <h5>Our Blogs</h5>
                            <h2>Latest News & <span class="text-stroke">Articles</span></h2>
                            <p class="mx-auto">
                                We are totally focused on delivering high quality Cloud Service & software solution. Bug Finder
                                is one of the pioneers in providing I.T. infrastructure and solutions on various platforms.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center g-4">
                    <div class="col-lg-5 col-xl-6">
                        <div class="blog-box">
                            <div class="img-box">
                                <img src="{{ asset($themeTrue.'img/blog/blog-1.jpg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="text-box">
                                <div class="date-author">
                                    <span>Admin</span>
                                    <span>5th Mar 2023</span>
                                </div>
                                <h4>
                                    <a href="blog-details.html" class="blog-title"
                                    >Brookfield Reinsurance signs deal for USA Equity</a
                                    >
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi hic veritatis sunt asperiores
                                    nobis aspernatur, quisquam ex porro maiores ad! Unde quo non nisi excepturi. Illo recusandae
                                    numquam omnis ipsam.
                                </p>
                                <a href="blog-details.html" class="read-more"
                                >read more
                                    <i class="fal fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-6">
                        <div class="blog-box d-flex">
                            <div class="img-box">
                                <img src="{{ asset($themeTrue.'') }}./img/blog/blog-2.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="text-box">
                                <div class="date-author">
                                    <span>Admin</span>
                                    <span>5th Mar 2023</span>
                                </div>
                                <h4>
                                    <a href="blog-details.html" class="blog-title"
                                    >Friends With Money #106: Investing with Equity Mates</a
                                    >
                                </h4>
                                <a href="blog-details.html" class="read-more"
                                >read more
                                    <i class="fal fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="blog-box d-flex">
                            <div class="img-box">
                                <img src="{{ asset($themeTrue.'img/blog/blog-3.jpg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="text-box">
                                <div class="date-author">
                                    <span>Admin</span>
                                    <span>5th Mar 2023</span>
                                </div>
                                <h4>
                                    <a href="blog-details.html" class="blog-title">Mowi cuts investment worth NOK 5 billion</a>
                                </h4>
                                <a href="blog-details.html" class="read-more"
                                >read more
                                    <i class="fal fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="blog-box d-flex">
                            <div class="img-box">
                                <img src="{{ asset($themeTrue.'img/blog/blog-4.jpg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="text-box">
                                <div class="date-author">
                                    <span>Admin</span>
                                    <span>5th Mar 2023</span>
                                </div>
                                <h4>
                                    <a href="blog-details.html" class="blog-title"
                                    >Lessons From The Bitcoin Investment Strategy</a
                                    >
                                </h4>
                                <a href="blog-details.html" class="read-more"
                                >read more
                                    <i class="fal fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif

