@extends($theme.'layouts.app')
@section('title',trans('Blog Details'))

@section('content')
    <!-- blog details  -->
    <section class="blog-section blog-details">
        <div class="container">
            <div class="row g-lg-5 g-4">
                <div class="col-lg-8">
                    <div class="blog-box">
                        <div class="img-box">
                            <img src="{{$singleItem['image']}}" class="img-fluid" alt="@lang('blog details image')"/>
                        </div>
                        <div class="text-box">
                            <div class="date-author">
                                <span>{{trans('Posted by - Admin ')}}</span>
                                <span>{{$singleItem['date']}}</span>
                            </div>
                            <h4>
                                @lang($singleItem['title'])
                            </h4>
                            <p>
                                @lang($singleItem['description'])
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="side-bar">
                        <div class="side-box">
                            <h4>@lang('Recent Post')</h4>
                            @foreach($popularContentDetails['blog']->sortDesc() as $data)
                                <div class="side-blog-box">
                                    <div class="img-box">
                                        <img class="img-fluid" src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="@lang('recenet blog img')"/>
                                    </div>
                                    <div class="text-box">
                                        <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}" class="title">{{\Str::limit($data->description->title,40)}} </a>
                                        <span class="date">{{dateTime($data->created_at)}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
