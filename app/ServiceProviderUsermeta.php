<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderUsermeta extends Model
{
  protected $table = "service_provider_usermeta";
  protected $guarded =[];

  public function service_provider_user(){

           return $this->belongsTo(ServiceProviderUser::class);

  }

}
