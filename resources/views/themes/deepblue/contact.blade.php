@extends($theme.'layouts.app')
@section('title',trans($title))

@section('content')
    <!-- CONTACT -->
    <section id="contact">
        <div class="container">
            <div class="contact-wrapper">
                <div class="d-flex align-items-start justify-content-center">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="contact-details wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.35s">
                                    <div class="d-flex justify-content-center">
                                        <div class="mb-40 pb-40">
                                            <h2 class="h2 font-weight-medium text-uppercase">@lang(@$contact->heading)</h2>
                                            <h6 class="h6 fontlato">@lang(@$contact->sub_heading)</h6>
                                        </div>
                                    </div>

                                    <div class="contact-info">
                                        <h4 class="h4 mb-30 font-weight-medium">@lang(@$contact->title)</h4>
                                        <div class="media mb-30">
                                            <img src="{{asset($themeTrue.'images/icon/contact_icon_1.png')}}" alt="Image Missing">
                                            <div class="media-body ml-20">
                                                <p class="p">@lang(@$contact->address)</p>
                                            </div>
                                        </div>
                                        <div class="media mb-30">
                                            <img src="{{asset($themeTrue.'images/icon/contact_icon_2.png')}}" alt="Image Missing">
                                            <div class="media-body ml-20">
                                                <p class="p">@lang(@$contact->email)</p>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <img src="{{asset($themeTrue.'images/icon/contact_icon_3.png')}}" alt="Image Missing">
                                            <div class="media-body ml-20">
                                                <p class="p">@lang(@$contact->phone)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-wrapper wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">
                                    <form class="contact-form" action="{{route('contact.send')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <h6 class="h6 fontlato mb-10">@lang('Name')</h6>

                                            <input class="form-control " name="name" value="{{old('name')}}" type="text"
                                                   placeholder="@lang('Name')">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h6 class="h6 fontlato mb-10">@lang('Email Address')</h6>
                                            <input class="form-control " name="email" value="{{old('email')}}"
                                                   type="email" placeholder="@lang('Email Address')">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6 class="h6 fontlato mb-10">@lang('Subject')</h6>
                                            <input class="form-control" type="text" name="subject"
                                                   value="{{old('subject')}}" placeholder="@lang('Subject')">

                                            @error('subject')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6 class="h6 fontlato mb-10">@lang('Message')</h6>
                                            <textarea class="textarea-control" cols="30" rows="5" name="message" placeholder="@lang('Message')">{{old('message')}}</textarea>
                                            @error('message')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
                                        <button class="btn-contact" type="submit">{{trans('Send Message')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /CONTACT -->
@endsection
