<?php

namespace App\Http\Controllers\Auth;

use App\Models\Ranking;
use App\Template;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Traits\Notify;

class LoginController extends Controller
{
    use Notify;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->theme = template();
        $this->middleware('guest')->except('logout');
    }


    public function loginModal(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if($this->guard()->validate($this->credentials($request))){
            if(Auth::attempt([$this->username() => $request->username, 'password' =>  $request->password, 'status' =>  1])){
                $user = Auth::user();
                $user->last_login = Carbon::now();
                $user->save();
                $request->session()->regenerate();
                return route('user.home');
            }else{
                return response()->json('You are banned from this application. Please contact with system Adminstrator.',401);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }



    public function login(Request $request)
    {

        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->guard()->validate($this->credentials($request))) {
            if (Auth::attempt([$this->username() => $request->username, 'password' => $request->password,'status'=>1])) {
                return $this->sendLoginResponse($request);
            } else {
                return back()->with('error', 'You are banned from this application. Please contact with system Administrator.');
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }



    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {

        $validateData = [
			$this->username() => 'required|string',
			'password' => 'required|string',
		];

		if (basicControl()->reCaptcha_status_login) {
			$validateData['g-recaptcha-response'] = 'sometimes|required|captcha';
		}

		$request->validate($validateData, [
            'g-recaptcha-response.required' => 'The reCAPTCHA field is required.',
        ]);
    }

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function showLoginForm()
    {
        return view($this->theme . 'auth.login');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/login');
    }



    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $user->last_login = Carbon::now();
        $user->two_fa_verify = ($user->two_fa == 1) ? 0 : 1;
        $user->save();

        if ($user) {

            $interestBalance = $user->total_interest_balance; //5
            $investBalance = $user->total_invest; //50
            $depositBalance = $user->total_deposit; //5.0

            $badges = Ranking::where([
                ['min_invest', '<=', $investBalance],
                ['min_deposit', '<=', $depositBalance],
                ['min_earning', '<=', $interestBalance]])->where('status', 1)->get();



            if ($badges) {
                foreach ($badges as $badge) {
                    if (($user->total_invest >= $badge->min_invest) && ($user->total_deposit >= $badge->min_deposit) && ($user->total_interest_balance >= $badge->min_earning)) {
                        $user->last_lavel = $badge->rank_lavel;
                        $user->save();
                        $userBadge = $badge;
                    }
                }



                if (isset($userBadge) && ($user->last_lavel == NULL ||  $userBadge->rank_lavel != $user->last_lavel) ) {
                    $user->last_lavel = $userBadge->rank_lavel;
                    $user->save();

                    $msg = [
                        'user' => $user->fullname,
                        'badge' => $userBadge->rank_lavel,
                    ];

                    $adminAction = [
                        "link" => route('admin.users'),
                        "icon" => "fa fa-user text-white"
                    ];

                    $userAction = [
                        "link" => route('user.profile'),
                        "icon" => "fa fa-user text-white"
                    ];

                    $user->userPushNotification($user, 'BADGE_NOTIFY_TO_USER', $msg, $userAction);
                    $user->adminPushNotification('BADGE_NOTIFY_TO_ADMIN', $msg, $adminAction);

                    $currentDate = Carbon::now();
                    $user->sendMailSms($user, $type = 'BADGE_MAIL_TO_USER', [
                        'user' => $user->fullname,
                        'badge' => $userBadge->rank_lavel,
                        'date' => $currentDate
                    ]);

                    $user->mailToAdmin($type = 'BADGE_MAIL_TO_ADMIN', [
                        'user' => $user->fullname,
                        'badge' => $userBadge->rank_lavel,
                        'date' => $currentDate
                    ]);
                }

            }
        }


        $currentDate = dateTime(Carbon::now());
        $msg = [
            'name' => $user->fullname,
        ];

        $action = [
            "link" => "#",
            "icon" => "fas fa-user text-white"
        ];

        $this->userPushNotification($user, 'LOGIN_NOTIFY_TO_USER', $msg, $action);

        $this->sendMailSms($user, $type = 'LOGIN_MAIL_TO_USER', [
            'name'          => $user->fullname,
            'last_login_time' => $currentDate
        ]);

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return \Illuminate\Support\Facades\Auth::guard();
    }

}
