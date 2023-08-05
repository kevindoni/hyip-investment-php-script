@extends('admin.layouts.app')
@section('title')
    @lang('Edit Rank')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-end">
                <a href="{{route('admin.rankingsUser')}}" class="btn btn-sm  btn-primary mr-2">
                    <span><i class="fas fa-arrow-left"></i> @lang('Back')</span>
                </a>
            </div>

            <form method="post" action="{{route('admin.rankUpdate',[$singleRanking->id])}}" class="form-row justify-content-center" enctype="multipart/form-data">
                @csrf
                <div class="col-md-8">
                    <div class="row ">

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label>@lang('Ranking Name')</label>
                                <input type="text" name="rank_name" value="{{ old('rank_name', @$singleRanking->rank_name) }}"
                                       placeholder="@lang('rank name')" class="form-control">
                                @error('rank_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label>@lang('Ranking Lavel')</label>
                                <input type="text" name="rank_lavel" value="{{ old('rank_lavel', @$singleRanking->rank_lavel) }}"
                                       placeholder="@lang('rank lavel')" class="form-control">
                                @error('rank_lavel')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6 fixedAmount d-block">
                            <label>@lang('Minimum Invest')</label>
                            <div class="input-group mb-3">
                                <input type="text" name="min_invest" class="form-control" value="{{ old('min_invest', @$singleRanking->min_invest) }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                </div>
                            </div>
                            @error('min_invest')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 fixedAmount d-block">
                            <label>@lang('Minimum Deposit')</label>
                            <div class="input-group mb-3">
                                <input type="text" name="min_deposit" class="form-control" value="{{ old('min_deposit', @$singleRanking->min_deposit) }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                </div>
                            </div>
                            @error('min_deposit')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 fixedAmount d-block">
                            <label>@lang('Minimum Earning')</label>
                            <div class="input-group mb-3">
                                <input type="text" name="min_earning" class="form-control" value="{{ old('min_earning', @$singleRanking->min_earning) }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                </div>
                            </div>
                            @error('min_earning')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-xl-6">
                            <label>@lang('Status')</label>
                            <input data-toggle="toggle" id="status" data-onstyle="success"
                                   data-offstyle="info" data-on="Active" data-off="Deactive" data-width="100%"
                                   type="checkbox" @if($singleRanking->status) checked @endif name="status">
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class=" col-md-6">
                            <div class="form-group">
                                <label>@lang('Description')</label>
                                <textarea name="description" rows="8"
                                          class="form-control">{{ old('description', @$singleRanking->description) }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>@lang('Ranking Icon')</label>

                                <div class="image-input rank_icon_input">
                                    <label for="image-upload" id="image-label"><i class="fas fa-upload"></i></label>
                                    <input type="file" name="rank_icon" placeholder="@lang('Choose image')" id="image">
                                    <img id="image_preview_container" class="preview-image"
                                         src="{{ asset(getFile(config('location.rank.path').@$singleRanking->rank_icon)) }}"
                                         alt="preview image">
                                </div>
                            </div>
                            @error('rank_icon')
                            <span class="text-danger">{{ trans($message) }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">
                        <span>
                            <i class="fas fa-save pr-2"></i>
                            @lang('Save Changes')
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <script>
        'use strict'
        $(document).ready(function (e) {
            "use strict";

            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });


            $('select').select2({
                selectOnClose: true
            });

        });
    </script>
@endpush
