<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutSetting;
use App\Models\WithdrawSetting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PayoutSettingsController extends Controller
{
    public function settings(){
        $data['page_title'] = 'Withdraw Settings';
        $data['withdrawSettings'] = PayoutSetting::firstOrCreate();
        return view('admin.payout.settings', $data);
    }

    public function settingsAction(Request $request){
        $requestData = $request->all();

        $data = PayoutSetting::firstOrCreate();

        $monday = isset($requestData['monday']) && $requestData['monday'] == 'on'? 1 : 0;
        $tuesday = isset($requestData['tuesday']) && $requestData['tuesday'] == 'on'? 1 : 0;
        $wednesday = isset($requestData['wednesday']) && $requestData['wednesday'] == 'on'? 1 : 0;
        $thursday = isset($requestData['thursday']) && $requestData['thursday'] == 'on'? 1 : 0;
        $friday = isset($requestData['friday']) && $requestData['friday'] == 'on'? 1 : 0;
        $saturday = isset($requestData['saturday']) && $requestData['saturday'] == 'on'? 1 : 0;
        $sunday = isset($requestData['sunday']) && $requestData['sunday'] == 'on'? 1 : 0;
        $data->monday = $monday;
        $data->tuesday = $tuesday;
        $data->wednesday = $wednesday;
        $data->thursday = $thursday;
        $data->friday = $friday;
        $data->saturday = $saturday;
        $data->sunday = $sunday;
        $data->save();
        return back()->with('success', __('Payout Settings Updated!'));
    }
}
