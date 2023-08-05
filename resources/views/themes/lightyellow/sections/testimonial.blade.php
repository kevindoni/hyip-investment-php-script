@if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
    <section class="testimonial_area">
        <div class="container">
            <div class="row">
                <div class="section_content">
                    <div class="section_header cmn_title text-start ">
                        <span class="section_category">@lang($testimonial->description->title)</span>
                        <h2>@lang($testimonial->description->sub_title)</h2>
                    </div>
                </div>
                <div class="col-md-9 mx-auto d-flex justify-content-center">

                </div>
             </div>
            @if(isset($contentDetails['testimonial']))
                <div class="row">
                    <div class="owl-carousel owl-theme {{(session()->get('rtl') == 1) ? 'testimonial_carousel-rtl': 'testimonial_carousel'}}">
                        @foreach($contentDetails['testimonial'] as $key => $data)
                         <div class="item">
                            <div class="card shadow1 mt-50 mb-50 ">
                                <p>@lang(@$data->description->description)</p>
                                <div class="client_comment d-flex align-items-center mt-20">
                                    <div class="image_area">
                                        <img class="img-fluid" src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="@lang('testimonial img')" />
                                    </div>
                                    <div class="text_area">
                                        <h5>@lang(@$data->description->name)</h5>
                                        <span>@lang(@$data->description->designation)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
    </div>
    </section>
@endif
