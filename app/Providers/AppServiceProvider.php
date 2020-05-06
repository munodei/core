<?php

namespace App\Providers;

use App\GeneralSettings;
use App\Menu;
use App\Social;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
          Schema::defaultStringLength(191);
        //   \URL::forceScheme('https');
          try {
            DB::connection()->getPdo();

          view()->composer('*', function ($view) {
            $data['basic'] =  GeneralSettings::first();
            $data['gnl'] =  GeneralSettings::first();
            $data['menus'] =  Menu::all();
            $data['social'] =  Social::all();
          $id           = Auth::user()->id ?? 0;

          $countries = \App\Country::where('status',1)->orderby('name','DESC')->get();
          $notifications = \App\Notification::where([['is_read',0],['user_id',$id]])->orderby('created_at','DESC')->get();

          $contacts     = \App\UserEntry::leftjoin('contacts','contacts.id','=','user_entry.entry_id')
                                                                                               ->leftjoin('users','users.id','=','contacts.user_id')
                                                                                                ->where([
                                                                                                                  ['user_entry.user_id',$id],
                                                                                                                  ['user_entry.entry','contact']
                                                                                                                  ])
                                                                                                ->select('contacts.id as contactID','contacts.email as emailContactID','user_entry.id as userFileEntryID','users.id as userID','users.email as emailUserlD','contacts.*','user_entry.*')
                                                                                                  ->orderby('contacts.created_at','DESC')->get();
                                                                                                  $contact_groups     = array();

                                                                                                  $contact_groups1    = \App\ContactGroup::leftjoin('user_entry','contact_groups.id','=','user_entry.entry_id')
                                                                                                                                                                                                                          ->leftjoin(
                                                                                                                                                                                                                           'contact_group_items',
                                                                                                                                                                                                                           'contact_group_items.contact_group_id',
                                                                                                                                                                                                                           '=',
                                                                                                                                                                                                                           'user_entry.entry_id')
                                                                                                                                                                                                                           ->leftjoin(
                                                                                                                                                                                                                             'contacts',
                                                                                                                                                                                                                             'contacts.id',
                                                                                                                                                                                                                             '=',
                                                                                                                                                                                                                             'contact_group_items.contact_id')
                                                                                                                                                                                                                           ->where([
                                                                                                                                                                                                                             ['user_entry.user_id',$id],
                                                                                                                                                                                                                             ['user_entry.entry','contact-group'],

                                                                                                                                                                                                                           ])
                                                                                                                                                                                                                           ->select(
                                                                                                                                                                                                                             'contact_groups.id as contactGroupID',
                                                                                                                                                                                                                             'contact_groups.slug as contactGroupSlug',
                                                                                                                                                                                                                             'contact_groups.*',
                                                                                                                                                                                                                             'contacts.id as contactID',
                                                                                                                                                                                                                             'contacts.slug as contactSlug',
                                                                                                                                                                                                                             'contacts.*'
                                                                                                                                                                                                                           )
                                                                                                                                                                                                                           ->distinct()
                                                                                                                                                                                                                           ->get();


           foreach ($contact_groups1 as $group) {

                 $contact_groups[$group->contactGroupID][] = $group;

           }
          $services = \App\Service::all();
          $random     = strtoupper(substr(md5(mt_rand()), 0, 7));
          if(! \App\ShoppingCart::where([['user_id',$id],['status',1]])->exists())
          {
             \App\ShoppingCart::create([
                                    'cart'=>$random,
                                    'user_id'=>$id,
                                    'status'=>1,
                                    'created_at'=>date('Y-m-d h:i:s'),
                                    'updated_at'=>date('Y-m-d h:i:s')

              ]);


          }

          $items    = \App\Item::leftjoin('shopping_carts','shopping_carts.id','items.cart_id')
                                          ->where([['shopping_carts.user_id',$id],['shopping_carts.status',1]])
                                          ->select('shopping_carts.id as ShoppingCartID','items.id as itemID','items.*')
                                          ->get();
          $delivery_locations = \App\DeliveryLocation::where('user_id',$id)->get();
          $cart = \App\ShoppingCart::where([['user_id',$id],['status',1]])->first();

          View::share('delivery_locations',$delivery_locations);
          View::share('cart',$cart);
          View::share('services',$services);
          View::share('items',$items);
          View::share('contacts',$contacts);
          View::share('contact_groups',$contact_groups);
          View::share('contact_groups1',$contact_groups1);
          View::share('notifications',$notifications);
          View::share('countries',$countries);
          View::share('country',$countries);
          View::share($data);
            });
        }catch (\Exception $e){
          //echo $e->getMessage();
      }

    }

    public function register()
    {
        //
    }

}
