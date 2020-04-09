<?php

namespace App\Http\Controllers;
use App\ShoppingList;
use App\ShoppingListRequest;
use Illuminate\Http\Request;

class ShoppingRequestController extends Controller
{

    public function __construct(){

      $this->middleware('auth');
      $this->icons = '<i class="material-icons">note_add</i>';

    }

    public function index(Request $request)
    {
      $user = $request->user();
      $page_title = 'Shopping Requests';
      $shopping_requests = ShoppingListRequest::leftjoin('shopping_lists','shopping_lists.id','=','shopping_list_requests.shopping_list_id')
                                                                                                                                            ->where('shopping_list_requests.user_id',$user->id)
                                                                                                                                            ->select(
                                                                                                                                              'shopping_list_requests.*',
                                                                                                                                              'shopping_lists.shopping_lists_name',
                                                                                                                                              )
                                                                                                                                            ->get();

      return view('custom.shopping-items.shopping-requests',compact('user','page_title','shopping_requests'));
    }

    public function cancel(Request $request)
    {
      $rules = [
        'id'=>'required',

      ];
      $msgs = [
            'id.required'=>'Error occured, reload Page and try again',

      ];
      $request->validate($rules,$msgs);

      extract($_POST);
      $user_id = $request->user()->id;

      if(ShoppingListRequest::where([['user_id',$user_id],['id',$id],['status','Rejected']])->orwhere([['user_id',$user_id],['id',$id],['status','Pending']])->exists()){

          ShoppingListRequest::where([['user_id',$user_id],['id',$id]])->update(['status'=>'Canceled']);
          add_notification($user_id, $this->icons, 'You have successfully canceled your Shopping Request! : @'.date('Y-m-d h:i:s'), route('shopping-requests.index'), 0);
          return redirect()->back()->with('success','You have successfully canceled your Shopping Request');

      }
      add_notification($user_id, $this->icons, 'Error occured on your attempt to cancel shopping Request! : @'.date('Y-m-d h:i:s'), route('shopping-requests.index'), 0);
      return redirect()->back()->with('error','Error occured on your attempt to cancel shopping Request!');

    }

    public function destroy(Request $request)
    {
        $rules = [
          'id'=>'required',

        ];

        $msgs = [
              'id.required'=>'Error occured, reload Page and try again',

        ];

        $request->validate($rules,$msgs);

        extract($_POST);
        $user_id = $request->user()->id;

        if(ShoppingListRequest::where([['user_id',$user_id],['id',$id],['status','Rejected']])->orwhere([['user_id',$user_id],['id',$id],['status','Canceled']])->exists()){

            ShoppingListRequest::where([['user_id',$user_id],['id',$id]])->delete();
            add_notification($user_id, $this->icons, 'You have successfully deleted your Shopping Request! : @'.date('Y-m-d h:i:s'), route('shopping-requests.index'), 0);
            return redirect()->back()->with('success','You have successfully deleted your Shopping Request');

        }
        add_notification($user_id, $this->icons, 'Error occured on your attempt to delete shopping Request! : @'.date('Y-m-d h:i:s'), route('shopping-requests.index'), 0);
        return redirect()->back()->with('error','Error occured on your attempt to delete shopping Request!');
    }
}
