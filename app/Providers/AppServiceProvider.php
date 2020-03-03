<?php

namespace App\Providers;

use App\GeneralSettings;
use App\Menu;
use App\Social;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $data['basic'] =  GeneralSettings::first();
       $data['gnl'] =  GeneralSettings::first();
       $data['menus'] =  Menu::all();
       $data['social'] =  Social::all();

        View::share($data);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
