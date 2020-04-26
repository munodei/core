<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct(){

      $this->middleware('auth');

    }

    public function index(Request $request)
    {

      $page_title = 'Notifications';
      $notifications1 =  Notification::where('user_id',$request->user()->id)->orderby('created_at','desc')->get();
      return view('custom.notifications.index',compact('page_title','notifications1'));

    }


    public function readNotification($id)
    {
      $noti = Notification::find($id);
      $noti->is_read = 1;
      $noti->save();
      return redirect()->route('notifications.index');

    }

    public function clearNotifications(Request $request)
    {
      $id = $request->user()->id;
      Notification::where('user_id',$id)->update(['is_read'=>1]);
      return redirect()->back()->with('success','You have cleared all your notifications!');
    }

    public function store(Request $request)
    {
        //
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

    public function destroy($id)
    {
        //
    }

}
