<?php namespace App\Http\Controllers\Common;

use App;
use Excel;
use Mail;
use Storage;
use App\User;
use App\Product;
use App\UserEntry;
use App\ShoppingItem;
use App\ShoppingList;
use App\ShoppingListItem;
use App\Exports\ShoppingItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


class ShoppingItemController extends Controller
{

  public function __construct()
   {
       $this->middleware('auth')->except(['showShoppingProduct']);
       $this->icons = '<i class="material-icons">shopping_cart</i>';
   }

    public function index(Request $request){

        $user               = $request->user();
        $id                 = $user->id;
        $shopping_items     = ShoppingItem::leftjoin('user_entry','shopping_items.id','=','user_entry.entry_id')
                                                                                                                              ->where([
                                                                                                                                        ['user_entry.user_id',$id],
                                                                                                                                        ['user_entry.entry','shopping-item']
                                                                                                                                      ])
                                                                                                                              ->select('shopping_items.*')
                                                                                                                              ->get();
       if($request->has('search_shopping_items')){

       $shopping_items     = ShoppingItem::leftjoin('user_entry','shopping_items.id','=','user_entry.shopping_item_id')
                                                                                                                        ->where([
                                                                                                                                  ['user_entry.user_id',$id],
                                                                                                                                  ['user_entry.entry','shopping-item'],
                                                                                                                                  ['shopping_items.shopping_item_name', 'like', "%{$request->input('search_shopping_items')}%"]
                                                                                                                                ])
                                                                                                                              ->orwhere([
                                                                                                                                         ['user_entry.user_id',$id],
                                                                                                                                         ['user_entry.entry','shopping-item'],
                                                                                                                                         ['shopping_items.shopping_item_description', 'like', "%{$request->input('search_shopping_items')}%"]
                                                                                                                                        ])
                                                                                                                              ->select('shopping_items.*')
                                                                                                                              ->distinct()
                                                                                                                              ->get();

                            }


       $shopping_lists     = array();

       $shopping_lists1    = ShoppingList::leftjoin('user_entry','shopping_lists.id','=','user_entry.entry_id')
                                                                                                                               ->leftjoin(
                                                                                                                                'shopping_list_items',
                                                                                                                                'shopping_list_items.shopping_list_id',
                                                                                                                                '=',
                                                                                                                                'user_entry.entry_id')
                                                                                                                                ->leftjoin(
                                                                                                                                  'shopping_items',
                                                                                                                                  'shopping_items.id',
                                                                                                                                  '=',
                                                                                                                                  'shopping_list_items.shopping_item_id')
                                                                                                                                ->where([
                                                                                                                                  ['user_entry.user_id',$id],
                                                                                                                                  ['user_entry.entry','shopping-list'],

                                                                                                                                ])
                                                                                                                                ->select(
                                                                                                                                  'shopping_lists.id as shopping_listID',
                                                                                                                                  'shopping_lists.slug as shopping_listSlug',
                                                                                                                                  'shopping_lists.*',
                                                                                                                                  'shopping_items.id as shopping_itemID',
                                                                                                                                  'shopping_items.slug as shopping_itemSlug',
                                                                                                                                  'shopping_items.*'
                                                                                                                                )
                                                                                                                                ->distinct()
                                                                                                                                ->get();


        foreach ($shopping_lists1 as $group) {

              $shopping_lists[$group->shopping_listID][] = $group;

        }
      $contacts = UserEntry::leftjoin('contacts','contacts.id','=','user_entry.entry_id')
                                                                                            ->leftjoin('users','users.id','=','contacts.user_id')
                                                                                             ->where([
                                                                                                               ['user_entry.user_id',$id],
                                                                                                               ['user_entry.entry','contact']
                                                                                                               ])
                                                                                             ->select('contacts.id as contactID','contacts.email as emailContactID','user_entry.id as userFileEntryID','users.id as userID','users.email as emailUserlD','contacts.*','user_entry.*')
                                                                                               ->orderby('contacts.created_at','DESC')->get();
        $page_title = 'Shopping Items';
        $products    = Product::all();
      return view('custom.shopping-items.index',compact('shopping_items','shopping_lists1','shopping_lists','contacts','page_title','products'));


    }

    public function exportAllShoppingItems(Request $request){


        add_notification($id, $this->icons, 'You exported all your Shopping Items! at'.date('Y-m-d h:i:s'), route('contacts-export'), 0);

       return (new ShoppingItems($request->user()->id))->download('shopping-items.csv');

    }

