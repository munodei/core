<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  protected $guarded = [];


  public function faqs(){
      return $this->hasMany('App\ServiceFaq');
  }

}
