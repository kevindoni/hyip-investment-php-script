@extends($theme.'layouts.app')
@section('title',trans('Blog Details'))

@section('content')

    <!-- blog details section -->
    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pe-lg-5">
                    <div class="details-box">
                    <div class="img-box mb-4">
                        <img
                            src="{{ @$singleItem['image']}}" alt="@lang('blog details image')"
                            class="img-fluid rounded"
                        />
                    </div>
                    <div class="text-box">
                        <span class="date">{{ @$singleItem['date'] }}</span>
                        <span class="author float-end">{{trans('Posted by - Admin ')}}</span>
                        <h4 class="title golden-text">
                            @lang(@$singleItem['title'])
                        </h4>
                        <p class="description">
                            @lang(@$singleItem['description'])
                        </p>
                    </div>
                    </div>
                </div>

                @if(isset($popularContentDetails['blog']))
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="recent-posts">
                        <h3 class="golden-text">{{trans('Recent Post')}}</h3>
                        @foreach($popularContentDetails['blog']->sortDesc() as $data)
                        <div class="recent-post-box d-flex align-items-center">
                            <div class="img-box">
                                <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}">
                                    <img
                                        src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                        alt="@lang('recenet blog img')"
                                        class="img-fluid rounded blog-img"
                                    />
                                </a>
                            </div>
                            <div class="text-box">
                                <h5 class="title golden-text">
                                    <a href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}"
                                    >{{\Str::limit($data->description->title,40)}}</a>
                                </h5>
                                <span class="date">{{dateTime($data->created_at)}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- blog details end -->

@endsection
