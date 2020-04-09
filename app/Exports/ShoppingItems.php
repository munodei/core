<?php

namespace App\Exports;

use App\User;
use App\UserEntry;
use App\ShoppingItem;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShoppingItems implements FromArray
{
     use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function array() : array
    {


        $shopping_items =  ShoppingItem::leftjoin('user_file_entry','shopping_items.id','=','user_file_entry.shopping_item_id')
                                                                                                                              ->where([
                                                                                                                                        ['user_file_entry.user_id',$this->id],
                                                                                                                                        ['user_file_entry.shopping_item_id','!=',null]
                                                                                                                                      ])
                                                                                                                              ->select(
                                                                                                                                'shopping_items.shopping_item_name',
                                                                                                                                'shopping_items.shopping_item_description',
                                                                                                                                'shopping_items.shopping_item_outlets',
                                                                                                                                'shopping_items.shopping_item_quantity',
                                                                                                                                'shopping_items.shopping_item_price',
                                                                                                                                'shopping_items.shopping_item_brand',
                                                                                                                                'shopping_items.photo'
                                                                                                                              
                                                                                                                                )
                                                                                                                              ->get()
                                                                                                                              ->toArray();

	   return $shopping_items;
                
    }

}
