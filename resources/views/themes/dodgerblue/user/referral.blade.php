@extends($theme.'layouts.user')
@section('title',trans($title))
@section('content')

    <!-- My Referral -->
    <section class="refferal-link">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h3 class="ms-2 mb-0 mt-2">{{trans($title)}}</h3>
                    </div>
                </div>
            </div>
            <div class="main row mt-4">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="card-box refferal-box">
                        <h5>@lang("Your referral link")</h5>
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control"
                                value="{{route('register.sponsor',[Auth::user()->username])}}"
                                id="sponsorURL"
                                disabled=""/>
                            <button id="copyBtn" onclick="copyText('sponsorURL')" class="btn text-white">
                                @lang('Copy Link')
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @if(0 < count($referrals))
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-start " id="ref-label">
                            <div class="nav flex-column nav-pills mx-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach($referrals as $key => $referral)
                                    <a class=" nav-link @if($key == '1')   active  @endif " id="v-pills-{{$key}}-tab" href="javascript:void(0)" data-bs-toggle="pill" data-bs-target="#v-pills-{{$key}}"  role="tab" aria-controls="v-pills-{{$key}}" aria-selected="true">@lang('Level') {{$key}}</a>
                                @endforeach
                            </div>
                            <div class="tab-content w-90" id="v-pills-tabContent">
                                @foreach($referrals as $key => $referral)
                                    <div class="tab-pane fade @if($key == '1') show active  @endif " id="v-pills-{{$key}}" role="tabpanel" aria-labelledby="v-pills-{{$key}}-tab">
                                        @if( 0 < count($referral))
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">@lang('Username')</th>
                                                        <th scope="col">@lang('Email')</th>
                                                        <th scope="col">@lang('Phone Number')</th>
                                                        <th scope="col">@lang('Joined At')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($referral as $user)
                                                        <tr>

                                                            <td data-label="@lang('Username')">
                                                                @lang($user->username)
                                                            </td>
                                                            <td data-label="@lang('Email')" class="">{{$user->email}}</td>
                                                            <td data-label="@lang('Phone Number')">
                                                                {{$user->mobile}}
                                                            </td>
                                                            <td data-label="@lang('Joined At')">
                                                                {{dateTime($user->created_at)}}
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>



@endsection

@push('script')

    <script>
        "use strict";
        function copyFunction() {
            var copyText = document.getElementById("sponsorURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success(`Copied: ${copyText.value}`);
        }
    </script>

@endpush
