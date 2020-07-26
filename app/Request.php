<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use SoftDeletes;
    protected  $guarded = [];
    protected $table = "tbl_request";
    
}
