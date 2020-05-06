<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
  protected  $guarded = [];

  protected $table = "shopping_carts";

  public function continent()
  {
      return $this->belongsTo('App\User');
  }

  public function items()
  {
      return $this->hasMany('App\Item');
  }
}
