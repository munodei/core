<?php

namespace App\Exports;

use App\User;
use App\UserEntry;
use App\ShoppingList;
use App\ShoppingItem;
use App\ShoppingListItem;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShoppingGroupItems implements FromArray
{
     use Exportable;

    public function __construct(int $id,$group_id)
    {
        $this->id = $id;
        $this->group_id = $group_id;
    }

    public function array() : array
    {
        $shopping_list  = ShoppingList::where('slug',$this->group_id)->first();
        $shopping_items = ShoppingListItem::leftjoin('shopping_items','shopping_items.id','=','shopping_list_items.shopping_item_id')
        																													  ->where('shopping_list_id',$shopping_list->id)
                                                                                                                              ->select(
                                                                                                                                'shopping_items.shopping_item_name',
                                                                                                                                'shopping_items.shopping_item_outlets',
                                                                                                                                'shopping_items.shopping_item_quantity',
                                                                                                                                'shopping_items.shopping_item_price',
                                                                                                                                'shopping_items.shopping_item_brand'
                                                                                                                                )
                                                                                                                              ->get()
                                                                                                                              ->toArray();

	   return $shopping_items;
                
    }

}
