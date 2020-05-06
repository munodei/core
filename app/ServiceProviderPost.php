<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderPost extends Model
{
  protected $table = "service_provider_posts";
  protected $guarded =[];

  public function service_provider_postmeta(){

           return $this->hasMany(ServiceProviderPostmeta::class);

  }

  public function location(){

           return $this->hasMany(ServiceProviderPostmeta::class);

  }

  public function picture(){

           return $this->hasOne(ServiceProviderPostmeta::class)->where('meta_key','essb_cached_image');

  }

  public function service_provider_user(){

           return $this->belongsTo(ServiceProviderUser::class);

  }

}
