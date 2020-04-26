<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProCat extends Model
{
    protected $table = 'pro_categories';
    protected $fillable = ['id', 'pro_category_name', 'slug', 'pro_category_id', 'pro_description', 'pro_category_type', 'pro_category_icon', 'pro_cat_id', 'outlet_cat_id', 'status', 'created_at', 'updated_at'];

    public function sub_categories(){

            return $this->hasMany('App\ProSubCat')->orderBy('pro_category_name', 'asc');
    }
    public function pro_cat(){

             return $this->belongsTo(OutletCat::class);

    }
}
