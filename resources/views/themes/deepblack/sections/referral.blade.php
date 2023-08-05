@if(isset($templates['news-letter-referral'][0]) && 0 < count($referralLevel) && $newsLetterReferral = $templates['news-letter-referral'][0])
    <section class="commission-section">
        <div class="container">
           <div class="row">
              <div class="col">
                 <div class="header-text text-center">
                    <h5>@lang(@$newsLetterReferral->description->title)</h5>
                    <h2>@lang(@$newsLetterReferral->description->sub_title)</h2>
                 </div>
              </div>
           </div>
           <div class="row">
            @foreach($referralLevel as $k => $data)
              <div class="col-md-6 col-lg-4 mb-5">
                 <div
                    class="box box{{$k+1}} {{(session()->get('rtl') == 1) ? 'isRtl': 'noRtl'}}"
                    data-aos="zoom-in"
                    data-aos-duration="800"
                    data-aos-anchor-placement="center-bottom"
                 >
                    <h2>{{$data->percent}}%</h2>
                    <h4>@lang('level') {{$data->level}}</h4>
                 </div>
              </div>
            @endforeach
           </div>
        </div>
    </section>
@endif