    public function assignGroupItem(Request $request){

      $rules = [
                'id'=>'required',
                'group_id'=>'required'
              ];

      $msgs = [
                'id.required'=>'Apprently there was an error with the Shopping Item, Please Select a shopping Item and Try Again',
                'group_id.required'=>'Apprently there was an error with the Shopping List, Please Select a Shopping List and Try Again',
                ];

      $request->validate($rules,$msgs);

      extract($_POST);

      $item = ShoppingList::find($group_id);

        if(!ShoppingListItem::where([['shopping_list_id',$group_id],['shopping_item_id',$id]])->exists()){

          $entry = ShoppingListItem::create([
              'shopping_list_id'=>$group_id,
              'shopping_item_id'=>$id,
              'created_at'=>date('Y-m-d H:i:s'),
              'updated_at'=>date('Y-m-d H:i:s'),

            ]);
            return redirect()->route('shopping-items')->with('success','You have successfully added an shopping item to a shopping list');
        }

      return redirect()->route('shopping-items')->with('error','No change happened to this group!');

    }

    public function addShoppingItem(Request $request){
        $page_title = 'Create Shopping Item';
        return view('custom.shopping-items.create',compact('page_title'));

    }

    public function showShoppingList(Request $request,$slug){

      $shopping_list  = ShoppingList::where('slug',$slug)->first();

      if(isset($shopping_list->user_id)){

      $user = User::find($shopping_list->user_id);

          if(ShoppingList::where([['slug',$slug],['user_id',Auth::user()->id]])->exists() || $user->sub == 1 || $request->user()->sub == 1 )
          {


          $shopping_items = ShoppingListItem::leftjoin('shopping_items','shopping_items.id','=','shopping_list_items.shopping_item_id')
                                                                                                                                      ->where('shopping_list_items.shopping_list_id',$shopping_list->id)
                                                                                                                                      ->select('shopping_items.*')
                                                                                                                                      ->get();

          return view('shopping-items.shopping-list-items',compact('shopping_list','shopping_items'));

         }

      }

      return redirect()->route('shopping-items')->with('error','Error Occured email administrator!');

    }

    public function showShoppingProduct($slug){

      $shopping_item = ShoppingItem::where('slug',$slug)->first();

      return view('shopping-items.shopping-item',compact('shopping_item'));


    }

    public function downloadShoppingItemsgroup(Request $request,$group_id){

        return (new ShoppingGroupItems($request->user()->id,intval($group_id)))->download('shopping-list.csv');

    }

    public function showShoppingItem(Request $request,$id){

      $user    = $request->user();
      $user_id = $user->id;

      if(UserEntry::where([['user_id',$user_id],['entry','shopping-item'],['entry_id',$id]])->exists()){

        if(UserEntry::where([['user_id',$user_id],['entry_id',$id],['entry','shopping-item'],['owner',1]])->exists()){

          $all_users = UserEntry::leftjoin('users','users.id','=','user_entry.user_id')->where([['entry','shopping-item'],['entry_id',$id]])->get();

        }else{

          $all_users = UserEntry::leftjoin('users','users.id','=','user_entry.user_id')->where([['user_id',$user_id],['entry','shopping-item'],['entry_id',$id]])->get();

        }

        $shopping_item = ShoppingItem::where('id',$id)->first();

        return view('shopping-items.shopping-item',['shopping_item','all_users','user']);

      }

      return redirect()->back()->with('error','Unfortunately you don\'t have access to this shopping ite,!');

    }

    public function editShoppingItem(Request $request,$id){

       $user                 = $request->user();

      if(ShoppingItem::where([['id',$id],['user_id',$user->id]])->exists()){

        $page_title = 'Edit Shopping Item';
        $shopping_item        = ShoppingItem::where([['id',$id],['user_id',$user->id]])->first();

        return view('custom.shopping-items.edit',compact('user','shopping_item','page_title'));

      }

      return redirect()->back()->with('error','Unfortunately you don\'t have access to this Shopping Item!');

    }

