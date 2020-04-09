<?php namespace App\Http\Controllers\Common;

use Mail;

use App;
use Excel;
use Storage;
use App\PersonalInformation;
use App\PersonalInformationExports;
use App\contact;
use App\tbl_chat;
use App\group_note;
use App\User;
use App\UserEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Intervention\Image\ImageManagerStatic as Image;



class GroupNoteController extends Controller
{

  public function __construct()
   {
       $this->middleware('auth');
   }

   public function index(Request $request)
    {

        $user        = $request->user();
        $group_notes = group_note::where('user_id',$user->id)->get();

        return view('notes',compact('user','group_notes'));

    }

    public function create(Request $request)
    {
        $user = $request->user();

        if(isset($_POST['group_notes_name'])){

        $this->validate($request, [
                  'group_notes_name'         =>'required',
                  'group_notes_descripition' => 'required'
          ]);

        extract($_POST);

        $group                           = new group_note;
        $group->user_id                  = $user->id;
        $group->group_notes_name         = $group_notes_name;
        $group->group_notes_descripltion = $group_notes_descripition;
        $group->created_at               = date('Y-m-d h:i:s');
        $group->updated_at               = date('Y-m-d H:i:s');

        $group->save();

        UserEntry::create([

                            'user_id'=>$user->id,
                            'group_note_id'=>$group->id,
                            'owner'=>1,
                            'created_at'=>date('Y-m-d h:i:s'),
                            'updated_at'=>date('Y-m-d h:i:s'),

                          ]);

      }

      return redirect()->route('notes')->with('success','You have successfully added a new group!');

      }

      public function update(Request $request)
      {
        if(isset($_POST['group_notes_name'])){

          $this->validate($request, [
              'group_notes_name'         =>'required',
              'group_notes_descripition' => 'required'
            ]);


        extract($_POST);

        $group                           =  group_note::find($id);

        if(!UserEntry::where([['user_id',$user->id],['group_note_id',$group->id],['owner',1]])->exists()){

        $group->group_notes_name         = $group_notes_name;
        $group->group_notes_descripltion = $group_notes_descripition;
        $group->updated_at               = date('Y-m-d H:i:s');

        $group->save();

        if(!UserEntry::where([['user_id',$user->id],['group_note_id',$group->id]])->exists()){

        UserEntry::create([

                    'user_id'=>$user->id,
                    'group_note_id'=>$group->id,
                    'owner'=>1,
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s'),

                  ]);
          }

        return redirect()->route('notes')->with('success','You have successfully upated your group!');

      }

       return redirect()->route('notes')->with('error','Unfortunately you don\'t have rights to update notes of this group!');

      }

      return redirect()->route('notes')->with('error','Missing Information!');

      }

      public function destroy(Request $request)
      {
        $user = $request->user();

        if(isset($_POST['id'])){

          extract($_POST);
          group_note::where([['id',$id],['user_id',$user->id]])->delete();
          UserEntry::where('group_note_id',$id)->delete();

          return redirect()->route('notes')->with('error','You have successfully deleted your group!');

        }elseif (UserEntry::where([['group_note_id',$id],['owner',0],['user_id',$user->id]])->exists()) {

          UserEntry::where([['group_note_id',$id],['owner',0],['user_id',$user->id]])->delete();

           return redirect()->route('notes')->with('error','You have successfully deleted your shared group!');

        }

        return redirect()->route('notes')->with('error','Group could not be identified!');
      }


}
