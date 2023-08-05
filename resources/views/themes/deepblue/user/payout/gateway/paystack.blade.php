@extends($theme.$layout)
@section('title', trans($title))
@push('navigator')
    <!-- PAGE-NAVIGATOR -->
    <section id="page-navigator">
        <div class="container-fluid">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">@lang($title)</a></li>
                </ol>
            </div>
        </div>
    </section>
    <!-- /PAGE-NAVIGATOR -->
@endpush
@section('content')
    <!-- main -->
    <section id="feature" class="about-page secbg-1 py-5">
        <div class="feature-wrapper add-fund">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-type-1 text-center">
                            <ul class="list-group">
                                <li class="list-group-item font-weight-bold bg-transparent">
                                    <img
                                        src="{{getFile(config('location.withdraw.path').optional($withdraw->method)->image)}}"
                                        class="card-img-top w-50" alt="{{optional($withdraw->method)->name}}">
                                </li>
                                <li class="list-group-item font-weight-bold bg-transparent">@lang('Request Amount')
                                    :
                                    <span
                                        class="text-success">{{@$basic->currency_symbol}}{{getAmount($withdraw->amount)}} </span>
                                </li>
                                <li class="list-group-item font-weight-bold bg-transparent">@lang('Charge Amount')
                                    :
                                    <span
                                        class=" text-danger">{{@$basic->currency_symbol}}{{getAmount($withdraw->charge)}} </span>
                                </li>
                                <li class="list-group-item font-weight-bold bg-transparent">@lang('Total Payable')
                                    :
                                    <span
                                        class=" text-danger">{{@$basic->currency_symbol}}{{getAmount($withdraw->net_amount)}} </span>
                                </li>
                                @if($layout != 'layouts.payment')
                                    <li class="list-group-item font-weight-bold bg-transparent">@lang('Available Balance')
                                        :
                                        <span
                                            class="text-success">{{@$basic->currency_symbol}}{{$remaining}} </span>
                                    </li>
                                @endif
                                <div id="showInfo">

                                </div>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8">

                        <div class="card card-type-1 form-block">
                            <div class="card-header custom-header text-center">
                                <h5 class="card-title">@lang('Additional Information To Withdraw Confirm')</h5>
                            </div>


                            <div class="card-body">
                                <form @if($layout == 'layouts.payment') action="{{route('user.payout.submit',$billId)}}"
                                      @else action="{{ route('user.payout.submit.paystack',$withdraw->trx_id) }}"
                                      @endif method="post" enctype="multipart/form-data"
                                      class="form-row text-left preview-form">
                                    @csrf
                                    <input type="hidden" class="type" name="type" value="">
                                    <input type="hidden" class="currency" name="currency" value="">

                                    @if($payoutMethod->supported_currency)
                                        <div class="col-md-12">
                                            <div class="form-group input-box search-currency-dropdown">
                                                <label for="from_wallet">@lang('Select Bank Currency')</label>
                                                <select id="from_wallet" name="currency_code"
                                                        class="form-control form-control-sm transfer-currency"
                                                        required>
                                                    <option value="" disabled=""
                                                            selected="">@lang('Select Currency')</option>
                                                    @foreach($payoutMethod->supported_currency as $singleCurrency)
                                                        <option
                                                            value="{{$singleCurrency}}"
                                                            @foreach($payoutMethod->convert_rate as $key => $rate)
                                                                @if($singleCurrency == $key) data-rate="{{$rate}}" @endif
                                                            @endforeach {{old('currency_code') == $singleCurrency ?'selected':''}}>{{$singleCurrency}}</option>
                                                    @endforeach
                                                </select>
                                                @error('currency_code')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-12 dynamic-bank input-box mx-1 mb-2  d-none">
                                        <label>@lang('Select Bank')</label>
                                        <select id="dynamic-bank" name="bank"
                                                class="form-control form-control-sm" required>
                                        </select>
                                        @error('bank')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    @if(optional($withdraw->method)->input_form)
                                        <div class="col-md-12 g-4">
                                            @foreach($withdraw->method->input_form as $k => $v)
                                                @if($v->type == "text")
                                                    <div class="input-box col-md-12">
                                                        <label>{{trans($v->label)}} @if($v->validation == 'required')
                                                                <span class="text-danger">*</span>
                                                            @endif</label>
                                                        <input type="text" name="{{$k}}"
                                                               class="form-control"
                                                               @if($v->validation == "required") required @endif>
                                                        @if ($errors->has($k))
                                                            <span
                                                                class="text-danger">{{ trans($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                @elseif($v->type == "textarea")
                                                    <div class="input-box col-12">
                                                        <div class="form-group">
                                                            <label>{{trans($v->label)}} @if($v->validation == 'required')
                                                                    <span class="text-danger">*</span>
                                                                @endif
                                                            </label>
                                                            <textarea name="{{$k}}" class="form-control"
                                                                      cols="30"
                                                                      rows="10"
                                                                      @if($v->validation == "required") required @endif></textarea>
                                                            @if ($errors->has($k))
                                                                <span
                                                                    class="text-danger">{{ trans($errors->first($k)) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @elseif($v->type == "file")
                                                    <div class="input-box col-12">
                                                        <label
                                                            for="">{{trans($v->label)}} @if($v->validation == 'required')
                                                                <span class="text-danger">*</span>
                                                            @endif</label>
                                                        <input class="form-control" name="{{$k}}" accept="image/*"
                                                               @if($v->validation == "required") required
                                                               @endif type="file"
                                                               id="formFile"/>
                                                        <span class="icon"> <i class="fal fa-paperclip"></i></span>
                                                        @if ($errors->has($k))
                                                            <br>
                                                            <span
                                                                class="text-danger">{{ __($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-base btn-block text-white mt-3">
                                            <span>@lang('Confirm Now')</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css-lib')

@endpush
@push('extra-js')

@endpush
@push('script')
    <script type="text/javascript">
        var bankName = null;
        var payAmount = '{{$withdraw->amount}}'
        var baseCurrency = "{{config('basic.currency')}}"
        var currency_code = "{{old('currency_code')}}";
        if (currency_code) {
            getBankForm(currency_code);
        }

        $(document).on("change", "#dynamic-bank", function () {
            let type = $(this).find(':selected').data('type');
            let currency = $(this).find(':selected').data('currency');

            $('.type').val(type);
            $('.currency').val(currency);
        })

        $(document).on("change", ".transfer-currency", function () {
            let currencyCode = $(this).val();
            let rate = $(this).find(':selected').data('rate');
            let getAmount = parseFloat(rate) * parseFloat(payAmount);
            var output = null;
            $('#showInfo').html('');
            output = `<p>@lang('Exchange rate:') <span
                         class="text-danger">1 ${baseCurrency} = ${rate} ${currencyCode}</span></p>
                      <p>@lang('You will get:') <span
                         class="text-danger">${getAmount} ${currencyCode}</span></p>`

            $('#showInfo').html(output);
        })


        $(document).on("change", ".transfer-currency", function () {
            currencyCode = $(this).val();
            $('.dynamic-bank').addClass('d-none');
            getBankForm(currencyCode);
        })

        function getBankForm(currencyCode) {
            $.ajax({
                url: "{{route('user.payout.getBankList')}}",
                type: "post",
                data: {
                    currencyCode,
                },
                success: function (response) {
                    if (response.data != null) {
                        showBank(response.data)
                    }
                }
            });
        }

        function showBank(bankLists) {
            $('#dynamic-bank').html(``);
            var options = `<option disabled selected>@lang("Select Bank")</option>`;
            for (let i = 0; i < bankLists.length; i++) {
                options += `<option value="${bankLists[i].code}" data-type="${bankLists[i].type}" data-currency="${bankLists[i].currency}">${bankLists[i].name}</option>`;
            }

            $('.dynamic-bank').removeClass('d-none');
            $('#dynamic-bank').html(options);
        }
    </script>
    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp
        <script>
            "use strict";
            @foreach ($errors as $error)
            Notiflix.Notify.Failure("{{ trans($error) }}");
            @endforeach
        </script>
    @endif
@endpush