    public function addProductToShoppingItems(Request  $request){


      if(Auth::check()){

          extract($_POST);


              $user     = $request->user();
              $product  = Product::find($id);
              $id       = $user->id;

              if(!ShoppingItem::where([['shopping_item_name',$product->product_name],['shopping_item_price',$product->product_price ],['shopping_item_brand',$product->product_brand],['shopping_item_outlets',$product->product_outlets]])->exists()){

              $shopping_item =ShoppingItem::create([
                                                    'user_id'=>$id,
                                                    'shopping_item_name'=>$product->product_name ?? '',
                                                    'shopping_item_description'=>$product->product_description ?? '',
                                                    'shopping_item_outlets'=>$product->product_outlets ?? '',
                                                    'shopping_item_quantity'=>$product->product_quantity ?? '',
                                                    'shopping_item_price'=> $product->product_price ?? '',
                                                    'shopping_item_brand'=> $product->product_brand,
                                                    'slug'=>unique_slug($product->product_name,'ShoppingItem') ?? '',
                                                    'photo'=>$product->product_photo ?? '/assets/uploads/shopping-items/images.png',
                                                    'created_at'=>date('Y-m-d h:i:s'),
                                                    'updated_at'=>date('Y-m-d h:i:s')
                                                    ]);

              $entry = UserEntry::create([
                                  'user_id'=>$id ?? 1,
                                  'entry_id'=>$shopping_item->id,
                                  'entry'=>'shopping-item',
                                  'owner'=>1,
                                  'created_at'=>date('Y-m-d h:i:s')
                                  ]);

           return redirect()->route('shopping-items')->with('success','You have successfull added a Shopping Item');
         }
         return redirect()->route('shopping-items')->with('error','Product Already Added To Shopping Items');
      }

    }

    public function saveShoppingItem(Request  $request){



      $rules = [

                'shopping_item_name'          =>'required',
                'shopping_item_description'   =>'required',
                'shopping_item_brand'         =>'required',
                'shopping_item_quantity'      =>'required',

               ];

      $this->validate($request,$rules);

      if(Auth::check()){

          extract($_POST);

           if($request->hasFile('upload')) {

                  $filenameWithExt = $request->file('upload')->getClientOriginalName();
                  $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                  $extension       = $request->file('upload')->getClientOriginalExtension();
                  $fileNameToStore = $filename.'-'.time().'.'.$extension;

                  $request->file('upload')->move(base_path() . '/assets/uploads/shopping-items/', $fileNameToStore);

                  $fileNameToStore = '/assets/uploads/shopping-items/'.$fileNameToStore;

            }

              $user     = $request->user();
              $id       = $user->id;

              $shopping_item =ShoppingItem::create([
                                                    'user_id'=>$id,
                                                    'shopping_item_name'=>$shopping_item_name ?? '',
                                                    'shopping_item_description'=>$shopping_item_description ?? '',
                                                    'shopping_item_outlets'=>$shopping_item_outlets ?? '',
                                                    'shopping_item_quantity'=>$shopping_item_quantity ?? '',
                                                    'shopping_item_price'=> $shopping_item_price ?? '',
                                                    'shopping_item_brand'=> $shopping_item_brand,
                                                    'slug'=>unique_slug($shopping_item_name,'ShoppingItem') ?? '',
                                                    'photo'=>$fileNameToStore ?? '/assets/uploads/shopping-items/images.png',
                                                    'created_at'=>date('Y-m-d h:i:s'),
                                                    'updated_at'=>date('Y-m-d h:i:s')
                                                    ]);

              $entry = UserEntry::create([
                                  'user_id'=>$id ?? 1,
                                  'entry_id'=>$shopping_item->id,
                                  'entry'=>'shopping-item',
                                  'owner'=>1,
                                  'created_at'=>date('Y-m-d h:i:s')
                                  ]);

           return redirect()->route('shopping-items')->with('success','You have successfull added a Shopping Item');
      }

    }

    public function import(Request $request){

      return view('shopping-items.import');

    }

    public function export(Request $request){

      return view('shopping-items.export');

    }

