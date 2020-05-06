<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverApplication extends Model
{
  protected  $guarded = [];

  protected $table = "driver_applications";

  public function country()
  {
      return $this->belongsTo('App\Country');
  }
  public function city()
  {
      return $this->belongsTo('App\City');
  }
  public function neighbourhood()
  {
      return $this->belongsTo('App\Neighbourhood');
  }
  public function suburb()
  {
      return $this->belongsTo('App\Suburb');
  }

}
