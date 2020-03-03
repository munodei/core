<?php

namespace App\Http\Controllers;

use App\Admin;
use App\SupportMessage;
use App\SupportTicket;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Image;

class AdminController extends Controller
{


	public function __construct(){
		$Gset = GeneralSettings::first();
		$this->sitename = $Gset->sitename;

		$this->middleware('auth:admin');
	}

	public function dashboard()
    {
        $data['page_title'] = 'DashBoard';

        return view('admin.dashboard', $data);
    }






    public function changePassword()
    {
        $data['page_title'] = "Change Password";
        return view('admin.change_password',$data);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $user = Auth::guard('admin')->user();

        $oldPassword = $request->old_password;
        $password = $request->new_password;
        $passwordConf = $request->password_confirmation;

        if (!Hash::check($oldPassword, $user->password) || $password != $passwordConf) {
            $notification =  array('message' => 'Password Do not match !!', 'alert-type' => 'error');
            return back()->with($notification);
        }elseif (Hash::check($oldPassword, $user->password) && $password == $passwordConf)
        {
            $user->password = bcrypt($password);
            $user->save();
            $notification =  array('message' => 'Password Changed Successfully !!', 'alert-type' => 'success');
            return back()->with($notification);
        }
    }


    public function profile()
    {
        $data['admin'] = Auth::user();
        $data['page_title'] = "Profile Settings";
        return view('admin.profile',$data);
    }

    public function updateProfile(Request $request)
    {
        $data = Admin::find($request->id);
        $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|max:50|unique:admins,email,'.$data->id,
            'mobile' => 'required|regex:/(01)[0-9]{9}/',
        ]);

        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'admin_'.time().'.jpg';
            $location = 'assets/admin/img/' . $filename;
            Image::make($image)->resize(300,300)->save($location);
            $path = './assets/admin/img/';
            File::delete($path.$data->image);
            $in['image'] = $filename;
        }
        $data->fill($in)->save();

        $notification =  array('message' => 'Profile Update Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }




    public function supportTicket()
    {
        $page_title = 'Support Tickets';
        $items = SupportTicket::orderBy('id', 'DESC')->paginate(15);
        return view('admin.support.tickets', compact('items','page_title'));
    }

    public function pendingSupportTicket()
    {
        $page_title = 'Support Tickets';
        $items = SupportTicket::whereIN('status', [0, 2])->orderBy('id', 'DESC')->paginate(15);
        return view('admin.support.pendingTickets', compact('items','page_title'));
    }


    public function ticketReply($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $page_title = 'Support Tickets';
        $messages = SupportMessage::where('supportticket_id', $ticket->id)->get();
        return view('admin.support.reply', compact('ticket', 'messages','page_title'));
    }

    public function ticketReplySend(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $message = new SupportMessage();
        if ($request->replayTicket == 1) {
            $this->validate($request,
                [
                    'message' => 'required',
                ]);
            $ticket->status = 1;
            $ticket->save();

            $message->supportticket_id = $ticket->id;
            $message->type = 2;
            $message->message = $request->message;
            $message->save();
            session()->flash('success', 'Support ticket replied successfully');
        } elseif ($request->replayTicket == 2) {
            $ticket->status = 3;
            $ticket->save();
            session()->flash('success', 'Support ticket closed successfully');
        }
        return back();
    }






    public function logout()    {
		Auth::guard('admin')->logout();
		session()->flash('message', 'Just Logged Out!');
		return redirect('/admin');
	}

}
