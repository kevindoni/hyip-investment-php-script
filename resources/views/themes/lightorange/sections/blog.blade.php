@if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])<!-- blog start -->
@if(0 < count($contentDetails['blog']))
    <section id="blog-section">
        <div class="overlay pt-150 pb-150">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-10">
                        <div class="section-header">
                            <h4 class="sub-title">@lang(@$blog->description->title)</h4>
                            <h3 class="title">@lang(@$blog->description->sub_title)</h3>
                            <p class="area-para">@lang(@$blog->description->short_title)</p>
                        </div>
                    </div>
                </div>

                @if(isset($contentDetails['blog']))
                    <div class="row d-flex justify-content-md-center">
                        @foreach($contentDetails['blog']->take(3)->sortDesc() as $k => $data)
                            <div class="col-lg-4 col-md-6 wow fadeInUp">
                                <div class="single-item">
                                    @if($k%2 !== 0)
                                        <div class="img-area">
                                            <img
                                                src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                                alt="@lang('blog-image')" style="">
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
                                                <i class="icofont-user-alt-4"></i> {{trans('Posted By- Admin')}}
                                            </a>
                                            <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                                <i class="icofont-calendar"></i>
                                                {{dateTime(@$data->created_at,'d M Y')}}
                                            </a>
                                        </div>
                                    </div>
                                    @if($k%2 == 0)
                                        <div class="img-area">
                                            <img
                                                src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                                alt="@lang('blog-image')" style="">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- blog end -->
@endif
@endif
