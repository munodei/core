<?php

namespace App\Http\Controllers;

use App\WithdrawalRequest;
use App\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawalRequests extends Controller
{

    public function __construct(){

      $this->middleware('auth');

    }

    public function usingBankTransfer(Request $request){

      $user = $request->user();
      $page_title = 'Withdrawal Using Bank Transfer';
      $method = WithdrawMethod::where('id',2)->first();

      return view('custom.withdrawals.bank-transfer',compact('user','page_title','method'));

    }

    public function usingEwallet(Request $request){

      $user = $request->user();
      $page_title = 'Withdrawal Using E-Wallet';
      $method = WithdrawMethod::where('id',1)->first();

      return view('custom.withdrawals.e-wallet',compact('user','page_title','method'));

    }

    public function withdrawalEwallet(Request $request){

      $rules =[
                'phone'=>'required',
                'amount'=>'required',
              ];

      $msgs = [

              ];

      $request->validate($rules,$msgs);



      $user = $request->user();
      $page_title = 'Withdrawal Using E-Wallet';
      $method = WithdrawMethod::where('id',1)->first();

      return view('custom.withdrawals.e-wallet',compact('user','page_title','method'));

    }

    public function index(Request $request)
    {
        $user = $request->user();
        $page_title = 'Withdrawal Requests';
        $withdrawals = WithdrawalRequest::where([['user_id',$user->id],['deleted_at',null]])->get();

        return view('custom.withdrawals.index',compact('user','page_title','withdrawals'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $rules = [
                  'phone'=>'required',
                  'amount'=>'required',
                 ];
        $request->validate($rules);

        extract($_POST);

        $method = WithdrawMethod::where('id',$method)->first();

        $total_debited = floatval($amount) + (floatval($amount) * (floatval($method->percent)/100)) + floatval($method->charge);

        if($total_debited < $method->withdraw_min ||  $total_debited > $method->withdraw_max)
        {
          $status = 'Withdrawal Declined';
          $reason = 'Withdrawal doesn\'t meet the Withdrawal Requirements!';
          $post_balance  = $request->user()->balance;

        }elseif($request->user()->balance > $total_debited && $total_debited > $method->withdraw_min &&  $total_debited < $method->withdraw_max)
        {
          $status = 'Withdrawal In Progress';
          $reason = 'Sufficient Float Balance!';
          $post_balance  = $request->user()->balance - $total_debited;

        }elseif($request->user()->balance < $total_debited ){

          $status = 'Withdrawal Declined';
          $reason = 'Insufficient Float Balance!';
          $post_balance  = $request->user()->balance;

        }

        WithdrawalRequest::create([
                                      'user_id'=>$request->user()->id,
                                      'phone'=>$phone ?? '',
                                      'is_whatsapp'=>$is_whatsapp ?? '',
                                      'method'=>$method->name,
                                      'status'=>$status,
                                      'reason'=>$reason,
                                      'amount'=>$amount,
                                      'charge'=>$method->charge,
                                      'total_debited'=>$total_debited,
                                      'pre_balance'=>$request->user()->balance,
                                      'post_balance'=>$post_balance,
                                      'bank'=>$bank ?? '',
                                      'bank_account'=>$bank_account ?? '',
                                      'branch_code'=>$branch_code ?? '',
                                      'name_of_recipient'=>$name_of_recipient ?? '',
                                      'branch'=>$branch ?? '',
                                      'created_at'=>date('Y-m-d h:i:s'),
                                      'updated_at'=>date('Y-m-d h:i:s')
                                    ]);

        return redirect()->route('withdrawal-requests.index')->with('success','Withdrawal Request Made');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
      $rules = [
                'id'=>'required',

      ];

      $msgs = [
                'id.required'=>'The Withdrawal Request is required!',
      ];

      $request->validate($rules,$msgs);

      $user = $request->user();
      $user_id = $user->id;
      extract($_POST);


      if(WithdrawalRequest::where([['user_id',$user_id],['id',$id]])->exists()){

        $withdrawal_requests = WithdrawalRequest::find($id);
        
        if($withdrawal_requests->status=='Withdrawal In Progress'){

          return redirect()->back()->with('error','You can\'t delete a Withdrawal Request in Progress');

        }
        $withdrawal_requests->deleted_at = date('Y-m-d h:i:s');

        $withdrawal_requests->save();

        return redirect()->back()->with('success','You have successfully deleted a Withdrawal request');

      }
      return redirect()->back()->with('error','Error occured on attempt to delete Withdrawal Request');
    }

}
