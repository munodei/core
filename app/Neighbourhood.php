<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighbourhood extends Model
{

  protected $table ='neighbourhoods';
  protected $fillable = ['id', 'city_id', 'neighbourhood', 'neighbourhood_description', 'slug', 'neighbourhood_photo', 'status', 'created_at', 'updated_at'];

  public function city(){

           return $this->belongsTo(City::class);

  }

  public function suburbs(){
          return $this->hasMany('App\Suburb')->orderBy('suburb', 'asc');
  }

  public function outlet(){
          return $this->hasMany('App\Outlet');
  }
}
