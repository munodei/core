<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillPayment extends Model
{
  protected $table = 'bill_payments';
  protected $fillable = ['id','user_id','trx_id','trx','biller_id','bill_id','status','remark','amount','deleted_at','created_at','updated_at'];

  public function user()
  {
      return $this->belongsTo('App\User','user_id','id');
  }

  public function biller()
  {
      return $this->belongsTo('App\Biller','biller_id','id');
  }

  public function bill()
  {
      return $this->belongsTo('App\Bill','bill_id','id');
  }

}
