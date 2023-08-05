@extends($theme.'layouts.app')
@section('title',trans($title))

@section('content')
    <!-- contact section -->
    <div class="contact-section">
        <div class="container">
            <div class="row g-lg-5 gy-5">
                <div class="col-lg-4">
                    <div class="contact-info">
                        <h4 class="mb-4">@lang('Our Office')</h4>
                        <div class="contact-map mb-5">
                            <img src="{{ asset($themeTrue.'img/map.png') }}" class="img-fluid" alt="" />
                        </div>
                        <div class="info-box">
                            <div class="icon">
                                <img src="{{ asset($themeTrue.'img/location-2.png') }}" alt="" />
                            </div>
                            <div>
                                <h5>@lang('Our Location')</h5>
                                <p>@lang(@$contact->address)</p>
                            </div>
                        </div>
                        <div class="info-box">
                            <div class="icon">
                                <img src="{{ asset($themeTrue.'img/email-2.png') }}" alt="" />
                            </div>
                            <div>
                                <h5>@lang('email address')</h5>
                                <p>@lang(@$contact->email)</p>
                            </div>
                        </div>
                        <div class="info-box">
                            <div class="icon">
                                <img src="{{ asset($themeTrue.'img/phone-2.png') }}" alt="" />
                            </div>
                            <div>
                                <h5>@lang('company number')</h5>
                                <p>@lang(@$contact->phone)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-6">
                    <h3>@lang(@$contact->heading)</h3>
                    <p class="mb-4">@lang(@$contact->sub_heading)</p>
                    <form action="{{route('contact.send')}}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="input-box col-md-12">
                                <input type="text"
                                       name="name"
                                       value="{{old('name')}}"
                                       class="form-control"
                                       placeholder="@lang('Full Name')" />
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="input-box col-md-12">
                                <input
                                    type="email"
                                    name="email"
                                    value="{{old('email')}}"
                                    class="form-control"
                                    placeholder="@lang('Email Address')" />
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-box col-md-12">
                                <input
                                    type="text"
                                    name="subject"
                                    value="{{old('subject')}}"
                                    class="form-control"
                                    placeholder="@lang('Subject')" />
                                @error('subject')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="input-box col-md-12">
                                <textarea
                                    class="form-control"
                                    name="message"
                                    cols="30"
                                    rows="10"
                                    placeholder="@lang('Message')">{{old('message')}}</textarea>
                                @error('message')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-box col-md-12">
                                <button class="btn-custom">{{trans('Send Message')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- newsletter section -->
    @if(isset($templates['news-letter'][0]) && $newsLetter = $templates['news-letter'][0])
        <section class="newsletter-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="box">
                        <div class="overlay">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="text-box">
                                        <h3>@lang(@$newsLetter->description->title)</h3>
                                        <p>@lang(@$newsLetter->description->sub_title)</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <form action="{{route('subscribe')}}" method="post">
                                        @csrf
                                        <div class="input-box col-md-12">

                                                <div class="input-group">
                                                    <input type="email" name="email" class="form-control" placeholder="@lang('Email Address')" />
                                                </div>
                                                <button class="btn-custom" type="submit">{{trans('Subscribe')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
