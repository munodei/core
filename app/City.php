<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['id', 'state_id', 'city', 'slug', 'city_description', 'city_photo','status', 'created_at', 'updated_at'];
    public function state(){

             return $this->belongsTo(State::class);

    }

    public function neighbourhoods(){
            return $this->hasMany('App\Neighbourhood')->orderBy('neighbourhood', 'asc');
    }

    public function outlet(){
            return $this->hasMany('App\Outlet');
    }
}
