<?php

namespace App\Http\Controllers;

use App\User;
use App\AirTimeSell;
use App\MobileNetwork;
use Illuminate\Http\Request;

class SellAirTimeController extends Controller
{
  public function __constuct(){

    $this->middleware('auth');

  }
  public function airTimeSells(Request $request){

    $user = $request->user();
    $page_title = 'Airtime Sells';
    $sells = AirTimeSell::where([['deleted_at',null],['user_id',$user->id]])->get();

    return view('custom.sell-airtime.airtime-sells',compact('page_title','sells'));

  }
  public function index(Request $request){

    $user = $request->user();
    $networks = MobileNetwork::where('status',1)->get();
    $page_title = 'Sell Airtime';

    return view('custom.sell-airtime.index',compact('page_title','networks'));

  }

  public function airTimepreview(Request $request){

    if(isset($_POST['amount'])){
    if($_POST['amount']<5){

    return redirect()->back()->with('the minimum air time sell is 5R');

    }elseif ($_POST['amount']>1000) {

    return redirect()->back()->with('the maximum air time sell is 1000R');


    }

    extract($_POST);
    $user = $request->user();
    $network = MobileNetwork::where('id',$network_id)->first();
    $page_title = 'Sell Airtime Preview';
    $data = $_POST ?? '';

    return view('custom.sell-airtime.preview',compact('page_title','network','data'));

  }
    return redirect()->route('sell-airtime.index')->with('error','Error occured!');
  }

  public function airTimeConfirm(Request $request){

    $rules = [
              'airtime_type'=>'required',
              'phone'=>'required'

    ];
    $msgs = [
              'airtime_type.required'=>'The Type of Airtime you are trying to sell is important!',
              'phone.required'=>'Your Phone Number is required for Urgent Contact!',

    ];



    $request->validate($rules,$msgs);

    extract($_POST);
      if($airtime_type == 1 && $token ==''){

        return back()->with('error','Token Missing!');

      }
    $user = $request->user();

    $entry = AirTimeSell::create([
                          'user_id'=>$request->user()->id,
                          'amount'=>$amount ?? '',
                          'charge'=>$charge,
                          'amount_to_be_deposited'=>$amount_to_be_deposited,
                          'airtime_type'=>$airtime_type,
                          'phone'=>$phone,
                          'is_whatsapp'=>$is_whatsapp,
                          'token'=>$token,
                          'network'=>$network,
                          'network_id'=>$network_id,
                          'status'=>'In Progress',
                          'created_at'=>date('Y-m-d h:i:s'),
                          'updated_at'=>date('Y-m-d h:i:s')
                        ]);

    return redirect()->route('airtime-sells')->with('success','You have successfull send a Request with, please note this will take us 3min to process your request!');

  }
}
