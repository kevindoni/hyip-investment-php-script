@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection

@section('content')



    @push('navigator')
        <!-- PAGE-NAVIGATOR -->
        <section id="page-navigator">
            <div class="container-fluid">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user.addFund')}}"
                                                       class="text-white">@lang('Add Fund')</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"
                                                       class="cursor-inherit">{{optional($order->gateway)->name ?? ''}}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- /PAGE-NAVIGATOR -->
    @endpush



    <section id="dashboard">
        <div class="dashboard-wrapper add-fund pb-50">
            <div class="row">
                <div class="col-md-12">
                    <div class="card secbg br-4">
                        <div class="card-body ">
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
                                            id="payment-button">@lang('Pay with Khalti')
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
        <script
            src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

        <script>

            $(document).ready(function () {
                $('body').addClass('antialiased')
            });

            var config = {
                // replace the publicKey with yours
                "publicKey": "{{$data->publicKey}}",
                "productIdentity": "{{$data->productIdentity}}",
                "productName": "Payment",
                "productUrl": "{{url('/')}}",
                "paymentPreference": [
                    "KHALTI",
                    "EBANKING",
                    "MOBILE_BANKING",
                    "CONNECT_IPS",
                    "SCT",
                ],
                "eventHandler": {
                    onSuccess(payload) {
                        // hit merchant api for initiating verfication
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('khalti.verifyPayment',[$order->transaction]) }}",
                            data: {
                                token: payload.token,
                                amount: payload.amount,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (res) {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('khalti.storePayment') }}",
                                    data: {
                                        response: res,
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    success: function (res) {
                                        window.location.href = "{{route('success')}}"
                                    }
                                });
                            }
                        });
                        // console.log(payload);
                    },
                    onError(error) {
                        console.log(error);
                    },
                    onClose() {
                        console.log('widget is closing');
                    }
                }
            };
            var checkout = new KhaltiCheckout(config);
            var btn = document.getElementById("payment-button");
            btn.onclick = function () {
                // minimum transaction amount must be 10, i.e 1000 in paisa.
                checkout.show({amount: "{{$data->amount *100}}"});
            }
        </script>
    @endpush



@endsection
