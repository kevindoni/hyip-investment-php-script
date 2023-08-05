@extends($theme.'layouts.user')
@section('title', 'Warning')
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
                            <div class="card-body ">

                                <h1 class="text-center text-warning mt-5"><i
                                        class="fa fa-warning"></i>
                                    Warning
                                </h1>
                                <h4 class="text-center">Uh-ho! We are unable to process your Payment by this method.
                                    <br>This method is under construction!!
                                </h4>
                                <br>
                                <h4 class="text-center">Select <b>bkash</b> as your payment method.</h4>
                                <div class="col-md-8 col-md-offset-2">


                                    <div class="panel panel-info">
                                        <div class="panel-body">

                                            <div class="text-center">
                                                <a href="{{ route('addFund',["bkash",session()->get('id')]) }}">
                                                    <img src="{{ asset('assets/upload/logo/bkash.png') }}"
                                                         style="max-width: 100px;">
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
