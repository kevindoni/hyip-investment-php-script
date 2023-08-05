<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ManagePlan extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['price'];

    /*
     * Price With Currency
     */
    public function getPriceAttribute()
    {
        if ($this->fixed_amount == 0) {
            return config('basic.currency_symbol') . $this->minimum_amount . ' - ' . config('basic.currency_symbol') . $this->maximum_amount;
        }
        return config('basic.currency_symbol').$this->fixed_amount;
    }




    public function getStatusMessageAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge badge-warning">' . trans('In-active') . '</span>';
        }
        return '<span class="badge badge-success">' . trans('Active') . '</span>';
    }

    public function getFeaturedMessageAttribute()
    {
        if ($this->featured == 0) {
            return '<span class="badge badge-warning">' . trans('No') . '</span>';
        }
        return '<span class="badge badge-success">' . trans('Yes') . '</span>';
    }



}
