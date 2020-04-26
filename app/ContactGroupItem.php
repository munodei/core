<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactGroupItem extends Model
{
    protected $table = 'contact_group_items';
    protected $fillable = ['id', 'contact_group_id', 'contact_id', 'created_at', 'updated_at'];
}
