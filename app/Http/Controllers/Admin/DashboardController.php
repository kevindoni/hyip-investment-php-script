<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Models\Fund;
use App\Models\Investment;
use App\Models\ManagePlan;
use App\Models\PayoutLog;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Purify\Facades\Purify;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function forbidden()
    {
        return view('admin.errors.403');
    }


    public function dashboard()
    {
        $data['totalPlan'] = ManagePlan::count();
        $data['funding'] = collect(Fund::selectRaw('SUM(CASE WHEN status = 1 AND plan_id IS NULL   THEN amount END) AS totalAmountReceived')
            ->selectRaw('SUM(CASE WHEN status = 1 THEN charge END) AS totalChargeReceived')
            ->selectRaw('SUM((CASE WHEN created_at = CURDATE() AND status = 1 AND plan_id IS NULL  THEN amount END)) AS todayDeposit')
            ->get()->toArray())->collapse();

        $data['userRecord'] = collect(User::selectRaw('COUNT(id) AS totalUser')
            ->selectRaw('count(CASE WHEN status = 1  THEN id END) AS activeUser')
            ->selectRaw('SUM(balance) AS totalUserBalance')
            ->selectRaw('SUM(interest_balance) AS totalInterestBalance')
            ->selectRaw('COUNT((CASE WHEN created_at = CURDATE()  THEN id END)) AS todayJoin')
            ->get()->makeHidden(['fullname', 'mobile'])->toArray())->collapse();

        $data['investment'] = collect(Investment::selectRaw('COUNT(id) AS total')
            ->selectRaw('SUM(amount) AS totalInvestAmount')
            ->selectRaw('COUNT(CASE WHEN status = 1  THEN status END) AS running')
            ->selectRaw('COUNT(CASE WHEN status = 0  THEN status END) AS complete')
            ->selectRaw('COUNT((CASE WHEN created_at = CURDATE()  THEN id END)) AS todayInvest')
            ->selectRaw('SUM((CASE WHEN created_at = CURDATE()  THEN amount END)) AS todayInvestmentAmount')
            ->selectRaw('SUM((CASE WHEN created_at =  DATE_SUB(CURRENT_DATE() , INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY) THEN amount END)) AS monthlyInvestmentAmount')
            ->get()->makeHidden('nextPayment')->toArray())->collapse();

        $data['tickets'] = collect(Ticket::where('created_at', '>', Carbon::now()->subDays(30))
            ->selectRaw('count(CASE WHEN status = 3  THEN status END) AS closed')
            ->selectRaw('count(CASE WHEN status = 2  THEN status END) AS replied')
            ->selectRaw('count(CASE WHEN status = 1  THEN status END) AS answered')
            ->selectRaw('count(CASE WHEN status = 0  THEN status END) AS pending')
            ->get()->toArray())->collapse();

        /*
         * Pie Chart Data
         */

        $totalSell = $data['investment']['total'];
        $pieLog = collect();
        Investment::with('plan:id,name')
            ->get()->groupBy('plan.name')->map(function ($items, $key) use ($totalSell, $pieLog) {
                $pieLog->push(['level' => $key, 'value' => round((0 < $totalSell) ? (count($items) / $totalSell * 100) : 0, 2)]);
                return $items;
            });

        $dailyInvest = $this->dayList();
        Investment::whereMonth('created_at', Carbon::now()->month)
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw('DATE_FORMAT(created_at,"Day %d") as date')
            )
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->makeHidden('nextPayment')->map(function ($item) use ($dailyInvest) {
                $dailyInvest->put($item['date'], round($item['totalAmount'], 2));
            });
        $statistics['investment'] = $dailyInvest;


        $dailyDeposit = $this->dayList();
        Fund::whereMonth('created_at', Carbon::now()->month)
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw('DATE_FORMAT(created_at,"Day %d") as date')
            )
            ->where('status',1)
            ->where('plan_id',null)
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->map(function ($item) use ($dailyDeposit) {
                $dailyDeposit->put($item['date'], round($item['totalAmount'], 2));
            });
        $statistics['deposit'] = $dailyDeposit;

        $dailyGaveProfit = $this->dayList();
         Transaction::whereMonth('created_at', Carbon::now()->month)
            ->selectRaw('SUM((CASE WHEN remarks LIKE "%Interest From%" THEN amount  END)) AS totalAmount')
            ->selectRaw('DATE_FORMAT(created_at,"Day %d") as date')
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->map(function ($item) use ($dailyGaveProfit) {
                $dailyGaveProfit->put($item['date'], round($item['totalAmount'], 2));
            });
        $statistics['gaveProfit'] = $dailyGaveProfit;



        $dailyPayout = $this->dayList();
        PayoutLog::whereMonth('created_at', Carbon::now()->month)
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw('DATE_FORMAT(created_at,"Day %d") as date')
            )
            ->where('status',2)
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->map(function ($item) use ($dailyPayout) {
                $dailyPayout->put($item['date'], round($item['totalAmount'], 2));
            });
        $statistics['payout'] = $dailyPayout;
        $statistics['schedule'] = $this->dayList();

        $data['payout'] = collect(PayoutLog::selectRaw('COUNT(CASE WHEN status = 1  THEN id END) AS pending')
            ->selectRaw('SUM((CASE WHEN status = 2 AND created_at = CURDATE()  THEN amount END)) AS todayPayoutAmount')
            ->selectRaw('SUM((CASE WHEN status = 2 AND created_at =  DATE_SUB(CURRENT_DATE() , INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY) THEN amount END)) AS monthlyPayoutAmount')
            ->selectRaw('SUM((CASE WHEN status = 2 AND created_at =  DATE_SUB(CURRENT_DATE() , INTERVAL DAYOFMONTH(CURRENT_DATE)-1 DAY) THEN charge END)) AS monthlyPayoutCharge')
            ->get()->toArray())->collapse();


        $data['latestUser'] = User::latest()->limit(5)->get();


        return view('admin.dashboard', $data, compact('statistics', 'pieLog','statistics'));
    }

    public function dayList()
    {
        $totalDays = Carbon::now()->endOfMonth()->format('d');
        $daysByMonth = [];
        for ($i = 1; $i <= $totalDays; $i++) {
            array_push($daysByMonth, ['Day ' . sprintf("%02d", $i) => 0]);
        }

        return collect($daysByMonth)->collapse();
    }

    public function profile()
    {
        $admin = $this->user;
        return view('admin.profile', compact('admin'));
    }


    public function profileUpdate(Request $request)
    {
        $req = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'sometimes|required',
            'username' => 'sometimes|required|unique:admins,username,' . $this->user->id,
            'email' => 'sometimes|required|email|unique:admins,email,' . $this->user->id,
            'phone' => 'sometimes|required',
            'address' => 'sometimes|required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])]
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = $this->user;
        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = $this->uploadImage($request->image, config('location.admin.path'), config('location.admin.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }
        $user->name = $req['name'];
        $user->username = $req['username'];
        $user->email = $req['email'];
        $user->phone = $req['phone'];
        $user->address = $req['address'];
        $user->save();

        return back()->with('success', 'Updated Successfully.');
    }


    public function password()
    {
        return view('admin.password');
    }

    public function passwordUpdate(Request $request)
    {
        $req = Purify::clean($request->all());

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $request = (object)$req;
        $user = $this->user;
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', "Password didn't match");
        }
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return back()->with('success', 'Password has been Changed');
    }
}
