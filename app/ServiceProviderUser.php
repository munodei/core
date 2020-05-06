<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderUser extends Model
{
  protected $table = "service_provider_users";
  protected $guarded =[];

  public function user(){

           return $this->belongsTo(User::class);

  }

  public function service_provider_usermeta(){

           return $this->hasMany(ServiceProviderUsermeta::class);

  }

  public function service_provider_post(){

           return $this->hasMany(ServiceProviderPost::class);

  }

}
