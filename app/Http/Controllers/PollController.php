<?php

namespace App\Http\Controllers;


use App\UserPoll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function __construct(){

      $this->middleware('auth');

    }

    public function index()
    {
        $page_title = 'Polls';
        $polls = array();
        return view('custom.polls.index',compact('page_title','polls'));
    }

    public function create()
    {

      $page_title = 'Create Poll';
      return view('custom.polls.create',compact('page_title'));

    }

    private function requirements(Request $request)
{

  $user = $request->user();

  if($user->premium_time != -1 &&  $user->premium_time < time()) {

        return redirect()->back()->with('error','Unfortnnately you don\'t have any subscriptions which allow you to to create a poll!')
  }

}

    public function store(Request $request)
    {


      $rules = [
                'name'=>'required',
                'question'=>'required',
                'timestamp'=>'required',
                'show_results'=>'required',
                'ip_restricted'=>'required',
                'status'=>'required',
                'votes'=>'required',
                'vote_type'=>'required',
                'themeid'=>'required',
                'cookie_restricted'=>'required',
                'user_restricted'=>'required',
                'public'=>'required',
      ];

      $msg = [

      ];

      $time = ($days * (3600 *24)) + ($hours * 3600) + ($minutes * 60);
        if($time > 0) {
          $time = time() + $time;
      }

      $poll = UserPoll::create([
                          "userid" => $this->user->info->ID,
                    			"name" => $name,
                    			"question" => $question,
                    			"timestamp" => $time,
                    			"created" => time(),
                    			"ip_restricted" => $ip_restriction,
                    			"show_results" => $show_results,
                    			"updated" => time(),
                    			"hash" => $hash,
                    			"vote_type" => $vote_type,
                    			"themeid" => $themeid,
                    			"cookie_restricted" => $cookie_restriction,
                    			"user_restricted" => $user_restriction,
                    			"public" => $public,
                          "created_at"=>date('Y-m-d h:i:s'),
                          "updated_at"=>date('Y-m-d h:i:s')
      ]);

      return redirect()->route('created-poll',['poll'=>$poll])->with('success','Please add the final details to your poll to finish your poll!');

    }

    public function createdPoll(Request $request,UserPoll $poll){

          return view('finalize-poll',compact('poll'));

    }

    public function show($poll)
    {

    }

    public function edit($poll)
    {

    }

    public function update(Request $request, $poll)
    {

    }

    public function destroy($poll)
    {

    }
}
