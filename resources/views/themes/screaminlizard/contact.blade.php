@extends($theme.'layouts.app')
@section('title',trans($title))

@section('content')
    <!-- CONTACT -->
    <!-- contact section -->
    <div class="contact-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="form-box">
                        <form action="{{route('contact.send')}}" method="post">
                            @csrf
                            <div class="row g-4">
                                <div class="input-box col-md-12">
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="@lang('Full name')" />
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="input-box col-md-12">
                                    <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="@lang('Email address')" />
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="input-box col-12">
                                    <input type="text" name="subject" value="{{old('subject')}}" class="form-control" placeholder="@lang('Subject')"/>
                                    @error('subject')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="input-box col-12">
                                    <textarea class="form-control" name="message" cols="30" rows="3" placeholder="@lang('Your message')">{{old('message')}}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="input-box col-12">
                                    <button class="btn-custom w-100">@lang('Send Message')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-1"></div>

                <div class="col-lg-6">
                    <div class="header-text">
                        <h5>@lang('Contact us')</h5>
                        <h3>@lang(wordSplice($contact->heading)['withoutLastWord']) <span class="text-stroke">@lang(wordSplice($contact->heading)['lastWord'])</span></h3>
                        <p>
                            @lang(@$contact->sub_heading)
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="icon"><img src="{{ asset($themeTrue.'img/icon/email.png') }}" alt="" /></div>
                                <div class="text">
                                    <h4>@lang('Email')</h4>
                                    <p>@lang(@$contact->email)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="icon"><img src="{{ asset($themeTrue.'img/icon/phone.png') }}" alt="" /></div>
                                <div class="text">
                                    <h4>@lang('Phone')</h4>
                                    <p>@lang(@$contact->phone)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="icon"><img src="{{ asset($themeTrue.'img/icon/location.png') }}" alt="" /></div>
                                <div class="text">
                                    <h4>@lang('Location')</h4>
                                    <p>@lang(@$contact->address)</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                @if(isset($contentDetails['social']))
                                    <div class="social-links">
                                        <h5 class="">@lang('Follow our social media')</h5>
                                        <div>
                                            @foreach($contentDetails['social'] as $data)
                                                <a href="{{@$data->content->contentMedia->description->link}}" class="facebook">
                                                    <i class="{{@$data->content->contentMedia->description->icon}}"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- /CONTACT -->
@endsection
