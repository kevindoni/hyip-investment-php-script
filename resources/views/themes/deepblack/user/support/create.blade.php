@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')

<section class="transaction-history profile-setting mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>{{trans($page_title)}}</h2>
             </div>
          </div>
       </div>

        <div class="edit-area">
            <form action="{{route('user.ticket.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="subject" class="golden-text">@lang('Subject')</label>
                        <input
                            type="text"
                            class="form-control"
                            id="subject"
                            name="subject" value="{{old('subject')}}" placeholder="@lang('Enter Subject')"
                        />
                        @error('subject')
                            <div class="error text-danger">@lang($message) </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <label for="message" class="golden-text">@lang('Message')</label>
                        <textarea
                            class="form-control ticket-box"
                            id="message"
                            name="message"
                            rows="5"
                            placeholder="@lang('Enter Message')"
                        >{{old('message')}}</textarea>
                        @error('message')
                            <div class="error text-danger">@lang($message) </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <label for="" class="golden-text">@lang('Upload File')</label
                        >
                        <div class="attach-file">
                           <span class="prev">
                              @lang('Upload File')
                           </span>
                           <input
                                type="file"
                                name="attachments[]"
                                multiple
                                class="form-control"
                           />
                        </div>
                        @error('attachments')
                            <span class="text-danger">{{trans($message)}}</span>
                        @enderror
                     </div>


                </div>
                <button type="submit" class="gold-btn">@lang('Submit')</button>
            </form>
        </div>

    </div>
 </section>

@endsection
