<?php namespace App\Http\Controllers\Common;

use Mail;
use App;
use Excel;
use Storage;
use App\User;
use App\ShoppingItem;
use App\UserEntry;
use App\ShoppingList;
use App\DeliveryLocation;
use App\ShoppingListRequest;
use App\Exports\ShoppingGroupItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;


class ShoppingListController extends Controller
{

  public function __construct()
   {
       $this->middleware('auth');
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

    $delivery_locations = DeliveryLocation::where('user_id',$id)->get();
    $page_title = 'Shopping Lists';

     return view('custom.shopping-items.shopping-list',compact('shopping_items','shopping_lists1','shopping_lists','contacts','page_title','delivery_locations'));


   }


      public function create(Request $request)
      {

        $user = $request->user();



          if(isset($_POST['shopping_lists_name'])){

              $request->validate([
                  'shopping_lists_name'=>'required',
                  'shopping_lists_descripltion' => 'required'
                ]);

              extract($_POST);

              $group                              = new ShoppingList;
              $group->user_id                     = $user->id;
              $group->shopping_lists_name         = $shopping_lists_name;
              $group->shopping_lists_descripltion = $shopping_lists_descripltion;
              $group->slug                        = unique_slug($shopping_lists_name,'ShoppingList') ?? '';
              $group->created_at                  = date('Y-m-d h:i:s');
              $group->updated_at                  = date('Y-m-d h:i:s');
              $group->save();

              $entry = UserEntry::create([
                                                   'user_id'=>$user->id,
                                                   'entry_id'=>$group->id,
                                                   'entry'=>'shopping-list',
                                                   'owner'=>1,
                                                   'created_at'=>date('Y-m-d h:i:s'),
                                                   'updated_at'=>date('Y-m-d h:i:s')
                                                 ]);
              add_notification($user->id, $this->icons, 'You have successfully added a new Shopping List! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
              return redirect()->route('shopping-list')->with('success','You have successfully added a new Shopping List!');
         }

       return redirect()->route('login')->with('error','Sorry, Apparently you are not logged in!');

      }

      public function exportShoppingGroupItems(Request $request,$group_id){
          add_notification($request->user()->id, $this->icons, 'Exported All Items On Shopping List in CSV (Excel)! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
          $shopping_list = ShoppingList::where('slug',$group_id)->first();
          return (new ShoppingGroupItems($request->user()->id,$group_id))->download($shopping_list->slug.'.csv');

      }

      public function shareShoppingList(Request $request){

          $rules = [
                    'id'=>'required',
                    'slug'=>'required',
                    'email'=>'required',


          ];
          $msgs  = [

                'id.required'=>'The Shopping List is required!',
                'slug.required'=>'The Shopping List is required!',
                'email.required'=>'Please Select A Valid User to Use this Service!',

          ];

          $request->validate($rules,$msgs);
          $user_id = $request->user()->id;
          extract($_POST);
          if(UserEntry::where([['user_id',$user_id],['entry_id',$id],['entry','shopping-list']])->exists())
          {
          if(User::where('email','=',trim($email))->exists()){

            $user = User::where('email','=',trim($email))->first();

               if(!UserEntry::where([['user_id',$user->id],['entry_id',$id],['entry','shopping-list'],['owner',0]])->exists())
               {

                          $entry = UserEntry::create([
                                                'user_id'=>$user->id,
                                                'entry_id'=>$id,
                                                'entry'=>'shopping-list',
                                                'owner'=>0,
                                                'created_at'=>date('Y-m-d h:i:s')
                                                ]);

               }
                add_notification($user_id, $this->icons, 'Shopping List Sharing Successful! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
                return redirect()->route('shopping-list')->with('success','You successfully shared your Shopping List!');


          }

            add_notification($user_id, $this->icons, 'Shopping List Sharing Failed, User does not exist! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
            return redirect()->route('shopping-list')->with('error','The user you are trying to share a Shopping List with isn\'t a registered user!');


        }
        add_notification($user_id, $this->icons, 'Error Occured on attempt to Share Shopping List! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
        return redirect()->route('shopping-list')->with('error','Error Occured!');
      }

      public function shoppingListPurchaseRequest(Request $request){

        $rules = [
                  'shopping_list_id'   =>'required',
                  'shopping_list_slug' =>'required',
                  'name'               =>'required',
                  'phone'              =>'required',
                  'emailaddress'       =>'required',
                  'address'            =>'required',
                  'suburb'             =>'required',
                  'neighbourhood'      =>'required',
                  'city'               =>'required',
                  'state'              =>'required',
                  'country'            =>'required',
                  'zip_code'           =>'required',
                  ];

        $msg  = [

                  'shopping_list_id.required'   =>'The Shopping List is Required',
                  'shopping_list_slug.required' =>'Something is wrong, Please Reload Shopping List and Try again!',
                  'name.required'               =>'Full Name Is required For this Service!',
                  'phone.required'              =>'Your Contact Number is required For this Service!',
                  'emailaddress.required'       =>'Your Email Address is required For this Service!',

                ];



        $request->validate($rules,$msg);

        extract($_POST);

        if($country!='19' ||$country!='10'){
          $status = 'Rejected';
          $reason = 'Service not yet Available in Region';
        }




        $shopping_list_request = ShoppingListRequest::create([
                                    'user_id'            =>$request->user()->id,
                                    'shopping_list_id'   =>$shopping_list_id ?? '',
                                    'shopping_list_slug' =>$shopping_list_slug ?? '',
                                    'name'               =>$name ?? '',
                                    'phone'              =>$phone ?? '',
                                    'is_whatsapp'        =>$is_whatsapp ?? 0,
                                    'email'              =>$emailaddress ?? '',
                                    'message'            =>$message ?? '',
                                    'address'            =>$address ?? '',
                                    'suburb'             =>$suburb ?? '',
                                    'neighbourhood'      =>$neighbourhood ?? '',
                                    'city'               =>$city ?? '',
                                    'state'              =>$state ?? '',
                                    'country'            =>$country ?? '',
                                    'status'             =>$status ?? 'Pending',
                                    'reason'             =>$reason ?? 'Invoicing',
                                    'zip_code'           =>$zip_code ?? '',
                                    'cart_id'            =>$cart_id ?? null
                                  ]);
                                  add_notification($request->user()->id, $this->icons, 'Shopping Request Made! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
              if(!DeliveryLocation::where([['address',$address],['suburb',$suburb],['neighbourhood',$neighbourhood],['city',$city],['state',$state],['country',$country],['zip_code',$zip_code ]])->exists()){
                  DeliveryLocation::create([
                                            'user_id'            =>$request->user()->id,
                                          'name'               =>'Nameless',
                                          'slug'               =>unique_slug('Unamed','DeliveryLocation'),
                                          'address'            =>$address ?? '',
                                          'suburb'             =>$suburb ?? '',
                                          'neighbourhood'      =>$neighbourhood ?? '',
                                          'city'               =>$city ?? '',
                                          'state'              =>$state ?? '',
                                          'country'            =>$country ?? '',
                                          'zip_code'           =>$zip_code ?? '',
                                          'instruction'        =>$message ?? '',
                                                            ]);
                  add_notification($request->user()->id, $this->icons, 'New Delivery Location Automatically Added For You! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
                                                          }

        if($request->hasFile('upload')){

          $filenameWithExt = $request->file('upload')->getClientOriginalName();
          $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          $extension       = $request->file('upload')->getClientOriginalExtension();
          $fileNameToStore = $filename.'-'.time().'.'.$extension;

          $request->file('upload')->move(base_path() . '/public/assets/uploads/files/', $fileNameToStore);

          $fileNameToStore = url('/').'/public/assets/uploads/files/'.$filename.'-'.time().'.'.$extension;

          $shopping_list_request->update(['doc'=>$fileNameToStore]);

        }


        $text = "Your Shopping Request Has been Sent";
        $user = $request->user();
        send_email_verification($user->email, $user->username, 'Shopping Request Sent', $text);
        send_email_verification('delivery@triviecash.com', 'Delivery Team', 'Attend to shopping List', 'Attend to Shopping Request made by'.$user->username);

        if(isset($cart_id))
        \App\ShoppingCart::where('id',$cart_id)->update(['status'=>0]);

          return redirect()->back()->with('success','Your request has been sent!');
      }

      public function save(Request $request){

                $user = $request->user();



          if(isset($_POST['shopping_lists_name'])){

              $request->validate([
                  'shopping_lists_name'=>'required',
                  'shopping_lists_descripltion' => 'required'
                ]);

              var_dump($_POST);

              extract($_POST);
              $group = ShoppingList::create([
                'user_id' =>$user->id,
                'shopping_lists_name' =>$shopping_lists_name,
                'shopping_lists_descripltion' =>$shopping_lists_descripltion,
                'slug' =>unique_slug($shopping_lists_name,'ShoppingList') ?? '',
                'created_at' =>date('Y-m-d h:i:s'),
                'updated_at' =>date('Y-m-d h:i:s')


               ]) ;

              $entry = UserEntry::create([
                                           'user_id'=>$user->id,
                                           'entry_id'=>$group->id,
                                           'entry'=>'shopping-list',
                                           'owner'=>1,
                                           'created_at'=>date('Y-m-d h:i:s'),
                                           'updated_at'=>date('Y-m-d h:i:s')
                                         ]);
                add_notification($user->id, $this->icons, 'You have successfully added a new shopping list! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
              return redirect()->route('shopping-list')->with('success','You have successfully added a new shopping list!');
         }

      return redirect()->route('login')->with('error','Sorry, Apparently you are not logged in!');

      }



      public function update(Request $request)
      {

        if(Auth::check()){

            if(isset($_POST['shopping_lists_name'])){

              $this->validate($request, [
                  'shopping_lists_name'=>'required',
                  'shopping_lists_descripltion' => 'required'
                ]);


            extract($_POST);
            $user_id = $request->user()->id;

            if(ShoppingList::where([['user_id',$user_id],['id',$id]])->exists()){

              $group =  ShoppingList::find($id);

              $group->shopping_lists_name = $shopping_lists_name;
              $group->shopping_lists_descripltion = $shopping_lists_descripltion;
              $group->updated_at = date('Y-m-d H:i:s');
              $group->save();

              if(!UserEntry::where([['user_id',$user_id],['entry_id',$group->id],['entry','shopping-list'],['owner',1]])->exists()){

              $entry = UserEntry::create([
                                                   'user_id'=>$user_id,
                                                   'entry_id'=>$group->id,
                                                   'entry'=>'shopping-list',
                                                   'owner'=>1,
                                                   'created_at'=>date('Y-m-d h:i:s'),
                                                   'updated_at'=>date('Y-m-d h:i:s')
                                                 ]);
              }

            }

          }
          add_notification($user_id, $this->icons, 'You have successfully upated your shopping list! : @'.date('Y-m-d h:i:s'),  route('shopping-list'), 0);
          return redirect()->route('shopping-list')->with('success','You have successfully upated your shopping list!');

        }

        return redirect()->route('login')->with('error','Sorry, Apparently you are not logged in!');

      }

      public function destroy(Request $request)
      {
        $user = $request->user();

        if(Auth::check()){

            if(isset($_POST['id'])){

              extract($_POST);

              if(ShoppingList::where([['user_id',$user->id],['id',$id]])->exists()){

                ShoppingList::where([['id',$id],['user_id',$user->id]])->delete();
                UserEntry::where([['entry','shopping-list'],['entry_id',$id]])->delete();

              }else{

                  UserEntry::where([['user_id',$user->id],['entry','shopping-list'],['entry_id',$id]])->delete();

              }


            }
            add_notification($user->id, $this->icons, 'You have successfully deleted your shopping list! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
            return redirect()->route('shopping-list')->with('error','You have successfully deleted your shopping list!');
      }
      add_notification($user->id, $this->icons, 'You tried to delete a Shopping List which does not belong to you! : @'.date('Y-m-d h:i:s'), route('shopping-list'), 0);
      return redirect()->route('login')->with('error','Sorry, Apparently you are not logged in!');

    }


}
