<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPoll extends Model
{
        protected $table = 'user_polls';
        protected $fillable = ['id', 'user_id', 'name', 'question', 'timestamp', 'show_results', 'ip_restricted', 'status', 'votes', 'created', 'updated', 'hash', 'vote_type', 'votes_today', 'votes_today_timestamp', 'votes_month', 'votes_month_timestamp', 'themeid', 'cookie_restricted', 'user_restricted', 'public', 'created_at', 'updated_at'];
}
