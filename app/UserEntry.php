<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEntry extends Model
{
    protected $table = 'user_entry';
    protected $fillable = ['id', 'user_id', 'entry', 'entry_id', 'owner', 'role', 'created_at', 'updated_at'];
}
