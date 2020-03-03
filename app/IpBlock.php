<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpBlock extends Model
{
      protected $table = 'ip_block';
      protected $fillable = ['id', 'IP', 'timestamp', 'reason', 'created_at', 'updated_at'];
}
