@extends($theme.'layouts.user')
@section('title',trans($page_title))

@section('content')

<section class="support-area mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>@lang($page_title)</h2>
             </div>
          </div>
       </div>
       <div class="box">
          <div
             class="header d-flex align-items-center justify-content-between"
          >
            <p class="lebelFont">
                @if($ticket->status == 0)
                    <span class="badge rounded-pill bg-primary">@lang('Open')</span>
                @elseif($ticket->status == 1)
                    <span class="badge rounded-pill bg-success">@lang('Answered')</span>
                @elseif($ticket->status == 2)
                    <span class="badge rounded-pill bg-info">@lang('Customer Reply')</span>
                @elseif($ticket->status == 3)
                    <span class="badge rounded-pill bg-danger">@lang('Closed')</span>
                @endif
                [{{trans('Ticket#'). $ticket->ticket }}] {{ $ticket->subject }}
            </p>
            <button type="button" class="gold-btn close"
                data-bs-toggle="modal"
                data-bs-target="#closeTicketModal"><i
                class="fas fa-times-circle"></i> {{trans('Close')}}
            </button>
          </div>
          <hr />

            <!-- refferal link -->
            <div class="typing-area">
                <form action="{{ route('user.ticket.reply', $ticket->id)}}"
                    method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="pb-3">
                        <h4 class="golden-text">Type here</h4>
                        <div class="input-group2">
                            <textarea
                                name="message"
                                id="textarea1"
                                cols="30"
                                rows="4"
                                type="text"
                                class="form-control ticket-box"
                                placeholder="@lang('Type Here')..."
                            >{{old('message')}}</textarea>
                            @error('message')
                                <span class="text-danger">{{trans($message)}}</span>
                            @enderror

                            <div>
                                <div class="upload-img">
                                    <button class="send-file-btn" title="{{trans('Upload File')}}">
                                        <img
                                            src="{{asset($themeTrue.'img/icon/paper-clip.png')}}"
                                            alt="@lang('paper-clip')"
                                        />
                                        <input
                                            type="file" name="attachments[]" id="upload"
                                            class="form-control upload-box"
                                            multiple
                                            placeholder="@lang('Upload File')"
                                        />
                                    </button>
                                    <small class="text-danger select-files-count"></small>

                                    @error('attachments')
                                        <span class="text-danger">{{trans($message)}}</span>
                                    @enderror
                                </div>
                                <button type="submit" name="replayTicket" value="1" class="gold-btn"><i class="fas fa-paper-plane"></i> {{trans('Reply')}}</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- chats -->
                @if(count($ticket->messages) > 0)
                    <div class="chats">
                        @foreach($ticket->messages as $item)
                            @if($item->admin_id == null)
                                <div class="chat-box this-side">
                                    <div class="text-wrapper">
                                        <span class="sendBy">{{optional($ticket->user)->username}}</span>
                                        <div class="text">
                                            <p>{{$item->message}}</p>
                                        </div>
                                        @if(0 < count($item->attachments))
                                            <div class="fileShow d-flex justify-content-end">
                                                @foreach($item->attachments as $k=> $image)
                                                    <a href="{{route('user.ticket.download',encrypt($image->id))}}"
                                                    class="ms-3 nowrap "><i
                                                            class="fa fa-file"></i> @lang('File') {{++$k}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                        <span class="time">{{dateTime($item->created_at, 'd M, y h:i A')}}</span>
                                    </div>
                                    <div class="img">
                                        <img
                                            class="img-fluid"
                                            src="{{getFile(config('location.user.path').optional($ticket->user)->image)}}"
                                            alt="@lang('user')"
                                        />
                                    </div>
                                </div>
                            @else
                                <div class="chat-box opposite-side">
                                    <div class="img">
                                        <img
                                            class="img-fluid"
                                            src="{{getFile(config('location.admin.path').optional($item->admin)->image)}}"
                                            alt="@lang('user')"
                                        />
                                    </div>
                                    <div class="text-wrapper">
                                        <span class="sendBy">{{optional($item->admin)->name}}</span>
                                        <div class="text">
                                            <p>{{$item->message}}</p>
                                        </div>
                                        @if(0 < count($item->attachments))
                                            <div class="fileShow d-flex justify-content-start">
                                                @foreach($item->attachments as $k=> $image)
                                                    <a href="{{route('user.ticket.download',encrypt($image->id))}}"
                                                        class="mr-3 nowrap"><i
                                                            class="fa fa-file"></i> @lang('File') {{++$k}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                        <span class="time">{{dateTime($item->created_at, 'd M, y h:i A')}}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
       </div>
    </div>
</section>



    <div class="modal fade" id="closeTicketModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content form-block">

                <form method="post" action="{{ route('user.ticket.reply', $ticket->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h4 class="modal-title golden-text"> @lang('Confirmation')</h4>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            class="btn-close"
                            aria-label="Close"
                        >
                            <img src="{{asset($themeTrue.'img/icon/cross.png')}}" alt="@lang('cross img')" />
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="lebelFont">@lang('Are you want to close ticket?')</p>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="submit" class="btn btn-bg" name="replayTicket"
                                value="2">@lang("Confirm")
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        'use strict';
        $(document).on('change', '#upload', function () {
            var fileCount = $(this)[0].files.length;
            $('.select-files-count').text(fileCount + ' file(s) selected')
        })
    </script>
@endpush


