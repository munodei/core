<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
  protected $table= 'delivery_locations';
  protected $fillable = ['id','user_id','name', 'slug', 'address', 'suburb', 'neighbourhood', 'city', 'state', 'country', 'zip_code', 'instruction', 'created_at', 'updated_at'];
}
