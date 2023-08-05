@extends('admin.layouts.app')
@section('title')
    @lang('Manage Schedule')
@endsection

@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">

        <div class="card-body">
            @if(adminAccessRoute(config('role.manage_plan.access.add')))
            <button class="btn btn-sm  btn-dark float-right mb-2" type="button"
                    data-toggle="modal"
                    data-target="#addModal">
                <span><i class="fas fa-plus"></i> @lang('Add New')</span>
            </button>
            @endif

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Duration')</th>
                        @if(adminAccessRoute(config('role.manage_plan.access.edit')))
                        <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($manageTimes as $item)
                        <tr>
                            <td data-label="@lang('Name')">
                                @lang($item->name)
                            </td>
                            <td data-label="@lang('Duration')">
                                @lang('Time'): @lang($item->time) @lang('Hours')
                            </td>
                            @if(adminAccessRoute(config('role.manage_plan.access.edit')))
                            <td data-label="@lang('Action')">
                                <button class="btn btn-sm  btn-primary edit-button" type="button"
                                        data-toggle="modal"
                                        data-target="#editModal"
                                        data-name="{{$item->name}}"
                                        data-time="{{$item->time}}"
                                        data-route="{{route('admin.update.schedule',['id'=>$item->id])}}">
                                    <span><i class="fas fa-edit"></i> @lang('Edit')</span>
                                </button>
                            </td>
                            @endif
                        </tr>

                    @empty
                        <tr>
                            <td colspan="100%">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Add New Schedule')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.store.schedule')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control form-control-lg">
                        </div>

                        <div class="form-group">
                            <label>@lang('Time')</label>
                            <div class="input-group mb-3">
                                <input type="text" name="time" value="{{old('time')}}"
                                       class="form-control form-control-lg">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{trans('Hour')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">
                            <span>@lang('Cancel')</span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span><i class="fas fa-save"></i> @lang('Save Changes')</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Edit Schedule')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input type="text" name="name" value="{{old('name')}}" class="edit-name form-control form-control-lg">
                        </div>

                        <div class="form-group">
                            <label>@lang('Time')</label>
                            <div class="input-group mb-3">
                                <input type="text" name="time" value="{{old('time')}}"
                                       class="edit-time form-control form-control-lg">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{trans('Hour')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">
                            <span>@lang('Cancel')</span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span><i class="fas fa-save"></i> @lang('Save Changes')</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@push('style-lib')
    <link href="{{asset('assets/admin/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endpush
@push('js')
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
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '.edit-button', function () {
                $('#editForm').attr('action', $(this).data('route'))
                $('.edit-name').val($(this).data('name'))
                $('.edit-time').val($(this).data('time'))
            })

        });

    </script>
@endpush