    public function shareShoppingItem(Request $request){

        $rules = [
                  'id'=>'required',
                  'email'=>'required',


        ];
        $msgs  = [

              'id.required'=>'The Shopping Item is required!',
              'email.required'=>'Please Select A Valid User to Use this Service!',

        ];

        $request->validate($rules,$msgs);
        $user_id = $request->user()->id;
        extract($_POST);
        if(UserEntry::where([['user_id',$user_id],['entry_id',$id],['entry','shopping-item']])->exists())
        {
        if(User::where('email','=',trim($email))->exists()){

          $user = User::where('email','=',trim($email))->first();

             if(!UserEntry::where([['user_id',$user->id],['entry_id',$id],['entry','shopping-item'],['owner',0]])->exists())
             {

                        $entry = UserEntry::create([
                                              'user_id'=>$user->id,
                                              'entry_id'=>$id,
                                              'entry'=>'shopping-item',
                                              'owner'=>0,
                                              'created_at'=>date('Y-m-d h:i:s')
                                              ]);

             }
                add_notification($id, $this->icons, 'Shopping Item Sharing Successful! : @'.date('Y-m-d h:i:s'), route('shopping-items'), 0);
              return redirect()->route('shopping-items')->with('success','You successfully shared your Shopping Item!');


        }
        else
        {
          add_notification($id, $this->icons, 'Shopping Item Sharing Failed, User does not exist! : @'.date('Y-m-d h:i:s'), route('shopping-items'), 0);
          return redirect()->route('shopping-items')->with('error','The user you are trying to share a Shopping Item with isn\'t a registered user!');
        }
      }
      add_notification($id, $this->icons, 'You tried to share a Shopping Item which does not belong to you! : @'.date('Y-m-d h:i:s'), route('shopping-items'), 0);
      return redirect()->route('shopping-items')->with('error','Error Occured!');
    }



public function updateShoppingItem(Request $request,$id){

$rules = [

                'shopping_item_name'          =>'required',
                'shopping_item_description'   =>'required',
                'shopping_item_brand'         =>'required',

               ];

      $this->validate($request,$rules);

      if(Auth::check() && ShoppingItem::where([['user_id',$request->user()->id],['id',$id]])->exists()){

          extract($_POST);

          $user     = $request->user();

          $shopping_item =  ShoppingItem::find($id);


           if($request->hasFile('upload')) {

                  $filenameWithExt = $request->file('upload')->getClientOriginalName();
                  $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                  $extension       = $request->file('upload')->getClientOriginalExtension();
                  $fileNameToStore = $filename.'-'.time().'.'.$extension;

                   $request->file('upload')->move(base_path() . '/assets/uploads/shopping-items/', $fileNameToStore);

                   $fileNameToStore = '/assets/uploads/shopping-items/'.$$fileNameToStore;

                   $shopping_item->photo         = $fileNameToStore;

            }

              $shopping_item->shopping_item_name          = $shopping_item_name ?? '';
              $shopping_item->shopping_item_description   = $shopping_item_description ?? '';
              $shopping_item->shopping_item_outlets       = $shopping_item_outlets ?? '';
              $shopping_item->shopping_item_quantity      = $shopping_item_quantity ?? '';
              $shopping_item->shopping_item_price         = $shopping_item_price ?? '';
              $shopping_item->shopping_item_brand         = $shopping_item_brand ?? '';
              $shopping_item->slug                        = unique_slug($shopping_item_name,'ShoppingItem') ?? '';
              $shopping_item->updated_at                  = date('Y-m-d h:i:s');

              $shopping_item->save();

              if(!UserEntry::where([['user_id',$request->user()->id],['entry_id',$id],['entry','shopping-item',],['owner',1]])->exists()){

                $entry = UserEntry::create([
                                  'user_id'=>$request->user()->id,
                                  'entry_id'=>$id,
                                  'entry'=>'shopping-item',
                                  'owner'=>1,
                                  'created_at'=>date('Y-m-d h:i:s')
                                  ]);

              }

           return redirect()->route('shopping-items')->with('success','You have successfull updated a Shopping Item');
      }

      return redirect()->back()->with('error','Error Occured!');
    }

    public function deleteFromShoppingList(Request $request,$group_id,$shopping_item_id){

      if(UserEntry::where([['user_id',$request->user()->id],['entry','shopping-list'],['entry_id',$group_id]])->exists()){

          if(ShoppingListItem::where([['shopping_list_id',$group_id],['shopping_item_id',$shopping_item_id]])->exists()){

                ShoppingListItem::where([['shopping_list_id',$group_id],['shopping_item_id',$shopping_item_id]])->delete();


          }

          return redirect()->back()->with('success','You have deleted an item from this shopping list');

        }

        return redirect()->back()->with('error','You have don\'t rights to delete items from this shopping list');

     }


public function deleteShoppingItem(Request $request){
    extract($_POST);
    $request->validate(['id'=>'required'],['id.required'=>'The Shopping item is Required For this Process!']);
    $user_id          = $request->user()->id;

    if(ShoppingItem::where([['id',$id],['user_id',$user_id]])->exists()){

        ShoppingItem::where([['id',$id],['user_id',$user_id]])->delete();
        UserEntry::where([['entry','shopping-item'],['entry_id',$id]])->delete();
        ShoppingListItem::where('shopping_item_id',$id)->delete();

      }else{

        UserEntry::where([['entry','shopping-item'],['entry_id',$id],['user_id',$user_id]])->delete();

      }

    return redirect()->route('shopping-items')->with('error','You have successfull deleted a item');


}


}
