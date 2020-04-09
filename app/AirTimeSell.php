<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirTimeSell extends Model
{
  protected $table = 'air_time_sells';
  protected $fillable = ['id', 'user_id', 'amount', 'charge', 'amount_to_be_deposited', 'airtime_type', 'phone', 'is_whatsapp', 'token', 'status', 'network', 'network_id', 'deleted_at', 'created_at', 'updated_at'];
}
