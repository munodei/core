<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
   protected $table = '';
   protected $fillable = ['id', 'user_id', 'method', 'amount', 'charge', 'user_balance', 'total', 'created_at', 'updated_at'];
}
