<?php

namespace App\Http\Controllers;

use App\MobileNetwork;
use Illuminate\Http\Request;

class BuyAirTimeController extends Controller
{
   public function __constuct(){

     $this->middleware('auth');
     
   }

   public function index(Request $request){

     $user = $request->user();
     $networks = MobileNetwork::where('status',1)->get();
     $page_title = 'Buy Airtime';

     return view('custom.buy-airtime.index',compact('page_title','networks'));

   }

}
