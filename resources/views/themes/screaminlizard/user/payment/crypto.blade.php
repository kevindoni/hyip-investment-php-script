@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection


@section('content')
<section class="transaction-history mt-5 pt-5">
    <div class="container-fluid">
         <div class="row">
                <div class="col">
                     <div class="header-text-full">
                            <h2>{{ 'Pay with '.optional($order->gateway)->name ?? '' }}</h2>
                     </div>
                </div>
         </div>

         <div class="row">
                <div class="col">
                    <div class="row justify-content-center">

                        <div class="col-md-8">
                            <div class="card secbg">
                                <div class="card-body text-center bg-dark">
                                    <h3 class="card-title">@lang('Payment Preview')</h3>

                                    <h4> @lang('PLEASE SEND EXACTLY') <span
                                            class="text-success"> {{ getAmount($data->amount) }}</span> {{$data->currency}}
                                    </h4>
                                    <h5>@lang('TO') <span class="text-success"> {{ $data->sendto }}</span></h5>
                                    <img src="{{$data->img}}" alt="..">
                                    <h4 class="text-color font-weight-bold">@lang('SCAN TO SEND')</h4>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
         </div>
    </div>
</section>


@endsection

