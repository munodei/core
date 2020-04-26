<?php
namespace App\Http\Controllers;

use Auth;
use Image;
use Session;
use App\Trx;
use App\User;
use App\Country;
use App\Deposit;
use App\Gateway;
use Carbon\Carbon;
use App\SendMoney;
use App\TransferMoney;
use App\SupportTicket;
use App\SupportMessage;
use App\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Artisan;

class TransferMoneyController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        //self::authCheck();
        $this->icons = '<i class="material-icons">monetization_on</i>';

    }


    public function authCheck()
    {
        if (Auth()->user()->status == '1' && Auth()->user()->email_verify == '1' && Auth()->user()->sms_verify == '1') {
            return redirect()->route('home');
        } else {
            $data['page_title'] = "Authorization";
            return view('user.authorization', $data);
        }
    }

    /*Merchant Manage*/
    public function transferMoney()
    {
        $user = Auth::user();
        $data['page_title'] = "Send Money";

        $data['country'] = Country::whereStatus(1)->orderBy('name','asc')->get();
        $data['countryLatest'] = Country::whereStatus(1)->orderBy('name','desc')->get();

        if ($user->merchant == 1) {
            return view('merchant.transfer-money', $data);
        }
        return view('user.sendmoney', $data);
    }

    public function transferMoneyCheck(Request $request)
    {
        $this->validate($request, [
            'send_amount' => 'required|numeric|min:0',
            'receive_amount' => 'required|numeric|min:0',
            'charge' => 'required|numeric|min:0',
            'fromCountry' => 'required',
            'toCountry' => 'required',
        ]);

        $fromCountry = Country::whereId($request->fromCountry)->first();
        $toCountry = Country::whereId($request->toCountry)->first();
        $basic = GeneralSettings::first();

        if ($fromCountry && $toCountry) {

            $usd = $request->send_amount / $fromCountry->rate; //send amount convert from currency to usd
            $charge = ($request->send_amount * $fromCountry->transfer_charge) / 100; //send amount charge  from currency
            $usdCharge = $charge / $fromCountry->rate; //send amount charge in usd
            $inputReceiveAmount = $usd * $toCountry->rate; // receive amount convert usd to target currency

            $auth = Auth::user();

            if ($auth->balance >= ($usdCharge + $usd)) {

                $data['sender_id'] = $auth->id;
                $data['usd_amo'] = $usd;
                $data['usd_charge'] = $usdCharge;


                $merchantChargeAble = ((0 * $basic->sending_charge) / 100); // 40% get Merchant Account
                $data['merchant_get_charge'] = round(($merchantChargeAble), 2);
                $withDrawChargeAble = (($usdCharge * $basic->withdraw_charge) / 100); // 40% withdraw Charge  Account
                $data['withdraw_charge'] = round(($withDrawChargeAble), 2);
                $data['admin_profit'] = round(($usdCharge - ($merchantChargeAble + $withDrawChargeAble)), 2);


                $data['from_currency'] = $fromCountry->id;
                $data['from_currency_amo'] = round(($usd * $fromCountry->rate), 2);
                $data['to_currency'] = $toCountry->id;
                $data['to_currency_amo'] = round($inputReceiveAmount, 2);
                $data['trx'] = rand(00000, 99999) . rand(00000, 99999);

                $transferMoney = TransferMoney::create($data)->trx;

                return redirect()->route('transfer.money.preview', $transferMoney);
            } else {

                session()->flash('alert', 'Insufficient Balance to make Internal Money Transfer');
                add_notification($request->user()->id, $this->icons, 'Insufficient Balance to make Internal Money Transfer! : @'.date('Y-m-d h:i:s'), route('transfer.money'), 0);
                return back();

            }
        }

        return back();

    }


    public function transferMoneyPreview($trx)
    {
        $page_title = "Transfer Money";
        $auth = Auth::user();

        $sendMoney = TransferMoney::with('fromCurrency', 'toCurrency')->where('trx', $trx)->where('sender_id', $auth->id)->whereStatus(0)->first();

        if ($sendMoney) {
            $totalPayable = $sendMoney->from_currency_amo + ($sendMoney->usd_charge * $sendMoney->fromCurrency->rate);
            if ($auth->merchant == 1) {
                return view('merchant.transfer-info', compact('auth', 'page_title', 'sendMoney', 'totalPayable'));
            }
            return view('user.send-info', compact('auth', 'page_title', 'sendMoney', 'totalPayable'));
        }
        abort(404);
    }

    public function transferConfirm(Request $request)
    {
        $this->validate($request, [
            'recipient_email' => 'required',
            'recipient_username' => 'required',
            'recipient_merchant_code' => 'required',
        ]);

        $basic = GeneralSettings::first();
        $data = TransferMoney::whereId($request->id)->whereStatus(0)->first();

        extract($_POST);

        if(!User::where([['email',$recipient_email],['username',$recipient_username],['merchant_identity',$recipient_merchant_code]])->exists())
        {
            add_notification($request->user()->id, $this->icons, 'User which you trying to transfer funds to isnt\'t registered with us! : @'.date('Y-m-d h:i:s'), route('transfer.money'), 0);
            return redirect()->back()->with('error','User which you trying to transfer funds to doesnt\'t exist');
        }

        $recipient = User::where([['email',$recipient_email],['username',$recipient_username],['merchant_identity',$recipient_merchant_code]])->first();

        if ($data) {

            $auth           = User::find($data->sender_id);
            $totalUsdCharge = $data->usd_amo + $data->usd_charge;

            if ($auth->balance >= $totalUsdCharge) {

                $data->name           = $recipient->username;
                $data->sender_name    = $auth->username;
                $data->address        = $recipient->email;
                $data->sender_address = $auth->email;
                $data->phone          = $recipient->phone;
                $data->sender_phone   = $auth->phone;
                $data->recipient_id   = $recipient->merchant_identity;
                $data->merchant_id    = $auth->merchant_identity;
                $data->status         = 2;

                $data->save();

                $auth->balance =  round(( $auth->balance-$totalUsdCharge), $basic->decimal) ;
                $auth->save();

                $recipient->balance =  round(( $recipient->balance + $data->usd_amo), $basic->decimal) ;
                $recipient->save();


                $merchant = Auth::user();

                Trx::create([
                    'user_id' => $auth->id,
                    'amount' => round($totalUsdCharge, 2),
                    'main_amo' => round($auth->balance, $basic->decimal),
                    'charge' => 0,
                    'type' => '-',
                    'title' => $data->from_currency_amo . ' ' . $data->fromCurrency->code . '  Send Money to ' . $data->toCurrency->name,
                    'trx' => $data->trx,
                ]);

                $txt = $data->from_currency_amo . ' ' . $data->fromCurrency->code . '  Send Money to ' . $data->toCurrency->name . ".<br>";
                $txt .= round($totalUsdCharge, $basic->decimal) . ' ' . $basic->currency . '  debited from your account ' . ".<br>";
                $txt .= '  Your current Balance ' . $auth->balance . ' ' . $basic->currency;


                $rec_txt = round($data->from_currency_amo, $basic->decimal) . ' ' . $basic->currency . ' has been credited to your account ' . ".<br>";
                $rec_txt .= '  Your current Balance ' . $recipient->balance . ' ' . $basic->currency;

                send_email($auth->email, $auth->username, 'Transfer Money  from Account', $txt);
                send_email($recipient->email, $recipient->username, 'Money Transferred To Account', $rec_txt);

                session()->flash('success', 'Amount Successfully Transferred');

                add_notification($request->user()->id, $this->icons, 'Amount Successfully Transferred! : @'.date('Y-m-d h:i:s'), route('transfer.money'), 0);
                add_notification($request->user()->id, $this->icons, round($totalUsdCharge, $basic->decimal) . ' ' . $basic->currency . '  has been debited from your account ! : @'.date('Y-m-d h:i:s'), route('transfer.money'), 0);
                add_notification($request->user()->id, $this->icons, 'Your current Balance ' . $auth->balance . ' ' . $basic->currency.' : @'.date('Y-m-d h:i:s'), route('transfer.money'), 0);

                add_notification($request->user()->id, $this->icons, round($data->from_currency_amo, $basic->decimal) . ' ' . $basic->currency . '  has been credited to your account! : @'.date('Y-m-d h:i:s'), route('transfer.money'), 0);
                add_notification($request->user()->id, $this->icons, 'Your current Balance ' . $recipient->balance . ' ' . $basic->currency.' : @'.date('Y-m-d h:i:s'), route('transfer.money'), 0);

                return redirect()->route('transfer.invoice', $data->trx);

            } else {
                session()->flash('alert', 'Insufficient Balance');
                  add_notification($request->user()->id, $this->icons, 'Insufficient Balance! : @'.date('Y-m-d h:i:s'), route('transfer.money'), 0);
                return back();
            }

        }
        return redirect()->route('transfer.money');
    }


    public function transferInvoice($trx)
    {
        $data['page_title'] = "Transfer Invoice";

        $auth = Auth::user();
        $data['invoice'] = TransferMoney::where('trx', $trx)->where('sender_id', $auth->id)->first();
        if ($auth->merchant == 1) {
            return view('merchant.transfer-invoice', $data);
        }
        return view('user.transfer-invoice', $data);
    }


    public function transferLog()
    {
        $auth = Auth::user();
        $data['page_title'] = "Transfer Money Log ";
        $data['sendMoney'] = TransferMoney::where('sender_id', $auth->id)->where('status', '!=', 0)->latest()->paginate(15);
        if ($auth->merchant == 1) {
            return view('merchant.transfer-log', $data);
        }
        return view('user.send-log', $data);
    }



}
