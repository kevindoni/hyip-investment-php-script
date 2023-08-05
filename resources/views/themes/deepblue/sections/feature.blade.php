
@if(isset($contentDetails['feature']))
    <!-- FEATURE -->
    <section id="feature">
        <div class="feature-wrapper">
            <div class="container">
                <div class="row">
                    @foreach($contentDetails['feature'] as $feature)

                        <div class="col-md-4">
                            <div class="card-type-1 card wow fadeInUp" data-wow-duration="1s" data-wow-dealy="0.1s">
                                <div class="card-icon">
                                    <img class="card-img-top" src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}" alt="....">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">@lang(@$feature->description->information)</h3>
                                    <h5 class="card-text">@lang(@$feature->description->title)</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- /FEATURE -->
@endif
