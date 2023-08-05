@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')

<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>@lang($page_title)</h2>
             </div>
          </div>
       </div>

       <div class="row">
          <div class="col">
            <div class="card bg-dark">
                <div class="card-header d-flex flex-row justify-content-between align-items-center borderBottom">
                    <h4 class="card-title golden-text mb-3">@lang($page_title)</h5>
                    <a href="{{route('user.ticket.create')}}" class="gold-btn-sm"> <i class="fa fa-plus-circle"></i> @lang('Create Ticket')</a>
                </div>
                <div class="card-body">
                    <div class="table-parent table-responsive">
                        <table class="table table-striped mb-5">
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
                                        <td>
                                            <a href="{{ route('user.ticket.view', $ticket->ticket) }}"
                                                class="btn btn-sm eye-btn" title="@lang('Details')" >
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

                        {{ $tickets->appends($_GET)->links($theme.'partials.pagination') }}

                     </div>
                </div>
            </div>

          </div>
       </div>
    </div>
</section>


@endsection
