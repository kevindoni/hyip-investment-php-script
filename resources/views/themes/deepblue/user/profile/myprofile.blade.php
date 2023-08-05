@extends($theme.'layouts.user')
@section('title',trans('Profile Settings'))

@section('content')
    @push('navigator')
        <!-- PAGE-NAVIGATOR -->
        <section id="page-navigator">
            <div class="container-fluid">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"
                                                       class="cursor-inherit">{{trans('Profile Settings')}}</a></li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- /PAGE-NAVIGATOR -->
    @endpush

    <section id="dashboard">
        <div class="dashboard-wrapper add-fund pb-50">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card secbg br-4">
                        <div class="card-body br-4">
                            <form method="post" action="{{ route('user.updateProfile') }}"
                                  enctype="multipart/form-data">
                                <div class="form-group">
                                    @csrf
                                    <div class="image-input ">
                                        <label for="image-upload" id="image-label"><i
                                                class="fas fa-upload"></i></label>
                                        <input type="file" name="image" placeholder="Choose image" id="image">
                                        <img id="image_preview_container" class="preview-image"
                                             style="max-width: 200px"
                                             src="{{getFile(config('location.user.path').$user->image)}}"
                                             alt="preview image">
                                    </div>
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                                <h4 class="text-center mb-2">@lang($user->fullname) <sup><sapn class="badge badge-pill bg-outline-success badge_lavel_style text-white border-1">{{ @$user->rank->rank_lavel }}</sapn></sup></h4>
                                <h5 class="text-center mt-2 mb-3">@lang(@$user->rank->rank_name)</h5>
                                <p class="text-center mb-2">@lang('Joined At') @lang($user->created_at->format('d M, Y g:i A'))</p>
                                <div class="submit-btn-wrapper text-center text-md-left">
                                    <button type="submit" class=" btn btn-primary base-btn btn-block btn-rounded">
                                        <span>@lang('Image Update')</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card secbg form-block br-4">
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ $errors->has('profile') ? 'active' : (($errors->has('password') || $errors->has('identity') || $errors->has('addressVerification')) ? '' : ' active') }}"
                                       data-toggle="tab" href="#home">@lang('Profile Information')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $errors->has('password') ? 'active' : '' }}"
                                       data-toggle="tab"
                                       href="#menu1">@lang('Password Setting')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $errors->has('identity') ? 'active' : '' }}"
                                       data-toggle="tab"
                                       href="#identity">@lang('Identity Verification')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $errors->has('addressVerification') ? 'active' : '' }}"
                                       data-toggle="tab"
                                       href="#addressVerification">@lang('Address Verification')</a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content ">
                                <div id="home"
                                     class="container mt-4 tab-pane  {{ $errors->has('profile') ? ' active' : (($errors->has('password') || $errors->has('identity') || $errors->has('addressVerification')) ? '' :  ' active') }}">

                                    <form action="{{ route('user.updateInformation')}}" method="post">
                                        @method('put')
                                        @csrf

                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>@lang('First Name')</label>
                                                    <input class="form-control" type="text" name="firstname"
                                                           value="{{old('firstname')?: $user->firstname }}">
                                                    @if($errors->has('firstname'))
                                                        <div
                                                            class="error text-danger">@lang($errors->first('firstname')) </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>@lang('Last Name')</label>
                                                    <input class="form-control" type="text" name="lastname"
                                                           value="{{old('lastname')?: $user->lastname }}">
                                                    @if($errors->has('lastname'))
                                                        <div
                                                            class="error text-danger">@lang($errors->first('lastname')) </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>@lang('Username')</label>
                                                    <input class="form-control" type="text" name="username"
                                                           value="{{old('username')?: $user->username }}">
                                                    @if($errors->has('username'))
                                                        <div
                                                            class="error text-danger">@lang($errors->first('username')) </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>@lang('Email Address')</label>
                                                    <input class="form-control" type="email"
                                                           value="{{ $user->email }}" readonly>
                                                    @if($errors->has('email'))
                                                        <div
                                                            class="error text-danger">@lang($errors->first('email')) </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>@lang('Phone Number')</label>
                                                    <input class="form-control" type="text" readonly
                                                           value="{{$user->phone}}">

                                                    @if($errors->has('phone'))
                                                        <div
                                                            class="error text-danger">@lang($errors->first('phone')) </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>@lang('Preferred language')</label>

                                                    <select name="language_id" id="language_id" class="form-control">
                                                        <option value="" disabled>@lang('Select Language')</option>
                                                        @foreach($languages as $la)
                                                            <option value="{{$la->id}}"

                                                                {{ old('language_id', $user->language_id) == $la->id ? 'selected' : '' }}>@lang($la->name)</option>
                                                        @endforeach
                                                    </select>

                                                    @if($errors->has('language_id'))
                                                        <div
                                                            class="error text-danger">@lang($errors->first('language_id')) </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label>@lang('Address')</label>
                                            <textarea class="form-control" name="address"
                                                      rows="5">@lang($user->address)</textarea>

                                            @if($errors->has('address'))
                                                <div
                                                    class="error text-danger">@lang($errors->first('address')) </div>
                                            @endif
                                        </div>

                                        <div class="submit-btn-wrapper text-center text-md-left">
                                            <button type="submit"
                                                    class="btn btn-primary base-btn btn-block btn-rounded">
                                                <span>@lang('Update User')</span></button>
                                        </div>
                                    </form>
                                </div>


                                <div id="menu1"
                                     class="container mt-4 tab-pane {{ $errors->has('password') ? 'active' : '' }}">

                                    <form method="post" action="{{ route('user.updatePassword') }}">
                                        @csrf
                                        <div class="form-group mt-4">
                                            <label>@lang('Current Password')</label>
                                            <input id="password" type="password" class="form-control"
                                                   name="current_password" autocomplete="off">
                                            @if($errors->has('current_password'))
                                                <div
                                                    class="error text-danger">@lang($errors->first('current_password')) </div>
                                            @endif
                                        </div>
                                        <div class="form-group mt-4">
                                            <label>@lang('New Password')</label>
                                            <input id="password" type="password" class="form-control"
                                                   name="password" autocomplete="off">
                                            @if($errors->has('password'))
                                                <div
                                                    class="error text-danger">@lang($errors->first('password')) </div>
                                            @endif
                                        </div>

                                        <div class="form-group ">
                                            <label>@lang('Confirm Password')</label>
                                            <input id="password_confirmation" type="password"
                                                   name="password_confirmation" autocomplete="off"
                                                   class="form-control">
                                            @if($errors->has('password_confirmation'))
                                                <div
                                                    class="error text-danger">@lang($errors->first('password_confirmation')) </div>
                                            @endif
                                        </div>

                                        <div class="submit-btn-wrapper text-center">
                                            <button type="submit"
                                                    class=" btn btn-primary base-btn btn-block btn-rounded">
                                                <span>@lang('Update Password')</span></button>
                                        </div>
                                    </form>
                                </div>


                                <div id="identity"
                                     class="container mt-4 tab-pane {{ $errors->has('identity') ? 'active' : '' }}">
                                    @if(in_array($user->identity_verify,[0,3])  )
                                        @if($user->identity_verify == 3)
                                            <div class="alert alert-danger" role="alert">
                                                @lang('You previous request has been rejected')
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('user.verificationSubmit')}}"
                                              enctype="multipart/form-data">
                                            @csrf


                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label class="form-label"
                                                           for="identity_type">@lang('Identity Type')</label>
                                                    <select name="identity_type" id="identity_type"
                                                            class="form-control ">
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
                                            </div>
                                            @if(isset($identityForm))
                                                @foreach($identityForm->services_form as $k => $v)
                                                    @if($v->type == "text")
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label
                                                                    for="{{$k}}">{{trans($v->field_level)}} @if($v->validation == 'required')
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
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label
                                                                    for="{{$k}}">{{trans($v->field_level)}} @if($v->validation == 'required')
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
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                        <span class="text-danger">*</span>  @endif
                                                                </label>

                                                                <br>
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

                                                <div class="submit-btn-wrapper text-center text-md-left">
                                                    <button type="submit"
                                                            class="  btn btn-primary base-btn btn-block btn-rounded">@lang('Submit')</button>
                                                </div>
                                            @endif
                                        </form>
                                    @elseif($user->identity_verify == 1)
                                        <div class="alert alert-warning" role="alert">
                                            @lang('Your KYC submission has been pending')
                                        </div>
                                    @elseif($user->identity_verify == 2)
                                        <div class="alert alert-success" role="alert">
                                            @lang('Your KYC already verified')
                                        </div>
                                    @endif
                                </div>

                                <div id="addressVerification"
                                     class="container mt-4 tab-pane {{ $errors->has('addressVerification') ? 'active' : '' }}">
                                    @if(in_array($user->address_verify,[0,3])  )
                                        @if($user->address_verify == 3)
                                            <div class="alert alert-danger" role="alert">
                                                @lang('You previous request has been rejected')
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('user.addressVerification')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">{{trans('Address Proof')}} <span
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


                                            <div class="submit-btn-wrapper text-center text-md-left">
                                                <button type="submit"
                                                        class=" btn btn-primary base-btn btn-block btn-rounded">@lang('Submit')</button>
                                            </div>

                                        </form>
                                    @elseif($user->address_verify == 1)
                                        <div class="alert alert-warning" role="alert">
                                            @lang('Your KYC submission has been pending')
                                        </div>
                                    @elseif($user->address_verify == 2)
                                        <div class="alert alert-success" role="alert">
                                            @lang('Your KYC already verified')
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

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
