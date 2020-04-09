<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['id', 'user_id', 'icon', 'message', 'link', 'is_read', 'deleted_at', 'created', 'updated_at'];
}
