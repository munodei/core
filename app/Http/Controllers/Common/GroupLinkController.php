<?php namespace App\Http\Controllers\Common;


use App;
use App\link;
use App\group_link;
use App\UserEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupLinkController extends Controller
{

  public function __construct()
   {
       $this->middleware('auth');
   }

   public function index(Request $request)
       {
           $user   = $request->user();
           $id     = $user->id;
           $result = array();
           $groups = group_link::where('user_id',$id)->get();
           $links  = link::where('tbl_links.user_id',$id)
                                     ->leftjoin('tbl_group_link','tbl_group_link.id','=','tbl_links.group_id')
                                     ->select('tbl_group_link.*','tbl_links.*','tbl_links.id as linkId','tbl_group_link.id as groupId')
                                     ->cursor();



           foreach ($links as $element) {
              $result[$element->group_name][] = $element;
           }

           return view('page-bookmarks.groups',compact('user','user','result','links','groups'));
       }




       public function create(Request $request)
       {
           $user = $request->user();

           if(isset($_POST['group_name'])){


           $this->validate($request, [
               'group_name'         =>'required',
               'group_descripition' => 'required'
             ]);

           extract($_POST);

           $group                     = new group_link;
           $group->user_id            = $user->id;
           $group->group_name         = $group_name;
           $group->group_descripltion = $group_descripition;
           $group->type               = isset($_POST['type'])?$type:'N/A';
           $group->created_at         = date('Y-m-d h:i:s');
           $group->updated_at         = date('Y-m-d H:i:s');

           $group->save();

           UserEntry::create([

                              'user_id'=>$user->id,
                              'group_link_id'=>$group->id,
                              'created_at'=>date('Y-m-d H:i:s'),
                              'updated_at'=>date('Y-m-d H:i:s'),

                            ]);

           return redirect()->route('bookmark-links')->with('success','You have successfully added a new group!');

         }

          return redirect()->route('bookmark-links')->with('error','Group not created, Error Occured!');

       }

       public function edit($id){

        $group                    =  group_link::find($id);

        return '<div id="formGroupEdit1"><input type="hidden" id="id" name="id" value="'.$group->id.'"/>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Group</label>
                <div class="col-sm-10">
                    <input type="text" required name="group_name" class="form-control" id="group_name"  value="'.$group->group_name.'">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Info</label>
                <div class="col-sm-10">
                    <textarea  required name="group_descripition" id="group_descripition" class="form-control" id="group_description">'.$group->group_descripltion.'</textarea>
                </div>
            </div> </div>';
       }


       public function update(Request $request)
       {
         if(isset($_POST['group_name'])){

           $this->validate($request, [
               'group_name'         =>'required',
               'group_descripition' => 'required'
             ]);

         $user = $request->user();
         extract($_POST);

         $group                    =  group_link::find($id);
         if(group_link::where([['user_id',$user->id],['id',$group->id]])->exists()){
         $group->group_name         = $group_name;
         $group->group_descripltion = $group_descripition;
         $group->updated_at         = date('Y-m-d H:i:s');

         $group->save();

         if(!UserEntry::where([['user_id',$user->id],['group_link_id',$group->id],['owner',1]])->exists()){

          UserEntry::create([

                    'user_id'=>$user->id,
                    'group_link_id'=>$group->id,
                    'owner'=>1,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),

                  ]);
        }


        return redirect()->route('bookmark-links')->with('success','You have successfully upated your group!');
       }

        return redirect()->route('bookmark-links')->with('error','Unfortunately you don\'t have rights to make changes to this group!');

       }

        return redirect()->route('bookmark-links')->with('error','Group not updated, Error Occured!');

       }

       public function groupUrls($id){

        $group                    =  group_link::find($id);
        $links                    =  link::where('group_id',$id)->cursor();

        $urls = '<div id="groupLinks1"><ul class="list-group col-md-12" >
                 <li class="list-group-item active" title="'.$group->group_descripltion.'">
                   <table>
                     <tr>
                       <td>'.$group->group_name.'</d>
                     </tr>
                   </table>
               </li>';


         foreach($links as $link){



          $urls .= ' <li class="list-group-item" title="'.$link->link_descripltion.'">
                   <table>
                     <tr>
                       <td style="width:98%;"><a href="'.$link->link.'"  target="_blank">'.$link->link_name.'</a></td>
                       <td>
                         <a href="#" style="width:1%;display:inline;" title="Edit Link '.$link->link_name.'" data-toggle="modal" data-target="#editLinkModal" onclick="editLink('.$link->id .')" class="text-success mr-2 pull-right offset-md-7">

                                 </a>
                         <a href="#" style="width:1%;display:inline;" title="Delete Link '.$link->link_name.'" class="pull-right offset-md-8" data-toggle="modal" onclick="deleteLink('.$link->id  .','.$link->link_name.')" data-target="#LinkDeleteModal"></a>
                       </td>
                     </tr>
                   </table>
                   </li>';



         }

        $urls .= ' </ul></div>';

        return $urls;

       }

       public function destroy(Request $request)
       {
         $user = $request->user();

          extract($_POST);

         if(isset($_POST['groupID']) && group_link::where([['id',$groupID],['user_id',$user->id]])->exists()){

           group_link::where([['id',$groupID],['user_id',$user->id]])->delete();
           UserEntry::where('group_link_id',$groupID)->delete();

           return redirect()->route('bookmark-links')->with('success','You have successfully deleted your group!');

         }elseif(UserEntry::where([['group_link_id',$groupID],['user_id',$user->id],['owner',0]])->exists()){

          UserEntry::where([['group_link_id',$groupID],['user_id',$user->id],['owner',0]])->delete();

          return redirect()->route('bookmark-links')->with('success','You have successfully deleted your shared group!');

         }
         return redirect()->route('bookmark-links')->with('error','Group not deleted, Error Occured!');

       }

}
