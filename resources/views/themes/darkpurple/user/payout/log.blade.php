@extends($theme.'layouts.user')
@section('title',trans('Payout Log'))

@push('css-lib')
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/bootstrap-datepicker.css') }}"/>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <h3 class="mb-0">@lang('Payout Log')</h3>
                </div>

                <div class="search-bar">
                    <form action="{{ route('user.payout.history.search') }}" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box">
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{@request()->name}}"
                                        class="form-control"
                                        placeholder="@lang('Type Here')"
                                    />
                                </div>
                            </div>

                            <div class="input-box col-lg-3">
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="">@lang('All Payment')</option>
                                    <option value="1"
                                            @if(@request()->status == '1') selected @endif>@lang('Complete Payment')</option>
                                    <option value="2"
                                            @if(@request()->status == '2') selected @endif>@lang('Pending Payment')</option>
                                    <option value="3"
                                            @if(@request()->status == '3') selected @endif>@lang('Cancel Payment')</option>
                                </select>
                            </div>

                            <div class="input-box col-lg-3 col-md-3 col-sm-12">
                                <input type="text" class="form-control datepicker" name="date_time" autocomplete="off"
                                       readonly placeholder="@lang('Select a date')"
                                       value="{{ old('date_time',request()->date_time) }}">
                            </div>

                            <div class="input-box col-lg-3">
                                <button class="btn-custom w-100" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Transaction ID')</th>
                            <th scope="col">@lang('Gateway')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Charge')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Time')</th>
                            <th scope="col">@lang('Detail')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($payoutLog as $item)
                            <tr>
                                <td>{{$item->trx_id}}</td>
                                <td>@lang(optional($item->method)->name)</td>
                                <td>{{getAmount($item->amount)}} @lang($basic->currency)</td>
                                <td>{{getAmount($item->charge)}} @lang($basic->currency)</td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge bg-warning">@lang('Pending')</span>
                                    @elseif($item->status == 2)
                                        <span class="badge bg-success">@lang('Complete')</span>
                                    @elseif($item->status == 3)
                                        <span class="badge bg-danger">@lang('Cancel')</span>
                                    @endif
                                </td>
                                <td>{{ dateTime($item->created_at, 'd M Y h:i A') }}</td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-sm infoButton payoutHistoryBtn"
                                        data-information="{{json_encode($item->information)}}"
                                        data-feedback="{{$item->feedback}}"
                                        data-trx_id="{{ $item->trx_id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#infoModal"
                                    >
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                </td>
                            </tr>

                        @empty
                            <tr class="text-center">
                                <td colspan="100%">{{__('No Data Found!')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $payoutLog->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div
        class="modal fade"
        id="infoModal"
        tabindex="-1"
        data-bs-backdrop="static"
        aria-labelledby="infoModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h3 class="modal-title text-white" id="infoModalLabel">
                        @lang('Details')
                    </h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fal fa-times  text-white" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">@lang('Transactions')
                            : <span class="trx"></span>
                        </li>
                        <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">@lang('Admin Feedback')
                            : <span
                                class="feedback"></span></li>
                    </ul>
                    <div class="payout-detail text-white">

                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="gold-btn btn-custom-rounded w-25 p-2 text-white btn-custom"
                        data-bs-dismiss="modal"
                    >
                        @lang('Close')
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset($themeTrue.'js/bootstrap-datepicker.js') }}"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $(".datepicker").datepicker({});
        });
    </script>

    <script>
        "use strict";

        $(document).ready(function () {
            $('.infoButton').on('click', function () {
                var infoModal = $('#infoModal');
                infoModal.find('.trx').text($(this).data('trx_id'));
                infoModal.find('.feedback').text($(this).data('feedback'));
                var list = [];
                var information = Object.entries($(this).data('information'));

                var ImgPath = "{{asset(config('location.withdrawLog.path'))}}/";
                var result = ``;
                for (var i = 0; i < information.length; i++) {
                    if (information[i][1].type == 'file') {
                        result += `<li class="list-group-item bg-transparent customborder lebelFont text-white">
                                            <span class="font-weight-bold "> ${information[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${information[i][1].field_name ?? information[i][1].fieldValue}" alt="..." class="w-100 mt-2">
                                        </li>`;
                    } else {
                        result += `<li class="list-group-item bg-transparent customborder lebelFont text-white">
                                            <span class="font-weight-bold "> ${information[i][0].replaceAll('_', " ")} </span> : <span class="font-weight-bold ml-3">${information[i][1].field_name ?? information[i][1].fieldValue}</span>
                                        </li>`;
                    }
                }

                if (result) {
                    infoModal.find('.payout-detail').html(`<br><h4 class="my-3 text-white">@lang('Payment Information')</h4>  ${result}`);
                } else {
                    infoModal.find('.payout-detail').html(`${result}`);
                }
                infoModal.modal('show');
            });


            $('.closeModal').on('click', function (e) {
                $("#infoModal").modal("hide");
            });
        });

    </script>
@endpush

