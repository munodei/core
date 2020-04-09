<?php
namespace App\Imports\ShoppingItems;

use Mail;
use Excel;
use App\User;
use App\UserEntry;
use App\ShoppingItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ShoppingItems implements ToModel, WithHeadingRow
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {

      if(!ShoppingItem::where([
              ['shopping_item_name',$row['shopping_item_name'] ?? ''],
              ['shopping_item_description',$row['shopping_item_description'] ?? ''],
              ['shopping_item_outlets',$row['shopping_item_outlets'] ?? ''],
              ['shopping_item_quantity',$row['shopping_item_quantity'] ?? ''],
              ['shopping_item_price',$row['shopping_item_price'] ?? ''],
              ['shopping_item_brand',$row['shopping_item_brand'] ?? ''],
              ['user_id',Auth::user()->id]
            ])->exists()){

      $shopping_item = ShoppingItem::create([

            'shopping_item_name'       => $row['shopping_item_name'] ?? '',
            'shopping_item_description'=> $row['shopping_item_description'] ?? '',
            'shopping_item_outlets'    => $row['shopping_item_outlets'] ?? '',
            'shopping_item_quantity'   => $row['shopping_item_quantity'] ?? '',
            'shopping_item_price'      => $row['shopping_item_price'] ?? '',
            'shopping_item_brand'      => $row['shopping_item_brand'] ?? '',
            'photo'                    => $row['photo_link'] ?? 'https://mypdz.com/assets/images/images.png',
            'slug'                     => unique_slug($row['shopping_item_name'],'ShoppingItem') ?? '',
            'user_id'                  => Auth::user()->id,
        ]);

      UserEntry::create([
      					'user_id'    =>Auth::user()->id,
      					'shopping_item_id' =>$shopping_item->id,
      					'owner'      =>1,
      					'created_at' =>date('Y-m-d h:i:s'),
      					'updated_at' =>date('Y-m-d h:i:s'),

      				]);


       return $shopping_item;
       
     }
    
    }

}