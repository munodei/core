<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStat extends Model
{
        protected $table = 'user_stats';
        protected $fillable = ['id', 'userid', 'timestamp', 'polls', 'poll_votes', 'poll_votes_today', 'created_at', 'updated_at'];
}
