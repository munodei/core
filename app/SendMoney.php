<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendMoney extends Model
{
    protected $table ="send_moneys";
    protected  $guarded = [];

    public function fromCurrency()
    {
        return $this->belongsTo('App\Country','from_currency','id');
    }

    public function toCurrency()
    {
        return $this->belongsTo('App\Country','to_currency','id');
    }

    protected $dates = ['received_at'];

}
