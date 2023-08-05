@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')

    <!-- main -->
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="dashboard-heading">
                    <h4 class="mb-0">@lang($page_title)</h4>
                    <a href="{{route('user.ticket.create')}}" class="btn-custom">
                        <i class="fa fa-plus-circle"></i> @lang('Create ticket')
                    </a>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive mt-4">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Subject')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Last Reply')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tickets as $key => $ticket)
                            <tr>
                                <td data-label="Subject font-weight-bold">[{{ trans('Ticket#').$ticket->ticket }}
                                    ] {{ $ticket->subject }}</td>
                                <td data-label="Status">
                                    @if($ticket->status == 0)
                                        <span class="badge bg-success">@lang('Open')</span>
                                    @elseif($ticket->status == 1)
                                        <span class="badge bg-primary">@lang('Answered')</span>
                                    @elseif($ticket->status == 2)
                                        <span class="badge bg-warning">@lang('Replied')</span>
                                    @elseif($ticket->status == 3)
                                        <span class="badge bg-danger">@lang('Closed')</span>
                                    @endif
                                </td>
                                <td data-label="Last Reply">{{diffForHumans($ticket->last_reply) }}</td>
                                <td data-label="Action">
                                    <div>
                                        <a href="{{ route('user.ticket.view', $ticket->ticket) }}" class="btn-action-icon bg-success">
                                            <i class="fad fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">{{__('No Data Found!')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $tickets->appends($_GET)->links($theme.'partials.pagination') }}
                </div>
            </div>
        </div>
    </div>

@endsection
