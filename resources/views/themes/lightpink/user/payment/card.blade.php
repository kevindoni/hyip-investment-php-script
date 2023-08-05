@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection

@section('content')
    @push('style')
        <link href="{{ asset('assets/admin/css/card-js.min.css') }}" rel="stylesheet" type="text/css"/>
        <style>
            .card-js .icon {
                top: 5px;
            }
        </style>
    @endpush


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
                <div class="card secbg br-4 bg-light">
                    <div class="card-body">
                        <div class="row ">

                            <div class="col-md-12">
                                <h3 class="card-title text-center mb-4"> @lang('Your Card Information')</h3>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <img
                                        src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}"
                                        class="card-img-top gateway-img" alt="..">
                                </div>
                            </div>

                            <div class="col-md-9">
                                <form class="form-horizontal" id="example-form"
                                      action="{{ route('ipn', [optional($order->gateway)->code ?? '', $order->transaction]) }}"
                                      method="post">
                                    <div class="card-js form-group --payment-card">
                                        <input class="card-number form-control"
                                               name="card_number"
                                               placeholder="@lang('Enter your card number')"
                                               autocomplete="off"
                                               required>
                                        <input class="name form-control"
                                               id="the-card-name-id"
                                               name="card_name"
                                               placeholder="@lang('Enter the name on your card')"
                                               autocomplete="off"
                                               required>
                                        <input class="expiry form-control"
                                               autocomplete="off"
                                               required>
                                        <input class="expiry-month" name="expiry_month">
                                        <input class="expiry-year" name="expiry_year">
                                        <input class="cvc form-control"
                                               name="card_cvc"
                                               autocomplete="off"
                                               required>
                                    </div>
                                    <button type="submit" class="btn btn-bg mt-3 strpe___btn">@lang('Submit')</button>
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
        <script src="{{ asset('assets/admin/js/card-js.min.js') }}"></script>
    @endpush

@endsection
