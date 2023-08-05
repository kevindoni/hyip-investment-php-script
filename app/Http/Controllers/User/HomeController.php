<?php

namespace App\Http\Controllers\User;

use App\Helper\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Fund;
use App\Models\Gateway;
use App\Models\IdentifyForm;
use App\Models\Investment;
use App\Models\KYC;
use App\Models\Language;
use App\Models\ManagePlan;
use App\Models\ManageTime;
use App\Models\MoneyTransfer;
use App\Models\PayoutLog;
use App\Models\PayoutMethod;
use App\Models\PayoutSetting;
use App\Models\Ranking;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Facades\App\Services\BasicService;

use hisorange\BrowserDetect\Parser as Browser;

class HomeController extends Controller
{
    use Upload, Notify;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->theme = template();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['walletBalance'] = getAmount($this->user->balance);
        $data['interestBalance'] = getAmount($this->user->interest_balance);
        $data['totalDeposit'] = getAmount($this->user->funds()->whereNull('plan_id')->whereStatus(1)->sum('amount'));
        $data['totalPayout'] = getAmount($this->user->payout()->whereStatus(2)->sum('amount'));
        $data['depositBonus'] = getAmount($this->user->referralBonusLog()->where('type', 'deposit')->sum('amount'));
        $data['investBonus'] = getAmount($this->user->referralBonusLog()->where('type', 'invest')->sum('amount'));
        $data['lastBonus'] = getAmount(optional($this->user->referralBonusLog()->latest()->first())->amount);

        $data['totalInterestProfit'] = getAmount($this->user->transaction()->where('balance_type', 'interest_balance')->where('trx_type', '+')->sum('amount'));

        $roi = Investment::where('user_id', $this->user->id)
            ->selectRaw('SUM( amount ) AS totalInvestAmount')
            ->selectRaw('COUNT( id ) AS totalInvest')
            ->selectRaw('COUNT(CASE WHEN status = 0  THEN id END) AS completed')
            ->selectRaw('COUNT(CASE WHEN status = 1  THEN id END) AS running')
            ->selectRaw('SUM(CASE WHEN maturity != -1  THEN maturity * profit END) AS expectedProfit')
            ->selectRaw('SUM(recurring_time * profit) AS returnProfit')
            ->get()->makeHidden('nextPayment')->toArray();
        $data['roi'] = collect($roi)->collapse();
        $data['ticket'] = Ticket::where('user_id', $this->user->id)->count();

        $monthlyInvestment = collect(['January' => 0, 'February' => 0, 'March' => 0, 'April' => 0, 'May' => 0, 'June' => 0, 'July' => 0, 'August' => 0, 'September' => 0, 'October' => 0, 'November' => 0, 'December' => 0]);
        Investment::where('user_id', $this->user->id)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->makeHidden('nextPayment')->map(function ($item) use ($monthlyInvestment) {
                $monthlyInvestment->put($item['months'], round($item['totalAmount'], 2));
            });
        $monthly['investment'] = $monthlyInvestment;


        $monthlyPayout = collect(['January' => 0, 'February' => 0, 'March' => 0, 'April' => 0, 'May' => 0, 'June' => 0, 'July' => 0, 'August' => 0, 'September' => 0, 'October' => 0, 'November' => 0, 'December' => 0]);
        $this->user->payout()->whereStatus(2)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->map(function ($item) use ($monthlyPayout) {
                $monthlyPayout->put($item['months'], round($item['totalAmount'], 2));
            });
        $monthly['payout'] = $monthlyPayout;


        $monthlyFunding = collect(['January' => 0, 'February' => 0, 'March' => 0, 'April' => 0, 'May' => 0, 'June' => 0, 'July' => 0, 'August' => 0, 'September' => 0, 'October' => 0, 'November' => 0, 'December' => 0]);
        $this->user->funds()->whereNull('plan_id')->whereStatus(1)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->map(function ($item) use ($monthlyFunding) {
                $monthlyFunding->put($item['months'], round($item['totalAmount'], 2));
            });
        $monthly['funding'] = $monthlyFunding;

        $monthlyReferralInvestBonus = collect(['January' => 0, 'February' => 0, 'March' => 0, 'April' => 0, 'May' => 0, 'June' => 0, 'July' => 0, 'August' => 0, 'September' => 0, 'October' => 0, 'November' => 0, 'December' => 0]);
        $this->user->referralBonusLog()->where('type', 'invest')
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->map(function ($item) use ($monthlyReferralInvestBonus) {
                $monthlyReferralInvestBonus->put($item['months'], round($item['totalAmount'], 2));
            });

        $monthly['referralInvestBonus'] = $monthlyReferralInvestBonus;


        $monthlyReferralFundBonus = collect(['January' => 0, 'February' => 0, 'March' => 0, 'April' => 0, 'May' => 0, 'June' => 0, 'July' => 0, 'August' => 0, 'September' => 0, 'October' => 0, 'November' => 0, 'December' => 0]);

        $this->user->referralBonusLog()->where('type', 'deposit')
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->map(function ($item) use ($monthlyReferralFundBonus) {
                $monthlyReferralFundBonus->put($item['months'], round($item['totalAmount'], 2));
            });
        $monthly['referralFundBonus'] = $monthlyReferralFundBonus;


        $latestRegisteredUser = User::where('referral_id', $this->user->id)->latest()->first();


