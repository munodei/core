<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Continent extends Model
{
    use SoftDeletes;

    protected $table = "continents";

    protected $guarded = [];

    public function countries()
    {
        return $this->hasMany('App\Country','continent_id','id')->orderBy('name');
    }


}
