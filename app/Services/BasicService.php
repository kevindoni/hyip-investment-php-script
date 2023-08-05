<?php

namespace App\Services;

use App\Http\Traits\Notify;
use App\Models\Investment;
use App\Models\ManageTime;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Image;

class BasicService
{
    use Notify;

    public function validateImage(object $getImage, string $path)
    {
        if ($getImage->getClientOriginalExtension() == 'jpg' or $getImage->getClientOriginalName() == 'jpeg' or $getImage->getClientOriginalName() == 'png') {
            $image = uniqid() . '.' . $getImage->getClientOriginalExtension();
        } else {
            $image = uniqid() . '.jpg';
        }
        Image::make($getImage->getRealPath())->resize(300, 250)->save($path . $image);
        return $image;
    }

    public function validateDate(string $date)
    {
        if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}$/", $date)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateKeyword(string $search, string $keyword)
    {
        return preg_match('~' . preg_quote($search, '~') . '~i', $keyword);
    }

    public function cryptoQR($wallet, $amount, $crypto = null)
    {

        $varb = $wallet . "?amount=" . $amount;
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8";
    }

    public function preparePaymentUpgradation($order)
    {
        $basic = (object) config('basic');
        $gateway = $order->gateway;

        if ($order->status == 0) {
            $order['status'] = 1;
            $order->update();

            $user = $order->user;

            $amount = getAmount($order->amount);
            $trx = $order->transaction;

            if ($order->plan_id) {
                $plan  = $order->plan;
                $remarks = 'Invested On ' . optional($order->plan)->name;
                $this->makeTransaction($user, $amount, getAmount($order->charge), $trx_type = '-', $balance_type = 'payment',  $trx, $remarks);

                $profit = ($plan->profit_type == 1) ? ($amount * $plan->profit) / 100 : $plan->profit;
                $maturity = ($plan->is_lifetime == 1) ? '-1' : $plan->repeatable;

                $timeManage = ManageTime::where('time', $plan->schedule)->first();

                //// For Fixed Plan
                if ($plan->fixed_amount != 0 && ($plan->fixed_amount == $amount)) {
                    $this->makeInvest($user, $plan, $amount, $profit, $maturity, $timeManage, $trx);
                } elseif ($plan->fixed_amount == 0) {
                    $this->makeInvest($user, $plan, $amount, $profit, $maturity, $timeManage, $trx);
                }

                if ($basic->investment_commission == 1) {
                    $this->setBonus($user, $amount, $type = 'invest');
                }

                $currentDate = dateTime(Carbon::now());
                $msg = [
                    'username' => $user->username,
                    'amount' => getAmount($amount),
                    'currency' => $basic->currency_symbol,
                    'plan_name' => $plan->name
                ];
                $action = [
                    "link" => route('admin.user.plan-purchaseLog',$user->id),
                    "icon" => "fa fa-money-bill-alt text-white"
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
                    'profit_amount' => $profit
                ]);

                $this->mailToAdmin($type = 'PLAN_PURCHASE_MAIL_TO_ADMIN', [
                    'username' => $user->username,
                    'amount' => getAmount($amount),
                    'currency' => $basic->currency_symbol,
                    'plan_name' => $plan->name,
                    'date' => $currentDate
                ]);

            } else {

                $user->balance += $order->amount;
                $user->save();

                $this->makeTransaction($user, getAmount($order->amount), getAmount($order->charge), $trx_type = '+', $balance_type = 'deposit', $order->transaction, $remarks = 'Deposit Via ' . $gateway->name);

                if ($basic->deposit_commission == 1) {
                    $this->setBonus($user, getAmount($order->amount), $type = 'deposit');
                }

                $currentDate = dateTime(Carbon::now());
                $msg = [
                    'username' => $user->username,
                    'amount' => getAmount($order->amount),
                    'currency' => $basic->currency,
                    'gateway' => $gateway->name
                ];
                $action = [
                    "link" => route('admin.user.fundLog', $user->id),
                    "icon" => "fa fa-money-bill-alt text-white"
                ];
                $this->adminPushNotification('ADMIN_NOTIFY_FUND_DEPOSIT_PAYMENT_COMPLETE', $msg, $action);
                $this->mailToAdmin($type = 'ADMIN_MAIL_FUND_DEPOSIT_PAYMENT_COMPLETE', [
                    'username' => $user->username,
                    'amount' => getAmount($order->amount),
                    'currency' => $basic->currency,
                    'gateway' => $gateway->name,
                    'date'  => $currentDate,
                ]);

                $userAction = [
                    "link" => route('user.fund-history'),
                    "icon" => "fa fa-money-bill-alt text-white"
                ];

                $this->userPushNotification($user, 'USER_NOTIFY_FUND_DEPOSIT_PAYMENT_COMPLETE', $msg, $userAction);
                $this->sendMailSms($user, 'USER_MAIL_FUND_DEPOSIT_PAYMENT_COMPLETE', [
                    'gateway_name' => $gateway->name,
                    'amount' => getAmount($order->amount),
                    'charge' => getAmount($order->charge),
                    'currency' => $basic->currency,
                    'transaction' => $order->transaction,
                    'remaining_balance' => getAmount($user->balance)
                ]);
            }
            session()->forget('amount');
            session()->forget('plan_id');
        }
    }




    public function setBonus($user, $amount, $commissionType = ''){

        $basic = (object) config('basic');
        $userId = $user->id;
        $i = 1;
        $level = \App\Models\Referral::where('commission_type', $commissionType)->count();
        while ($userId != "" || $userId != "0" || $i < $level) {
            $me = \App\Models\User::with('referral')->find($userId);
            $refer = $me->referral;
            if (!$refer) {
                break;
            }
            $commission = \App\Models\Referral::where('commission_type', $commissionType)->where('level', $i)->first();
            if (!$commission) {
                break;
            }
            $com = ($amount * $commission->percent) / 100;
            $new_bal = getAmount($refer->interest_balance + $com);
            $refer->interest_balance = $new_bal;
            $refer->total_interest_balance += $com;

            $refer->save();

            $trx = strRandom();
            $balance_type = 'interest_balance';

            $remarks = ' level ' . $i . ' Referral bonus From ' . $user->username;

            $this->makeTransaction($refer, $com, 0, '+', $balance_type, $trx, $remarks);

            $bonus = new \App\Models\ReferralBonus();
            $bonus->from_user_id = $refer->id;
            $bonus->to_user_id = $user->id;
            $bonus->level = $i;
            $bonus->amount = getAmount($com);
            $bonus->main_balance = $new_bal;
            $bonus->transaction = $trx;
            $bonus->type = $commissionType;
            $bonus->remarks = $remarks;
            $bonus->save();


            $this->sendMailSms($refer, $type = 'REFERRAL_BONUS', [
                'transaction_id' => $trx,
                'amount' => getAmount($com),
                'currency' => $basic->currency_symbol,
                'bonus_from' => $user->username,
                'final_balance' => $refer->interest_balance,
                'level' => $i
            ]);


            $msg = [
                'bonus_from' => $user->username,
                'amount' => getAmount($com),
                'currency' => $basic->currency_symbol,
                'level' => $i
            ];
            $action = [
                "link" => route('user.referral.bonus'),
                "icon" => "fa fa-money-bill-alt"
            ];
            $this->userPushNotification($refer,'REFERRAL_BONUS', $msg, $action);

            $userId = $refer->id;
            $i++;
        }
        return 0;

    }


    /**
     * @param $user
     * @param $amount
     * @param $charge
     * @param $trx_type
     * @param $balance_type
     * @param $trx_id
     * @param $remarks
     */
    public function makeTransaction($user, $amount, $charge, $trx_type = null, $balance_type, $trx_id, $remarks = null): void
    {
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = getAmount($amount);
        $transaction->charge = $charge;
        $transaction->trx_type = $trx_type;
        $transaction->balance_type = $balance_type;
        $transaction->final_balance = $user[$balance_type];
        $transaction->trx_id = $trx_id;
        $transaction->remarks = $remarks;
        $transaction->save();
    }


    /**
     * @param $user
     * @param $plan
     * @param $amount
     * @param $profit
     * @param $maturity
     * @param $timeManage
     * @param $trx
     */
    public function makeInvest($user, $plan, $amount, $profit, $maturity, $timeManage, $trx): void
    {
        $invest = new Investment();
        $invest->user_id = $user->id;
        $invest->plan_id = $plan->id;
        $invest->amount = $amount;
        $invest->profit = $profit;
        $invest->maturity = $maturity;
        $invest->point_in_time = $plan->schedule;
        $invest->point_in_text = $timeManage->name;
        $invest->afterward = Carbon::parse(now())->addHours($plan->schedule);
        $invest->status = 1;
        $invest->capital_back = $plan->is_capital_back;
        $invest->trx = $trx;
        $invest->save();
    }

}
