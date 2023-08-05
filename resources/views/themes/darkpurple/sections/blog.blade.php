<!-- blog section -->
@if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
    @if(0 < count($contentDetails['blog']))
        <section class="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-text text-center">
                    <h5>@lang(@$blog->description->sub_title)</h5>
                    <h6>@lang(@$blog->description->short_title)</h6>
                </div>
            </div>
        </div>
        @if(isset($contentDetails['blog']))
            <div class="row g-4 g-lg-5">
                @foreach($contentDetails['blog']->take(3)->sortDesc() as $k => $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-box" data-aos="fade-up" data-aos-duration="1000" data-aos-anchor-placement="center-bottom">
                            <div class="img-box">
                                <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                    <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" class="img-fluid" alt="@lang('blog-image')" />
                                </a>
                            </div>
                            <div class="text-box">
                                <div class="date-author">
                                    <span><i class="far fa-calendar-alt"></i> {{dateTime(@$data->created_at,'d M, Y')}} </span>
                                </div>
                                <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="title">{{\Illuminate\Support\Str::limit(@$data->description->title,60)}}</a>
                                <p>
                                    @lang(\Illuminate\Support\Str::limit(strip_tags(@$data->description->description), 120))
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
    @endif
@endif
