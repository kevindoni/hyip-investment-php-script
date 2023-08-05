@extends($theme.'layouts.user')
@section('title',__('2 Step Security'))
@push('navigator')
    <!-- PAGE-NAVIGATOR -->
    <section id="page-navigator">
        <div class="container-fluid">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('2 Step Security')</a></li>
                </ol>
            </div>
        </div>
    </section>
    <!-- /PAGE-NAVIGATOR -->
@endpush
@section('content')

    <section id="dashboard">
        <div class="dashboard-wrapper pb-50">
            <div class="row feature-wrapper top-0">
                @if(auth()->user()->two_fa)
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card card-type-1 text-center br-4">
                            <div class="card-header">
                                <h5 class="card-title">@lang('Two Factor Authenticator')</h5>
                            </div>
                            <div class="card-body">

                                <div class="form-group form-block">
                                    <div class="input-group">
                                        <input type="text" value="{{$previousCode}}"
                                               class="form-control form-control-lg bg-transparent" id="referralURL"
                                               readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text copytext" id="copyBoard"
                                                  onclick="copyFunction()">
                                                <i class="fa fa-copy"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mx-auto text-center">
                                    <img class="mx-auto" src="{{$previousQR}}">
                                </div>

                                <div class="form-group mx-auto text-center">
                                    <a href="javascript:void(0)" class="btn btn-block btn-lg btn-danger"
                                       data-toggle="modal" data-target="#disableModal">@lang('Disable Two Factor Authenticator')</a>
                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card card-type-1 text-center br-4">
                            <div class="card-header">
                                <h5 class="card-title">@lang('Two Factor Authenticator')</h5>
                            </div>
                            <div class="card-body">

                                <div class="form-group ">
                                    <div class="input-group ">
                                        <input type="text" value="{{$secret}}"
                                               class="form-control form-control-lg bg-transparent" id="referralURL"
                                               readonly>
                                        <div class="input-group-append">
                                                <span class="input-group-text copytext" id="copyBoard"
                                                      onclick="copyFunction()">
                                                    <i class="fa fa-copy"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mx-auto text-center">
                                    <img class="mx-auto" src="{{$qrCodeUrl}}">
                                </div>

                                <div class="form-group mx-auto text-center">
                                    <a href="javascript:void(0)" class="btn btn-block btn-lg btn-success"
                                       data-toggle="modal"
                                       data-target="#enableModal">@lang('Enable Two Factor Authenticator')</a>
                                </div>
                            </div>

                        </div>
                    </div>

                @endif


                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="card card-type-1 text-center">
                        <div class="card-header">
                            <h5 class="card-title">@lang('Google Authenticator')</h5>
                        </div>
                        <div class="card-body">

                            <h6 class="text-uppercase my-3">@lang('Use Google Authenticator to Scan the QR code  or use the code')</h6>

                            <p class="p-5">@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')</p>
                            <a class="btn btn-success btn-md mt-3"
                               href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                               target="_blank">@lang('DOWNLOAD APP')</a>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>





    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content form-block">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Verify Your OTP')</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="{{route('user.twoStepEnable')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control bg-transparent" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Verify')</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content form-block">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Verify Your OTP to Disable')</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('user.twoStepDisable')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control bg-transparent" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Verify')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>




@endsection



@push('script')
    <script>
        function copyFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success(`Copied: ${copyText.value}`);
        }
    </script>
@endpush

