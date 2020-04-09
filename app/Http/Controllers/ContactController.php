<?php

namespace App\Http\Controllers;

use App\User;
use App\ContactGroup;
use App\Contact;
use App\Country;
use App\UserEntry;
use App\UserLogin;
use App\Exports\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct()
    {

      $this->middleware('auth');
      $this->icons = '<i class="material-icons">user</i>';

    }

    public function index(Request $request)
    {

          $page_title   = 'Contacts';
          $id           = $request->user()->id;
          $contacts     = UserEntry::leftjoin('contacts','contacts.id','=','user_entry.entry_id')
                                                                                               ->leftjoin('users','users.id','=','contacts.user_id')
                                                                                                ->where([
                                                                                                                  ['user_entry.user_id',$id],
                                                                                                                  ['user_entry.entry','contact']
                                                                                                                  ])
                                                                                                ->select('contacts.id as contactID','contacts.email as emailContactID','user_entry.id as userFileEntryID','users.id as userID','users.email as emailUserlD','contacts.*','user_entry.*')
                                                                                                  ->orderby('contacts.created_at','DESC')->paginate(15);

             return view('custom.contacts.index', ['contacts'=> $contacts,'page_title'=>$page_title]);


        return view('auth.login');
    }

    public function searchContacts(Request $request){




  if($request->has('search')){

 extract($_POST);

 $page_title   = 'Contacts';
 $id           = $request->user()->id;
 $contacts     = UserEntry::leftjoin('contacts','contacts.id','=','user_entry.entry_id')
                                                                                      ->leftjoin('users','users.id','=','contacts.user_id')
                                                                                       ->where([
                                                                                                         ['user_entry.user_id',$id],
                                                                                                         ['user_entry.entry','contact'],
                                                                                                         ['firstname', 'like', "%{$search}%"]
                                                                                                         ])
                                                                                       ->orwhere([
                                                                                                         ['user_entry.user_id',$id],
                                                                                                         ['user_entry.entry','contact'],
                                                                                                         ['lastname', 'like', "%{$search}%"]
                                                                                                         ])
                                                                                      ->select('contacts.id as contactID','contacts.email as emailContactID','user_entry.id as userFileEntryID','users.id as userID','users.email as emailUserlD','contacts.*','user_entry.*')
                                                                                      ->orderby('contacts.created_at','DESC')->paginate(15);

     }

   return view('custom.contacts.index',compact('page_title','contacts'));


 }

    public function create()
    {
        $page_title = 'Add Contact';
        $country    = Country::whereStatus(1)->get();
        return view('custom.contacts.create',compact('page_title','country'));
    }

        public function singleUser(Contact $contact)
    {
        $user = Contact::findorFail($contact->id);

        $data['page_title'] = "Contact Manage";
        $data['user'] = $user;
        $data['country'] = Country::whereStatus(1)->get();
        $data['last_login'] = UserLogin::whereUser_id($user->id)->orderBy('id', 'desc')->first();
        return view('custom.contacts.contact', $data);
    }


    public function store(Request $request)
    {

        if(Auth::check()){

          $rules = [

                         'firstname'  =>'required',
                         'lastname'   =>'required',
                         'email'      =>'required',
                         'mobilephone'      =>'required',

                        ];

          $msg = [

                'firstname.required'    =>'The First Name of Contact is required!',
                'lastname.required'              =>'The Last Name of Contact is required!',
                'email.required'                 =>'The Email Address of Contact is required!',
                'mobilephone.required'           =>'The Mobile Number of Contact is required!',

                  ];

               $this->validate($request,$rules,$msg);

               extract($_POST);

               if($request->hasFile('photo')) {

                 $filenameWithExt = $request->file('photo')->getClientOriginalName();
                 $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                 $extension       = $request->file('photo')->getClientOriginalExtension();
                 $fileNameToStore = $filename.'-'.time().'.'.$extension;

                  $request->file('photo')->move('assets/user/images/', $fileNameToStore);

                  $fileNameToStore = '/assets/user/images/'.$fileNameToStore;

                 }

                 $user     = $request->user();
                 $id       = $user->id;

                 $contact_id = User::where('email',$email)->first();

                 $full_name = $contact_id->fname ?? $firstname;
                 $full_name .= ' ';
                 $full_name .= $contact_id->lname ?? $lastname;

                 $contact = contact::create([
                                             'firstname'        => $contact_id->fname ?? $firstname,
                                             'lastname'         => $contact_id->lname ?? $lastname,
                                             'additional'       => $additional ?? '',
                                             'prefix'           => $prefix ?? '',
                                             'suffix'           => $suffix ?? '',
                                             'mobilephone'      => $contact_id->phone ?? $mobilephone ?? '',
                                             'workphone'        => $workphone ?? '',
                                             'city'             => $city ?? '',
                                             'country_id'       => $country_id ?? '',
                                             'zip_code'         => $zip_code ?? '',
                                             'jobtitle'         => $jobtitle ?? '',
                                             'role'             => $role ?? '',
                                             'email'            => $email ?? '',
                                             'address'          => $contact_id->address ?? $address ?? '',
                                             'label'            => $label ?? '',
                                             'url'              => $url ?? '',
                                             'photo'            => $fileNameToStore  ?? $contact_id->photo ?? '/assets/images/user/user-default.png',
                                             'user_id'          => $contact_id->id ?? $id,
                                             'users'            => $contact_id->id ?? $id,
                                             'about'            => $about ?? '',
                                             'slug'             => unique_slug($full_name,'Contact'),
                                             'contact_id'       => $contact_id->id ?? Null,
                                             'created_at'       => date('Y-m-d h:i:s'),
                                             'updated_at'       => date('Y-m-d h:i:s')

                                             ]);

                     $entry = UserEntry::create([

                                         'user_id'=>$contact_id->id ?? $request->user()->id,
                                         'entry_id'=>$contact->id,
                                         'entry'=>'contact',
                                         'owner'=>isset($contact_id->id)?0:1,
                                         'created_at'=>date('Y-m-d h:i:s')

                                         ]);

                    if(isset($contact_id->id )){

                         $entry = UserEntry::create([
                                                'user_id'=>$contact_id->id,
                                                'contact_id'=>$contact->id,
                                                'owner'=>1,
                                                'created_at'=>date('Y-m-d h:i:s')

                                                ]);
                        }

              add_notification($request->user()->id, $this->icons, 'You have successfully added a Contact! : @'.date('Y-m-d h:i:s'), route('contacts.index'), 0);

              return redirect()->route('contacts.index')->with('success','You have successfully added a Contact');

        }

            return back()->withInput()->with('errors', 'Error creating new Contact');

    }


      public function allContactsExport(Request $request){

        add_notification($request->user()->id, $this->icons, 'You have successfully exported all Contacts! : @'.date('Y-m-d h:i:s'), route('contacts.index'), 0);
        return (new Contacts($request->user()->id))->download('contacts.csv');

      }

      public function contactsImport(Request $request){

          $user = $request->user();
          $page_title = 'Contacts Import';
          return view('custom.contacts.import',compact('user','page_title'));

      }

      public function contactsExport(Request $request){

          $user = $request->user();
          $page_title = 'Contacts Export';
          return view('custom.contacts.export',compact('user','page_title'));

      }

    public function edit(Contact $contact)
    {

        $page_title = 'Edit Contact';
        $contact = Contact::find($contact->id);
        $country    = Country::whereStatus(1)->get();
        return view('custom.contacts.edit',compact('page_title','contact','country'));
    }

    public function update(Request $request,$contact)
    {


      if(Auth::check()){

          $rules = [

                         'firstname'  =>'required',
                         'lastname'   =>'required',
                         'email'      =>'required',
                         'mobilephone'      =>'required',

                        ];

          $msg = [

                'firstname.required'    =>'The First Name of Contact is required!',
                'lastname.required'              =>'The Last Name of Contact is required!',
                'email.required'                 =>'The Email Address of Contact is required!',
                'mobilephone.required'           =>'The Mobile Number of Contact is required!',

                  ];

               $this->validate($request,$rules,$msg);


        extract($_POST);

        $contact    = contact::find($contact);
        $contact_id = User::where('email',$email)->first();
        $user       = $request->user();
        $user_id    = $user->id;


        if($request->hasFile('photo')) {

          $filenameWithExt = $request->file('photo')->getClientOriginalName();
          $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          $extension       = $request->file('photo')->getClientOriginalExtension();
          $fileNameToStore = $filename.'-'.time().'.'.$extension;

           $request->file('photo')->move('assets/user/images/', $fileNameToStore);

           $fileNameToStore = '/assets/user/images/'.$filename.'-'.time().'.'.$extension;



          }

              $full_name = $contact_id->fname ?? $firstname;
              $full_name .= ' ';
              $full_name .= $contact_id->lname ?? $lastname;

          $contact->fill([
                                        'firstname'        => $contact_id->fname ?? $firstname,
                                        'lastname'         => $contact_id->lname ?? $lastname,
                                        'additional'       => $additional ?? '',
                                        'prefix'           => $prefix ?? '',
                                        'suffix'           => $suffix ?? '',
                                        'mobilephone'      => $contact_id->phone ?? $mobilephone ?? '',
                                        'workphone'        => $workphone ?? '',
                                        'jobtitle'         => $jobtitle ?? '',
                                        'city'             => $city ?? '',
                                        'country_id'       => $country_id ?? '',
                                        'zip_code'         => $zip_code ?? '',
                                        'role'             => $role ?? '',
                                        'email'            => $email ?? $contact_id->email ?? '',
                                        'address'          => $contact_id->address ?? $address ?? '',
                                        'label'            => $label ?? '',
                                        'url'              => $url ?? '',
                                        'user_id'          => $contact_id->id ?? $user_id,
                                        'photo'            => $fileNameToStore ?? $contact_id->photo ?? $contact->photo,
                                        'about'            => $about ?? '',
                                        'slug'             => unique_slug($full_name,'contact'),
                                        'contact_id'       => $contact_id->id ?? Null,


                                        ]);

          $contact->save();




       if(isset($contact_id->id)){

             if(!UserEntry::where([['user_id',$contact_id->id],['entry_id',$contact->id],['entry','contact'],['owner',isset($contact_id->id)?0:1]])->exists()){

               $entry = UserEntry::create([
                                   'user_id'=>$contact_id->id,
                                   'entry_id'=>$contact->id,
                                   'entry'=>'contact',
                                   'owner'=>1,
                                   'created_at'=>date('Y-m-d h:i:s')

                                   ]);

             $entry = UserEntry::create([
                                    'user_id'=>$user_id,
                                    'entry_id'=>$contact->id,
                                    'entry'=>'contact',
                                    'owner'=>0,
                                    'created_at'=>date('Y-m-d h:i:s')

                                    ]);

             }

          }

        else{

          if(!UserEntry::where([['user_id',$user_id],['entry_id',$contact->id],['entry','contact']])->exists()){
              $entry = UserEntry::create([
                                     'user_id'=>$user_id,
                                     'entry_id'=>$contact->id,
                                     'entry'=>'contact',
                                     'owner'=>1,
                                     'created_at'=>date('Y-m-d h:i:s')

                                     ]);
                                   }

        }
          add_notification($request->user()->id, $this->icons, 'You have successfully updated a contact! : @'.date('Y-m-d h:i:s'), route('contacts.index'), 0);
          return redirect()->route('contacts.index')->with('success','You have successfully updated a contact!');
        }

      return back()->withInput();



    }



    public function destroy($contact)
    {

      $contact = Contact::where('id',intval($contact))->first();
      if(Auth::check() && isset($contact->id)){

          if(Contact::where([['id',$contact->id],['user_id',Auth::user()->id]])->exists()){

              Contact::where('id',$contact->id)->delete();
              UserEntry::where([['entry_id',$contact->id],['entry','contact']])->delete();

          }
          UserEntry::where([['user_id',Auth::user()->id],['entry_id',$contact->id],['entry','contact']])->delete();
          add_notification(Auth::user()->id, $this->icons, 'You have successfuly deleted a Contact! : @'.date('Y-m-d h:i:s'), route('contacts.index'), 0);
          return redirect()->route('contacts.index')->with('success','You have successfuly deleted a Contact1');
        }
        add_notification(Auth::user()->id, $this->icons, 'Contact could not be deleted! : @'.date('Y-m-d h:i:s'), route('contacts.index'), 0);
        return redirect()->back()->with('error' , 'Contact could not be deleted!');


    }

    public function destroyAll(Request $request){

      $user = $request->user();
      $id   = $user->id;
      Contact::where('user_id',$id)->delete();
      UserEntry::where([['user_id',$id],['entry','contact']])->delete();
      add_notification(Auth::user()->id, $this->icons, 'You have successfuly deleted all Contacts! : @'.date('Y-m-d h:i:s'), route('contacts.index'), 0);
      return redirect()->route('contacts.index')->with('success','You have successfuly deleted all Contacts!');

    }
}
