<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingItem extends Model
{
    protected $table = 'shopping_items';
    protected $fillable = ['id', 'user_id', 'shopping_item_name', 'shopping_item_description', 'shopping_item_outlets', 'shopping_item_quantity', 'shopping_item_price', 'shopping_item_brand', 'users', 'slug', 'photo', 'approved', 'created_at', 'updated_at'];
}
