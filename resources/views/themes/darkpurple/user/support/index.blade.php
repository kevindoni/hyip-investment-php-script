@extends($theme.'layouts.user')
@section('title')
    @lang($page_title)
@endsection

@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <h3 class="mb-0">@lang($page_title)</h3>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end mb-3">
                    <a href="{{route('user.ticket.create')}}" class="btn btn-custom create-ticket-button notiflix-confirm text-white"> <i class="fal fa-plus" aria-hidden="true"></i> @lang('Create Ticket')</a>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Subject')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Last Reply')</th>
                            <th scope="col" class="text-end">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tickets as $key => $ticket)
                            <tr>
                                <td>
                                    <span class="font-weight-bold"> [{{ trans('Ticket#').$ticket->ticket }}
                                    ] {{ $ticket->subject }}
                                    </span>
                                </td>
                                <td>
                                    @if($ticket->status == 0)
                                        <span class="badge rounded-pill bg-success">@lang('Open')</span>
                                    @elseif($ticket->status == 1)
                                        <span class="badge rounded-pill bg-primary">@lang('Answered')</span>
                                    @elseif($ticket->status == 2)
                                        <span class="badge rounded-pill bg-warning">@lang('Replied')</span>
                                    @elseif($ticket->status == 3)
                                        <span class="badge rounded-pill bg-danger">@lang('Closed')</span>
                                    @endif
                                </td>
                                <td>{{diffForHumans($ticket->last_reply) }}</td>
                                <td class="text-end">
                                    <a
                                        href="{{ route('user.ticket.view', $ticket->ticket) }}"
                                        class="btn btn-sm infoButton payoutHistoryBtn"
                                    >
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="100%">{{__('No Data Found!')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $tickets->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
