<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutletCatOutlet extends Model
{
    protected $table = 'outlet_outlet_cat';
    protected$fillable = ['id', 'outlet_id', 'outlet_cat_id', 'created_at', 'updated_at'];
}
