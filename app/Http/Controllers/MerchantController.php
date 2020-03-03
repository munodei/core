<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MerchantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Merchant List";
        $data['merchant'] = User::where('merchant', 1)->latest()->paginate(15);
        return view('admin.merchant.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = " Add Merchant";
        return view('admin.merchant.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|min:8|unique:users',
            'username' => 'required|min:5|unique:users|regex:/^\S*$/u',
            'image' => 'mimes:png,jpg,jpeg'
        ],
            [
                'fname.required' => 'First Name  must not be  empty!!',
                'lname.required' => 'Last Name  must not be  empty!!',
                'phone.required' => 'Contact Number must not be  empty!!',
                'email.required' => 'Email Address must not be  empty!!',
                'username.required' => 'Username must not be  empty!!',
            ]);

        $basic = GeneralSettings::first();

        if ($basic->email_verification == 1) {
            $email_verify = 0;
        } else {
            $email_verify = 1;
        }
        if ($basic->sms_verification == 1) {
            $phone_verify = 0;
        } else {
            $phone_verify = 1;
        }

        $verification_code = strtoupper(Str::random(6));
        $sms_code = strtoupper(Str::random(6));
        $email_time = Carbon::parse()->addMinutes(5);
        $phone_time = Carbon::parse()->addMinutes(5);

        $password =  strtoupper(Str::random(6));

        $in = Input::except('_method', '_token');
        $in['reference'] = $request->username;
        $in['verification_code'] = $verification_code;
        $in['sms_code'] = $sms_code;
        $in['email_time'] = $email_time;
        $in['phone_time'] = $phone_time;
        $in['password'] = bcrypt($password);
        $in['merchant'] = 1;
        $in['merchant_info'] = $request->merchant_info;
        $in['merchant_identity'] = rand(00000, 99999) . rand(00000, 99999) . rand(00, 99);

        $in['address'] = $request->address;
        $in['city'] = $request->city;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $request->username . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['image'] = $filename;
            Image::make($image)->resize(800, 800)->save($location);
        }
        $user = User::create($in)->id;

        $userInfo = User::whereId($user)->first();

        $msg = "Your Merchant Account Created By Admin  <br>";
        $msg .= "Your Merchant Account No: $userInfo->merchant_identity <br>";
        $msg .= "Username : $userInfo->username  <br> Password:  $password";
        send_email($userInfo->email, $userInfo->username, "Welcome To $basic->sitename", $msg);

        $notification = array('message' => 'Merchant Created Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = "Merchant Edit";
        return view('admin.merchant.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
