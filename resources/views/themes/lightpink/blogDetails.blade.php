@extends($theme.'layouts.app')
@section('title',trans('Blog Details'))

@section('content')

    <!-- blog_details_area_start -->
    <section class="blog_details_area">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-8 order-2 order-md-1">
                    <div class="blog_details">
                        <div class="blog_image">
                            <img src="{{$singleItem['image']}}" alt="@lang('blog details image')"
                                 class="img-fluid rounded">
                        </div>
                        <div class="blog_header py-3">
                            <span><a href=""><i class="fa fa-user"></i>@lang('Admin')</a></span>
                            <span><i class="fa-regular fa-clock"></i>{{$singleItem['date']}}</span>
                            <h3 class="mt-30">@lang($singleItem['title'])</h3>
                        </div>
                        <div class="blog_para">
                            <p>@lang($singleItem['description'])</p>
                        </div>
                    </div>
                </div>
                @if(isset($popularContentDetails['blog']))
                    <div class="col-md-4 order-1 order-md-2">
                    <div class="blog_sidebar">
                        <div class="section_header">
                            <h4>{{trans('Recent Post')}}</h4>
                        </div>
                        @foreach($popularContentDetails['blog']->sortDesc() as $data)
                            <div class="blog_widget_area">
                            <ul>
                                <li>
                                    <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}" class="d-flex">
                                        <div class="blog_widget_image">
                                            <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="@lang('recenet blog img')">
                                        </div>
                                        <div class="blog_widget_content">
                                            <h6 class="blog_title">
                                                {{\Str::limit($data->description->title,40)}}
                                            </h6>
                                            <div class="blog_date">
                                                <div class="blog_item1">{{dateTime($data->created_at)}}</div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- blog_details_area_end -->

@endsection
