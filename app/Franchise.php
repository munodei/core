<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    protected $table = 'franchises';
    protected $fillable = ['id', 'franchise','photo', 'franchise_description', 'slug', 'status', 'created_at', 'updated_at'];
    public function products(){
            return $this->hasMany('App\Product');
    }



    public function outlet_cats()
    {
        return $this->belongsToMany('App\OutletCat');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
