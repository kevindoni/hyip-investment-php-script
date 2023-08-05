@extends($theme.'layouts.user')
@section('title',__($page_title))

@section('content')
    @push('navigator')
        <!-- PAGE-NAVIGATOR -->
        <section id="page-navigator">
            <div class="container-fluid">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"
                                                       class="cursor-inherit">{{__($page_title)}}</a></li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- /PAGE-NAVIGATOR -->
    @endpush

    <section id="dashboard">
        <div class="dashboard-wrapper add-fund pb-50">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card secbg br-4">
                        <div class="card-header media justify-content-between">
                            <h5 class="card-title mb-3">@lang($page_title)</h5>
                            <a href="{{route('user.ticket.create')}}" class="btn btn-sm btn-success"> <i class="fa fa-plus-circle"></i> @lang('Create Ticket')</a>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-hover table-striped text-white text-white">
                                    <thead class="thead-dark">
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
                                            <td data-label="@lang('Subject')">
                                                    <span
                                                        class="font-weight-bold"> [{{ trans('Ticket#').$ticket->ticket }}
                                                        ] {{ $ticket->subject }} </span>
                                            </td>
                                            <td data-label="@lang('Status')">
                                                @if($ticket->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-success">@lang('Open')</span>
                                                @elseif($ticket->status == 1)
                                                    <span
                                                        class="badge badge-pill badge-primary">@lang('Answered')</span>
                                                @elseif($ticket->status == 2)
                                                    <span
                                                        class="badge badge-pill badge-warning">@lang('Replied')</span>
                                                @elseif($ticket->status == 3)
                                                    <span class="badge badge-pill badge-dark">@lang('Closed')</span>
                                                @endif
                                            </td>

                                            <td data-label="@lang('Last Reply')">
                                                {{diffForHumans($ticket->last_reply) }}
                                            </td>

                                            <td data-label="@lang('Action')">
                                                <a href="{{ route('user.ticket.view', $ticket->ticket) }}"
                                                   class="btn btn-sm base-btn"
                                                   data-toggle="tooltip" title="" data-original-title="Details">
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
                            </div>

                            {{ $tickets->appends($_GET)->links($theme.'partials.pagination') }}



                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
