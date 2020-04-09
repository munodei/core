<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{
    protected $table = 'withdraw_methods';
    protected $fillable = ['id', 'name', 'image', 'percent', 'charge','duration', 'status', 'withdraw_min', 'withdraw_max', 'created_at', 'updated_at'];
}
