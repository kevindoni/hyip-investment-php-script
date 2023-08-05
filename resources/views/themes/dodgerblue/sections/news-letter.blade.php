@if(isset($templates['news-letter'][0]) && $newsLetter = $templates['news-letter'][0])
<!-- REFFERAL -->
<section class="newsletter-section">
    <div class="container">
       <div class="row">
          <div class="col">
             <div class="header-text text-center">
                <h5>@lang(@$newsLetter->description->title)</h5>
                <h2>@lang(@$newsLetter->description->sub_title)</h2>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col">
            <form action="{{route('subscribe')}}" method="post">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" class="form-control" placeholder="@lang('Email Address')" />
                    <button type="submit" class="gold-btn">{{trans('Subscribe')}}</button>
                </div>
            </form>
          </div>
       </div>
    </div>
 </section>
@endif
