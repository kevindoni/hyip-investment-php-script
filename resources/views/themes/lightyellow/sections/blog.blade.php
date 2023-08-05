@if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
    @if(0 < count($contentDetails['blog']))
        <section class="blog_area">
            <div class="container">
                <div class="row">
                    <div class="section_content">
                        <div class="section_header text-center">
                            <span class="section_category">@lang(@$blog->description->title)</span>
                            <h2>@lang(@$blog->description->sub_title)</h2>
                            <p>@lang(@$blog->description->short_title)</p>
                        </div>
                    </div>
                </div>
                @if(isset($contentDetails['blog']))
                        <div class="row">
                        @foreach($contentDetails['blog']->take(3)->sortDesc() as $k => $data)
                            <div class="col-lg-4 col-sm-6 pt-50">
                                <div class="single_card_area shadow1">
                                    <div class="card_header">
                                        <a href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">
                                            <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}" alt="@lang('blog-image')">
                                        </a>
                                    </div>
                                    <div class="card_body pt-2">
                                        <div class="blog_content">
                                            <div class="blog_date">
                                                <img src="{{ asset($themeTrue.'img/calendar.png') }}" alt="">{{dateTime(@$data->created_at,'d M, Y')}}
                                            </div>
                                            <h5 class="card-title pt-3 pb-2"><a class="blog_title" href="{{route('blogDetails',[slug(@$data->description->title), $data->content_id])}}">{{\Illuminate\Support\Str::limit(@$data->description->title,60)}}</a></h5>
                                            <p class="card-text pb-2">
                                                @lang(\Illuminate\Support\Str::limit(strip_tags(@$data->description->description), 120))
                                            </p>
                                        </div>
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
