<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

  protected $table = 'bills';
  protected $guarded = [];

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function biller()
  {
      return $this->belongsTo('App\Biller','biller_id','id');
  }

  public function currency()
  {
      return $this->belongsTo('App\Currency','currency_id','id');
  }


}
