@if(isset($contentDetails['feature']))
    @if(0 < count($contentDetails['feature']))
    <section class="feature-section">
        <div class="container">
           <div class="row">
            @foreach($contentDetails['feature'] as $feature)
              <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                 <div
                    class="box"
                    data-aos="fade-up"
                    data-aos-duration="800"
                    data-aos-anchor-placement="center-bottom"
                 >
                    <div class="img-box">
                       <img src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}" alt="@lang('feature image')" />
                    </div>
                    <h2>@lang(@$feature->description->information)</h2>
                    <h4>@lang(@$feature->description->title)</h4>
                 </div>
              </div>
            @endforeach
           </div>
        </div>
     </section>
    @endif
@endif
