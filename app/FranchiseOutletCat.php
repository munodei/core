<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FranchiseOutletCat extends Model
{
  protected $table = 'franchise_outlet_cats';
  protected$fillable = ['id', 'franchise_id', 'outlet_cat_id', 'status', 'created_at', 'updated_at'];
}
