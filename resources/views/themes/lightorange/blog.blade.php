@extends($theme.'layouts.app')
@section('title', trans($title))

@section('content')

    <!-- blog details start -->
    <section id="blog-details-section" class="blog-details sidebar">
        <div class="overlay pt-150 pb-150">
            <div class="container">
                @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-10">
                        <div class="section-header">
                            <h4 class="sub-title">@lang(@$blog->description->title)</h4>
                            <h3 class="title">@lang(@$blog->description->sub_title)</h3>
                            <p class="area-para">@lang(@$blog->description->short_title)</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row mb-30-none">
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach($contentDetails['blog']->take(3)->sortDesc() as $k => $data)
                                <div class="col-lg-4 col-md-6 wow fadeInUp">
                                    <div class="single-item">
                                        @if($k%2 !== 0)
                                            <div class="img-area">
                                                <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="@lang('blog-image')">
                                            </div>
                                        @endif
                                        <div class="text-area">
                                            <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                                <h2 class="font-weight-bold">{{\Illuminate\Support\Str::limit(@$data->description->title,40)}}</h2>
                                            </a>
                                            <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                                <p class="color-two">
                                                    @lang(\Illuminate\Support\Str::limit(strip_tags(@$data->description->description), 120))
                                                </p>
                                            </a>
                                            <div class="icon-area d-flex justify-content-between">
                                                <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                                    <i class="icofont-user-alt-4"></i> {{trans('Post by Admin')}}
                                                </a>
                                                <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                                <i class="icofont-calendar"></i>
                                                    {{dateTime(@$data->created_at,'d M Y')}}
                                                </a>
                                            </div>
                                        </div>
                                        @if($k%2 == 0)
                                            <div class="img-area">
                                                <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="@lang('blog-image')">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- blog details end -->


    <!-- BLOG -->
    {{-- <section id="blog">
        <div class="container">
            @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
                <div class="d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="heading-container">
                            <h6 class="topheading">@lang(@$blog->description->title)</h6>
                            <h3 class="heading">@lang(@$blog->description->sub_title)</h3>
                            <p class="slogan">@lang(@$blog->description->short_title)</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($contentDetails['blog']))
            <div class="blog-wrapper">
                <div class="row">
                    @foreach($contentDetails['blog'] as $data)
                        <div class="col-md-6 col-lg-4">
                            <a class="card-blog card wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.15s"
                               href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                <div class="fig-container">
                                    <img
                                        src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                        alt="Image Missing">
                                </div>
                                <h5 class="h5 mt-5 mb-5">{{\Illuminate\Support\Str::limit(@$data->description->title,40)}}</h5>
                                <p class="text">
                                    {{Illuminate\Support\Str::limit(strip_tags(@$data->description->description),120)}}
                                </p>
                                <div class="date-wrapper colorbg-1">
                                    <h4 class="font-weight-medium fontubonto">{{dateTime(@$data->created_at,'d')}}</h4>
                                    <h4 class="font-weight-medium fontubonto">{{dateTime(@$data->created_at,'M')}}</h4>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section> --}}
    <!-- /BLOG -->

@endsection
