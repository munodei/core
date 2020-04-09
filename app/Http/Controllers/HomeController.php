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
use App\SupportTicket;
use App\SupportMessage;
use App\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {

        $auth = Auth::user();
        $data['page_title'] = "Dashboard";

        $data['country'] = Country::whereStatus(1)->get();
        $data['countryLatest'] = Country::latest()->whereStatus(1)->get();


        $data['user'] = User::find($auth->id);
        $data['trx'] = Trx::whereUser_id($auth->id)->latest()->count();
        $data['payout'] = SendMoney::where('status', 2)->where('merchant_id', $auth->id)->count();
        $data['sendMoney'] = SendMoney::where('sender_id', $auth->id)->where('status', '!=', 0)->latest()->count();
        $data['depositLog'] = Deposit::whereUser_id($auth->id)->whereStatus(1)->latest()->count();
        $data['gateway'] = Gateway::where('status',1)->count();


        if ($auth->merchant == 1) {
            return view('merchant.home', $data);
        }
        return view('home', $data);
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

    public function sendVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->phone_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->phone_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('danger', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->phone_time = Carbon::now();
            $user->sms_code = $code;
            $user->save();
            send_sms($user->phone, 'Your Verification Code is ' . $code);

            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function smsVerify(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user->sms_code == $request->sms_code) {
            $user->phone_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('danger', 'Verification Code Did not matched');
        }
        return back();
    }

    public function sendEmailVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->email_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->email_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('danger', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->email_time = Carbon::now();
            $user->verification_code = $code;
            $user->save();
            send_email($user->email, $user->username, 'Verificatin Code', 'Your Verification Code is ' . $code);
            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function postEmailVerify(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if ($user->verification_code == $request->email_code) {
            $user->email_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('danger', 'Verification Code Did not matched');
        }
        return back();
    }


    public function editProfile()
    {
        $auth = Auth::user();
        $data['page_title'] = "Edit Profile";
        $data['user'] = User::findOrFail($auth->id);
        $data['country'] = Country::whereStatus(1)->get();
        if ($auth->merchant == 1) {
            return view('merchant.edit-profile', $data);
        }
        return view('user.edit-profile', $data);
    }

    public function submitProfile(Request $request)
    {


        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'address' => 'required|string|max:255',
//            'country_id' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
//            'phone' => 'required|string|min:10|unique:users,phone,' . $user->id,
//            'username' => 'required|min:5||regex:/^\S*$/u|unique:users,username,' . $user->id,
            'image' => 'mimes:png,jpg,jpeg'
        ], [
            'fname.required' => 'First Name must not be empty',
            'lname.required' => 'Last Name must not be empty',
            'country_id.required' => 'Please Select Your Country',
        ]);
        $in = Input::except('_method', '_token');
        $in['reference'] = $request->username;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $request->username . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['image'] = $filename;
            if ($user->image != 'user-default.png') {
                $path = './assets/images/user/';
                $link = $path . $user->image;
                if (file_exists($link)) {
                    @unlink($link);
                }
            }
            Image::make($image)->resize(800, 800)->save($location);
        }
        $user->fill($in)->save();
        return back()->with('success', 'Profile Updated Successfully.');

    }

    public function changePassword()
    {
        $data['page_title'] = "Change Password";
        $auth = Auth::user();
        if ($auth->merchant == 1) {
            return view('merchant.change_password', $data);
        }
        return view('user.change-password', $data);
    }

    public function submitPassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if (Hash::check($request->current_password, $c_password)) {

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                return back()->with('success', 'Password Changes Successfully.');
            } else {
                return back()->with('danger', 'Current Password Not Match');
            }

        } catch (\PDOException $e) {
            return back()->with('danger', $e->getMessage());
        }
    }


    public function deposit()
    {
        $data['page_title'] = "Select Payment Gateways";

        $data['gates'] = Gateway::whereStatus(1)->get();

        $auth = Auth::user();
        if ($auth->merchant == 1) {
            return view('merchant.deposit', $data);
        }
        return view('user.deposit', $data);
    }

    public function depositDataInsert(Request $request)
    {
        $this->validate($request,
            [
                'amount' => 'required|numeric|min:1',
                'gateway' => 'required',
            ]);

        if ($request->amount <= 0) {
            return back()->with('danger', 'Invalid Amount');
        } else {
            $gate = Gateway::findOrFail($request->gateway);

            if (isset($gate)) {
                if ($gate->minamo <= $request->amount && $gate->maxamo >= $request->amount) {
                    $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
                    $usdamo = ($request->amount + $charge) / $gate->rate;

                    $depo['user_id'] = Auth::id();
                    $depo['gateway_id'] = $gate->id;
                    $depo['amount'] = $request->amount;
                    $depo['charge'] = $charge;
                    $depo['usd'] = round($usdamo, 2);
                    $depo['btc_amo'] = 0;
                    $depo['btc_wallet'] = "";
                    $depo['trx'] = str_random(16);
                    $depo['try'] = 0;
                    $depo['status'] = 0;
                    Deposit::create($depo);

                    Session::put('Track', $depo['trx']);

                    return redirect()->route('user.deposit.preview');

                } else {
                    return back()->with('danger', 'Please Follow Deposit Limit');
                }
            } else {
                return back()->with('danger', 'Please Select Deposit gateway');
            }
        }

    }

    public function depositPreview()
    {

        $track = Session::get('Track');
        $data = Deposit::where('status', 0)->where('trx', $track)->first();
        $page_title = "Deposit Preview";
        $auth = Auth::user();
        if ($auth->merchant == 1) {
            return view('user.merchant-payment.preview', compact('data', 'page_title'));
        }

        return view('user.payment.preview', compact('data', 'page_title'));
    }

    public function activity()
    {
        $user = Auth::user();
        $data['invests'] = Trx::whereUser_id($user->id)->latest()->paginate(15);
        $data['page_title'] = "Transaction Log";

        if ($user->merchant == 1) {
            return view('merchant.trx', $data);
        }
        return view('user.trx', $data);
    }

    public function depositLog()
    {
        $user = Auth::user();

        $data['page_title'] = "Deposit Log";
        $data['invests'] = Deposit::whereUser_id($user->id)->whereStatus(1)->latest()->paginate(15);
        if ($user->merchant == 1) {
            return view('merchant.deposit-log', $data);
        }
        return view('user.deposit-log', $data);
    }


    /*Merchant Manage*/
    public function sendMoney()
    {
        $user = Auth::user();
        $data['page_title'] = "Send Money";

        $data['country'] = Country::whereStatus(1)->orderBy('name','asc')->get();
        $data['countryLatest'] = Country::whereStatus(1)->orderBy('name','desc')->get();

        if ($user->merchant == 1) {
            return view('merchant.send-money', $data);
        }
        return view('user.sendmoney', $data);
    }

    public function sendMoneyCheck(Request $request)
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
            $charge = ($request->send_amount * $fromCountry->charge) / 100; //send amount charge  from currency
            $usdCharge = $charge / $fromCountry->rate; //send amount charge in usd
            $inputReceiveAmount = $usd * $toCountry->rate; // receive amount convert usd to target currency

            $auth = Auth::user();

            if ($auth->balance >= ($usdCharge + $usd)) {
                $data['sender_id'] = $auth->id;
                $data['usd_amo'] = $usd;
                $data['usd_charge'] = $usdCharge;
                if ($auth->merchant == 1) {
                    $merchantChargeAble = (($usdCharge * $basic->sending_charge) / 100); // 40% get Merchant Account
                    $data['merchant_get_charge'] = round(($merchantChargeAble), 2);
                    $withDrawChargeAble = (($usdCharge * $basic->withdraw_charge) / 100); // 40% withdraw Charge  Account
                    $data['withdraw_charge'] = round(($withDrawChargeAble), 2);
                    $data['admin_profit'] = round(($usdCharge - ($merchantChargeAble + $withDrawChargeAble)), 2);
                } else {
                    $merchantChargeAble = ((0 * $basic->sending_charge) / 100); // 40% get Merchant Account
                    $data['merchant_get_charge'] = round(($merchantChargeAble), 2);
                    $withDrawChargeAble = (($usdCharge * $basic->withdraw_charge) / 100); // 40% withdraw Charge  Account
                    $data['withdraw_charge'] = round(($withDrawChargeAble), 2);
                    $data['admin_profit'] = round(($usdCharge - ($merchantChargeAble + $withDrawChargeAble)), 2);
                }

                $data['from_currency'] = $fromCountry->id;
                $data['from_currency_amo'] = round(($usd * $fromCountry->rate), 2);
                $data['to_currency'] = $toCountry->id;
                $data['to_currency_amo'] = round($inputReceiveAmount, 2);
                $data['trx'] = rand(00000, 99999) . rand(00000, 99999);

                $sendMoney = SendMoney::create($data)->trx;

                return redirect()->route('send.money.preview', $sendMoney);
            } else {
                session()->flash('alert', 'Insufficient Balance');
                return back();
            }
        }
        return back();
    }


    public function sendMoneyPreview($trx)
    {
        $page_title = "Send Money";
        $auth = Auth::user();

        $sendMoney = SendMoney::with('fromCurrency', 'toCurrency')->where('trx', $trx)->where('sender_id', $auth->id)->whereStatus(0)->first();

        if ($sendMoney) {
            $totalPayable = $sendMoney->from_currency_amo + ($sendMoney->usd_charge * $sendMoney->fromCurrency->rate);
            if ($auth->merchant == 1) {
                return view('merchant.send-info', compact('auth', 'page_title', 'sendMoney', 'totalPayable'));
            }
            return view('user.send-info', compact('auth', 'page_title', 'sendMoney', 'totalPayable'));
        }
        abort(404);
    }

    public function sendingConfirm(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'sender_name' => 'required',
            'sender_phone' => 'required',
        ]);
        $basic = GeneralSettings::first();
        $data = SendMoney::whereId($request->id)->whereStatus(0)->first();
        if ($data) {
            $auth = User::find($data->sender_id);
            $totalUsdCharge = $data->usd_amo + $data->usd_charge;
            if ($auth->balance >= $totalUsdCharge) {

                $data->name = $request->name;
                $data->sender_name = $request->sender_name;
                $data->address = $request->address;
                $data->sender_address = $request->sender_address;
                $data->phone = $request->phone;
                $data->sender_phone = $request->sender_phone;
                $data->status = 1;
                $data->save();

                $auth->balance =  round(( $auth->balance-$totalUsdCharge), $basic->decimal) ;
                $auth->save();


                $merchant = Auth::user();
                if ($merchant->merchant == 1) {
                    $merchant->balance = round(($merchant->balance +$data->merchant_get_charge), $basic->decimal);
                    $merchant->save();


                    $merchant2 = Auth::user();
                    $merchant2->balance = round(($merchant2->balance - $totalUsdCharge), $basic->decimal);
                    $merchant2->save();

                    Trx::create([
                        'user_id' => $merchant->id,
                        'amount' => $data->merchant_get_charge,
                        'main_amo' => round($merchant->balance, $basic->decimal),
                        'charge' => 0,
                        'type' => '+',
                        'title' => $data->merchant_get_charge . ' ' . $basic->currency . ' credited in your Account for sending ' . $data->from_currency_amo . ' ' . $data->fromCurrency->code,
                        'trx' => $data->trx,
                    ]);

                    $msg = round($data->merchant_get_charge, $basic->decimal) . ' ' . $basic->currency . ' credited in your Account for sending ' . $data->from_currency_amo . ' ' . $data->fromCurrency->code . ".<br>";
                    $msg .= '  Your current Balance ' . round($merchant->balance,$basic->decimal) . ' ' . $basic->currency;
                    send_email($merchant->email, $merchant->username, 'Credited Money ', $msg);
                }


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
                send_email($auth->email, $auth->username, 'Send Money  from Account', $txt);

                session()->flash('success', 'Amount Successfully Sent  ');
                return redirect()->route('send.invoice', $data->trx);

            } else {
                session()->flash('alert', 'Insufficient Balance');
                return back();
            }

        }
        return redirect()->route('send.money');
    }


    public function sendInvoice($trx)
    {
        $data['page_title'] = "Send Money History ";

        $auth = Auth::user();
        $data['invoice'] = SendMoney::where('trx', $trx)->where('sender_id', $auth->id)->first();
        if ($auth->merchant == 1) {
            return view('merchant.sent-invoice', $data);
        }
        return view('user.sent-invoice', $data);
    }


    public function sendingLog()
    {
        $auth = Auth::user();
        $data['page_title'] = "Send Money Log ";
        $data['sendMoney'] = SendMoney::where('sender_id', $auth->id)->where('status', '!=', 0)->latest()->paginate(15);
        if ($auth->merchant == 1) {
            return view('merchant.send-log', $data);
        }
        return view('user.send-log', $data);
    }

    /*Merchant Withdraw Manage */

    public function withdraw()
    {
        $auth = Auth::user();
        $data['page_title'] = "Payout Money";
        if ($auth->merchant == 1) {
            return view('merchant.withdraw-money', $data);
        }
        abort(404);
    }

    public function trxCheck(Request $request)
    {
        $this->validate($request, [
            'trx' => 'required',
        ], [
            'trx.required' => 'Transaction / Slip Number must not be empty',
        ]);
        $auth = Auth()->user();
        $trx = SendMoney::where('trx', $request->trx)->first();
        if ($trx) {
            if ($trx->sender_id == $auth->id) {
                session()->flash('alert', ' Sender Cannot Payout  Money');
                return back();
            }

            if ($trx->status == 1) {
                $data['page_title'] = "Receipt Preview";
                $data['invoice'] = $trx;
                return view('merchant.preview-receipt', $data);
            }
            session()->flash('alert', 'This Transaction already Closed');
            return back();
        }
        session()->flash('alert', 'Invalid Transaction / Slip Number');
        return back();
    }

    public function withdrawConfirm(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $basic = GeneralSettings::first();

        $data = SendMoney::where('id', $request->id)->where('status', 1)->first();
        if ($data) {

            $data->received_at = Carbon::now();
            $data->status = 2;
            $data->merchant_id = Auth::id();
            $data->save();



            $auth = Auth::user();
            $auth->balance += round($data->usd_amo, $basic->decimal);
            $auth->save();


            $auth2 = User::find(Auth::id());
            $auth2->balance += round($data->withdraw_charge, $basic->decimal);
            $auth2->save();



            Trx::create([
                'user_id' => $auth2->id,
                'amount' => round($data->withdraw_charge, $basic->decimal),
                'main_amo' => round($auth2->balance, $basic->decimal),
                'charge' => 0,
                'type' => '+',
                'title' => round($data->withdraw_charge, $basic->decimal) . '  ' . $basic->currency . '  profit credited in your account for payout ' . $data->to_currency_amo . ' ' . $data->toCurrency->code,
                'trx' => $data->trx,
            ]);


            Trx::create([
                'user_id' => $auth->id,
                'amount' => round($data->usd_amo, $basic->decimal),
                'main_amo' => round(($auth->balance), $basic->decimal),
                'charge' => 0,
                'type' => '+',
                'title' => round($data->usd_amo, $basic->decimal). '  ' . $basic->currency . '  credited in your account for payout ' . $data->to_currency_amo . ' ' . $data->toCurrency->code,
                'trx' => $data->trx,
            ]);



            $msg = round($data->usd_amo, $basic->decimal) . '  ' . $basic->currency . '  credited in your Account for payout ' . $data->to_currency_amo . ' ' . $data->toCurrency->code . ".<br>";
            $msg .= '  Your current Balance ' . $auth->balance . '  ' . $basic->currency;
            send_email($auth->email, $auth->username, 'Credited Money ', $msg);



            $msg2 = round($data->withdraw_charge, $basic->decimal) . ' ' . $basic->currency . ' profit credited in your Account for payout ' . $data->to_currency_amo . '  ' . $data->toCurrency->code . ". <br>";
            $msg2 .= '  Your current Balance ' . $auth2->balance . ' ' . $basic->currency;
            send_email($auth2->email, $auth2->username, ' Credited Money ', $msg2);


            $success = " Payout  Amount Successfull. ";
            $success .= " Thank you for using " . $basic->sitename . ".";
            session()->flash("success", $success);
            return redirect()->route('merchant.withdraw');
        }
        abort(404);
    }

    public function withdrawLog()
    {
        $auth = Auth::user();
        if ($auth->merchant == 1) {
            $data['page_title'] = "Payout Log";
            $data['invests'] = SendMoney::where('status', 2)->where('merchant_id', $auth->id)->paginate(20);
            return view('merchant.withdraw-log', $data);
        }
        abort(404);
    }




    public function supportTicket()
    {
        $page_title = "Support Tickets";
        $supports = SupportTicket::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(15);
        return view('merchant.support.supportTicket', compact('supports','page_title'));

    }

    public function openSupportTicket()
    {
        $auth = Auth::user();
        if($auth->merchant == 1)
        {
            $page_title = "Support Tickets";
            return view('merchant.support.sendSupportTicket',compact('page_title'));
        }
        abort(404);

    }

    public function storeSupportTicket(Request $request)
    {
        $ticket = new SupportTicket();
        $message = new SupportMessage();
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
        ]);

        $ticket->user_id = Auth::id();
        $random = rand(100000, 999999);

        $ticket->ticket = 'S-' . $random;
        $ticket->subject = $request->subject;
        $ticket->status = 0;
        $ticket->save();

        $message->supportticket_id = $ticket->id;
        $message->type = 1;
        $message->message = $request->message;
        $message->save();

        session()->flash('success', 'Support ticket created successfully');
        return back();

    }

    public function supportMessage($ticket)
    {
        $auth = Auth::user();
        if($auth->merchant == 1)
        {
            $page_title = "Support Tickets";
            $my_ticket = SupportTicket::where('ticket', $ticket)->latest()->first();
            $messages = SupportMessage::where('supportticket_id', $my_ticket->id)->get();
            if ($my_ticket->user_id == Auth::id()) {
                return view('merchant.support.supportMessage', compact('my_ticket', 'messages','page_title'));
            } else {
                return abort(404);
            }
        }
        abort(404);

    }

    public function supportMessageStore(Request $request, $id)
    {

        $ticket = SupportTicket::findOrFail($id);
        $message = new SupportMessage();
        if ($ticket->status != 3) {

            if ($request->replayTicket == 1) {
                $ticket->status = 2;
                $ticket->save();

                $message->supportticket_id = $ticket->id;
                $message->type = 1;
                $message->message = $request->message;
                $message->save();

                session()->flash('success', 'Support ticket replied successfully');
            } elseif ($request->replayTicket == 2) {
                $ticket->status = 3;
                $ticket->save();
                session()->flash('success', 'Support ticket closed successfully');
            }
            return back();
        } else {
            session()->flash('alert', 'Support ticket has alredy been closed');
            return back();
        }

    }


}
