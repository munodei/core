<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    protected $table = 'contact_groups';
    protected $fillable = ['id', 'user_id', 'group_contacts_name', 'group_contacts_description', 'group_contacts_type', 'group_contacts_order', 'slug', 'contacts', 'created_at', 'updated_at'];
}
