<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProSubCat extends Model
{
  protected $table = 'pro_categories';

   public function parentCategory(){
       return $this->belongsTo(ProCats::class);
   }
}
