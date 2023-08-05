@extends($theme.'layouts.app')
@section('title',trans($title))

@section('content')
    <!-- contact_area_start -->
    <section class="contact_area">
        <div class="container">
            <div class="row g-5 align-items-lg-end">
                <div class="section_header text-center">
                    <span class="section_category">
                        @lang('contact')
                    </span>
                    <h2>@lang($title)</h2>
                </div>
                <div class="col-md-7 order-2 order-md-1">
                    <div class="form_area text-center">
                        <form action="{{route('contact.send')}}" method="post">
                            @csrf
                            <div class="form_title text-start mb-30">
                                <h3>@lang(@$contact->heading)</h3>
                                <p>@lang(@$contact->sub_heading)</p>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <input
                                           type="text"
                                           name="name"
                                           value="{{old('name')}}"
                                           class="form-control"
                                           placeholder="@lang('Full Name')"
                                    >
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{old('email')}}"
                                        class="form-control"
                                        placeholder="@lang('Email Address')"
                                    >
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <input
                                        type="text"
                                        name="subject"
                                        value="{{old('subject')}}"
                                        class="form-control"
                                        placeholder="@lang('Subject')"
                                    >
                                    @error('subject')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12">
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
                            <div class="btn_area d-flex">
                                <button type="submit" class="custom_btn mt-30">{{trans('Send Message')}}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-5 order-1 order-md-2">
                    <div class="address_area">
                        <div class="image_area">
                            <img src="{{ asset($themeTrue.'img/contact/Get in touch-rafiki.png') }}" alt="">
                        </div>
                        <div class="text_area mt-30">
                            <p><a href="mailto:maile@example.com"><i class="fa fa-phone"></i>@lang(@$contact->phone)</a></p>
                            <p><a href="mailto:maile@example.com"><i class="fa fa-envelope"></i>@lang(@$contact->email)</a></p>
                            <p><i class="fa fa-location"></i>@lang(@$contact->address)</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- contact_area_end -->
@endsection
