@extends($theme.'layouts.app')
@section('title',trans($title))

@section('content')
    <!-- CONTACT -->
    <section class="contact-section">
        <div class="container">
           <div class="row">
              <div class="col-lg-6 mb-5 mb-lg-0">
                 <div class="header-text-full mb-5">
                    <h2>@lang(@$contact->heading)</h2>
                    <p>@lang(@$contact->sub_heading)</p>
                 </div>
                 <div class="box mb-5">
                    <div class="img">
                       <img src="{{asset($themeTrue.'img/icon/location2.png')}}" alt="location image" />
                    </div>
                    <div class="text">
                       <h4 class="golden-text">@lang('Our Location')</h4>
                       <p>@lang(@$contact->address)</p>
                    </div>
                 </div>
                 <div class="box mb-5">
                    <div class="img">
                       <img src="{{asset($themeTrue.'img/icon/email2.png')}}" alt="email image" />
                    </div>
                    <div class="text">
                       <h4 class="golden-text">@lang('email address')</h4>
                       <p>@lang(@$contact->email)</p>
                    </div>
                 </div>
                 <div class="box">
                    <div class="img">
                       <img src="{{asset($themeTrue.'img/icon/phone2.png')}}" alt="phone image" />
                    </div>
                    <div class="text">
                       <h4 class="golden-text">@lang('company number')</h4>
                       <p>@lang(@$contact->phone)</p>
                    </div>
                 </div>
              </div>
              <div class="col-lg-6 ps-lg-5">
                 <div class="contact-box">
                    <form action="{{route('contact.send')}}" method="post">
                        @csrf
                       <div>
                          <h4 class="golden-text">@lang('Full name')</h4>
                          <div class="input-group mb-4">
                             <div class="img">
                                <img src="{{asset($themeTrue.'img/icon/edit.png')}}" alt="@lang('edit img')" />
                             </div>
                             <input
                                type="text"
                                name="name"
                                value="{{old('name')}}"
                                class="form-control"
                                placeholder="@lang('Full Name')"
                             />
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                       </div>
                       <div>
                          <h4 class="golden-text">@lang('your email')</h4>
                          <div class="input-group mb-4">
                             <div class="img">
                                <img src="{{asset($themeTrue.'img/icon/email2.png')}}" alt="@lang('edit img')" />
                             </div>
                             <input
                                type="email"
                                name="email"
                                value="{{old('email')}}"
                                class="form-control"
                                placeholder="@lang('Email Address')"
                             />
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                       </div>
                       <div>
                          <h4 class="golden-text">@lang('Subject')</h4>
                          <div class="input-group mb-4">
                             <div class="img">
                                <img src="{{asset($themeTrue.'img/icon/email2.png')}}" alt="@lang('edit img')" />
                             </div>
                             <input
                                type="text"
                                name="subject"
                                value="{{old('subject')}}"
                                class="form-control"
                                placeholder="@lang('Subject')"
                             />
                            @error('subject')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                       </div>
                       <div>
                          <h4 class="golden-text">@lang('your message')</h4>
                          <div class="input-group mb-4">
                            <div class="img">
                            <img src="{{asset($themeTrue.'img/icon/edit.png')}}" alt="" />
                            </div>
                            <textarea
                                class="form-control"
                                name="message"
                                cols="30"
                                rows="10"
                                placeholder="@lang('Message')"
                            >{{old('message')}}</textarea>
                            @error('message')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                       </div>
                       <button class="gold-btn">{{trans('Send Message')}}</button>
                    </form>
                 </div>
              </div>
           </div>
        </div>
    </section>
    <!-- /CONTACT -->
@endsection
