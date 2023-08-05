@if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
    <!-- how it work -->
{{--    @php--}}
{{--        $totalContents = $contentDetails['how-it-work'];--}}
{{--    @endphp--}}
{{--    <section class="how-it-work @if(session()->get('rtl') == 1) rtl @endif">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="header-text text-center">--}}
{{--                    <h5>@lang(@$howItWork->description->sub_title)</h5>--}}
{{--                    <h2>@lang(wordSplice($howItWork->description->title)['withoutLastWord']) <span class="text-stroke">@lang(wordSplice($howItWork->description->title)['lastWord'])</span></h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row g-4 g-lg-5">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="img-box">--}}
{{--                        <img src="{{getFile(config('location.content.path').@$howItWork->templateMedia()->image)}}" alt="" class="img-fluid" />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                @foreach($totalContents as $k =>  $item)--}}
{{--                    <div class="process-box">--}}
{{--                        <h4>@lang(@$item->description->title)</h4>--}}
{{--                        <p>@lang(@$item->description->short_description)</p>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <!-- how it work -->
    <section class="how-it-work">
        <div class="container">
            <div class="row">
                <div class="header-text text-center">
                    <h5>working process</h5>
                    <h2>How it <span class="text-stroke">works</span></h2>
                </div>
            </div>
            <div class="row g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="img-box">
                        <img src="{{ asset($themeTrue.'img/how-works.jpg') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="process-box">
                        <h4>Register & Login</h4>
                        <p>Creating an account is the first step. then you need to log in</p>
                    </div>
                    <div class="process-box">
                        <h4>Add Fund</h4>
                        <p>Next, pick a payment method and add funds to your account</p>
                    </div>
                    <div class="process-box">
                        <h4>Select a service</h4>
                        <p>Select the services you want and get ready to receive more publicity</p>
                    </div>
                    <div class="process-box">
                        <h4>Enjoy Super Results</h4>
                        <p>You can enjoy incredible results when your order is complete</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endif
