<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Configure;
use App\Models\Gateway;
use App\Models\ManagePlan;
use App\Models\ManageTime;
use App\Models\Ranking;
use App\Models\Referral;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\RequiredIf;
use Stevebauman\Purify\Facades\Purify;

class ManagePlanController extends Controller
{
    use Upload, Notify;

    public function rankingsUser(Ranking $ranking)
    {
        $data['allRankings'] = Ranking::orderBy('sort_by', 'asc')->get();
        $data['page_title'] = 'Rank List';
        return view('admin.rank.index', $data);
    }

    public function rankCreate()
    {
        return view('admin.rank.create');
    }

    public function rankStore(Request $request)
    {

        $rules = [
            'rank_name' => 'required',
            'rank_lavel' => 'required',
            'rank_icon' => 'required'
        ];

        $this->validate($request, $rules);

        $rank = new Ranking();
        $rank->rank_name = $request->rank_name;
        $rank->rank_lavel = $request->rank_lavel;
        $rank->min_invest = isset($request->min_invest) ? $request->min_invest : 0;
        $rank->min_deposit = isset($request->min_deposit) ? $request->min_deposit : 0;
        $rank->min_earning = isset($request->min_earning) ? $request->min_earning : 0;
        $rank->description = $request->description;
        $rank->status = isset($request->status) ? 1 : 0;

        if ($request->hasFile('rank_icon')) {
            try {
                $rank->rank_icon = $this->uploadImage($request->rank_icon, config('location.rank.path'), config('location.rank.size'));
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }

        $rank->save();
        return redirect()->route('admin.rankingsUser')->with('success', 'Ranking create successfully');
    }


    public function rankEdit($id)
    {
        $data['singleRanking'] = Ranking::findOrFail($id);
        return view('admin.rank.edit', $data);
    }

    public function rankUpdate(Request $request, $id){
        $rules = [
            'rank_name' => 'required',
            'rank_lavel' => 'required',
        ];

        $this->validate($request, $rules);

        $rank = Ranking::findOrFail($id);
        $rank->rank_name = $request->rank_name;
        $rank->rank_lavel = $request->rank_lavel;
        $rank->min_invest = isset($request->min_invest) ? $request->min_invest : 0;
        $rank->min_deposit = isset($request->min_deposit) ? $request->min_deposit : 0;
        $rank->min_earning = isset($request->min_earning) ? $request->min_earning : 0;
        $rank->description = $request->description;
        $rank->status = isset($request->status) ? 1 : 0;

        if ($request->hasFile('rank_icon')) {
            try {
                $rank->rank_icon = $this->uploadImage($request->rank_icon, config('location.rank.path'), config('location.rank.size'));
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }

        $rank->save();
        return redirect()->route('admin.rankingsUser')->with('success', 'Ranking Update successfully');

    }

    public function rankDelete($id){
        Ranking::findOrFail($id)->delete();
        return back()->with('success', 'Delete Successfull');
    }

    public function sortBadges(Request $request){
        $data = $request->all();
        foreach ($data['sort'] as $key => $value) {

            Ranking::where('id', $value)->update([
                'sort_by' => $key + 1
            ]);
        }

    }


    public function referralCommissionAction(Request $request)
    {
        $configure = Configure::firstOrNew();
        $reqData = Purify::clean($request->except('_token', '_method'));

        $configure->fill($reqData)->save();

        config(['basic.deposit_commission' => (int)$reqData['deposit_commission']]);
        config(['basic.investment_commission' => (int)$reqData['investment_commission']]);
        config(['basic.profit_commission' => (int)$reqData['profit_commission']]);
        $fp = fopen(base_path() . '/config/basic.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('basic'), true) . ';');
        fclose($fp);

        return back()->with('success', 'Update Successfully.');
    }

    public function referralCommission()
    {
        $data['control'] = Configure::firstOrNew();
        $data['referrals'] = Referral::get();
        return view('admin.plan.referral-commission', $data);
    }

    public function referralCommissionStore(Request $request)
    {
        $request->validate([
            'level*' => 'required|integer|min:1',
            'percent*' => 'required|numeric',
            'commission_type' => 'required',
        ]);

        Referral::where('commission_type', $request->commission_type)->delete();

        for ($i = 0; $i < count($request->level); $i++) {
            $referral = new Referral();
            $referral->commission_type = $request->commission_type;
            $referral->level = $request->level[$i];
            $referral->percent = $request->percent[$i];
            $referral->save();
        }

        return back()->with('success', 'Level Bonus Has been Updated.');
    }

    public function scheduleManage()
    {
        $manageTimes = ManageTime::all();
        return view('admin.plan.schedule', compact('manageTimes'));
    }

    public function storeSchedule(Request $request)
    {

        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'name' => 'required|string',
            'time' => 'required|integer',
        ], [
            'name.required' => 'Name is required',
            'time.required' => 'Time is required'
        ]);
        $data = ManageTime::firstOrNew(['time' => $reqData['time']]);
        $data->name = $reqData['name'];
        $data->save();
        return back()->with('success', 'Added Successfully.');
    }

    public function updateSchedule(Request $request, $id)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'name' => 'required|string',
            'time' => 'required|integer',
        ], [
            'name.required' => 'Name is required',
            'time.required' => 'Time is required'
        ]);

        $data = ManageTime::findOrFail($id);
        $data->time = $reqData['time'];
        $data->name = $reqData['name'];
        $data->save();
        return back()->with('success', 'Update Successfully.');
    }


    public function planList()
    {
        $managePlans = ManagePlan::latest()->get();
        return view('admin.plan.list', compact('managePlans'));
    }

    public function planCreate()
    {
        $times = ManageTime::latest()->get();
        return view('admin.plan.create', compact('times'));
    }

    public function planStore(Request $request)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));
        $request->validate([
            'name' => 'required',
            'schedule' => 'numeric|min:0',
            'profit' => 'numeric|min:0',
        ]);

        $minimum_amount = $reqData['minimum_amount'];
        $maximum_amount = $reqData['maximum_amount'];
        $fixed_amount = isset($reqData['plan_price_type']) ? $reqData['fixed_amount'] : 0;
        $profit_type = (int)$reqData['profit_type'];

        $repeatable = isset($reqData['is_lifetime']) ? $reqData['repeatable'] : 0;
        $featured = isset($reqData['featured']) && $reqData['featured'] == 'on' ? 1 : 0;


        if (($minimum_amount < 0 || $maximum_amount < 0) && $fixed_amount < 0) {
            return back()->with('error', 'Invest Amount cannot lower than 0')->withInput();
        }
        if (0 > $reqData['profit']) {
            return back()->with('error', 'Interest cannot lower than 0')->withInput();
        }
        if (0 > $repeatable) {
            return back()->with('error', 'Return Time cannot lower than 0')->withInput();
        }

        $data = new ManagePlan();
        $data->name = $reqData['name'];
        $data->badge = $reqData['badge'];
        $data->minimum_amount = $minimum_amount;
        $data->maximum_amount = $maximum_amount;
        $data->fixed_amount = $fixed_amount;
        $data->profit = $reqData['profit'];
        $data->profit_type = $profit_type;
        $data->schedule = $reqData['schedule'];
        $data->status = isset($reqData['status']) ? 1 : 0;
        $data->is_capital_back = isset($reqData['is_capital_back']) ? 1 : 0;
        $data->is_lifetime = isset($reqData['is_lifetime']) ? 1 : 0;
        $data->repeatable = $repeatable;
        $data->featured = $featured;
        $data->save();

        return back()->with('success', 'Plan has been Added');
    }

    public function planEdit($id)
    {
        $data = ManagePlan::findOrFail($id);
        $times = ManageTime::latest()->get();
        return view('admin.plan.edit', compact('data', 'times'));
    }

    public function planUpdate(Request $request, $id)
    {
        $data = ManagePlan::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'schedule' => 'numeric|min:0',
            'profit' => 'numeric|min:0',
            'repeatable' => 'sometimes|required',
        ], [
            'schedule|numeric' => 'Accrual field is required'
        ]);
        $reqData = Purify::clean($request->except('_token', '_method'));


        $minimum_amount = $reqData['minimum_amount'];
        $maximum_amount = $reqData['maximum_amount'];
        $fixed_amount = isset($reqData['plan_price_type']) ? $reqData['fixed_amount'] : 0;
        $profit_type = (int)$reqData['profit_type'];
        $repeatable = isset($reqData['is_lifetime']) ? $reqData['repeatable'] : 0;
        $featured = isset($reqData['featured']) && $reqData['featured'] == 'on' ? 1 : 0;

        if (($minimum_amount < 0 || $maximum_amount < 0) && $fixed_amount < 0) {
            return back()->with('error', 'Invest Amount cannot lower than 0')->withInput();
        }
        if ($reqData['profit'] < 0) {
            return back()->with('error', 'Interest cannot lower than 0')->withInput();
        }
        if ($repeatable < 0) {
            return back()->with('error', 'Return Time cannot lower than 0')->withInput();
        }

        $data->name = $reqData['name'];
        $data->badge = $reqData['badge'];
        $data->minimum_amount = $minimum_amount;
        $data->maximum_amount = $maximum_amount;
        $data->fixed_amount = $fixed_amount;
        $data->profit = $reqData['profit'];
        $data->profit_type = $profit_type;
        $data->schedule = $reqData['schedule'];
        $data->status = isset($reqData['status']) ? 1 : 0;
        $data->is_capital_back = isset($reqData['is_capital_back']) && $reqData['is_capital_back'] == 'on' ? 1 : 0;
        $data->is_lifetime = isset($reqData['is_lifetime']) && $reqData['is_lifetime'] == 'on' ? 0 : 1;


        $data->repeatable = $repeatable;
        $data->featured = $featured;
        $data->save();

        return back()->with('success', 'Plan has been Updated');
    }

    public function activeMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select ID.');
            return response()->json(['error' => 1]);
        } else {
            ManagePlan::whereIn('id', $request->strIds)->update([
                'status' => 1,
            ]);
            session()->flash('success', 'User Status Has Been Active');
            return response()->json(['success' => 1]);
        }
    }

    public function inActiveMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select ID.');
            return response()->json(['error' => 1]);
        } else {
            ManagePlan::whereIn('id', $request->strIds)->update([
                'status' => 0,
            ]);
            session()->flash('success', 'User Status Has Been Deactive');
            return response()->json(['success' => 1]);
        }
    }


}
