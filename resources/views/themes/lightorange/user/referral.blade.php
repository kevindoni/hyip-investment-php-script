@extends($theme.'layouts.user')
@section('title',trans($title))
@section('content')
    @push('navigator')
        <!-- PAGE-NAVIGATOR -->
        <section id="page-navigator">
            <div class="container-fluid">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"
                                                       class="cursor-inherit">{{trans($title)}}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- /PAGE-NAVIGATOR -->
    @endpush

    <section id="dashboard">
        <div class="dashboard-wrapper add-fund pb-50">
            <div id="feature">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card secbg ">
                            <div class="card-header media justify-content-between">
                                <h5 class="card-title mb-3">@lang($title)</h5>
                            </div>

                            <div class="card-body ">
                                <div class="row mb-50">
                                    <div class="col-xl-12">
                                        <div class="form-group form-block br-4">
                                            <h5 class="mb-15">@lang('Referral Link')</h5>
                                            <div class="input-group mb-50">
                                                <input type="text" value="{{route('register.sponsor',[Auth::user()->username])}}"
                                                       class="form-control form-control-lg bg-transparent" id="sponsorURL"
                                                       readonly>
                                                <div class="input-group-append">
                                            <span class="input-group-text copytext" id="copyBoard"
                                                  onclick="copyFunction()">
                                                <i class="fa fa-copy"></i>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                @if(0 < count($referrals))
                                <div class="d-flex align-items-start">
                                    <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        @foreach($referrals as $key => $referral)
                                       <a class="nav-link @if($key == '1')  active  @endif " id="v-pills-{{$key}}-tab" data-toggle="pill" href="#v-pills-{{$key}}"  role="tab" aria-controls="v-pills-{{$key}}" aria-selected="true">@lang('Level') {{$key}}</a>
                                        @endforeach
                                    </div>

                                    <div class="tab-content" id="v-pills-tabContent">

                                        @foreach($referrals as $key => $referral)
                                            <div class="tab-pane fade @if($key == '1') show active  @endif " id="v-pills-{{$key}}" role="tabpanel" aria-labelledby="v-pills-{{$key}}-tab">
                                                @if( 0 < count($referral))
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-striped text-white">
                                                            <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">@lang('Name')</th>
                                                                <th scope="col">@lang('Email')</th>
                                                                <th scope="col">@lang('Phone Number')</th>
                                                                <th scope="col">@lang('Joined At')</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($referral as $user)
                                                                <tr>

                                                                    <td data-label="@lang('Name')">{{$user->username}}</td>
                                                                    <td data-label="@lang('Email')">{{$user->email}}</td>
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
                                    @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
