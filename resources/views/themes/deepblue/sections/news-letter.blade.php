@if(isset($templates['news-letter'][0]) && $newsLetter = $templates['news-letter'][0])


<!-- REFFERAL -->
<section id="refferal">
    <div class="container">
        <div class="row" id="subscribe">
            {{-- @dd($referralLevel) --}}
            <div @if(isset($templates['news-letter-referral'][0]) && 0 < count($referralLevel)) class="col-md-6" @else class="col-md-12"  @endif>
                <div
                    class="d-flex align-items-center justify-content-center justify-content-md-start h-fill wow fadeInLeft"
                    data-wow-duration="1s" data-wow-delay="0.15s">
                    <div class="w-fill text-center text-md-left pr-30">
                        <h3 class="h3 text-capitalize">@lang(@$newsLetter->description->title)</h3>
                        <p class="text mt-20 mb-20">@lang(@$newsLetter->description->sub_title)</p>
                        <div class="subscribe" >
                            <form class="subscribe-form" action="{{route('subscribe')}}" method="post">
                                @csrf
                                <input class="form-control" name="email" type="email" placeholder="@lang('Email Address')">
                                @error('email')
                                <span class="text-white">{{$message}}</span>
                                @enderror
                                <button class="btn-subscribe" type="submit">{{trans('Subscribe')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            @if(isset($templates['news-letter-referral'][0]) && 0 < count($referralLevel) && $newsLetterReferral = $templates['news-letter-referral'][0])
            <div class="col-md-6">
                <div class="refferal-offer wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.15s">
                    <h3 class="h3 text-capitalize">@lang(@$newsLetterReferral->description->title)</h3>
                    <p class="text text-capitalize mb-30">@lang(@$newsLetterReferral->description->sub_title) </p>
                    <div class="row">
                        @foreach($referralLevel as $data)
                        <div class="col-lg-6">
                            <div class="media align-items-center">
                                <div class="media-icon">
                                    <img src="{{asset($themeTrue.'images/icon/dashboard_3.png')}}" alt="Icon Missing">
                                </div>
                                <div class="media-body ml-20">
                                    <p class="text">{{trans('Level')}} {{$data->level}} {{trans('Instant')}} <strong class="themecolor">{{$data->percent}}%</strong></p>
                                    <p class="text">@lang('Bonus Reward')</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- /REFFERAL -->
@endif
