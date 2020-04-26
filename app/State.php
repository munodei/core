<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = ['id', 'country_id', 'state', 'slug', 'state_description', 'state_image','status','created_at', 'updated_at'];

    public function country(){

             return $this->belongsTo(Country::class);

    }

    public function cities(){

            return $this->hasMany('App\City')->orderBy('city', 'asc');
    }

    public function outlet(){
            return $this->hasMany('App\Outlet');
    }

}
