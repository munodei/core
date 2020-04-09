<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingListItem extends Model
{
    protected $table = 'shopping_list_items';
    protected $fillable = ['id', 'shopping_list_id', 'shopping_item_id', 'created_at', 'updated_at'];
}
