@extends($theme.'layouts.app')
@section('title', trans($title))

@section('content')

    @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
        @if(0 < count($contentDetails['blog']))
            <section class="blog-section">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="header-text text-center">
                                <h5>@lang(@$blog->description->title)</h5>
                                <h2>@lang(@$blog->description->sub_title)</h2>
                                <p>@lang(@$blog->description->short_title)</p>
                            </div>
                        </div>
                    </div>

                    @if(isset($contentDetails['blog']))
                        <div class="row">
                            @foreach($contentDetails['blog']->sortDesc() as $k => $data)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="blog-box">
                                        <div class="img-box">
                                            <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                                <img class="img-fluid"
                                                     src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                                     alt="@lang('blog-image')">
                                            </a>
                                        </div>
                                        <div class="text-box">
                                            <span class="date">{{dateTime(@$data->created_at,'d M, Y')}}</span>
                                            <h4 class="title golden-text">
                                                <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                                    {{\Illuminate\Support\Str::limit(@$data->description->title,60)}}
                                                </a>
                                            </h4>
                                            <p class="description">{{Illuminate\Support\Str::limit(strip_tags(@$data->description->description),120)}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
            <!-- blog end -->
        @endif
    @endif

@endsection
