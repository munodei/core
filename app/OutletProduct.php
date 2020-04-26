<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutletProduct extends Model
{
    protected $table = 'outlet_product';
    protected $fillable = ['id', 'outlet_id', 'product_id', 'created_at', 'updated_at'];
}
