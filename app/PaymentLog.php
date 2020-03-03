<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
         protected $table = 'payment_logs';
         protected $fillable = ['id', 'user_id', 'amount', 'timestamp', 'email', 'processor', 'hash', 'created_at', 'updated_at'];
}
