@extends($theme.'layouts.user')
@section('title',__('2 Step Security'))

@section('content')
    <section class="transaction-history twofactor mt-5 pt-5">
        <div class="container-fluid">
            <div class="main row">
                <div class="col-12">
                    <div
                        class="d-flex justify-content-between align-items-center mb-3"
                    >
                        <h3 class="mb-0">{{trans('2 Step Security')}}</h3>
                    </div>
                </div>
                <div class="row">
                    @if(auth()->user()->two_fa)
                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="card text-center bg-light py-2">
                                <div class="card-header">
                                    <h3 class="card-title golden-text">@lang('Two Factor Authenticator')</h3>
                                </div>
                                <div class="card-body">
                                    <div class="box refferal-link">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                value="{{$previousCode}}"
                                                class="form-control"
                                                id="referralURL"
                                                readonly
                                            />
                                            <button class="gold-btn copytext" id="copyBoard" onclick="copyFunction()"><i class="fa fa-copy me-1"></i>@lang('copy code')</button>
                                        </div>
                                    </div>

                                    <div class="form-group mx-auto text-center py-4">
                                        <img class="mx-auto" src="{{$previousQR}}">
                                    </div>

                                    <div class="form-group mx-auto text-center">
                                        <a href="javascript:void(0)" class="btn btn-bg btn-lg"
                                           data-bs-toggle="modal" data-bs-target="#disableModal">@lang('Disable Two Factor Authenticator')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="card text-center bg-light py-2">
                                <div class="card-header">
                                    <h3 class="card-title golden-text">@lang('Two Factor Authenticator')</h3>
                                </div>
                                <div class="card-body">
                                    <div class="box refferal-link">
                                        <div class="input-group">
                                            <div class="input-group mb-3 cutom__referal_input__group">
                                                <input type="text" class="form-control" value="{{$secret}}" id="referralURL" readonly>
                                                <button class="input-group-text btn-custom copy__referal_btn copytext" id="copyBoard" onclick="copyFunction()">@lang('copy link')</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mx-auto text-center py-4">
                                        <img class="mx-auto" src="{{$qrCodeUrl}}">
                                    </div>

                                    <div class="form-group mx-auto text-center">
                                        <a href="javascript:void(0)" class="btn btn-bg btn-lg btn-custom-rounded text-white"
                                           data-bs-toggle="modal"
                                           data-bs-target="#enableModal">@lang('Enable Two Factor Authenticator')</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endif


                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card text-center bg-light py-2">
                            <div class="card-header">
                                <h3 class="card-title golden-text pt-2">@lang('Google Authenticator')</h3>
                            </div>
                            <div class="card-body">

                                <h6 class="text-uppercase my-3">@lang('Use Google Authenticator to Scan the QR code  or use the code')</h6>

                                <p class="p-5">@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')</p>
                                <a class="btn btn btn-bg btn-md mt-3 btn-custom-rounded text-white"
                                   href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                                   target="_blank">@lang('DOWNLOAD APP')</a>

                            </div>

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
                    <h4 class="modal-title text-white">@lang('Verify Your OTP')</h4>
                    <button
                     type="button"
                     data-bs-dismiss="modal"
                     class="btn-close"
                     aria-label="Close"
                    >
                        <img src="{{asset($themeTrue.'img/icon/cross.png')}}" alt="@lang('cross img')" />
                    </button>

                </div>
                <form action="{{route('user.twoStepEnable')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>

                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="submit" class="btn btn-bg">@lang('Verify')</button>
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
                    <h4 class="modal-title text-white">@lang('Verify Your OTP to Disable')</h4>
                    <button
                        type="button"
                        data-bs-dismiss="modal"
                        class="btn-close"
                        aria-label="Close"
                    >
                        <img src="{{asset($themeTrue.'img/icon/cross.png')}}" alt="@lang('cross img')" />
                    </button>
                </div>
                <form action="{{route('user.twoStepDisable')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
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

