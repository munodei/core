<?php namespace App\Http\Controllers\Bills;

use Auth;
use Session;
use App\Bill;
use App\Biller;
use App\BillPayment;
use App\User;
use App\Trx;
use App\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
  public function __construct()
   {
       $this->middleware('auth');

   }

    public function index(Request $request)
    {

          $data['page_title']    = 'Bill Payment Services | Saved Bills';
          $data['bills']         = Bill::where('user_id',$request->user()->id)->paginate(20);
          return view('custom.bills.index', $data);

    }

   public function create(Request $request)
    {
          $data['page_title']    = 'Bill Payment Services | Add Bill';
          $data['billers']       = Biller::all();
          return view('custom.bills.create', $data);
    }

    public function billPaymentPreview(Request $request)
    {
      $this->validate($request,
          [
              'amount' => 'required|numeric|min:50',
              'id' => 'required',
          ],['id.required'=>"Error Occured Reload Page and Select Bill"]);

        $bill_trx = strtoupper(str_random(16));
        extract($_POST);
        $data['data'] = Bill::find($id);
        $data['amount'] = $amount;
        $data['charge'] = 0;
        $data['page_title'] = "Bill Payment Preview";
        $auth = Auth::user();

        if(!Session::has('Bill_Trx')){

          Session::put('Bill_Trx', $bill_trx);
          BillPayment::create([
                                'user_id'=>$request->user()->id,
                                'trx'=>$bill_trx,
                                'biller_id'=>$data['data']->biller_id,
                                'bill_id'=>$data['data']->id,
                                'status'=>'pending',
                                'remark'=>"Bill Payment Preview",
                                'amount'=>$amount,
                                'created_at'=>date('Y-m-d h:i:s'),
                                'updated_at'=>date('Y-m-d h:i:s'),


          ]);
      }


        return view('custom.bills.preview',$data);

    }

    public function billPaymentConfirm(Request $request)
    {

        $gnl = GeneralSettings::first();
        $bill_trx = Session::pull('Bill_Trx');
        $user = $request->user();
        $data = BillPayment::where([['user_id',$request->user()->id],['trx',$bill_trx]])->first();

        if (BillPayment::where([['user_id',$request->user()->id],['trx',$bill_trx]])->exists()) {

          if($user->balance >= round(($user->balance - $data->amount),$gnl->decimal)){

            $user->balance = round(($user->balance - $data->amount),$gnl->decimal);
            $user->save();

            $trx = Trx::create([
                'user_id' => $user->id,
                'amount' => $data->amount,
                'main_amo' => round($user->balance,$gnl->decimal),
                'charge' => 0,
                'type' => '-',
                'title' => 'Bill Payment for '.$data->biller->biller_name,
                'trx' => $bill_trx
            ]);

            $txt = $data->amount . ' ' . $gnl->currency . ' Bill Payment for '.$data->biller->biller_name;

            $data->update(['trx_id'=>$trx->id,'status'=>'approved','remark'=>'Money Credited For Bill Payment']);

            send_email($user->email, $user->username, 'Bill Payment', $txt);

            send_sms($user->phone, $txt);

            return redirect()->route('bills.index')->with('success', 'Bill has successfully been paid expect a notification!');

          }
          $data = BillPayment::where([['user_id'=>$request->user()->id],['trx'=>$bill_trx]])->first();

          $trx = Trx::create([
              'user_id' => $user->id,
              'amount' => $data->amount,
              'main_amo' => round($user->balance,$gnl->decimal),
              'charge' => 0,
              'type' => '',
              'title' => 'Insufficient Credit to falicitate Bill Payment for '.$data->biller->biller_name,
              'trx' => $bill_trx
          ]);

          $txt = $data->amount . ' ' . $gnl->currency . ' Insufficient Credit to falicitate Bill Payment for '.$data->biller->biller_name;

          $data->update(['trx_id'=>$trx->id,'status'=>'rejected','remark'=>'Insufficient Credit to falicitate Bill Payment for '.$data->biller->biller_name]);

          send_email($user->email, $user->username, 'Bill Payment', $txt);

          return back()->with('error', 'Insufficient Credit, Deposit Money to Pay Bills!');

        }

          return back()->with('error', 'Problem Experienced with Action!');

    }

    public function store(Request $request)
    {
      $rules = [
                  'user_id' =>'required',
                  'biller_id' =>'required',
                  'currency' =>'required',
                  'bill_owner' =>'required',
                  'bill_account_number' =>'required',
              ];
      $msg = [
              'user_id.required' =>'Error Occured reload Page!',
              'biller_id.required'=>'Select a Valid Biller/Merchant to proceed!!',
              'currency.required'=>'Select a preferred Currency of Payment to proceed!!',
              'bill_owner.required'=>'Add the Account Owner Associated with Bill to proceed!!',
              'bill_account_number.required'=>'Add the Account Number Associated with Bill to proceed!!',
            ];

      $request->validate($rules,$msg);


                    $in = Input::except('_token');

                    if(intval($in['user_id']) === $request->user()->id)
                    {
                        $in['user_id'] = $request->user()->id;

                        $res = Bill::create($in);

                        if ($res) {
                            return redirect()->route('bills.index')->with('success', 'Bill Information has successfully been added!');
                        } else {
                            return back()->with('error', 'Problem Experienced with Action!');
                        }

                    }

                  return back()->with('error', 'Problem Experienced with Action!');

    }


    public function edit(Request $request,$id)
    {
          $data['page_title']    = 'Bill Payment Services | Edit Bill';
          $data['user_id']       = $request->user()->id;
          $data['billers']       = Biller::all();
          $data['bill']          = Bill::where('id',$id)->first();
          return view('custom.bills.edit',$data);

    }

    public function update(Request $request, $id)
    {
              $rules = [
                          'user_id' =>'required',
                          'biller_id' =>'required',
                          'currency' =>'required',
                          'bill_owner' =>'required',
                          'bill_account_number' =>'required',
                      ];
              $msg = [
                      'user_id.required' =>'Error Occured reload Page!',
                      'biller_id.required'=>'Select a Valid Biller/Merchant to proceed!!',
                      'currency.required'=>'Select a preferred Currency of Payment to proceed!!',
                      'bill_owner.required'=>'Add the Account Owner Associated with Bill to proceed!!',
                      'bill_account_number.required'=>'Add the Account Number Associated with Bill to proceed!!',
                    ];

            $request->validate($rules,$msg);

            $in = Input::except('_token');
            if(intval($in['user_id']) === $request->user()->id && Bill::where([['id',$id],['user_id',$request->user()->id]])->exists())
            {
                $res = Bill::find($id);
                $in['user_id'] = $request->user()->id;

                $res->update($in);

                if ($res) {
                    return redirect()->route('bills.index')->with('success', 'Bill Information has successfully been updated!');
                } else {
                    return back()->with('error', 'Problem Experienced with Action!');
                }
            }
            return back()->with('error', 'Problem Experienced with Action!');
    }

    public function destroy(Request $request)
    {

      $rules = ['id'=>'required'];
      $msgs  = ['id.required'=>'Error Occured, Reload Page and try Again!!'];

      $request->validate($rules,$msgs);
      extract($_POST);

      if(Bill::where([['id',$id],['user_id',$request->user()->id]])->exists())
      {
        Bill::where([['id',$id],['user_id',$request->user()->id]])->delete();
        return back()->with('success', 'You have successfully deleted your bill!');
      }
      return back()->with('error', 'Problem Experienced with Action!');

    }
}
