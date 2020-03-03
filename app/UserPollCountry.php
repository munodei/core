<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPollCountry extends Model
{
        protected $table = 'user_poll_countries';
        protected $fillable = ['id', 'pollid', 'country', 'votes', 'created_at', 'updated_at'];
}
