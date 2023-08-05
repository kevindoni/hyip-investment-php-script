@if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
    <section class="how_it_work_area shape3">
        <div class="container">
            <div class="row">
                <div class="section_header mb-50 text-center">
                    <h1>@lang('How It Works?')</h1>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="seciton_right cmn_scroll">
                        @if(isset($contentDetails['how-it-work']))
                            @foreach($contentDetails['how-it-work'] as $k =>  $item)
                                <div class="cmn_box2 box1 d-flex shadow3 flex-column flex-sm-row">
                                    <span class="number">{{++$k}}</span>
                                    <div class="text_area">
                                        <h5>@lang(@$item->description->title)</h5>
                                        <p>@lang(@$item->description->short_description)</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 flex-column flex-sm-row">
                    <div class="section_left">
                        <div class="image_area">
                            <img
                                src="{{getFile(config('location.content.path').@$howItWork->templateMedia()->image)}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
