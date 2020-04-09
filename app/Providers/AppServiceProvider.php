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
          try {
            DB::connection()->getPdo();

          view()->composer('*', function ($view) {
            $data['basic'] =  GeneralSettings::first();
            $data['gnl'] =  GeneralSettings::first();
            $data['menus'] =  Menu::all();
            $data['social'] =  Social::all();
          $id           = Auth::user()->id ?? 0;

          $countries = \App\Country::where('status',1)->orderby('name','DESC')->get();
          $notifications = \App\Notification::where([['is_read',0],['user_id',$id]])->get();

          $contacts     = \App\UserEntry::leftjoin('contacts','contacts.id','=','user_entry.entry_id')
                                                                                               ->leftjoin('users','users.id','=','contacts.user_id')
                                                                                                ->where([
                                                                                                                  ['user_entry.user_id',$id],
                                                                                                                  ['user_entry.entry','contact']
                                                                                                                  ])
                                                                                                ->select('contacts.id as contactID','contacts.email as emailContactID','user_entry.id as userFileEntryID','users.id as userID','users.email as emailUserlD','contacts.*','user_entry.*')
                                                                                                  ->orderby('contacts.created_at','DESC')->get();
          View::share('contacts',$contacts);
          View::share('notifications',$notifications);
          View::share('countries',$countries);
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
