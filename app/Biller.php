<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{

  protected $table = 'billers';
  protected $guarded = [];

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function country()
  {
      return $this->belongsTo('App\Country','biller_country','id');
  }

  public function currency()
  {
      return $this->belongsTo('App\Currency','currency_id','id');
  }

}
