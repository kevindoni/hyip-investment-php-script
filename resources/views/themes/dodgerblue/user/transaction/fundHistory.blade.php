@extends($theme.'layouts.user')
@section('title',trans('Fund History'))

@section('content')
    <!-- main -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="header-text-full">
                    <h3 class="ms-2 mb-0 mt-2">{{trans('Fund History')}}</h3>
                </div>
            </div>
        </div>
        <div class="main row">
            <div class="col-12">
                <!-- table -->
                <div class="table-parent table-responsive mt-4">
                    <div class="table-search-bar">
                        <div>
                            <form action="{{ route('user.fund-history.search') }}" method="get">
                                <div class="row g-3 align-items-end">
                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <input type="text" name="name" value="{{@request()->name}}" class="form-control" placeholder="@lang('Type Here')" />
                                    </div>
                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <select class="js-example-basic-single form-control" name="status" id="salutation" aria-label="Default select example">
                                            <option value="">@lang('All Payment')</option>
                                            <option value="1"
                                                    @if(@request()->status == '1') selected @endif>@lang('Complete Payment')</option>
                                            <option value="2"
                                                    @if(@request()->status == '2') selected @endif>@lang('Pending Payment')</option>
                                            <option value="3"
                                                    @if(@request()->status == '3') selected @endif>@lang('Cancel Payment')</option>
                                        </select>
                                    </div>

                                    <div class="input-box col-lg-3 col-md-3 col-xl-3 col-12">
                                        <input type="text" class="form-control datepicker" name="date_time"
                                               placeholder="@lang('Select a date')" value="{{ old('date_time', request()->date_time) }} autocomplete="off" readonly/>
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
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($funds as $data)
                            <tr>
                                <td data-label="@lang('Transaction ID')">{{$data->transaction}}</td>
                                <td data-label="@lang('Gateway')">@lang(optional($data->gateway)->name)</td>
                                <td data-label="@lang('Amount')">{{getAmount($data->amount)}} @lang($basic->currency)</td>
                                <td data-label="@lang('Charge')"> {{getAmount($data->charge)}} @lang($basic->currency)</td>
                                <td data-label="@lang('Status')">
                                    @if($data->status == 1)
                                        <span class="badge bg-success">@lang('Complete')</span>
                                    @elseif($data->status == 2)
                                        <span class="badge bg-warning">@lang('Pending')</span>
                                    @elseif($data->status == 3)
                                        <span class="badge bg-danger">@lang('Cancel')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Time')">{{ dateTime($data->created_at, 'd M Y h:i A') }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">{{__('No Data Found!')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $funds->appends($_GET)->links($theme.'partials.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset($themeTrue.'js/bootstrap-datepicker.js')}}"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $(".datepicker").datepicker({
                autoclose: true,
                clearBtn: true,
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush
