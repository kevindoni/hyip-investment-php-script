@if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
    @if(0 < count($contentDetails['blog']))
        <section class="blog_area shape1">
            <div class="container">
            <div class="row">
                <div class="section_header mb-50 text-center text-sm-start">
                    <div class="section_subtitle">@lang(@$blog->description->title)</div>
                    <h1>@lang(@$blog->description->sub_title)</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($contentDetails['blog']->take(3)->sortDesc() as $k => $data)
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog_box box1">
                            <div class="image_area">
                                <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                     alt="@lang('blog-image')">
                            </div>
                            <div class="text_area">
                                <h4><a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">{{\Illuminate\Support\Str::limit(@$data->description->title,60)}}</a></h4>
                                <span><a href=""><i class="fa fa-user"></i>@lang('Admin')</a></span>
                                <span><i class="fa-regular fa-clock"></i>{{dateTime(@$data->created_at,'d M, Y')}}</span>
                                <p class="pt-35 pb-35">
                                    @lang(\Illuminate\Support\Str::limit(strip_tags(@$data->description->description), 120))
                                </p>
                            </div>
                            <div class="btn_area d-flex justify-content-center">
                                <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}" class="custom_btn bottom-right-radius-0">@lang('Read More')<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </section>
    @endif
@endif
<!-- blog_area_end -->
