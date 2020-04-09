<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileNetwork extends Model
{
    protected $table = 'mobile_networks';
    protected $fillable = ['id', 'name', 'logo', 'minamo', 'maxamo', 'percent_charge', 'fixed_charge', 'type','status', 'created_at', 'updated_at'];
}
