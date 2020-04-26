<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
    protected $table = 'suburbs';
    protected $fillable = ['id', 'suburb','neighbourhood_id', 'slug', 'neighbourhood', 'suburb_description', 'suburb_type', 'suburb_photo','status','created_at', 'updated_at'];
    public function neighbourhood(){

             return $this->belongsTo(Neighbourhood::class);

    }
    public function outlet(){
            return $this->hasMany('App\Outlet');
    }

}
