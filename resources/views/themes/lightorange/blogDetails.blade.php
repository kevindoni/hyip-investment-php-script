@extends($theme.'layouts.app')
@section('title',trans('Blog Details'))

@section('content')


    <!-- blog details start -->
    <section id="blog-details-section" class="blog-details">
        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row mb-30-none">
                    <div class="col-lg-8 wow fadeInLeftBig">
                        <div class="blog-item mb-30">
                            <div class="image-area d-flex justify-content-between align-items-center">
                                <img src="{{$singleItem['image']}}" width="730px" height="475px" alt="@lang('blog details image')">
                            </div>
                            <div class="post d-flex flex-wrap">
                                <div class="single">
                                    <a href="javascript:void(0)">
                                        <i class="icofont-user-alt-4"></i>
                                        <span>{{trans('Post by Admin')}}</span>
                                    </a>
                                </div>
                                <div class="single">
                                    <a href="javascript:void(0)">
                                        <i class="icofont-calendar"></i>
                                        <span>{{$singleItem['date']}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="blog-content-style color-two">
                                <h2 class="title-area">@lang($singleItem['title'])</h2>
                                <p class="area-para">@lang($singleItem['description'])</p>
                            </div>
                        </div>
                    </div>

                    @if(isset($popularContentDetails['blog']))
                    <div class="col-lg-4 col-sm-8 wow fadeInRightBig">
                        <div class="sidebar">
                            <div class="widget-box mb-30">
                                <h2 class="area-title">{{trans('Recent Post')}}</h2>
                                @foreach($popularContentDetails['blog']->sortDesc() as $data)
                                <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}">
                                <div class="single-area d-flex align-items-center">
                                        <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" width="80px" height="80px"
                                        alt="{{@$data->description->title}}">
                                        <div class="right-area">
                                            <p class="area-para">{{\Str::limit($data->description->title,40)}}</p>
                                            <span>{{dateTime($data->created_at)}}</span>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- blog details end -->

@endsection
