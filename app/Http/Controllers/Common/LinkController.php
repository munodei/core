<?php namespace App\Http\Controllers\Common;


use App;
use App\group_link;
use App\link;
use App\User;
use App\UserEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth');
    }

   public function index(Request $request)
    {
           $user   = $request->user();
           $id     = $user->id;
           $group_links1    = group_link::leftjoin('user_file_entry','tbl_group_link.id','=','user_file_entry.group_link_id')
                                                                                                                     ->leftjoin('tbl_links','tbl_links.group_id','=','tbl_group_link.id')

                                                                                                                              ->where([
                                                                                                                                ['user_file_entry.user_id',$id],                     ['user_file_entry.shopping_item_id','=',null],
                                                                                                                                ['user_file_entry.shopping_list_id','=',null],
                                                                                                                                ['user_file_entry.inventory_item_id','=',null],
                                                                                                                                ['user_file_entry.inventory_group_id','=',null],
                                                                                                                                ['user_file_entry.group_link_id','!=',null]
                                                                                                                              ])
                                                                                                                              ->select(
                                                                                                                                'tbl_group_link.id as groupLinkID',
                                                                                                                                'tbl_group_link.*',
                                                                                                                                'user_file_entry.owner',
                                                                                                                                'tbl_links.*',
                                                                                                                                'tbl_links.id as linkID'
                                                                                                                              )
                                                                                                                              ->distinct()
                                                                                                                             ->get();


        foreach($group_links1 as $group){

          $links[] = link::where('tbl_links.group_id',$group->groupLinkID)->get();

        }

        $group_links     = array();

        foreach ($group_links1 as $group) {

              $group_links[$group->groupLinkID][] = $group;

        }

        return view('page-bookmarks.index',compact('user','group_links','links'));
       }

      public function shareLinkGroup(Request $request){


        $user_id = $request->user()->id;

        extract($_POST);

        if(User::where('email','=',trim($email))->exists()){

          $user = User::where('email','=',trim($email))->first();

             if(!UserEntry::where([['user_id',$user->id],['group_link_id',$id]])->exists())
             {

                        $entry = UserEntry::create([
                                              'user_id'=>$user->id,
                                              'group_link_id'=>$id,
                                              'owner'=>0,
                                              'created_at'=>date('Y-m-d h:i:s')
                                              ]);

             }

              return redirect()->route('bookmark-links')->with('success','You successfully shared your Group Links!');


        }
        else
        {
          return redirect()->route('bookmark-links')->with('error','The user you are trying to share your Group Links with isn\'t a registered user!');
        }

    }

       public function create(Request $request)
       {

         $user = $request->user();

         if(isset($_POST['link_name'])){

           $this->validate($request,[
             'link_name'         =>'required',
             'link'              =>'required',
             'group_id'          =>'required',
             'link_descripition' => 'required'

           ]);

         extract($_POST);

         $link1                   = $link;
         $link                    = new link;

         $link->link_name         = $link_name;
         $link->group_id          = intval($group_id);
         $link->link              = $link1;
         $link->link_descripltion = $link_descripition;
         $link->created_at        = date('Y-m-d h:i:s');
         $link->created_at        = date('Y-m-d h:i:s');

         $link->save();

         return redirect()->route('bookmark-links')->with('success','You have successfully added a link to your group!');

         }

         return redirect()->route('bookmark-links')->with('error','Link not added, Error Occured!');
       }


      public function save($id){

        $group   = group_link::find($id);

        return '<input type="hidden" name="group_id" id="group_id" value="'.$group->id.'">

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Link</label>
                <div class="col-sm-10">
                    <input type="text" required name="link" class="form-control" id="link"  value="'.old('link').'">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input  required name="link_name" id="link_name" class="form-control" id="link_name" value="'.old('link_name').'">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Info</label>
                <div class="col-sm-10">
                    <textarea  required name="link_descripition" id="link_descripition" class="form-control">'.old('link_descripition').'</textarea>
                </div>
            </div>';

      }

      public function edit($id){

        $link = link::find($id);

        return '<div id="formLinkCreate1"><input type="hidden" id="id" name="id" value="'.$link->id.'"/>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Link</label>
                <div class="col-sm-10">
                    <input type="text" required name="link" class="form-control" id="link"  value="'.$link->link.'">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Link Name/Title</label>
                <div class="col-sm-10">
                    <textarea  required name="link_name" id="link_name" class="form-control" id="group_description">'.$link->link_name.'</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Info</label>
                <div class="col-sm-10">
                    <textarea  required name="link_descripition" id="link_descripition" class="form-control">'.$link->link_descripltion.'</textarea>
                </div>
            </div> </div>';

      }

       public function update(Request $request)
       {
           $user = $request->user();

           if(isset($_POST['link_name'])){

             $this->validate($request,[
               'link_name'         =>'required',
               'link'              =>'required',
               'link_descripition' => 'required'

             ]);

            extract($_POST);

            $link1                   = $link;

            $link                    = link::find($id);

            $link->link_name         = $link_name;
            $link->link              = $link1;
            $link->link_descripltion = $link_descripition;
            $link->created_at        = date('Y-m-d h:i:s');

           $link->save();

           return redirect()->route('bookmark-links')->with('success','You have successfully updated your link information!');

           }

           return redirect()->route('bookmark-links')->with('error','You did not successfully update your link information!');

       }

       public function destroy(Request $request)
       {
           $user = $request->user();
           extract($_POST);

           if(isset($_POST['linkID']) && link::where([['id',$linkID],['user_id',$user->id]])->exists()){


             link::where([['id',$linkID],['user_id',$user->id]])->delete();

             return redirect()->route('bookmark-links')->with('success','You have successfully deleted a link!');

           }

            return redirect()->route('bookmark-links')->with('error','You link not deleted, Error Occured!');
       }




}
