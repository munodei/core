<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPollAnswer extends Model
{
     protected $table = 'user_poll_answers';
     protected $fillable = ['id', 'pollid', 'answer', 'image', 'votes', 'created_at', 'updated_at'];
}
