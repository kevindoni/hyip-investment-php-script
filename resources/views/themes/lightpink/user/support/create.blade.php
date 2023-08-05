@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">@lang('Create New Ticket')</h3>
                </div>
            </div>

            <div class="col-xl-12 col-md-12 col-12">
                <div class="search-bar my-search-bar p-0">
                    <form action="{{route('user.ticket.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="inbox_right_side bg-white rounded">
                                <div class="d-flex justify-content-center">
                                    <div id="tab1">
                                        <div class="col-xl-12">
                                            <div class="form">
                                                <input class="form-control" name="purchase_package_id" type="hidden" value=""/>
                                                <div class="basic-form ticket-basic-form">
                                                    <div class="row g-3">
                                                        <div class="input-box col-md-12">
                                                            <label>@lang('Subject')</label>
                                                            <input class="form-control" type="text" name="subject"
                                                                   value="{{old('subject')}}" placeholder="@lang('Enter Subject')">
                                                            @error('subject')
                                                            <div class="error text-danger">@lang($message) </div>
                                                            @enderror
                                                        </div>

                                                        <div class="input-box col-md-12">
                                                            <label>@lang('Message')</label>
                                                            <textarea class="form-control ticket-box" name="message" rows="5"
                                                                      id="textarea1"
                                                                      placeholder="@lang('Enter Message')">{{old('message')}}</textarea>
                                                            @error('message')
                                                            <div class="error text-danger">@lang($message) </div>
                                                            @enderror
                                                        </div>

                                                        <div class="input-box col-md-12">
                                                            <input type="file" name="attachments[]"
                                                                   class="form-control"
                                                                   multiple
                                                                   placeholder="@lang('Upload File')">

                                                            @error('attachments')
                                                            <span class="text-danger">{{trans($message)}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3 justify-content-strat d-flex mt-4 mb-4">
                                            <button type="submit" class="btn-custom ticket-btn">
                                                <i class="fal fa-check-circle" aria-hidden="true"></i>@lang('Submit')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

