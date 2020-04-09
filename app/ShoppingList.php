<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $table    = 'shopping_lists';
    protected $fillable = ['id', 'user_id', 'shopping_lists_name', 'shopping_lists_descripltion', 'shopping_lists_type', 'shopping_lists_order', 'shopping_items', 'slug', 'created_at', 'updated_at'];

    public function scopeSlug($query,$slug)
    {
        return $query->where('slug', $slug);
    }
}
