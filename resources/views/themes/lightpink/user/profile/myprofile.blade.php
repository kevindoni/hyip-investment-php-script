@extends($theme.'layouts.user')
@section('title',trans('Profile Settings'))

@section('content')

    <section class="profile-setting">
        <div class="container-fluid">
            <div class="main row">
                <div class="col-12">
                    <div
                        class="d-flex justify-content-between align-items-center mb-3"
                    >
                        <h3 class="mb-0">@lang('Profile Settings')</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="upload-img">
                                <form method="post" action="{{ route('user.updateProfile') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="img-box">
                                        <input
                                            accept="image/*"
                                            name="image"
                                            type="file"
                                            id="image"
                                            onchange="previewImage()"
                                        />
                                        <span class="select-file text-white"
                                        >@lang('Choose image')</span
                                        >
                                        <img
                                            id="frame"
                                            src="{{getFile(config('location.user.path').$user->image)}}"
                                            alt="@lang('preview user image')"
                                        />
                                    </div>
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                    <h3 class="golden-text">@lang(ucfirst($user->username)) <sup><sapn class="badge badge-pill bg-outline-success badge_lavel_style text-white border-1">{{ @$user->rank->rank_lavel }}</sapn></sup></h3>
                                    <h4> @lang(@$user->rank->rank_name)</h4>
                                    <p>@lang('Joined At') @lang($user->created_at->format('d M, Y g:i A'))</p>
                                    <button class="gold-btn btn-custom">@lang('Image Update')</button>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="edit-area">
                                <div class="profile-navigator">
                                    <button
                                        tab-id="tab1"
                                        class="darkblue-text-bold tab {{ $errors->has('profile') ? 'active' : (($errors->has('password') || $errors->has('identity') || $errors->has('addressVerification')) ? '' : ' active') }}"
                                    >
                                        @lang('Profile Information')
                                    </button>
                                    <button tab-id="tab2" class="darkblue-text-bold tab {{ $errors->has('password') ? 'active' : '' }}">
                                        @lang('Password Setting')
                                    </button>
                                    <button tab-id="tab3" class="darkblue-text-bold tab {{ $errors->has('identity') ? 'active' : '' }}">
                                        @lang('Identity Verification')
                                    </button>
                                    <button tab-id="tab4" class="darkblue-text-bold tab {{ $errors->has('addressVerification') ? 'active' : '' }}">
                                        @lang('Address Verification')
                                    </button>
                                </div>

                                <div id="tab1" class="content {{ $errors->has('profile') ? ' active' : (($errors->has('password') || $errors->has('identity') || $errors->has('addressVerification')) ? '' :  ' active') }}">
                                    <form action="{{ route('user.updateInformation')}}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="firstname" class="golden-text">@lang('First Name')</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="firstname"
                                                    id="firstname"
                                                    value="{{old('firstname')?: $user->firstname }}"
                                                />
                                                @if($errors->has('firstname'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('firstname'))
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label for="lastname" class="golden-text">@lang('Last Name')</label>
                                                <input
                                                    type="text"
                                                    id="lastname"
                                                    name="lastname"
                                                    class="form-control"
                                                    value="{{old('lastname')?: $user->lastname }}"
                                                />
                                                @if($errors->has('lastname'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('lastname'))
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label for="username" class="golden-text">@lang('Username')</label>
                                                <input
                                                    type="text"
                                                    id="username"
                                                    name="username"
                                                    value="{{old('username')?: $user->username }}"
                                                    class="form-control"
                                                />
                                                @if($errors->has('username'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('username'))
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label for="email" class="golden-text">@lang('Email Address')</label>
                                                <input
                                                    type="email"
                                                    id="email"
                                                    value="{{ $user->email }}"
                                                    readonly
                                                    class="form-control"
                                                />
                                                @if($errors->has('email'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('email'))
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label for="phone" class="golden-text">@lang('Phone Number')</label>
                                                <input
                                                    type="text"
                                                    id="phone"
                                                    readonly
                                                    class="form-control"
                                                    value="{{$user->phone}}"
                                                />
                                                @if($errors->has('phone'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('phone'))
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label for="language_id" class="golden-text">@lang('Preferred language')</label>
                                                <select
                                                    class="form-select"
                                                    name="language_id"
                                                    id="language_id"
                                                    aria-label="Default select example"
                                                >
                                                    <option value="" disabled>@lang('Select Language')</option>
                                                    @foreach($languages as $la)
                                                        <option value="{{$la->id}}" {{ old('language_id', $user->language_id) == $la->id ? 'selected' : '' }}>
                                                            @lang($la->name)
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('language_id'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('language_id'))
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 mb-4">
                                                <label for="address" class="golden-text">@lang('Address')</label>
                                                <textarea
                                                    class="form-control"
                                                    id="address"
                                                    name="address"
                                                    cols="30"
                                                    rows="3"
                                                >@lang($user->address)</textarea>
                                                @if($errors->has('address'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('address'))
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                        <button type="submit" class="gold-btn btn-custom">@lang('Update User')</button>
                                    </form>
                                </div>

                                <div id="tab2" class="content {{ $errors->has('password') ? 'active' : '' }}">
                                    <form method="post" action="{{ route('user.updatePassword') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="current_password" class="golden-text">@lang('Current Password')</label>
                                                <input
                                                    type="password"
                                                    id="current_password"
                                                    name="current_password"
                                                    autocomplete="off"
                                                    class="form-control"
                                                    placeholder="@lang('Enter Current Password')"
                                                />
                                                @if($errors->has('current_password'))
                                                    <div class="error text-danger">@lang($errors->first('current_password'))</div>
                                                @endif
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label for="password" class="golden-text">@lang('New Password')</label>
                                                <input
                                                    type="password"
                                                    id="password"
                                                    name="password"
                                                    autocomplete="off"
                                                    class="form-control"
                                                    placeholder="@lang('Enter New Password')"
                                                />
                                                @if($errors->has('password'))
                                                    <div class="error text-danger">@lang($errors->first('password'))</div>
                                                @endif
                                            </div>

                                            <div class="col-12 mb-4">
                                                <label for="password_confirmation" class="golden-text">@lang('Confirm Password')</label>
                                                <input
                                                    type="password"
                                                    id="password_confirmation"
                                                    name="password_confirmation"
                                                    autocomplete="off"
                                                    class="form-control"
                                                    placeholder="@lang('Confirm Password')"
                                                />
                                                @if($errors->has('password_confirmation'))
                                                    <div class="error text-danger">@lang($errors->first('password_confirmation'))</div>
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="gold-btn btn-custom">
                                            @lang('Update Password')
                                        </button>
                                    </form>
                                </div>

                                <div id="tab3" class="content {{ $errors->has('identity') ? 'active' : '' }}">
                                    @if(in_array($user->identity_verify,[0,3])  )
                                        @if($user->identity_verify == 3)
                                            <div class="alert mb-0">
                                                <img src="{{asset($themeTrue.'img/icon/cross.png')}}" alt="@lang('cross img')"/>
                                                <span>@lang('You previous request has been rejected')</span>
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('user.verificationSubmit')}}"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="col-md-12 mb-3">
                                                <div class="form-group input-group">
                                                    <label class="form-label d-block w-100 golden-text"
                                                           for="identity_type">@lang('Identity Type')</label>
                                                    <select name="identity_type" id="identity_type"
                                                            class="form-control d-block">
                                                        <option class="text-dark bg-light" value="" selected disabled>@lang('Select Type')</option>
                                                        @foreach($identityFormList as $sForm)
                                                            <option class="text-dark bg-light"
                                                                    value="{{$sForm->slug}}" {{ old('identity_type', @$identity_type) == $sForm->slug ? 'selected' : '' }}>@lang($sForm->name)</option>
                                                        @endforeach
                                                    </select>
                                                    @error('identity_type')
                                                    <div class="error text-danger">@lang($message) </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            @if(isset($identityForm))
                                                @foreach($identityForm->services_form as $k => $v)
                                                    @if($v->type == "text")
                                                        <div class="col-md-12 mb-2">
                                                            <div class="form-group">
                                                                <label
                                                                    for="{{$k}}" class="golden-text">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                        <span class="text-danger">*</span>  @endif
                                                                </label>
                                                                <input type="text" name="{{$k}}"
                                                                       class="form-control "
                                                                       value="{{old($k)}}" id="{{$k}}"
                                                                       @if($v->validation == 'required') required @endif>

                                                                @if($errors->has($k))
                                                                    <div
                                                                        class="error text-danger">@lang($errors->first($k)) </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    @elseif($v->type == "textarea")
                                                        <div class="col-md-12 mb-2">
                                                            <div class="form-group">
                                                                <label
                                                                    for="{{$k}}" class="golden-text">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                        <span
                                                                            class="text-danger">*</span>  @endif
                                                                </label>
                                                                <textarea name="{{$k}}" id="{{$k}}"
                                                                          class="form-control "
                                                                          rows="5"
                                                                          placeholder="{{trans('Type Here')}}"
                                                            @if($v->validation == 'required')@endif>{{old($k)}}</textarea>
                                                                @error($k)
                                                                <div class="error text-danger">
                                                                    {{trans($message)}}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @elseif($v->type == "file")
                                                        <div class="col-md-12 mb-2">
                                                            <div class="form-group">
                                                                <label class="golden-text">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                        <span class="text-danger">*</span>  @endif
                                                                </label>

                                                                <br>
                                                                <div class="fileinput fileinput-new "
                                                                     data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail "
                                                                         data-trigger="fileinput">
                                                                        <img class="w-25 d-flex justify-content-start"
                                                                             src="{{ getFile(config('location.default')) }}"
                                                                             alt="...">
                                                                    </div>
                                                                    <div
                                                                        class="fileinput-preview fileinput-exists thumbnail wh-200-150 "></div>

                                                                    <div class="img-input-div">
                                                        <span class="btn btn-success btn-file">
                                                            <span
                                                                class="fileinput-new "> @lang('Select') {{$v->field_level}}</span>
                                                            <span
                                                                class="fileinput-exists"> @lang('Change')</span>
                                                            <input type="file" name="{{$k}}"
                                                                   value="{{ old($k) }}" accept="image/*"
                                                                    @if($v->validation == "required")@endif>
                                                        </span>
                                                                        <a href="#"
                                                                           class="btn btn-danger fileinput-exists"
                                                                           data-dismiss="fileinput"> @lang('Remove')</a>
                                                                    </div>

                                                                </div>

                                                                @error($k)
                                                                <div class="error text-danger">
                                                                    {{trans($message)}}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif

                                                @endforeach

                                                <button type="submit" class="gold-btn mt-2 btn-custom">
                                                    @lang('Submit')
                                                </button>
                                            @endif
                                        </form>
                                    @elseif($user->identity_verify == 1)
                                        <div class="alert mb-0">
                                            <img src="{{asset($themeTrue.'img/icon/notification.png')}}" alt="@lang('notification img')"/>
                                            <span> @lang('Your KYC submission has been pending')</span>
                                        </div>
                                    @elseif($user->identity_verify == 2)
                                        <div class="alert mb-0">
                                            <i aria-hidden="true" class="far fa-bell mr-2"></i>
                                            <span> @lang('Your KYC already verified')</span>
                                        </div>
                                    @endif
                                </div>

                                <div id="tab4" class="content {{ $errors->has('addressVerification') ? 'active' : '' }}">
                                    @if(in_array($user->address_verify,[0,3])  )
                                        @if($user->address_verify == 3)
                                            <div class="alert mb-0">
                                                <i aria-hidden="true" class="far fa-bell mr-2"></i>
                                                <span> @lang('You previous request has been rejected')</span>
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('user.addressVerification')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label class="form-label golden-text">{{trans('Address Proof')}} <span
                                                            class="text-danger">*</span> </label><br>

                                                    <div class="fileinput fileinput-new "
                                                         data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail "
                                                             data-trigger="fileinput">
                                                            <img class="w-25 d-flex justify-content-start"
                                                                 src="{{ getFile(config('location.default')) }}"
                                                                 alt="...">
                                                        </div>
                                                        <div
                                                            class="fileinput-preview fileinput-exists thumbnail wh-200-150 "></div>

                                                        <div class="img-input-div">
                                                        <span class="btn btn-success btn-file">
                                                            <span
                                                                class="fileinput-new "> @lang('Select Image') </span>
                                                            <span
                                                                class="fileinput-exists"> @lang('Change')</span>
                                                            <input type="file" name="addressProof"
                                                                   value="{{ old('addressProof')}}"
                                                                   accept="image/*">
                                                        </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists"
                                                               data-dismiss="fileinput"> @lang('Remove')</a>
                                                        </div>

                                                    </div>

                                                    @error('addressProof')
                                                    <div class="error text-danger">
                                                        {{trans($message)}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <button type="submit" class="gold-btn btn-custom">
                                                @lang('Submit')
                                            </button>

                                        </form>
                                    @elseif($user->address_verify == 1)
                                        <div class="alert mb-0">
                                            <img src="{{asset($themeTrue.'img/icon/notification.png')}}" alt="@lang('notification img')"/>
                                            <span> @lang('Your KYC submission has been pending')</span>
                                        </div>
                                    @elseif($user->address_verify == 2)
                                        <div class="alert mb-0">
                                            <img src="{{asset($themeTrue.'img/icon/notification.png')}}" alt="@lang('notification img')"/>
                                            <span> @lang('Your KYC already verified')</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>>
    </section>

@endsection
@push('css-lib')
    <link rel="stylesheet" href="{{asset($themeTrue.'css/bootstrap-fileinput.css')}}">
@endpush

@push('script')
    <script src="{{asset($themeTrue.'js/bootstrap-fileinput.js')}}"></script>
    <script>
        "use strict";
        $(document).on('click', '#image-label', function () {
            $('#image').trigger('click');
        });
        $(document).on('change', '#image', function () {
            var _this = $(this);
            var newimage = new FileReader();
            newimage.readAsDataURL(this.files[0]);
            newimage.onload = function (e) {
                $('#image_preview_container').attr('src', e.target.result);
            }
        });


        $(document).on('change', "#identity_type", function () {
            let value = $(this).find('option:selected').val();
            window.location.href = "{{route('user.profile')}}/?identity_type=" + value
        });

    </script>
@endpush
