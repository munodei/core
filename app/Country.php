<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    protected  $guarded = [];

    protected $table = "countries";

    public function continent()
    {
        return $this->belongsTo('App\Continent');
    }
}
