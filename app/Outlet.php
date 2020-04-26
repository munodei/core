<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'outlets';
    protected $fillable = ['id', 'outlet', 'slug', 'franchise_id','outlet_desc', 'franchise_id', 'outlet_photo', 'outlet_cat_id', 'outtlet_long', 'outlet_lat', 'neighbourhood_id', 'suburb_id', 'city_id', 'state_id', 'country_id', 'address', 'phone', 'email', 'website', 'open_time', 'status', 'deleted_at', 'created_at', 'updated_at'];
    public function suburb(){

             return $this->belongsTo(Suburb::class);

    }
    public function neighbourhood(){

             return $this->belongsTo(Neighbourhood::class);

    }
    public function state(){

             return $this->belongsTo(State::class);

    }
    public function country(){

             return $this->belongsTo(Neighbourhood::class);

    }
    public function outlet_cat(){

             return $this->belongsTo(OutletCat::class);

    }
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
    public function outlet_cats()
    {
        return $this->belongsToMany('App\OutletCat');
    }
}
