@extends('admin.layouts.app')
@section('title')
    @lang('Create a Plan')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-end">
                <a href="{{route('admin.planList')}}" class="btn btn-sm  btn-primary mr-2">
                    <span><i class="fas fa-arrow-left"></i> @lang('Back')</span>
                </a>
            </div>

            <form method="post" action="{{route('admin.planStore')}}" class="form-row justify-content-center">
                @csrf
                <div class="col-md-8">

                <div class="row ">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input type="text" name="name" value="{{old('name')}}" placeholder="@lang('Plan Name')" class="form-control" >
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-md-6">
                        <div class="form-group">
                            <label>@lang('Badge Name')  <small>({{trans('Optional')}})</small></label>
                            <input type="text" name="badge" value="{{old('badge')}}" placeholder="@lang('eg. premium, popular')" class="form-control" >
                            @error('badge')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-sm-6 form-group">
                        <label>@lang('Plan Price Type')</label>
                        <input data-toggle="toggle" id="plan_price_type" class="amount" data-onstyle="success"
                        data-offstyle="info" data-on="Fixed" data-off="Range" data-width="100%"
                        type="checkbox" checked name="plan_price_type">
                        @error('plan_price_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-6 fixedAmount d-block">
                        <label>@lang('Fixed Amount')</label>
                        <div class="input-group mb-3">
                            <input type="text" name="fixed_amount" class="form-control" placeholder="0.00" >
                            <div class="input-group-append">
                                <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                            </div>
                        </div>
                        @error('fixed_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-6 rangeAmount d-none">
                        <label>@lang('Minimum Amount')</label>
                        <div class="input-group mb-3">
                            <input type="text" name="minimum_amount" class="form-control" placeholder="0.00" >
                            <div class="input-group-append">
                                <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                            </div>
                        </div>
                        @error('minimum_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 rangeAmount d-none">
                        <label>@lang('Maximum Amount')</label>
                        <div class="input-group mb-3">
                            <input type="text" name="maximum_amount" class="form-control" placeholder="0.00" >
                            <div class="input-group-append">
                                <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                            </div>
                        </div>
                        @error('maximum_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-6">
                        <label>@lang('Yield')</label>
                        <div class="input-group mb-3">
                            <input type="text" name="profit" class="form-control" placeholder="0.00">
                            <div class="input-group-append">
                                <select name="profit_type" id="profit_type" class="form-control">
                                    <option value="1">%</option>
                                    <option value="0">@lang(config('basic.currency_symbol'))</option>
                                </select>
                            </div>
                        </div>
                        @error('profit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-6">
                        <label for="schedule">@lang('Accrual')</label>
                        <select name="schedule" id="schedule" class="form-control">
                            <option value="" disabled>@lang('Select a Period')</option>
                            @foreach($times as $item)
                                <option value="{{$item->time}}">@lang('Every') {{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('schedule')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-6 ">
                        <label>@lang('Return')</label>

                        <input data-toggle="toggle" id="is_lifetime" data-onstyle="success"
                               data-offstyle="info" data-on="PERIOD" data-off="LIFETIME" data-width="100%"
                               type="checkbox" checked name="is_lifetime">

                        @error('is_lifetime')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 repeatable d-block">
                        <label>@lang('Maturity')</label>
                        <div class="input-group mb-3">
                            <input type="text" name="repeatable" value="{{old('repeatable')}}" class="form-control" placeholder="@lang('How many times')">
                            <div class="input-group-append">
                                <span class="input-group-text">@lang('Times')</span>
                            </div>
                        </div>

                        @error('repeatable')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-4 ">
                        <label>@lang('Capital back')</label>
                        <input data-toggle="toggle" id="is_capital_back" data-onstyle="success" data-offstyle="info" data-on="YES" data-off="NO" data-width="100%" type="checkbox" checked name="is_capital_back">
                        @error('is_capital_back')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-4 ">
                        <label>@lang('Featured')</label>
                        <input data-toggle="toggle" id="featured" data-onstyle="success" data-offstyle="info" data-on="YES" data-off="NO" data-width="100%" type="checkbox" checked name="featured">
                        @error('featured')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-4 ">
                        <label>@lang('Status')</label>
                        <input data-toggle="toggle" id="status" data-onstyle="success"
                               data-offstyle="info" data-on="Active" data-off="Deactive" data-width="100%"
                               type="checkbox" checked name="status">
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                </div>


                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><span><i
                            class="fas fa-save pr-2"></i> @lang('Save Changes')</span></button>

                </div>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <script>
        "use strict";
        $(document).on('change','#plan_price_type', function () {
            var isCheck = $(this).prop('checked');
            if (isCheck == false) {
                $('.rangeAmount').addClass('d-block');
                $('.fixedAmount').removeClass('d-block');
                $('.fixedAmount').addClass('d-none');
            } else {
                $('.rangeAmount').removeClass('d-block');
                $('.fixedAmount').addClass('d-block');
            }
        });

        $(document).on('change','#is_lifetime', function () {
            var isCheck = $(this).prop('checked');

            if(isCheck == false){
                $('.repeatable').removeClass('d-block');
                $('.repeatable').addClass('d-none');
            }else {
                $('.repeatable').removeClass('d-none');
                $('.repeatable').addClass('d-block');
            }

        });

        $(document).ready(function () {
            $('select[name=schedule]').select2({
                selectOnClose: true
            });
        });


    </script>

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
@endpush
