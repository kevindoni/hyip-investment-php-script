@extends($theme.'layouts.user')
@section('title',trans('Profile Settings'))

@section('content')

    <!-- main -->
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="dashboard-heading">
                    <h4 class="mb-0">@lang('Edit Profile')</h4>
                </div>

                <section class="profile-setting">
                    <div class="row g-4 g-lg-5">
                        <div class="col-lg-4">
                            <div class="sidebar-wrapper">
                                <form method="post" action="{{ route('user.updateProfile') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="profile">
                                        <div class="img">
                                            <img id="profile"
                                                 src="{{getFile(config('location.user.path').$user->image)}}"
                                                 alt="@lang('preview user image')" class="img-fluid"/>
                                            <button class="upload-img">
                                                <i class="fal fa-camera"></i>
                                                <input
                                                    class="form-control"
                                                    accept="image/*"
                                                    type="file"
                                                    name="image"
                                                    id="image"
                                                    onchange="previewImage('profile')"/>
                                            </button>
                                            @error('image')
                                            <span class="text-danger mb-2">{{$message}}</span>
                                            @enderror
                                        </div>


                                        <div class="text">
                                            <h5 class="name">@lang(ucfirst($user->username))</h5>
                                            <span>{{ $user->email }}</span>
                                            <div>
                                                <button class="btn-custom mt-2 p-2 text-white"
                                                        type="submit">@lang('Submit Changes')</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="profile-navigator">
                                    <button tab-id="tab1" class="tab {{ $errors->has('profile') ? 'active' : (($errors->has('password') || $errors->has('identity') || $errors->has('addressVerification')) ? '' : ' active') }}">
                                        <i class="fal fa-user"></i> @lang('Profile information')
                                    </button>
                                    <button tab-id="tab2" class="tab {{ $errors->has('password') ? 'active' : '' }}">
                                        <i class="fal fa-key"></i> @lang('Password setting')
                                    </button>
                                    <button tab-id="tab3" class="tab {{ $errors->has('identity') ? 'active' : '' }}">
                                        <i class="fal fa-id-card"></i> @lang('identity verification')
                                    </button>
                                    <button tab-id="tab4" class="tab {{ $errors->has('addressVerification') ? 'active' : '' }}">
                                        <i class="fal fa-map-marked-alt"></i>
                                        @lang('address verification')
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div id="tab1" class="content {{ $errors->has('profile') ? ' active' : (($errors->has('password') || $errors->has('identity') || $errors->has('addressVerification')) ? '' :  ' active') }}">
                                <form action="{{ route('user.updateInformation')}}" method="post">
                                    @method('put')
                                    @csrf
                                    <div class="row g-4">
                                        <div class="input-box col-md-6">
                                            <label for="">@lang('First Name')</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname"
                                                   value="{{old('firstname')?: $user->firstname }}"/>
                                            @if($errors->has('firstname'))
                                                <div class="error text-danger">@lang($errors->first('firstname'))</div>
                                            @endif
                                        </div>

                                        <div class="input-box col-md-6">
                                            <label for="">@lang('Last Name')</label>
                                            <input type="text" id="lastname" name="lastname" class="form-control"
                                                   value="{{old('lastname')?: $user->lastname }}"/>
                                            @if($errors->has('lastname'))
                                                <div class="error text-danger">@lang($errors->first('lastname'))</div>
                                            @endif
                                        </div>

                                        <div class="input-box col-md-6">
                                            <label for="">@lang('Username')</label>
                                            <input type="text" id="username" name="username"
                                                   value="{{old('username')?: $user->username }}" class="form-control"/>
                                            @if($errors->has('username'))
                                                <div class="error text-danger">@lang($errors->first('username'))</div>
                                            @endif
                                        </div>
                                        <div class="input-box col-md-6">
                                            <label for="">@lang('Email Address')</label>
                                            <input type="email" id="email" value="{{ $user->email }}" readonly
                                                   class="form-control"/>
                                            @if($errors->has('email'))
                                                <div class="error text-danger">@lang($errors->first('email'))</div>
                                            @endif
                                        </div>
                                        <div class="input-box col-md-6">
                                            <label for="">@lang('Phone Number')</label>
                                            <input type="text" id="phone" readonly class="form-control"
                                                   value="{{$user->phone}}"/>
                                            @if($errors->has('phone'))
                                                <div class="error text-danger">@lang($errors->first('phone'))</div>
                                            @endif
                                        </div>
                                        <div class="input-box col-md-6">
                                            <label for="">@lang('Preferred language')</label>
                                            <select class="js-example-basic-single form-control form-select"
                                                    name="language_id"
                                                    id="language_id"
                                                    aria-label="Default select example">
                                                <option value="" disabled>@lang('Select Language')</option>
                                                @foreach($languages as $la)
                                                    <option
                                                        value="{{$la->id}}" {{ old('language_id', $user->language_id) == $la->id ? 'selected' : '' }}>
                                                        @lang($la->name)
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('language_id'))
                                                <div
                                                    class="error text-danger">@lang($errors->first('language_id'))</div>
                                            @endif
                                        </div>

                                        <div class="input-box col-12">
                                            <label for="">@lang('Address')</label>
                                            <textarea class="form-control" id="address" name="address" cols="30"
                                                      rows="3">{{$user->address}}</textarea>
                                            @if($errors->has('address'))
                                                <div class="error text-danger">@lang($errors->first('address'))</div>
                                            @endif
                                        </div>
                                        <div class="input-box col-12">
                                            <button class="btn-custom">@lang('Update')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="tab2" class="content {{ $errors->has('password') ? 'active' : '' }}">
                                <form method="post" action="{{ route('user.updatePassword') }}">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="input-box col-md-6">
                                            <label for="">@lang('Current Password')</label>
                                            <input type="password" id="current_password" name="current_password"
                                                   autocomplete="off" class="form-control"
                                                   placeholder="@lang('Enter Current Password')"/>
                                            @if($errors->has('current_password'))
                                                <div
                                                    class="error text-danger">@lang($errors->first('current_password'))</div>
                                            @endif
                                        </div>

                                        <div class="input-box col-md-6">
                                            <label for="">@lang('New Password')</label>
                                            <input type="password" id="password" name="password" autocomplete="off"
                                                   class="form-control" placeholder="@lang('Enter New Password')"/>
                                            @if($errors->has('password'))
                                                <div class="error text-danger">@lang($errors->first('password'))</div>
                                            @endif
                                        </div>
                                        <div class="input-box col-md-6">
                                            <label for="">@lang('Confirm Password')</label>
                                            <input type="password" id="password_confirmation"
                                                   name="password_confirmation" autocomplete="off" class="form-control"
                                                   placeholder="@lang('Confirm Password')"/>
                                            @if($errors->has('password_confirmation'))
                                                <div
                                                    class="error text-danger">@lang($errors->first('password_confirmation'))</div>
                                            @endif
                                        </div>
                                        <div class="input-box col-12">
                                            <button class="btn-custom" type="submit">@lang('Update Password')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="tab3" class="content {{ $errors->has('identity') ? 'active' : '' }}">
                                @if(in_array($user->identity_verify,[0,3]))
                                    @if($user->identity_verify == 3)
                                        <div class="alert mb-0">
                                            <i class="fal fa-times-circle"></i>
                                            <span>@lang('You previous request has been rejected')</span>
                                        </div>
                                    @endif
                                    <form method="post" action="{{route('user.verificationSubmit')}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-box col-md-12">
                                            <label for="">@lang('Identity Type')</label>
                                            <select class="js-example-basic-single form-control d-block"
                                                    name="identity_type" id="identity_type">
                                                <option value="" selected disabled>@lang('Select Type')</option>
                                                @foreach($identityFormList as $sForm)
                                                    <option
                                                        value="{{$sForm->slug}}" {{ old('identity_type', @$identity_type) == $sForm->slug ? 'selected' : '' }}>@lang($sForm->name)</option>
                                                @endforeach
                                            </select>
                                            @error('identity_type')
                                            <div class="error text-danger">@lang($message) </div>
                                            @enderror
                                        </div>

                                        @if(isset($identityForm))
                                            @foreach($identityForm->services_form as $k => $v)
                                                @if($v->type == "text")
                                                    <div class="col-md-12 mb-2">
                                                        <div class="input-box">
                                                            <label
                                                                for="{{$k}}"
                                                                class="golden-text">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                    <span class="text-danger">*</span>
                                                                @endif
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
                                                        <div class="input-box">
                                                            <label
                                                                for="{{$k}}"
                                                                class="golden-text">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                    <span
                                                                        class="text-danger">*</span>
                                                                @endif
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
                                                            <label
                                                                class="golden-text">{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                    <span class="text-danger">*</span>
                                                                @endif
                                                            </label>

                                                            <br>
                                                            <div class="fileinput fileinput-new "
                                                                 data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail "
                                                                     data-trigger="fileinput">
                                                                    <img class="w-150px"
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
                                                <button type="submit" class="btn-custom mt-2">
                                                    @lang('Submit')
                                                </button>
                                        @endif
                                    </form>
                                @elseif($user->identity_verify == 1)
                                        <div class="alert mb-0">
                                            <i class="fal fa-times-circle text-warning"></i>
                                            <span class="text-warning">@lang('Your KYC submission has been pending')</span>
                                        </div>
                                @elseif($user->identity_verify == 2)
                                    <div class="alert mb-0">
                                        <i class="fal fa-times-circle text-success"></i>
                                        <span class="text-success">@lang('Your KYC already verified')</span>
                                    </div>
                                @endif
                            </div>

                            <div id="tab4" class="content {{ $errors->has('addressVerification') ? 'active' : '' }}">
                                @if(in_array($user->address_verify,[0,3]))
                                    @if($user->address_verify == 3)
                                        <div class="alert mb-0">
                                            <i class="fal fa-check-circle text-danger"></i>
                                            <span>@lang('You previous request has been rejected')</span>
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
                                                            <img class="w-150px "
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

                                            <button type="submit" class="btn-custom">
                                                @lang('Submit')
                                            </button>

                                        </form>
                                @elseif($user->address_verify == 1)
                                    <div class="alert mb-0">
                                        <i class="fal fa-check-circle text-warning"></i>
                                        <span>@lang('Your KYC submission has been pending')</span>
                                    </div>
                                @elseif($user->address_verify == 2)
                                    <div class="alert mb-0">
                                        <i class="fal fa-check-circle text-success"></i>
                                        <span>@lang('Your KYC already verified')</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
@push('css-lib')
    <link rel="stylesheet" href="{{asset($themeTrue.'css/bootstrap-fileinput.css')}}">
@endpush

@push('extra-js')
    <script src="{{asset($themeTrue.'js/bootstrap-fileinput.js')}}"></script>
@endpush

@push('script')
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
