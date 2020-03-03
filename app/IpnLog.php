<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpnLog extends Model
{
    protected $table = 'ipn_logs';
    protected $fillable = ['id', 'data', 'timestamp', 'IP', 'created_at', 'updated_at'];
}
