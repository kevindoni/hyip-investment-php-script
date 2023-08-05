@if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
    <!-- how it work -->
    @php
        $totalContents = $contentDetails['how-it-work'];
    @endphp
    <section class="how-it-work @if(session()->get('rtl') == 1) rtl @endif">
        <div class="container">
            <div class="row">
                <div class="header-text text-center">
                    <h5>@lang(@$howItWork->description->sub_title)</h5>
                    <h2>@lang(wordSplice($howItWork->description->title)['withoutLastWord']) <span class="text-stroke">@lang(wordSplice($howItWork->description->title)['lastWord'])</span></h2>
                </div>
            </div>
            <div class="row g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="img-box">
                        <img src="{{getFile(config('location.content.path').@$howItWork->templateMedia()->image)}}" alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-lg-6">
                @foreach($totalContents as $k =>  $item)
                    <div class="process-box">
                        <h4>@lang(@$item->description->title)</h4>
                        <p>@lang(@$item->description->short_description)</p>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>

@endif
