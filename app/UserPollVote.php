<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPollVote extends Model
{
     protected $table = 'user_poll_votes';
     protected $fillable = ['id', 'userid', 'pollid', 'answerid', 'IP', 'user_agent', 'timestamp', 'date_stamp', 'created_at', 'updated_at'];
}
