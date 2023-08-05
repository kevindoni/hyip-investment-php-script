<?php

namespace App\Console\Commands;

use App\Http\Traits\Notify;
use App\Models\PayoutLog;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BinanceGetStatus extends Command
{
    use Notify;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payout-status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron for Binance Status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $basic = (object)config('basic');
        $methodObj = 'App\\Services\\Payout\\binance\\Card';
        $data = $methodObj::getStatus();
        if ($data) {
            $apiResponses = collect($data);
            $binaceIds = $apiResponses->pluck('id');
            $payouts = PayoutLog::whereIn('response_id', $binaceIds)->where('status', 1)->get();
            foreach ($payouts as $payout) {
                $user = $payout->user;
                foreach ($apiResponses as $apiResponse) {
                    if ($payout->response_id == $apiResponse->id) {
                        $status = $apiResponse->status;
                        if ($status == 6) {
                            $payout->status = 2;
                            $payout->save();
                            $binance = new BinanceGetStatus();
                            $binance->userSuccessNotify($payout);

                        } elseif ($status == 1 || $status == 3 || $status == 5) {
                            $payout->status = 4;
                            $payout->save();

                            $user->balance += $payout->net_amount;
                            $user->save();

                            $transaction = new Transaction();
                            $transaction->user_id = $user->id;
                            $transaction->amount = getAmount($payout->net_amount);
                            $transaction->final_balance = $user->balance;
                            $transaction->charge = $payout->charge;
                            $transaction->trx_type = '+';
                            $transaction->remarks = getAmount($payout->amount) . ' ' . $basic->currency . ' withdraw amount has been refunded';
                            $transaction->trx_id = $payout->trx_id;
                            $transaction->save();


                            $binance = new BinanceGetStatus();
                            $binance->userFailNotify($payout, $user);
                        }
                        break;
                    }
                }
            }
        }
        return 0;
    }


    public function userSuccessNotify($data)
    {
        $user = $data->user;
        $basic = (object)config('basic');

        try {
            $userMsg = [
                'amount' => getAmount($data->amount),
                'currency' => $basic->currency,
            ];

            $adminMsg = [
                'user_name' => $user->fullname,
                'amount' => getAmount($data->amount),
                'currency' => $basic->currency,
            ];

            $adminAction = [
                "link" => route('admin.payout-log'),
                "icon" => "fa fa-money-bill-alt"
            ];

            $userAction = [
                "link" => '#',
                "icon" => "fa fa-money-bill-alt"
            ];

            $this->adminPushNotification('ADMIN_NOTIFY_PAYOUT_APPROVE', $adminMsg, $adminAction);
            $this->userPushNotification($user, 'USER_NOTIFY_PAYOUT_APPROVE', $userMsg, $userAction);

            $currentDate = dateTime(Carbon::now());
            $this->sendMailSms($user, $type = 'USER_MAIL_PAYOUT_APPROVE', [
                'method' => optional($data->method)->name,
                'amount' => getAmount($data->amount),
                'charge' => getAmount($data->charge),
                'currency' => $basic->currency,
                'transaction' => $data->trx_id,
                'feedback' => $data->feedback,
                'date' => $currentDate
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_PAYOUT_APPROVE', [
                'user_name' => $user->fullname,
                'method' => optional($data->method)->name,
                'amount' => getAmount($data->amount),
                'charge' => getAmount($data->charge),
                'currency' => $basic->currency,
                'transaction' => $data->trx_id,
                'feedback' => $data->feedback,
                'date' => $currentDate
            ]);
        } catch (\Exception $e) {
            return 0;
        }
        return 0;
    }


    public function userFailNotify($data, $user = null)
    {
        $user = $data->user;
        $basic = (object)config('basic');

        try {
            $userMsg = [
                'amount' => getAmount($data->amount),
                'currency' => $basic->currency,
            ];

            $adminMsg = [
                'user_name' => $user->fullname,
                'amount' => getAmount($data->amount),
                'currency' => $basic->currency,
            ];

            $adminAction = [
                "link" => route('admin.payout-log'),
                "icon" => "fa fa-money-bill-alt"
            ];

            $userAction = [
                "link" => '#',
                "icon" => "fa fa-money-bill-alt"
            ];

            $this->adminPushNotification('ADMIN_NOTIFY_PAYOUT_REJECTED', $adminMsg, $adminAction);
            $this->userPushNotification($user, 'USER_NOTIFY_PAYOUT_REJECTED', $userMsg, $userAction);

            $currentDate = dateTime(Carbon::now());
            $this->sendMailSms($user, $type = 'USER_MAIL_PAYOUT_REJECTED', [
                'method' => optional($data->method)->name,
                'amount' => getAmount($data->amount),
                'charge' => getAmount($data->charge),
                'currency' => $basic->currency,
                'transaction' => $data->trx_id,
                'feedback' => $data->feedback,
                'date' => $currentDate
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_PAYOUT_REJECTED', [
                'user_name' => $user->fullname,
                'method' => optional($data->method)->name,
                'amount' => getAmount($data->amount),
                'charge' => getAmount($data->charge),
                'currency' => $basic->currency,
                'transaction' => $data->trx_id,
                'feedback' => $data->feedback,
                'date' => $currentDate
            ]);
        } catch (\Exception $e) {
            return 0;
        }
        return 0;
    }

}
