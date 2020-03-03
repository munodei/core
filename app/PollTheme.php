<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollTheme extends Model
{
     protected $table = 'poll_themes';
     protected $fillable = ['id', 'name', 'css_code', 'created_at', 'updated_at'];
}
