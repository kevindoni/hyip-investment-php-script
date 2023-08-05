@extends($theme.'layouts.user')
@section('title',trans('Fund History'))

@push('css-lib')
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/bootstrap-datepicker.css') }}" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <h3 class="mb-0">@lang('Fund History')</h3>
                </div>

                <div class="search-bar my-search-bar p-0">
                    <form action="{{ route('user.fund-history.search') }}" method="get" enctype="multipart/form-data">
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

                            <div class="input-box col-lg-3 col-md-3 col-sm-12">
                                <select name="status" id="package_status" class="form-control js-example-basic-single">
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
                                <input type="text" class="form-control datepicker" name="date_time" autocomplete="off" readonly placeholder="@lang('Select a date')" value="{{ old('purchase_date',request()->purchase_date) }}">
                            </div>


                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <button class="btn-custom" type="submit">@lang('Search')</button>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($funds as $data)
                                <tr>
                                    <td>{{$data->transaction}}</td>
                                    <td>@lang(optional($data->gateway)->name)</td>
                                    <td>{{getAmount($data->amount)}} @lang($basic->currency)</td>
                                    <td>{{getAmount($data->charge)}} @lang($basic->currency)</td>
                                    <td>
                                        @if($data->status == 1)
                                            <span class="badge bg-success">@lang('Complete')</span>
                                        @elseif($data->status == 2)
                                            <span class="badge bg-warning">@lang('Pending')</span>
                                        @elseif($data->status == 3)
                                            <span class="badge bg-danger">@lang('Cancel')</span>
                                        @endif
                                    </td>
                                    <td>{{ dateTime($data->created_at, 'd M Y h:i A') }}</td>
                                </tr>

                            @empty
                                <tr class="text-center">
                                    <td colspan="100%">{{__('No Data Found!')}}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $funds->appends($_GET)->links() }}
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
            $( ".datepicker" ).datepicker({
            });
        });
    </script>
@endpush

