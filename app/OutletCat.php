<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutletCat extends Model
{
    protected $table    = 'outlet_categories';
    protected $fillable = ['id', 'outlet_cat', 'outlet_cat_des', 'photo', 'status', 'deleted_at', 'created_at', 'updated_at'];


    public function outlets()
    {
        return $this->belongsToMany('App\Outlet')->using('App\OutletCatOutlet');
    }


    public function franchises()
    {
        return $this->belongsToMany('App\Franchise')->using('App\FranchiseCatOutlet');
    }
    public function pro_cats()
    {
        return $this->belongsToMany('App\ProCat');
    }
    

}
