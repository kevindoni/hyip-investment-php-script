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


    <section id="feature" class="about-page secbg-1 py-5">
        <div class="feature-wrapper add-fund">

            <div class="container-fluid">
                <div class="row justify-content-center">

                    <div class="col-md-8">
                        <div class="card secbg">
                            <div class="card-body text-center">
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
    </section>


@endsection

