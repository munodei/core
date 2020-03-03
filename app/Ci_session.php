<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ci_session extends Model
{
    protected $table = 'ci_sessions';
    protected $fillable = ['id', 'ip_address', 'timestamp', 'data','created_at','updated_at'];
}
