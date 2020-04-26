<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';
  protected $fillable = ['id', 'product_name', 'product_description', 'product_outlets', 'product_quantity', 'product_price', 'product_brand', 'slug', 'photo', 'product_approved', 'pro_cat_id', 'product_outlet_id', 'url', 'status', 'created_at', 'updated_at'];
  public function outlets()
  {
      return $this->belongsToMany('App\Outlet');
  }

  public function pro_cat(){

           return $this->belongsTo(ProCat::class);

  }

  public function franchise(){

           return $this->belongsTo(Franchise::class);

  }
}
