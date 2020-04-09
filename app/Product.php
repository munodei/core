<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';
  protected $fillable = ['id', 'product_name', 'product_description', 'product_outlets', 'product_quantity', 'product_price', 'product_brand', 'product_slug', 'product_photo', 'product_approved', 'product_cat', 'created_at', 'updated_at'];
}
