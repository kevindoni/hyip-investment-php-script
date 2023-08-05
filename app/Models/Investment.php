<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['nextPayment'];

    public function getNextPaymentAttribute()
    {
        $start  = strtotime(($this->formerly) ? :$this->created_at);
        $end = strtotime($this->afterward);
        $diff = $end - $start;
        $current = time();
        $currentDiff = $current - $start;

        if ($currentDiff > $diff) {
            $percent = 1.0;
        }
        else if ($current < $start) {
            $percent = 0.0;
        }
        else {
            $percent = $currentDiff / $diff;
        }
        return sprintf('%.2f%%', $percent * 100);
    }

    public function plan()
    {
        return $this->belongsTo(ManagePlan::class,'plan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
