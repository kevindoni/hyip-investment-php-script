@extends('admin.layouts.app')
@section('title')
    @lang($page_title)
@endsection

@section('content')

    <div class="alert alert-warning my-5 m-0 m-md-4" role="alert">
        <i class="fas fa-info-circle mr-2"></i> @lang("N.B: Pull up or down the rows to sort the ranking list order that how do you want to display the ranking in admin and user panel.")
    </div>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-end">
                @if(adminAccessRoute(config('role.manage_plan.access.add')))
                    <a href="{{route('admin.rankCreate')}}" class="btn btn-sm  btn-primary mr-2">
                        <span><i class="fas fa-plus"></i> @lang('Add New')</span>
                    </a>
                @endif
            </div>


            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('Rank Name')</th>
                        <th scope="col">@lang('Rank Lavel')</th>
                        <th scope="col">@lang('Rank Icon')</th>
                        <th scope="col">@lang('Min Invest')</th>
                        <th scope="col">@lang('Min Deposit')</th>
                        <th scope="col">@lang('Min Earning')</th>
                        <th scope="col">@lang('Details')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>

                    <tbody id="sortable">
                    @forelse($allRankings as $item)
                        <tr data-id="{{ $item->id }}">
                            <td data-label="@lang('Rank Name')">
                                @lang($item->rank_name)
                            </td>
                            <td data-label="@lang('Rank Level')">
                                <p class="font-weight-bold">{{$item->rank_lavel}}</p>
                            </td>

                            <td data-label="@lang('Rank icon')">
                                <img src="{{ getFile(config('location.rank.path').$item->rank_icon)}}"
                                     alt="@lang('not found')" width="60">
                            </td>

                            <td data-label="@lang('Minimum Earning')">
                                <p class="font-weight-bold">{{$item->min_invest}} {{ config('basic.currency') }}</p>
                            </td>

                            <td data-label="@lang('Minimum Earning')">
                                <p class="font-weight-bold">{{$item->min_deposit}} {{ config('basic.currency') }}</p>
                            </td>

                            <td data-label="@lang('Minimum Earning')">
                                <p class="font-weight-bold">{{$item->min_earning}} {{ config('basic.currency') }}</p>
                            </td>

                            <td data-label="@lang('Bonus')">
                                <p class="font-weight-bold">@lang($item->description)</p>
                            </td>

                            <td data-label="@lang('Status')">

                                <span
                                    class="{{ $item->status == 1 ? 'badge-success' : 'badge-danger' }}  badge badge-pill badge-rounded">
                                    @if($item->status == 1)
                                        @lang('Active')
                                    @else
                                        @lang('Deactive')
                                    @endif
                                </span>
                            </td>

                            <td data-label="@lang('Action')">
                                <div class="dropdown show">
                                    <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('admin.rankEdit',$item->id) }}">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Edit')
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-item notiflix-confirm"
                                           data-route="{{ route('admin.rankDelete',$item->id) }}"
                                           data-toggle="modal"
                                           data-target="#delete-modal">
                                            <i class="fa fa-trash text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Delete')
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel">@lang('Delete Confirmation')
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure to delete this?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">@lang('Close')</button>
                    <form action="" method="post" class="deleteRoute">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/jquery-ui.min.css') }}">
    <link href="{{asset('assets/admin/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('assets/global/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/datatable-basic.init.js') }}"></script>


    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp
        <script>
            "use strict";
            @foreach ($errors as $error)
            Notiflix.Notify.Failure("{{trans($error)}}");
            @endforeach
        </script>
    @endif

    <script>
        'use strict'
        $('.notiflix-confirm').on('click', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })
    </script>



    <script>
        "use strict";
        $(document).ready(function () {
            $("#sortable").sortable({
                update: function (event, ui) {
                    var methods = [];
                    $('#sortable tr').each(function (key, val) {
                        let methodId = $(val).data('id');
                        methods.push(methodId);
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        'url': "{{ route('admin.sort.badges') }}",
                        'method': "POST",
                        'data': {
                            sort: methods
                        },
                        success: function (data) {
                            console.log(data);
                        }

                    });

                }
            });
            $("#sortable").disableSelection();
        });


    </script>
@endpush
