@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection

@section('content')
    <style>
        body{
            color: #26293b !important;
        }
        .wpwl-control {
            color: #000 !important;
        }
        #frameDiv {
            border-style: solid;
            border-width: 1cm;
            border-color: red;
            margin: 0;
            padding: 0 13px !important;
            background: #d1d1d1 !important;
        }
    </style>

    <section class="transaction-history mt-5 pt-5 overflow-hidden">
        <div class="container-fluid">
           <div class="row">
              <div class="col">
                 <div class="header-text-full">
                    <h2>{{ 'Pay with '.optional($order->gateway)->name ?? '' }}</h2>
                 </div>
              </div>
           </div>

           <div class="row">
            <div class="col-md-12">
                <div class="card secbg br-4 bg-dark">
                    <div class="card-body">
                        <h6 class="mt-2">@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h6>
                        <h6 class="mt-1">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h6>

                        <form action="{{$data->url}}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>
                    </div>
                </div>
            </div>
        </div>
        </div>
     </section>



    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$data->checkoutId}}"></script>

@endsection
