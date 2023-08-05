@extends($theme.'layouts.user')
@section('title',trans($title))
@section('content')

    <!-- main -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h3 class="ms-2 mb-0 mt-2">{{trans($title)}}</h3>
                </div>
            </div>
        </div>
        <div class="main row">
            <div class="col-12">
                <!-- table -->
                <div class="table-parent table-responsive mt-4">
                    <div class="table-search-bar">
                        <div>
                            <form action="{{ route('user.payout.history.search') }}" method="get">
                                <div class="row g-3 align-items-end">
                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <input type="text" name="name" value="{{@request()->name}}" class="form-control" placeholder="@lang('Type Here')" />
                                    </div>

                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <select class="js-example-basic-single form-control" name="status" id="salutation" aria-label="Default select example">
                                            <option value="">@lang('All Payment')</option>
                                            <option value="1"
                                                    @if(@request()->status == '1') selected @endif>@lang('Pending Payment')</option>
                                            <option value="2"
                                                    @if(@request()->status == '2') selected @endif>@lang('Complete Payment')</option>
                                            <option value="3"
                                                    @if(@request()->status == '3') selected @endif>@lang('Rejected Payment')</option>
                                        </select>
                                    </div>

                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <input type="text" class="form-control datepicker" name="date_time"
                                               placeholder="@lang('Select a date')" value="{{ old('date_time', request()->date_time) }}" autocomplete="off" readonly/>
                                    </div>

                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <button class="btn-custom w-100" type="submit"><i class="fal fa-search"></i> @lang('Search')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped mb-5">
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
                                <td data-label="@lang('Transaction ID')">{{$item->trx_id}}</td>
                                <td data-label="@lang('Gateway')">@lang(optional($item->method)->name)</td>
                                <td data-label="@lang('Amount')">
                                    {{getAmount($item->amount)}} @lang($basic->currency)
                                </td>
                                <td data-label="@lang('Charge')"> {{getAmount($item->charge)}} @lang($basic->currency) </td>
                                <td data-label="@lang('Status')">
                                    @if($item->status == 1)
                                        <span class="badge bg-warning">@lang('Pending')</span>
                                    @elseif($item->status == 2)
                                        <span class="badge bg-success">@lang('Complete')</span>
                                    @elseif($item->status == 3)
                                        <span class="badge bg-danger">@lang('Cancel')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Time')">{{ dateTime($item->created_at, 'd M Y h:i A') }}</td>
                                <td data-label="Action">
                                    <div>
                                        <button
                                            class="btn-action-icon bg-info infoButton"
                                            type="button"
                                            data-information="{{json_encode($item->information)}}"
                                            data-feedback="{{$item->feedback}}"
                                            data-trx_id="{{ $item->trx_id }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#infoModal">
                                            <i class="fal fa-info-circle"></i>
                                        </button>
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
                    {{ $payoutLog->appends($_GET)->links($theme.'partials.pagination') }}
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
        <div class="modal-header">
            <h3 class="modal-title golden-text" id="infoModalLabel">
                @lang('Details')
            </h3>
            <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                <i class="fal fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">@lang('Transactions') : <span class="trx"></span>
                </li>
                <li class="list-group-item list-group-item-primary bg-transparent lebelFont text-white">@lang('Admin Feedback') : <span
                        class="feedback"></span></li>
            </ul>
            <div class="payout-detail text-white">

            </div>
        </div>
        <div class="modal-footer">
            <button
                type="button"
                class="btn-custom w-100"
                data-bs-dismiss="modal">
                @lang('Close')
            </button>
        </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script src="{{asset($themeTrue.'js/bootstrap-datepicker.js')}}"></script>

    <script>
        "use strict";
        $(document).ready(function () {
            $(".datepicker").datepicker({
                autoclose: true,
                clearBtn: true,
                format: 'yyyy-mm-dd'
            });

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
                                            <span class="font-weight-bold "> ${information[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${information[i][1].field_name??information[i][1].fieldValue}" alt="..." class="w-100">
                                        </li>`;
                    } else {
                        result += `<li class="list-group-item bg-transparent customborder lebelFont text-white">
                                            <span class="font-weight-bold "> ${information[i][0].replaceAll('_', " ")} </span> : <span class="font-weight-bold ml-3">${information[i][1].field_name??information[i][1].fieldValue}</span>
                                        </li>`;
                    }
                }

                if (result) {
                    infoModal.find('.payout-detail').html(`<br><h4 class="my-3 golden-text">@lang('Payment Information')</h4>  ${result}`);
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
