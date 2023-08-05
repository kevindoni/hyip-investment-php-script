@extends($theme.'layouts.app')
@section('title',trans('Blog Details'))

@section('content')

    <!-- blog section  -->
    <section class="blog-page blog-details">
        <div class="container">
            <div class="row g-lg-5">
                <div class="col-lg-8">
                    <div class="blog-box">
                        <div class="img-box">
                            <img src="{{$singleItem['image']}}" alt="@lang('blog details image')" class="img-fluid" alt="" />
                        </div>
                        <div class="text-box">
                            <div class="date-author">
                                <span><i class="far fa-calendar-alt"></i> {{$singleItem['date']}} </span>
                                <span><i class="far fa-user-circle"></i> {{trans('Posted by - Admin ')}}</span>
                            </div>
                            <a class="title"> @lang($singleItem['title'])</a>
                            <p>
                                @lang($singleItem['description'])
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="side-bar">
                        <div class="side-box">
                            <h4>{{trans('Recent Post')}}</h4>
                            @foreach($popularContentDetails['blog']->sortDesc() as $data)
                                <div class="blog-box">
                                    <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}">
                                        <div class="img-box">
                                            <img class="img-fluid" src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                                 alt="@lang('recenet blog img')" />
                                        </div>
                                    </a>

                                    <div class="text-box">
                                        <span class="date">{{dateTime($data->created_at)}}</span>
                                        <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}" class="title">{{\Str::limit($data->description->title,40)}}</a>
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
