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

         <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card secbg br-4 bg-darkBlack">
                    <div class="card-body br-4">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <img
                                    src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}"
                                    class="card-img-top gateway-img" alt="..">
                            </div>

                            <div class="col-md-9">
                                <h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                <h4 class="mt-15 mb-15">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h4>

                                <form action="{{$data->url}}" method="{{$data->method}}">
                                    <script src="{{$data->checkout_js}}"
                                            @foreach($data->val as $key=>$value)
                                            data-{{$key}}="{{$value}}"
                                        @endforeach >
                                    </script>
                                    <input type="hidden" custom="{{$data->custom}}" name="hidden">
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    @push('script')
        <script>
            $(document).ready(function () {
                $('input[type="submit"]').addClass(" btn-custom2 btn btn-bg bg-darkBlue text-white p-2 mt-4");
            })
        </script>
    @endpush

@endsection




