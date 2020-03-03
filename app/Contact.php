<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['id', 'firstname', 'lastname', 'additional', 'prefix', 'suffix', 'company', 'jobtitle', 'role', 'email', 'mobilephone', 'workphone', 'address', 'city', 'country_id', 'zip_code', 'label', 'url', 'photo', 'user_id', 'users', 'about', 'slug', 'contact_id', 'group_contact_id'];
}
