<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetLog extends Model
{
       protected $table = 'reset_log';
       protected $fillable = ['id', 'IP', 'timestamp', 'created_at', 'updated_at'];
}
	