        return view($this->theme . 'user.dashboard', $data, compact('monthly', 'latestRegisteredUser'));
    }


    public function transaction()
    {
        $transactions = $this->user->transaction()->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view($this->theme . 'user.transaction.index', compact('transactions'));
    }

    public function transactionSearch(Request $request)
    {
        $search = $request->all();
        $dateSearch = $request->datetrx;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $transaction = Transaction::where('user_id', $this->user->id)->with('user')
            ->when(@$search['transaction_id'], function ($query) use ($search) {
                return $query->where('trx_id', 'LIKE', "%{$search['transaction_id']}%");
            })
            ->when(@$search['remark'], function ($query) use ($search) {
                return $query->where('remarks', 'LIKE', "%{$search['remark']}%");
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->paginate(config('basic.paginate'));
        $transactions = $transaction->appends($search);


        return view($this->theme . 'user.transaction.index', compact('transactions'));

    }

    public function fundHistory()
    {
        $funds = Fund::where('user_id', $this->user->id)->where('status', '!=', 0)->where('plan_id', null)->orderBy('id', 'DESC')->with('gateway')->paginate(config('basic.paginate'));
        return view($this->theme . 'user.transaction.fundHistory', compact('funds'));
    }

    public function fundHistorySearch(Request $request)
    {
        $search = $request->all();

        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $funds = Fund::orderBy('id', 'DESC')->where('user_id', $this->user->id)->where('status', '!=', 0)
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->where('transaction', 'LIKE', $search['name']);
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->with('gateway')
            ->paginate(config('basic.paginate'));
        $funds->appends($search);

        return view($this->theme . 'user.transaction.fundHistory', compact('funds'));

    }


    public function addFund()
    {
        if (session()->get('plan_id') != null) {
            return redirect(route('user.payment'));
        }

        $data['totalPayment'] = null;
        $data['gateways'] = Gateway::where('status', 1)->orderBy('sort_by', 'ASC')->get();

        return view($this->theme . 'user.addFund', $data);
    }

    public function payment()
    {
        $encPlanId = session()->get('plan_id');
        if ($encPlanId == null) {
            return redirect(route('user.addFund'));
        }
        $plan = ManagePlan::where('id', decrypt($encPlanId))->where('status', 1)->firstOrFail();
        $amount = session()->get('amount');
        $data['totalPayment'] = decrypt($amount);
        $data['gateways'] = Gateway::where('status', 1)->orderBy('sort_by', 'ASC')->get();
        $data['plan'] = $plan;
        return view($this->theme . 'user.payment', $data);
    }


    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), []);
        $data['user'] = $this->user;
        $data['languages'] = Language::all();
        $data['identityFormList'] = IdentifyForm::where('status', 1)->get();
        if ($request->has('identity_type')) {
            $validator->errors()->add('identity', '1');
            $data['identity_type'] = $request->identity_type;
            $data['identityForm'] = IdentifyForm::where('slug', trim($request->identity_type))->where('status', 1)->firstOrFail();
            return view($this->theme . 'user.profile.myprofile', $data)->withErrors($validator);
        }
        return view($this->theme . 'user.profile.myprofile', $data);
    }


    public function updateProfile(Request $request)
    {
        $allowedExtensions = array('jpg', 'png', 'jpeg');

        $image = $request->image;
        $this->validate($request, [
            'image' => [
                'required',
                'max:4096',
                function ($fail) use ($image, $allowedExtensions) {
                    $ext = strtolower($image->getClientOriginalExtension());
                    if (($image->getSize() / 1000000) > 2) {
                        throw ValidationException::withMessages(['image' => 'Images MAX  2MB ALLOW!']);
                    }
                    if (!in_array($ext, $allowedExtensions)) {
                        throw ValidationException::withMessages(['image' => 'Only png, jpg, jpeg images are allowed']);
                    }
                }
            ]
        ]);

        $user = $this->user;
        if ($request->hasFile('image')) {
            $path = config('location.user.path');
            try {
                $user->image = $this->uploadImage($image, $path);
            } catch (\Exception $exp) {
                return back()->with('error', 'Could not upload your ' . $image)->withInput();
            }
        }
        $user->save();

        $msg = [
            'name' => $user->fullname,
        ];

        $adminAction = [
            "link" => route('admin.user-edit', $user->id),
            "icon" => "fas fa-user text-white"
        ];
        $userAction = [
            "link" => route('user.profile'),
            "icon" => "fas fa-user text-white"
        ];

        $this->adminPushNotification('ADMIN_NOTIFY_USER_PROFILE_UPDATE', $msg, $adminAction);
        $this->userPushNotification($user, 'USER_NOTIFY_HIS_PROFILE_UPDATE', $msg, $userAction);

        $currentDate = dateTime(Carbon::now());
        $this->sendMailSms($user, $type = 'USER_MAIL_HIS_PROFILE_UPDATE', [
            'name' => $user->fullname,
            'date' => $currentDate,
        ]);

        $this->mailToAdmin($type = 'ADMIN_MAIL_USER_PROFILE_UPDATE', [
            'name' => $user->fullname,
            'date' => $currentDate,
        ]);

        return back()->with('success', 'Updated Successfully.');
    }


    public function updateInformation(Request $request)
    {

        $languages = Language::all()->map(function ($item) {
            return $item->id;
        });

        $req = Purify::clean($request->all());
        $user = $this->user;
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => "sometimes|required|alpha_dash|min:5|unique:users,username," . $user->id,
            'address' => 'required',
            'language_id' => Rule::in($languages),
        ];
        $message = [
            'firstname.required' => 'First Name field is required',
            'lastname.required' => 'Last Name field is required',
        ];

        $validator = Validator::make($req, $rules, $message);
        if ($validator->fails()) {
            $validator->errors()->add('profile', '1');
            return back()->withErrors($validator)->withInput();
        }
        $user->language_id = $req['language_id'];
        $user->firstname = $req['firstname'];
        $user->lastname = $req['lastname'];
        $user->username = $req['username'];
        $user->address = $req['address'];
        $user->save();

        $msg = [
            'name' => $user->fullname,
        ];

        $adminAction = [
            "link" => route('admin.user-edit', $user->id),
            "icon" => "fas fa-user text-white"
        ];
        $userAction = [
            "link" => route('user.profile'),
            "icon" => "fas fa-user text-white"
        ];

        $this->adminPushNotification('ADMIN_NOTIFY_USER_PROFILE_INFORMATION_UPDATE', $msg, $adminAction);
        $this->userPushNotification($user, 'USER_NOTIFY_HIS_PROFILE_INFORMATION_UPDATE', $msg, $userAction);

        $currentDate = dateTime(Carbon::now());
        $this->sendMailSms($user, $type = 'USER_MAIL_HIS_PROFILE_INFORMATION_UPDATE', [
            'name' => $user->fullname,
            'date' => $currentDate,
        ]);

        $this->mailToAdmin($type = 'ADMIN_MAIL_USER_PROFILE_INFORMATION_UPDATE', [
            'name' => $user->fullname,
            'date' => $currentDate,
        ]);
        return back()->with('success', 'Updated Successfully.');
    }


    public function updatePassword(Request $request)
    {

        $rules = [
            'current_password' => "required",
            'password' => "required|min:5|confirmed",
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->errors()->add('password', '1');
            return back()->withErrors($validator)->withInput();
        }
        $user = $this->user;
        try {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->password);
                $user->save();

                $msg = [
                    'name' => $user->fullname,
                ];

                $adminAction = [
                    "link" => route('admin.user-edit', $user->id),
                    "icon" => "fas fa-user text-white"
                ];
                $userAction = [
                    "link" => route('user.profile'),
                    "icon" => "fas fa-user text-white"
                ];

                $this->adminPushNotification('ADMIN_NOTIFY_USER_PROFILE_PASSWORD_UPDATE', $msg, $adminAction);
                $this->userPushNotification($user, 'USER_NOTIFY_HIS_PROFILE_PASSWORD_UPDATE', $msg, $userAction);

                $currentDate = dateTime(Carbon::now());
                $this->sendMailSms($user, $type = 'USER_MAIL_HIS_PROFILE_PASSWORD_UPDATE', [
                    'name' => $user->fullname,
                    'date' => $currentDate,
                ]);

                $this->mailToAdmin($type = 'ADMIN_MAIL_USER_PROFILE_PASSWORD_UPDATE', [
                    'name' => $user->fullname,
                    'date' => $currentDate,
                ]);

                return back()->with('success', 'Password Changes successfully.');
            } else {
                throw new \Exception('Current password did not match');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function twoStepSecurity()
    {
        $basic = (object)config('basic');
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($this->user->username . '@' . $basic->site_title, $secret);
        $previousCode = $this->user->two_fa_code;

        $previousQR = $ga->getQRCodeGoogleUrl($this->user->username . '@' . $basic->site_title, $previousCode);
        return view($this->theme . 'user.twoFA.index', compact('secret', 'qrCodeUrl', 'previousCode', 'previousQR'));
    }

    public function twoStepEnable(Request $request)
    {
        $user = $this->user;
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

        $userCode = $request->code;
        if ($oneCode == $userCode) {
            $user['two_fa'] = 1;
            $user['two_fa_verify'] = 1;
            $user['two_fa_code'] = $request->key;
            $user->save();
            $browser = new Browser();
            $this->mail($user, 'TWO_STEP_ENABLED', [
                'action' => 'Enabled',
                'code' => $user->two_fa_code,
                'ip' => request()->ip(),
                'browser' => @$browser->browserName() . ', ' . @$browser->platformName(),
                'time' => date('d M, Y h:i:s A'),
            ]);
            return back()->with('success', 'Google Authenticator Has Been Enabled.');
        } else {
            return back()->with('error', 'Wrong Verification Code.');
        }


    }


    public function twoStepDisable(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);
        $user = $this->user;
        $ga = new GoogleAuthenticator();

        $secret = $user->two_fa_code;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {
            $user['two_fa'] = 0;
            $user['two_fa_verify'] = 1;
            $user['two_fa_code'] = null;
            $user->save();
            $browser = new Browser();
            $this->mail($user, 'TWO_STEP_DISABLED', [
                'action' => 'Disabled',
                'ip' => request()->ip(),
                'browser' => @$browser->browserName() . ', ' . @$browser->platformName(),
                'time' => date('d M, Y h:i:s A'),
            ]);

            return back()->with('success', 'Google Authenticator Has Been Disabled.');
        } else {
            return back()->with('error', 'Wrong Verification Code.');
        }
    }

    public function purchasePlan(Request $request)
    {
        $this->validate($request, [
            'balance_type' => 'required',
            'amount' => 'required|numeric',
            'plan_id' => 'required',
        ]);

        $user = $this->user;
        $plan = ManagePlan::where('id', $request->plan_id)->where('status', 1)->first();
        if (!$plan) {
            return back()->with('error', 'Invalid Plan Request');
        }

        $timeManage = ManageTime::where('time', $plan->schedule)->first();

        $balance_type = $request->balance_type;
        if (!in_array($balance_type, ['balance', 'interest_balance', 'checkout'])) {
            return back()->with('error', 'Invalid Wallet Type');
        }


        $amount = $request->amount;
        $basic = (object)config('basic');
        if ($plan->fixed_amount == '0' && $amount < $plan->minimum_amount) {
            return back()->with('error', "Invest Limit " . $plan->price);
        } elseif ($plan->fixed_amount == '0' && $amount > $plan->maximum_amount) {
            return back()->with('error', "Invest Limit " . $plan->price);
        } elseif ($plan->fixed_amount != '0' && $amount != $plan->fixed_amount) {
            return back()->with('error', "Please invest " . $plan->price);
        }

        if ($balance_type == "checkout") {
            session()->put('amount', encrypt($amount));
            session()->put('plan_id', encrypt($plan->id));
            return redirect()->route('user.payment');
        }

        if ($amount > $user->$balance_type) {
            return back()->with('error', 'Insufficient Balance');
        }

        $new_balance = getAmount($user->$balance_type - $amount);
        $user->$balance_type = $new_balance;
        $user->total_invest += $request->amount;
        $user->save();

        $trx = strRandom();
        $remarks = 'Invested On ' . $plan->name;
        BasicService::makeTransaction($user, $amount, 0, $trx_type = '-', $balance_type, $trx, $remarks);


        $profit = ($plan->profit_type == 1) ? ($amount * $plan->profit) / 100 : $plan->profit;
        $maturity = ($plan->is_lifetime == 1) ? '-1' : $plan->repeatable;

        //// For Fixed Plan
        if ($plan->fixed_amount != 0 && ($plan->fixed_amount == $amount)) {
            BasicService::makeInvest($user, $plan, $amount, $profit, $maturity, $timeManage, $trx);
        } elseif ($plan->fixed_amount == 0) {
            BasicService::makeInvest($user, $plan, $amount, $profit, $maturity, $timeManage, $trx);
        }

        if ($basic->investment_commission == 1) {
            BasicService::setBonus($user, $request->amount, $type = 'invest');
        }

        $currentDate = Carbon::now();
        $msg = [
            'username' => $user->username,
            'amount' => getAmount($amount),
            'currency' => $basic->currency_symbol,
            'plan_name' => $plan->name
        ];
        $action = [
            "link" => route('admin.user.plan-purchaseLog', $user->id),
            "icon" => "fa fa-money-bill-alt "
        ];
        $userAction = [
            "link" => route('user.invest-history'),
            "icon" => "fa fa-money-bill-alt "
        ];
        $this->adminPushNotification('PLAN_PURCHASE_NOTIFY_TO_ADMIN', $msg, $action);
        $this->userPushNotification($user, 'PLAN_PURCHASE_NOTIFY_TO_USER', $msg, $userAction);

        $this->sendMailSms($user, $type = 'PLAN_PURCHASE_MAIL_TO_USER', [
            'transaction_id' => $trx,
            'amount' => getAmount($amount),
            'currency' => $basic->currency_symbol,
            'profit_amount' => $profit,
        ]);

        $this->mailToAdmin($type = 'PLAN_PURCHASE_MAIL_TO_ADMIN', [
            'username' => $user->username,
            'amount' => getAmount($amount),
            'currency' => $basic->currency_symbol,
            'plan_name' => $plan->name,
            'date' => $currentDate,
        ]);

        return back()->with('success', 'Plan has been Purchased Successfully');
    }


    public function investHistory()
    {
        $investments = $this->user->invests()->paginate(config('basic.paginate'));
        return view($this->theme . 'user.transaction.investLog', compact('investments'));
    }


    /*
     * User payout Operation
     */
    public function payoutMoney()
    {
        $data['title'] = "Payout Money";
        $data['gateways'] = PayoutMethod::whereStatus(1)->get();
        $data['payoutSettings'] = PayoutSetting::first();
        $data['today'] = Str::lower(Carbon::now()->format('l'));
        return view($this->theme . 'user.payout.money', $data);
    }

    public function payoutMoneyRequest(Request $request)
    {
        $this->validate($request, [
            'wallet_type' => ['required', Rule::in(['balance', 'interest_balance'])],
            'gateway' => 'required|integer',
            'amount' => ['required', 'numeric']
        ]);


        $basic = (object)config('basic');
        $method = PayoutMethod::where('id', $request->gateway)->where('status', 1)->firstOrFail();
        $authWallet = $this->user;

        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);

        $finalAmo = $request->amount + $charge;

        if ($request->amount < $method->minimum_amount) {
            session()->flash('error', 'Minimum payout Amount ' . round($method->minimum_amount, 2) . ' ' . $basic->currency);
            return back();
        }
        if ($request->amount > $method->maximum_amount) {
            session()->flash('error', 'Maximum payout Amount ' . round($method->maximum_amount, 2) . ' ' . $basic->currency);
            return back();
        }

        if (getAmount($finalAmo) > $authWallet[$request->wallet_type]) {
            session()->flash('error', 'Insufficient ' . snake2Title($request->wallet_type) . ' For Withdraw.');
            return back();
        } else {
            $trx = strRandom();
            $withdraw = new PayoutLog();
            $withdraw->user_id = $authWallet->id;
            $withdraw->method_id = $method->id;
            $withdraw->amount = getAmount($request->amount);
            $withdraw->charge = $charge;
            $withdraw->net_amount = $finalAmo;
            $withdraw->trx_id = $trx;
            $withdraw->status = 0;
            $withdraw->balance_type = $request->wallet_type;
            $withdraw->save();
            session()->put('wtrx', $trx);
            return redirect()->route('user.payout.preview');
        }
    }


    public function payoutPreview()
    {
        $withdraw = PayoutLog::latest()->where('trx_id', session()->get('wtrx'))->where('status', 0)->latest()->with('method', 'user')->firstOrFail();
        $payoutMethod = $withdraw->method;
        $title = "Payout Form";
        $layout = 'layouts.user';
        if ($withdraw['balance_type'] == 'balance') {
            $wallet = auth()->user()->balance;
        } else {
            $wallet = auth()->user()->interest_balance;
        }
        $remaining = getAmount($wallet - $withdraw->net_amount);
        if ($payoutMethod->code == 'flutterwave') {
            return view($this->theme . 'user.payout.gateway.' . $payoutMethod->code, compact('withdraw', 'title', 'remaining', 'layout', 'payoutMethod'));
        } elseif ($payoutMethod->code == 'paystack') {
            return view($this->theme . 'user.payout.gateway.' . $payoutMethod->code, compact('withdraw', 'title', 'remaining', 'layout', 'payoutMethod'));
        }
        return view($this->theme . 'user.payout.preview', compact('withdraw', 'title', 'remaining', 'payoutMethod'));
    }

    public function getBankList(Request $request)
    {
        $currencyCode = $request->currencyCode;
        $methodObj = 'App\\Services\\Payout\\paystack\\Card';
        $data = $methodObj::getBank($currencyCode);
        return $data;
    }

    public function getBankForm(Request $request)
    {
        $bankName = $request->bankName;
        $bankArr = config('banks.' . $bankName);

        if ($bankArr['api'] != null) {

            $methodObj = 'App\\Services\\Payout\\flutterwave\\Card';
            $data = $methodObj::getBank($bankArr['api']);
            $value['bank'] = $data;
        }
        $value['input_form'] = $bankArr['input_form'];
        return $value;
    }

    public function paystackPayout(Request $request, $trx_id)
    {
        $payout = PayoutLog::where('trx_id', $trx_id)->firstOrFail();
        $payoutMethod = PayoutMethod::find($payout->method_id);
        $user = $this->user;

        $purifiedData = Purify::clean($request->all());

        if (empty($purifiedData['bank'])) {
            return back()->with('alert', 'Bank field is required')->withInput();
        }

        $rules = [];
        $inputField = [];
        if ($payoutMethod->input_form != null) {
            foreach ($payoutMethod->input_form as $key => $cus) {

                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], 'mimes:jpeg,jpg,png');
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $rules['type'] = 'required';
        $rules['currency'] = 'required';

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        if (getAmount($payout->net_amount) > $user[$payout->balance_type]) {
            session()->flash('error', 'Insufficient balance For Payout.');
            return redirect()->route('user.payout.money');
        }

        $collection = collect($purifiedData);
        $reqField = [];
        if ($payoutMethod->input_form != null) {
            foreach ($collection as $k => $v) {
                foreach ($payoutMethod->input_form as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->file($inKey) && $request->file($inKey)->isValid()) {
                                $extension = $request->$inKey->extension();
                                $fileName = strtolower(strtotime("now") . '.' . $extension);
                                $storedPath = config('location.withdrawLog.path');
                                $imageMake = Image::make($purifiedData[$inKey]);
                                $imageMake->save($storedPath);

                                $reqField[$inKey] = [
                                    'fieldValue' => $fileName,
                                    'type' => $inVal->type,
                                ];
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'fieldValue' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $reqField['type'] = [
                'fieldValue' => $request->type,
                'type' => 'text',
            ];
            $reqField['bank_code'] = [
                'fieldValue' => $request->bank,
                'type' => 'text',
            ];
            $reqField['amount'] = [
                'fieldValue' => $payout->amount * convertRate($request->currency, $payout),
                'type' => 'text',
            ];
            $payout->information = $reqField;
        } else {
            $payout->information = null;
        }
        $payout->currency_code = $request->currency_code;
        $payout->status = 1;
        $payout->save();


        $user[$payout->balance_type] = $user[$payout->balance_type] - $payout->net_amount;
        $user->save();

        $remarks = 'Withdraw Via ' . optional($payout->method)->name;
        BasicService::makeTransaction($user, $payout->amount, $payout->charge, '-', $payout->balance_type, $payout->trx_id, $remarks);

        $this->userNotify($user, $payout);

        return redirect(route('user.payout.money'))->with('success', 'Withdraw request Successfully Submitted. Wait For Confirmation.');
    }


    public function flutterwavePayout(Request $request, $trx_id)
    {
        $payout = PayoutLog::where('trx_id', $trx_id)->first();
        $payoutMethod = PayoutMethod::find($payout->method_id);
        $user = $this->user;

        $purifiedData = Purify::clean($request->all());

        if (empty($purifiedData['transfer_name'])) {
            return back()->with('alert', 'Transfer field is required');
        }
        $validation = config('banks.' . $purifiedData['transfer_name'] . '.validation');

        $rules = [];
        $inputField = [];
        if ($validation != null) {
            foreach ($validation as $key => $cus) {
                $rules[$key] = 'required';
                $inputField[] = $key;
            }
        }

        if (getAmount($payout->net_amount) > $user[$payout->balance_type]) {
            session()->flash('error', 'Insufficient balance For Withdraw.');
            return redirect()->route('user.payout.money');
        }

        if ($request->transfer_name == 'NGN BANK' || $request->transfer_name == 'NGN DOM' || $request->transfer_name == 'GHS BANK'
            || $request->transfer_name == 'KES BANK' || $request->transfer_name == 'ZAR BANK' || $request->transfer_name == 'ZAR BANK') {
            $rules['bank'] = 'required';
        }

        $rules['currency_code'] = 'required';

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $collection = collect($purifiedData);
        $reqField = [];
        $metaField = [];

        if (config('banks.' . $purifiedData['transfer_name'] . '.input_form') != null) {
            foreach ($collection as $k => $v) {
                foreach (config('banks.' . $purifiedData['transfer_name'] . '.input_form') as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {

                        if ($inVal == 'meta') {
                            $metaField[$inKey] = $v;
                            $metaField[$inKey] = [
                                'fieldValue' => $v,
                                'type' => 'text',
                            ];
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'fieldValue' => $v,
                                'type' => 'text',
                            ];
                        }
                    }
                }
            }

            if ($request->transfer_name == 'NGN BANK' || $request->transfer_name == 'NGN DOM' || $request->transfer_name == 'GHS BANK'
                || $request->transfer_name == 'KES BANK' || $request->transfer_name == 'ZAR BANK' || $request->transfer_name == 'ZAR BANK') {

                $reqField['account_bank'] = [
                    'fieldValue' => $request->bank,
                    'type' => 'text',
                ];
            } elseif ($request->transfer_name == 'XAF/XOF MOMO') {
                $reqField['account_bank'] = [
                    'fieldValue' => 'MTN',
                    'type' => 'text',
                ];
            } elseif ($request->transfer_name == 'FRANCOPGONE' || $request->transfer_name == 'mPesa' || $request->transfer_name == 'Rwanda Momo'
                || $request->transfer_name == 'Uganda Momo' || $request->transfer_name == 'Zambia Momo') {
                $reqField['account_bank'] = [
                    'fieldValue' => 'MPS',
                    'type' => 'text',
                ];
            }

            if ($request->transfer_name == 'Barter') {
                $reqField['account_bank'] = [
                    'fieldValue' => 'barter',
                    'type' => 'text',
                ];
            } elseif ($request->transfer_name == 'flutterwave') {
                $reqField['account_bank'] = [
                    'fieldValue' => 'barter',
                    'type' => 'text',
                ];
            }


            $reqField['amount'] = [
                'fieldValue' => $payout->amount * convertRate($request->currency_code, $payout),
                'type' => 'text',
            ];

            $payout->information = $reqField;
            $payout->meta_field = $metaField;
        } else {
            $payout->information = null;
            $payout->meta_field = null;
        }

        $payout->status = 1;
        $payout->currency_code = $request->currency_code;
        $payout->save();

        $user[$payout->balance_type] = $user[$payout->balance_type] - $payout->net_amount;
        $user->save();

        $remarks = 'Withdraw Via ' . optional($payout->method)->name;
        BasicService::makeTransaction($user, $payout->amount, $payout->charge, '-', $payout->balance_type, $payout->trx_id, $remarks);

        $this->userNotify($user, $payout);

        return redirect(route('user.payout.money'))->with('success', 'Payout request Successfully Submitted. Wait For Confirmation.');
    }


    public function payoutRequestSubmit(Request $request)
    {
        $basic = (object)config('basic');
        $withdraw = PayoutLog::latest()->where('trx_id', session()->get('wtrx'))->where('status', 0)->with('method', 'user')->firstOrFail();
        $rules = [];
        $inputField = [];
        if (optional($withdraw->method)->input_form != null) {
            foreach ($withdraw->method->input_form as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], 'mimes:jpeg,jpg,png');
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        if (optional($withdraw->method)->is_automatic == 1) {
            $rules['currency_code'] = 'required';
            if (optional($withdraw->method)->code == 'paypal') {
                $rules['recipient_type'] = 'required';
            }
        }

        $this->validate($request, $rules);
        $user = $this->user;

        if (getAmount($withdraw->net_amount) > $user[$withdraw->balance_type]) {
            session()->flash('error', 'Insufficient ' . snake2Title($withdraw->balance_type) . ' For Payout.');
            return redirect()->route('user.payout.money');
        } else {
            $collection = collect($request);
            $reqField = [];
            if ($withdraw->method->input_form != null) {
                foreach ($collection as $k => $v) {
                    foreach ($withdraw->method->input_form as $inKey => $inVal) {
                        if ($k != $inKey) {
                            continue;
                        } else {
                            if ($inVal->type == 'file') {
                                if ($request->hasFile($inKey)) {
                                    $image = $request->file($inKey);
                                    $filename = time() . uniqid() . '.jpg';
                                    $location = config('location.withdrawLog.path');
                                    $reqField[$inKey] = [
                                        'fieldValue' => $filename,
                                        'type' => $inVal->type,
                                    ];
                                    try {
                                        $this->uploadImage($image, $location, $size = null, $old = null, $thumb = null, $filename);
                                    } catch (\Exception $exp) {
                                        return back()->with('error', 'Image could not be uploaded.');
                                    }

                                }
                            } else {
                                $reqField[$inKey] = [
                                    'fieldValue' => $v,
                                    'type' => $inVal->type,
                                ];
                            }
                        }
                    }
                }
                if (optional($withdraw->method)->is_automatic == 1) {
                    $reqField['amount'] = [
                        'fieldValue' => $withdraw->amount * convertRate($request->currency_code, $withdraw),
                        'type' => 'text',
                    ];
                }
                if (optional($withdraw->method)->code == 'paypal') {
                    $reqField['recipient_type'] = [
                        'fieldValue' => $request->recipient_type,
                        'type' => 'text',
                    ];
                }
                $withdraw['information'] = $reqField;
            } else {
                $withdraw['information'] = null;
            }

            $withdraw->currency_code = @$request->currency_code;
            $withdraw->status = 1;
            $withdraw->save();

            $user[$withdraw->balance_type] -= $withdraw->net_amount;
            $user->save();


            $remarks = 'Withdraw Via ' . optional($withdraw->method)->name;
            BasicService::makeTransaction($user, $withdraw->amount, $withdraw->charge, '-', $withdraw->balance_type, $withdraw->trx_id, $remarks);

            $this->userNotify($user, $withdraw);
            session()->flash('success', 'Payout request Successfully Submitted. Wait For Confirmation.');
            return redirect()->route('user.payout.money');
        }
    }

    public function userNotify($user, $withdraw)
    {
        try {
            $basic = (object)config('basic');

            $msg = [
                'username' => $user->username,
                'amount' => getAmount($withdraw->amount),
                'currency' => $basic->currency_symbol,
            ];
            $action = [
                "link" => route('admin.payout-request', $user->id),
                "icon" => "fa fa-money-bill-alt "
            ];
            $userAction = [
                "link" => route('user.payout.history'),
                "icon" => "fa fa-money-bill-alt "
            ];

            $this->userPushNotification($user, 'USER_NOTIFY_PAYOUT_REQUEST', $msg, $userAction);
            $this->adminPushNotification('ADMIN_NOTIFY_PAYOUT_REQUEST', $msg, $action);

            $this->sendMailSms($user, $type = 'USER_MAIL_PAYOUT_REQUEST', [
                'method_name' => optional($withdraw->method)->name,
                'amount' => getAmount($withdraw->amount),
                'charge' => getAmount($withdraw->charge),
                'currency' => $basic->currency_symbol,
                'trx' => $withdraw->trx_id,
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_PAYOUT_REQUEST', [
                'method_name' => optional($withdraw->method)->name,
                'amount' => getAmount($withdraw->amount),
                'charge' => getAmount($withdraw->charge),
                'currency' => $basic->currency_symbol,
                'trx' => $withdraw->trx_id,
            ]);
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }


    public function payoutHistory()
    {
        $user = $this->user;
        $data['payoutLog'] = PayoutLog::whereUser_id($user->id)->where('status', '!=', 0)->latest()->with('user', 'method')->paginate(config('basic.paginate'));
        $data['title'] = "Payout Log";
        return view($this->theme . 'user.payout.log', $data);
    }


    public function payoutHistorySearch(Request $request)
    {
        $search = $request->all();

        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $payoutLog = PayoutLog::orderBy('id', 'DESC')->where('user_id', $this->user->id)->where('status', '!=', 0)
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->where('trx_id', 'LIKE', $search['name']);
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->with('user', 'method')->paginate(config('basic.paginate'));
        $payoutLog->appends($search);

        $title = "Payout Log";
        return view($this->theme . 'user.payout.log', compact('title', 'payoutLog'));
    }


    public function referral()
    {
        $title = "My Referral";
        $referrals = getLevelUser($this->user->id);
        return view($this->theme . 'user.referral', compact('title', 'referrals'));
    }

    public function referralBonus()
    {
        $title = "Referral Bonus";
        $transactions = $this->user->referralBonusLog()->latest()->with('bonusBy:id,firstname,lastname')->paginate(config('basic.paginate'));
        return view($this->theme . 'user.transaction.referral-bonus', compact('title', 'transactions'));
    }

    public function referralBonusSearch(Request $request)
    {
        $title = "Referral Bonus";
        $search = $request->all();
        $dateSearch = $request->datetrx;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);

        $transaction = $this->user->referralBonusLog()->latest()
            ->with('bonusBy:id,firstname,lastname')
            ->when(isset($search['search_user']), function ($query) use ($search) {
                return $query->whereHas('bonusBy', function ($q) use ($search) {
                    $q->where(DB::raw('concat(firstname, " ", lastname)'), 'LIKE', "%{$search['search_user']}%")
                        ->orWhere('firstname', 'LIKE', '%' . $search['search_user'] . '%')
                        ->orWhere('lastname', 'LIKE', '%' . $search['search_user'] . '%')
                        ->orWhere('username', 'LIKE', '%' . $search['search_user'] . '%');
                });
            })
            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->paginate(config('basic.paginate'));
        $transactions = $transaction->appends($search);

        return view($this->theme . 'user.transaction.referral-bonus', compact('title', 'transactions'));
    }

    public function moneyTransfer()
    {
        $page_title = "Balance Transfer";
        return view($this->theme . 'user.money-transfer', compact('page_title'));
    }

    public function moneyTransferConfirm(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'amount' => 'required',
            'wallet_type' => ['required', Rule::in(['balance', 'interest_balance'])],
            'password' => 'required'
        ], [
            'wallet_type.required' => 'Please Select a wallet'
        ]);

        $basic = (object)config('basic');
        $email = trim($request->email);

        $receiver = User::where('email', $email)->first();


        if (!$receiver) {
            session()->flash('error', 'This Email  could not Found!');
            return back();
        }
        if ($receiver->id == Auth::id()) {
            session()->flash('error', 'This Email  could not Found!');
            return back()->withInput();
        }

        if ($receiver->status == 0) {
            session()->flash('error', 'Invalid User!');
            return back()->withInput();
        }


        if ($request->amount < $basic->min_transfer) {
            session()->flash('error', 'Minimum Transfer Amount ' . $basic->min_transfer . ' ' . $basic->currency);
            return back()->withInput();
        }
        if ($request->amount > $basic->max_transfer) {
            session()->flash('error', 'Maximum Transfer Amount ' . $basic->max_transfer . ' ' . $basic->currency);
            return back()->withInput();
        }

        $transferCharge = ($request->amount * $basic->transfer_charge) / 100;

        $user = Auth::user();
        $wallet_type = $request->wallet_type;
        if ($user[$wallet_type] >= ($request->amount + $transferCharge)) {

            if (Hash::check($request->password, $user->password)) {


                $sendMoneyCheck = MoneyTransfer::where('sender_id', $user->id)->where('receiver_id', $receiver->id)->latest()->first();

                if (isset($sendMoneyCheck) && Carbon::parse($sendMoneyCheck->send_at) > Carbon::now()) {

                    $time = $sendMoneyCheck->send_at;
                    $delay = $time->diffInSeconds(Carbon::now());
                    $delay = gmdate('i:s', $delay);

                    session()->flash('error', 'You can send money to this user after  delay ' . $delay . ' minutes');
                    return back()->withInput();
                } else {

                    $user[$wallet_type] = round(($user[$wallet_type] - ($transferCharge + $request->amount)), 2);
                    $user->save();

                    $receiver[$wallet_type] += round($request->amount, 2);
                    $receiver->save();

                    $trans = strRandom();

                    $sendTaka = new MoneyTransfer();
                    $sendTaka->sender_id = $user->id;
                    $sendTaka->receiver_id = $receiver->id;
                    $sendTaka->amount = round($request->amount, 2);
                    $sendTaka->charge = $transferCharge;
                    $sendTaka->trx = $trans;
                    $sendTaka->send_at = Carbon::parse()->addMinutes(1);
                    $sendTaka->save();

                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->amount = round($request->amount, 2);
                    $transaction->charge = $transferCharge;
                    $transaction->trx_type = '-';
                    $transaction->balance_type = $wallet_type;
                    $transaction->remarks = 'Balance Transfer to  ' . $receiver->email;
                    $transaction->trx_id = $trans;
                    $transaction->final_balance = $user[$wallet_type];
                    $transaction->save();


                    $transaction = new Transaction();
                    $transaction->user_id = $receiver->id;
                    $transaction->amount = round($request->amount, 2);
                    $transaction->charge = 0;
                    $transaction->trx_type = '+';
                    $transaction->balance_type = $wallet_type;
                    $transaction->remarks = 'Balance Transfer From  ' . $user->email;
                    $transaction->trx_id = $trans;
                    $transaction->final_balance = $receiver[$wallet_type];
                    $transaction->save();

                    $currentDate = dateTime(Carbon::now());
                    $msg = [
                        'send_user' => $user->fullname,
                        'to_user' => $receiver->fullname,
                        'amount' => $request->amount,
                        'currency' => $basic->currency,
                    ];
                    $action = [
                        "link" => "#",
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];

                    $userAction = [
                        "link" => route('user.home'),
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];

                    $this->adminPushNotification('ADMIN_NOTIFY_BALANCE_TRANSFER', $msg, $action);
                    $this->userPushNotification($user, 'SENDER_NOTIFY_BALANCE_TRANSFER', $msg, $userAction);
                    $this->userPushNotification($receiver, 'RECEIVER_NOTIFY_BALANCE_TRANSFER', $msg, $userAction);

                    $this->mailToAdmin($type = 'ADMIN_MAIL_BALANCE_TRANSFER', [
                        'send_user' => $user->fullname,
                        'to_user' => $receiver->fullname,
                        'amount' => $request->amount,
                        'currency' => $basic->currency,
                        'date' => $currentDate
                    ]);

                    $this->sendMailSms($user, 'SENDER_MAIL_BALANCE_TRANSFER', [
                        'send_user' => $user->fullname,
                        'to_user' => $receiver->fullname,
                        'amount' => $request->amount,
                        'currency' => $basic->currency,
                        'date' => $currentDate
                    ]);

                    $this->sendMailSms($receiver, 'RECEIVER_MAIL_BALANCE_TRANSFER', [
                        'send_user' => $user->fullname,
                        'to_user' => $receiver->fullname,
                        'amount' => $request->amount,
                        'currency' => $basic->currency,
                        'date' => $currentDate
                    ]);

                    session()->flash('success', 'Balance Transfer  has been Successful');
                    return redirect()->route('user.money-transfer');
                }
            } else {
                session()->flash('error', 'Password Do Not Match!');
                return back()->withInput();
            }
        } else {
            session()->flash('error', 'Insufficient Balance!');
            return back()->withInput();
        }
    }


    public function verificationSubmit(Request $request)
    {
        $identityFormList = IdentifyForm::where('status', 1)->get();
        $rules['identity_type'] = ["required", Rule::in($identityFormList->pluck('slug')->toArray())];
        $identity_type = $request->identity_type;
        $identityForm = IdentifyForm::where('slug', trim($identity_type))->where('status', 1)->firstOrFail();

        $params = $identityForm->services_form;

        $rules = [];
        $inputField = [];
        $verifyImages = [];

        if ($params != null) {
            foreach ($params as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], 'mimes:jpeg,jpg,png');
                    array_push($rules[$key], 'max:2048');
                    array_push($verifyImages, $key);
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->errors()->add('identity', '1');

            return back()->withErrors($validator)->withInput();
        }


        $path = config('location.kyc.path') . date('Y') . '/' . date('m') . '/' . date('d');
        $collection = collect($request);

        $reqField = [];
        if ($params != null) {
            foreach ($collection as $k => $v) {
                foreach ($params as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $this->uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    session()->flash('error', 'Could not upload your ' . $inKey);
                                    return back()->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
        }

        try {

            DB::beginTransaction();

            $user = $this->user;
            $kyc = new KYC();
            $kyc->user_id = $user->id;
            $kyc->kyc_type = $identityForm->slug;
            $kyc->details = $reqField;
            $kyc->save();

            $user->identity_verify = 1;
            $user->save();

            if (!$kyc) {
                DB::rollBack();
                $validator->errors()->add('identity', '1');
                return back()->withErrors($validator)->withInput()->with('error', "Failed to submit request");
            }
            DB::commit();

            $msg = [
                'name' => $user->fullname,
            ];

            $adminAction = [
                "link" => route('admin.kyc.users.pending'),
                "icon" => "fas fa-user text-white"
            ];
            $userAction = [
                "link" => route('user.profile'),
                "icon" => "fas fa-user text-white"
            ];

            $this->adminPushNotification('ADMIN_NOTIFY_USER_KYC_REQUEST', $msg, $adminAction);
            $this->userPushNotification($user, 'USER_NOTIFY_HIS_KYC_REQUEST_SEND', $msg, $userAction);

            $currentDate = dateTime(Carbon::now());
            $this->sendMailSms($user, $type = 'USER_MAIL_HIS_KYC_REQUEST_SEND', [
                'name' => $user->fullname,
                'date' => $currentDate,
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_USER_KYC_REQUEST', [
                'name' => $user->fullname,
                'date' => $currentDate,
            ]);

            return redirect()->route('user.profile')->withErrors($validator)->with('success', 'KYC request has been submitted.');

        } catch (\Exception $e) {
            return redirect()->route('user.profile')->withErrors($validator)->with('error', $e->getMessage());
        }
    }

    public function addressVerification(Request $request)
    {
        $rules = [];
        $rules['addressProof'] = ['image', 'mimes:jpeg,jpg,png', 'max:2048'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->errors()->add('addressVerification', '1');
            return back()->withErrors($validator)->withInput();
        }

        $path = config('location.kyc.path') . date('Y') . '/' . date('m') . '/' . date('d');

        $reqField = [];
        try {
            if ($request->hasFile('addressProof')) {
                $reqField['addressProof'] = [
                    'field_name' => $this->uploadImage($request['addressProof'], $path),
                    'type' => 'file',
                ];
            } else {
                $validator->errors()->add('addressVerification', '1');

                session()->flash('error', 'Please select a ' . 'address Proof');
                return back()->withInput();
            }
        } catch (\Exception $exp) {
            session()->flash('error', 'Could not upload your ' . 'address Proof');
            return redirect()->route('user.profile')->withInput();
        }

        try {

            DB::beginTransaction();
            $user = $this->user;
            $kyc = new KYC();
            $kyc->user_id = $user->id;
            $kyc->kyc_type = 'address-verification';
            $kyc->details = $reqField;
            $kyc->save();
            $user->address_verify = 1;
            $user->save();

            if (!$kyc) {
                DB::rollBack();
                $validator->errors()->add('addressVerification', '1');
                return redirect()->route('user.profile')->withErrors($validator)->withInput()->with('error', "Failed to submit request");
            }
            DB::commit();

            $msg = [
                'name' => $user->fullname,
            ];

            $adminAction = [
                "link" => route('admin.kyc.users.pending'),
                "icon" => "fas fa-user text-white"
            ];
            $userAction = [
                "link" => route('user.profile'),
                "icon" => "fas fa-user text-white"
            ];

            $this->adminPushNotification('ADMIN_NOTIFY_USER_ADDRESS_VERIFICATION_REQUEST', $msg, $adminAction);
            $this->userPushNotification($user, 'USER_NOTIFY_ADDRESS_VERIFICATION_REQUEST_SEND', $msg, $userAction);

            $currentDate = dateTime(Carbon::now());
            $this->sendMailSms($user, $type = 'USER_MAIL_ADDRESS_VERIFICATION_REQUEST_SEND', [
                'name' => $user->fullname,
                'date' => $currentDate,
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_USER_ADDRESS_VERIFICATION_REQUEST', [
                'name' => $user->fullname,
                'date' => $currentDate,
            ]);

            return redirect()->route('user.profile')->withErrors($validator)->with('success', 'Your request has been submitted.');

        } catch (\Exception $e) {
            $validator->errors()->add('addressVerification', '1');
            return redirect()->route('user.profile')->with('error', $e->getMessage())->withErrors($validator);
        }
    }


    public function badges()
    {
        $data['allBadges'] = Ranking::orderBy('sort_by', 'ASC')->get();
        return view($this->theme . 'user.badge.index', $data);
    }

}
