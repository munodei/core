<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderPostmeta extends Model
{
  protected $table = "service_provider_postmeta";
  protected $guarded =[];

  public function service_provider_post(){

           return $this->hasOne(ServiceProviderPost::class);

  }

}
