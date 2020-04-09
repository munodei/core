<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingListRequest extends Model
{
    protected $table    = 'shopping_list_requests';
    protected $fillable = ['id','user_id','shopping_list_id','shopping_list_slug','name','phone','is_whatsapp','email','message','doc','address','suburb','neighbourhood','city','state','country','zip_code','status','reason','created_at','updated_at'];
}
