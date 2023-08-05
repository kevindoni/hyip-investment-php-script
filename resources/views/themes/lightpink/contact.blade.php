@extends($theme.'layouts.app')
@section('title',trans($title))

@section('content')
    <!-- contact_area_start -->
    <section class="contact_area">
        <div class="container">
            <div class="row">
                <div class="section_header text-center mb-50">
                    <div class="section_subtitle mx-auto">@lang('Feel Free To Conatct Us')</div>
                    <h1>@lang('Contact Us')</h1>
                </div>
            </div>
            <div class="row g-5  justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="box text-center bottom-left-radius-0">
                        <div class="icon mx-auto">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <h4 class="mt-40 mb-30">@lang('Our Location')</h4>
                        <p>@lang(@$contact->address)</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box text-center bottom-left-radius-0">
                        <div class="icon mx-auto">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <h4 class="mt-40 mb-30">@lang('E-mail')</h4>
                        <p>@lang(@$contact->email)</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box text-center bottom-left-radius-0">
                        <div class="icon mx-auto">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <h4 class="mt-40 mb-30">@lang('Phone')</h4>
                        <p>@lang(@$contact->phone)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact_area_end -->

    <!-- contact_message_area_start -->
    <section class="contact_message_area">
        <div class="container">
            <div class="row">
                <div class="section_header text-center mb-50">
                    <div class="section_subtitle mx-auto">@lang('send message')</div>
                    <h1>@lang(@$contact->heading)</h1>
                    <p class="para_text mx-auto">@lang(@$contact->sub_heading)</p>
                </div>
            </div>
            <div class="row">
                <form class="row g-3" action="{{route('contact.send')}}" method="post">
                    @csrf
                    <div class="col-md-6">
                        <div class="name_area icon_position">
                            <input type="text"
                                   name="name"
                                   value="{{old('name')}}"
                                   class="form-control"
                                   placeholder="@lang('Full Name')">
                            <div class="image_area">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="email_area icon_position">
                            <input type="email"
                                   name="email"
                                   value="{{old('email')}}"
                                   class="form-control"
                                   placeholder="@lang('Email Address')">
                            <div class="image_area">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="subject_area icon_position">
                            <input type="text"
                                   name="subject"
                                   value="{{old('subject')}}"
                                   class="form-control"
                                   placeholder="@lang('Subject')">
                            <div class="image_area">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                            @error('subject')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text_area icon_position">
                            <textarea class="form-control" rows="1" name="message" placeholder="@lang('Write Message...')">{{old('message')}}</textarea>
                            <div class="image_area">
                                <i class="fa-solid fa-message"></i>
                            </div>
                            @error('message')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 pt-40">
                        <button type="submit" class="custom_btn bottom-right-radius-0">@lang('SEND MESSAGE')</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- contact_message_area_end -->
@endsection
