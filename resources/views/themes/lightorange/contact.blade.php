@extends($theme.'layouts.app')
@section('title',trans($title))

@section('content')
    <!-- CONTACT -->

        <!-- deposited start -->
        <section id="profit-deposited" class="pt-150 pb-150 contact">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-4 col-md-6 wow fadeInLeftBig">
                        <div class="single-item text-center">
                            <div class="icon-area">
                                <img src="{{asset($themeTrue.'images/icon/contact_icon_3.png')}}" alt="@lang('Phone image')">
                            </div>
                            <div class="text-area">
                                <p class="top">Call</p>
                                <p class="area-para">@lang(@$contact->phone)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp">
                        <div class="single-item text-center">
                            <div class="icon-area">
                                <img src="{{asset($themeTrue.'images/icon/contact_icon_2.png')}}" alt="@lang('Email image')">
                            </div>
                            <div class="text-area">
                                <p class="top">@lang('Email')</p>
                                <p class="area-para">@lang(@$contact->email)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInRightBig">
                        <div class="single-item text-center">
                            <div class="icon-area">
                                <img src="{{asset($themeTrue.'images/icon/contact_icon_1.png')}}" alt="@lang('address image')">
                            </div>
                            <div class="text-area">
                                <p class="top">@lang('Location')</p>
                                <p class="area-para">@lang(@$contact->address)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- deposited end -->

        <!-- contact Us start -->
        <section id="contact-section">
            <div class="overlay pb-150">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-10">
                            <div class="section-header">
                                <h4 class="sub-title">@lang(@$contact->heading)</h4>
                                <h3 class="title">@lang(@$contact->sub_heading)</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <form class="contact-form" action="{{route('contact.send')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 wow fadeInLeftBig">
                                    <div class="form-group mb-30">
                                        <label>@lang('Type Your Name')</label>
                                        <input type="text" class="name text-dark" name="name" value="{{old('name')}}" placeholder="@lang('Name')">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 wow fadeInUp">
                                    <div class="form-group mb-30">
                                        <label>@lang('Type Your E-mail')</label>
                                        <input type="email" class="text-dark" name="email" value="{{old('email')}}" placeholder="@lang('Email Address')">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 wow fadeInRightBig">
                                    <div class="form-group mb-30">
                                        <label>@lang('Type Subject')</label>
                                        <input type="text" class="text-dark" name="subject" value="{{old('subject')}}" placeholder="@lang('Subject')">
                                        @error('subject')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 wow fadeInUp">
                                    <div class="form-group textarea mb-30">
                                        <label>@lang('Type Your Message')</label>
                                        <textarea name="message" class="text-dark" placeholder="@lang('Something write here...')" cols="50" rows="7">{{old('message')}}</textarea>
                                        @error('message')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 btn-area text-right">
                                    <button type="submit" class="cmn-btn">{{trans('Send Message')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <!-- /CONTACT -->
@endsection
