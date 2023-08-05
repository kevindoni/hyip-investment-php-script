@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')
    <!-- main -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h3 class="ms-2 mb-0 mt-2">{{trans($page_title)}}</h3>
                </div>
            </div>
        </div>

        <div class="main row">
            <div class="col-12">
                <!-- table -->
                <div class="table-parent table-responsive mt-4">
                    <div class="table-search-bar">
                        <div>
                            <form action="{{route('user.ticket.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3 align-items-end">
                                    <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                        <input type="text" class="form-control" id="subject" name="subject" value="{{old('subject')}}" placeholder="@lang('Enter Subject')"/>
                                        @error('subject')
                                        <div class="error text-danger">@lang($message) </div>
                                        @enderror
                                    </div>

                                    <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                        <textarea class="form-control ticket-box" id="message" name="message" rows="5" placeholder="@lang('Enter Message')">{{old('message')}}</textarea>
                                        @error('message')
                                            <div class="error text-danger">@lang($message) </div>
                                        @enderror
                                    </div>


                                    <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                        <div class="attach-file">
                                            <span class="prev"> <i class="fal fa-link"></i> </span>
                                            <input class="form-control" accept="image/*" type="file" name="attachments[]"
                                                   multiple/>
                                        </div>
                                        @error('attachments')
                                            <span class="text-danger">{{trans($message)}}</span>
                                        @enderror
                                    </div>

                                    <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                        <button class="btn-custom w-100" type="submit"><i class="fal fa-dollar-sign"></i>@lang('Create')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
