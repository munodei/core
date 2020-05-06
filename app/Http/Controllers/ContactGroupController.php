<?php
namespace App\Http\Controllers;

use App\ContactGroup;
use App\ContactGroupItem;
use App\User;
use App\Contact;
use App\UserEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactGroupController extends Controller
{
    public function __construct(){

      $this->middleware('auth');
      $this->icons = '<i class="material-icons">group</i>';

    }

    public function index(Request $request)
    {
      $id                 = $request->user()->id;
      $page_title         = 'Contact Groups';

      return view('custom.contacts.contact-list', compact('page_title'));
    }

    public function create(Request $request)
    {
        return view('companies.create');
    }

    public function shareContactGroup(Request $request){

      $rules = [
                'email'=>'required',
                'id'=>'required'
      ];
      $msgs =  [
                  'email.required'=>'Email for the User you want to share information with is required!',
                  'id.required'=>'The Contact group To Be Shared is Required!'

      ];

      $request->validate($rules,$msgs);

      extract($_POST);

      if(!User::where('email',$email)->exists())
      {
          add_notification($request->user()->id, $this->icons, 'Unfortunately the User ('.$email.') you\'re trying to share contact group with doesn\'t exist! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
          return redirect()->back()->with('error','Unfortunately the User you\'re trying to share contact group with doesn\'t exist!');
      }

      $user = User::where('email',$email)->first();

      if(UserEntry::where([['entry','contact-group'],['user_id',$request->user()->id],['entry_id',$id]])->exists()){

            UserEntry::create([
                                'entry' => 'contact-group',
                                'entry_id' => $id ,
                                'user_id' => $user->id,
                                'owner'=>0
            ]);

            add_notification($request->user()->id, $this->icons, 'You have successfully shared your Contact group with '.$email.'! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
            return redirect()->back()->with('success','You have successfully shared your Contact group with '.$email.'!');

      }

      add_notification($request->user()->id, $this->icons, 'Error occured whilst attempting to Share Contact Group with '.$email.' : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
      return redirect()->back()->with('error','Error occured whilst attempting to Share Contact Group with '.$email);

    }

    public function addContactToGroup(Request $request){

      $rules = [
                  'contact_group_id'=>'required',
                  'contact_id'=>'required',
                ];

      $msgs = [
                'contact_id.required'=>'The Contact is required!',
                'contact_group_id.required'=>'The Contact group is required!'
              ];

      $request->validate($rules,$msgs);

      extract($_POST);

      $contact_group_created = ContactGroupItem::create([

        'contact_group_id'=>$contact_group_id,
        'contact_id'=>$contact_id,
        'created_at'=>date('Y-m-d h:i:s'),
        'updated_at'=>date('Y-m-d h:i:s')

      ]);

      if($contact_group_created){

        add_notification($request->user()->id, $this->icons, 'Contact added to Group successfully! : @'.date('Y-m-d h:i:s'), route('contacts.index'), 0);
        return redirect()->route('contacts.index')->with('success' , 'Contact added to Group successfully!');

      }

      add_notification($request->user()->id, $this->icons, 'Contact added to Group Error! : @'.date('Y-m-d h:i:s'), route('contacts.index'), 0);
      return redirect()->route('contacts.index')->with('success' , 'Contact added to Group Error!');


    }

    public function store(Request $request)
    {
        $rules = [
                    'group_contacts_name'=>'required',
                    'group_contacts_description'=>'required'
                  ];

        $request->validate($rules);
        extract($_POST);
        $contact_group = ContactGroup::create([
                                    'group_contacts_name' => $group_contacts_name,
                                    'group_contacts_description' => $group_contacts_description,
                                    'user_id' => Auth::user()->id
        ]);


        if($contact_group){

          UserEntry::create([
                              'entry' => 'contact-group',
                              'entry_id' => $contact_group->id ,
                              'user_id' => Auth::user()->id,
                              'owner'=>1
          ]);

            add_notification($request->user()->id, $this->icons, 'You have successfully added a Contact Group! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
            return redirect()->route('contact-groups.index')->with('success' , 'Contact Group created successfully');
        }

    }


    public function update(Request $request)
    {
      $rules = [
                  'group_contacts_name'=>'required',
                  'group_contacts_description'=>'required'
                ];

      $request->validate($rules);

      extract($_POST);
      $contact_group = ContactGroup::find($id);

      if($contact_group->user_id === $request->user()->id)
      {
        $contact_group->update([
                                    'group_contacts_name' => $request->input('group_contacts_name'),
                                    'group_contacts_description' => $request->input('group_contacts_description'),
                                    'user_id' => Auth::user()->id
                                  ]);


        if($contact_group){
            add_notification($request->user()->id, $this->icons, 'You have successfully updated a Contact Group! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
            return redirect()->route('contact-groups.index')->with('success' , 'Contact Group updated successfully');
        }
      }

      add_notification($request->user()->id, $this->icons, 'Error occured in attempt to update Contact Group! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
      return redirect()->route('contact-groups.index')->with('success' , 'Error occured in attempt to update Contact Group');

    }

    public function destroy(Request $request)
    {
          $rules = ['id'=>'required'];
          $msgs = ['id.required'=>'The Contact Group to be deleted is Required!'];
          $request->validate($rules,$msgs);

          $user_id = $request->user()->id;

          extract($_POST);

          if(UserEntry::where([['entry','contact-group'],['entry_id',$id],['owner',1],['user_id',$user_id]])->exists())
          {

            UserEntry::where([['entry','contact-group'],['entry_id',$id]])->delete();
            ContactGroupItem::where('contact_group_id',$id)->delete();
            ContactGroup::where('id',$id)->delete();
            add_notification($request->user()->id, $this->icons, 'You have successfully deleted your Contact Group! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
            return redirect()->back()->with('error','You have successfully deleted your Contact Group!');

          }

          elseif (UserEntry::where([['entry','contact-group'],['entry_id',$id],['owner',0],['user_id',$user_id]])->exists())
          {

            UserEntry::where([['entry','contact-group'],['entry_id',$id],['user_id',$user_id]])->delete();
            add_notification($request->user()->id, $this->icons, 'You have successfully deleted your shared Contact Group! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
            return redirect()->back()->with('error','You have successfully deleted your shared Contact Group!');

          }

          add_notification($request->user()->id, $this->icons, 'Error Occured in Attempt to delete Contact Group! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
          return redirect()->back()->with('error','Error Occured in Attempt to delete Contact Group!');


    }

    public function deleteFromContactList(Request $request,$group_id,$contact_id){

      if(UserEntry::where([['user_id',$request->user()->id],['entry','contact-group'],['entry_id',$group_id]])->exists()){

          if(ContactGroupItem::where([['contact_group_id',$group_id],['contact_id',$contact_id]])->exists()){

                ContactGroupItem::where([['contact_group_id',$group_id],['contact_id',$contact_id]])->delete();


          }
          add_notification($request->user()->id, $this->icons, 'You have deleted an item from this Contact list : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
          return redirect()->back()->with('success','You have deleted an item from this Contact list!');

        }
        add_notification($request->user()->id, $this->icons, 'Error Occured in Attempt to delete Contact ! : @'.date('Y-m-d h:i:s'), route('contact-groups.index'), 0);
        return redirect()->back()->with('error','Error Occured in Attempt to delete Contact!');


     }


}
