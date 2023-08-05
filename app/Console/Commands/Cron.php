<?php

namespace App\Console\Commands;

use App\Models\Investment;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Facades\App\Services\BasicService;

class Cron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron for investment Status';

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
        $now = Carbon::now();
        $basic = (object) config('basic');
        $investments = Investment::whereHas('user')->whereHas('plan')->whereStatus(1)->where('afterward', '<=', $now)->with(['user:id,firstname,lastname,username,email,phone_code,phone,balance,interest_balance','plan'])->get();

        foreach ($investments as $data) {
            if($data){
                $next_time = Carbon::parse($now)->addHours($data->point_in_time);
                $invest= $data;
                $invest->recurring_time += 1;
                $invest->afterward = $next_time; // next Profit will get
                $invest->formerly = $now; // Last Time Get Profit

                // Return Amount to user's Interest Balance
                $user = $data->user;
                $new_balance = getAmount($user->interest_balance + $data->profit);
                $user->interest_balance = $new_balance;
                $user->total_interest_balance += $data->profit;
                $user->save();

                $remarks =  getAmount($data->profit) . ' ' . $basic->currency . ' Interest From '.optional($invest->plan)->name;
                BasicService::makeTransaction($user, $data->profit, 0, $trx_type = '+', $balance_type = 'interest_balance',  $trx = strRandom(), $remarks);


                // Complete the investment if user get full amount as plan
                if ($invest->recurring_time >= $data->maturity && $data->maturity != '-1') {
                    $invest->status = 0; // stop return Back
                    // Give the capital back if plan says the same
                    if ($data->capital_back == 1) {
                        $capital =  $data->amount;
                        $new_balance = getAmount($user->interest_balance + $capital);
                        $user->interest_balance = $new_balance;
                        $user->save();
                        $remarks = getAmount($capital) . ' ' . $basic->currency . ' Capital Back From '.optional($invest->plan)->name;
                        BasicService::makeTransaction($user, getAmount($capital), 0, $trx_type = '+', $balance_type = 'interest_balance',  $trx = strRandom(), $remarks);
                    }
                }
                $invest->status = ($data->period == '-1') ? 1 : $invest->status; // Plan will run Lifetime
                $invest->save();


                if ($basic->profit_commission == 1) {
                    BasicService::setBonus($user, $data->profit, $type = 'profit_commission');
                }

            }

        }

        $this->info('status');
    }

}
