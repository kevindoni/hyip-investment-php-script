@extends($theme.'layouts.app')
@section('title', trans($title))

@section('content')
    @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
        @if(0 < count($contentDetails['blog']))
            <!-- blog section  -->
{{--            <section class="blog-section blog-details">--}}
{{--                <div class="container">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="header-text text-center">--}}
{{--                                <h5>@lang(@$blog->description->title)</h5>--}}
{{--                                <h2>@lang(@$blog->description->sub_title)</h2>--}}
{{--                                <p class="w-100"> @lang(@$blog->description->short_title)</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if(isset($contentDetails['blog']))--}}
{{--                        <div class="row g-lg-5 gy-5">--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="row g-4 g-lg-5">--}}
{{--                                    @foreach($contentDetails['blog']->sortDesc() as $k => $data)--}}
{{--                                        <div class="col-lg-4 col-md-4">--}}
{{--                                            <div class="blog-box">--}}
{{--                                                <div class="img-box">--}}
{{--                                                    <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"--}}
{{--                                                         class="img-fluid"--}}
{{--                                                         alt="@lang('blog-image')"/>--}}
{{--                                                </div>--}}
{{--                                                <div class="text-box">--}}
{{--                                                    <div class="date-author">--}}
{{--                                                        <span>{{dateTime(@$data->created_at,'d M, Y')}}</span>--}}
{{--                                                    </div>--}}
{{--                                                    <h4>--}}
{{--                                                        <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="text-white"--}}
{{--                                                        >{{\Illuminate\Support\Str::limit(@$data->description->title,60)}}</a--}}
{{--                                                        >--}}
{{--                                                    </h4>--}}
{{--                                                    <p>{{Illuminate\Support\Str::limit(strip_tags(@$data->description->description),120)}}</p>--}}
{{--                                                    <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="read-more"--}}
{{--                                                    >@lang('read more')--}}
{{--                                                        <i class="fal fa-long-arrow-right"></i>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                @endif--}}

{{--            </section>--}}

            <!-- blog section  -->
            @if(isset($contentDetails['blog']))

            @else
                <h2>@lang('No blog found')</h2>
            @endif
            <section class="blog-section blog-details">
                <div class="container">
                    <div class="row g-lg-5 gy-5">
                        <div class="col-lg-8">
                            <div class="row g-4">
                                @foreach($contentDetails['blog']->sortDesc() as $k => $data)
                                    <div class="col-12">
                                        <div class="blog-box">
                                            <div class="img-box">
                                                <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" class="img-fluid" alt="">
                                            </div>
                                            <div class="text-box">
                                                <div class="date-author">
                                                    <span>@lang('Admin')</span>
                                                    <span>{{dateTime(@$data->created_at,'d M, Y')}}</span>
                                                </div>
                                                <h4>
                                                    <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="blog-title"
                                                    >{{\Illuminate\Support\Str::limit(@$data->description->title,60)}}</a
                                                    >
                                                </h4>
                                                <p>{{Illuminate\Support\Str::limit(strip_tags(@$data->description->description),120)}}</p>
                                                <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="read-more">@lang('read more')
                                                    <i class="fal fa-long-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="side-bar">
                                <div class="side-box">
                                    <h4>@lang('Recent Post')</h4>
                                    @foreach($contentDetails['blog']->shuffle()->take(3) as $key => $data)
                                        <div class="side-blog-box">
                                            <div class="img-box">
                                                <img class="img-fluid" src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="">
                                            </div>
                                            <div class="text-box">
                                                <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="title">{{\Illuminate\Support\Str::limit(@$data->description->title,20)}} </a>
                                                <span class="date">{{dateTime(@$data->created_at,'d M, Y')}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

@endsection
