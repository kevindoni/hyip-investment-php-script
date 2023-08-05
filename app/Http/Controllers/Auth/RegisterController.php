<?php

namespace App\Http\Controllers\Auth;

use App\Http\Traits\Notify;
use App\Models\Admin;
use App\Models\User;
use App\Mail\UserRegisterNotifyMail;
use App\Mail\AdminRegisterNotifyMail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Facades\App\Services\BasicService;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use Notify;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        if (config('basic.registration') == 0) {
            return redirect('/')->with('warning', 'Registration Has Been Disabled.');
        }

        $info = json_decode(json_encode(getIpInfo()), true);
        $country_code  = null;
        if(!empty($info['code'])){
        $country_code = @$info['code'][0];
        }
        $countries = config('country');

        return view(template().'auth.register',compact('country_code','countries'));
    }

    public function sponsor($sponsor)
    {
        if (config('basic.registration') == 0) {
            return redirect('/')->with('warning', 'Registration Has Been Disabled.');
        }

        session()->put('sponsor', $sponsor);
        $info = json_decode(json_encode(getIpInfo()), true);
        $country_code  = null;
        if(!empty($info['code'])){
            $country_code = @$info['code'][0];
        }
        $countries = config('country');

        return view(template().'auth.register', compact('sponsor', 'countries','country_code'));

    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (config('basic.strong_password') == 0) {
            $rules['password'] = ['required', 'min:6', 'confirmed'];
        } else {
            $rules['password'] = ["required", 'confirmed',
                Password::min(6)->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()];
        }

        if (basicControl()->reCaptcha_status_registration) {
            $rules['g-recaptcha-response'] = ['sometimes', 'required','captcha'];
        }

        $rules['firstname'] = ['required', 'string', 'max:91'];
        $rules['lastname'] = ['required', 'string', 'max:91'];
        $rules['username'] = ['required', 'alpha_dash', 'min:5', 'unique:users,username'];
        $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email'];
        $rules['country_code'] = ['max:5'];
        $rules['phone_code'] = ['required'];
        $rules['phone'] = ['required'];
        return Validator::make($data, $rules, [
            'firstname.required' => 'First Name Field is required',
            'lastname.required' => 'Last Name Field is required',
            'g-recaptcha-response.required' => 'The reCAPTCHA field is required.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $basic = (object) config('basic');

        $sponsor = session()->get('sponsor');
        if ($sponsor != null) {
            $sponsorId = User::where('username', $sponsor)->first();
        } else {
            $sponsorId = null;
        }


        return  User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'referral_id' => ($sponsorId != null) ? $sponsorId->id : null,
            'country_code' => $data['country_code'],
            'phone_code' => $data['phone_code'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'email_verification' => ($basic->email_verification) ? 0 : 1,
            'sms_verification' => ($basic->sms_verification) ? 0 : 1,
        ]);

    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $msg = [
            'fullname' => $user->fullname,
        ];
        $action = [
            "link" => route('admin.user-edit',$user->id),
            "icon" => "fas fa-user text-white"
        ];
        $userAction = [
            "link" => "#",
            "icon" => "fas fa-user text-white"
        ];

        $this->adminPushNotification('REGISTER_NEW_USER_NOTIFY_TO_ADMIN', $msg, $action);
        $this->userPushNotification($user, 'REGISTER_NEW_USER_NOTIFY_TO_USER', $msg, $userAction);

        $currentDate = dateTime(Carbon::now());
        $this->sendMailSms($user, $type = 'REGISTER_CONFIRM_MAIL_TO_USER', [
            'name'          => $user->fullname,
            'date'          => $currentDate,
        ]);

        $this->mailToAdmin($type = 'REGISTER_CONFIRM_MAIL_TO_ADMIN', [
            'name' => $user->fullname,
            'email' => $user->email,
            'date'  => $currentDate,
        ]);

        $this->guard()->login($user);


        session()->forget('sponsor');

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        if($request->ajax()) {
            return route('user.home');
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }


    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->last_login = Carbon::now();
        $user->save();

        $basic = (object) config('basic');

        if ($basic->joining_bonus == 1) {
            $amount = $basic->bonus_amount;
            $user->balance += $amount;
            $user->save();
            $remarks = 'You got '.$basic->currency_symbol .getAmount($amount). ' joining bonus.';
            BasicService::makeTransaction($user, getAmount($amount), 0, '+', $balance_type = 'deposit', strRandom(), $remarks);
        }

    }

    protected function guard()
    {
        return Auth::guard();
    }

}
