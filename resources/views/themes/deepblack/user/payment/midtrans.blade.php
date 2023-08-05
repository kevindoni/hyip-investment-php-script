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
                <div class="col-md-12">
                    <div class="card secbg br-4 bg-dark">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-center ">
                                <div class="col-md-3">
                                    <img
                                        src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}"
                                        class="w-75" alt="..">
                                </div>
                                <div class="col-md-5">
                                    <h4>@lang('Please Pay') {{round($order->final_amount)}} {{$order->gateway_currency}}</h4>

                                    <button type="button"
                                            class="btn btn-success mt-3"
                                            id="pay-button">@lang('Pay Now')
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    @push('script')
        <script type="text/javascript"
                src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ $data->client_key }}"></script>

        <script defer>
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
                window.snap.pay("{{ $data->token }}");
            });
        </script>
    @endpush

@endsection
