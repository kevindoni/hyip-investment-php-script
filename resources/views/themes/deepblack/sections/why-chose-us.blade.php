@if(isset($templates['why-chose-us'][0]) && $whyChoseUs = $templates['why-chose-us'][0])
<!-- why choose us start -->
<section class="choose-section">
    <div class="container">
       <div class="row">
          <div class="col">
             <div class="header-text text-center">
                <h5>@lang($whyChoseUs->description->title)</h5>
                <h2>@lang($whyChoseUs->description->sub_title)</h2>
                <p>
                    @lang($whyChoseUs->description->short_details)
                </p>
             </div>
          </div>
       </div>

       @if(isset($contentDetails['why-chose-us']))
            <div class="row">
                @foreach($contentDetails['why-chose-us'] as $item)
                    <div class="col-md-6 mb-4">
                        <div
                            class="box"
                            data-aos="fade-up"
                            data-aos-duration="800"
                            data-aos-anchor-placement="center-bottom"
                        >
                            <div class="img">
                            <img class="img-center" src="{{getFile(config('location.content.path').@$item->content->contentMedia->description->image)}}" alt="@lang('why-choose-us image')" />
                            </div>
                            <div class="text">
                            <h4 class="golden-text">@lang(@$item->description->title)</h4>
                            <p>@lang(@$item->description->information)</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
       @endif
    </div>
</section>
<!-- why choose us end -->
@endif
