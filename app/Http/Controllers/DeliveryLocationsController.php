<?php

namespace App\Http\Controllers;

use App\DeliveryLocation;
use App\User;
use App\UserEntry;
use Illuminate\Http\Request;

class DeliveryLocationsController extends Controller
{
    public function __construct(){

      $this->middleware('auth');
      $this->icons = '<i class="material-icons">location_on</i>';
    }

    public function index(Request $request)
    {
      $user = $request->user();
      $page_title = 'Delivery Locations';
      $delivery_locations = DeliveryLocation::where('user_id',$user->id)->get();
      $contacts = UserEntry::leftjoin('contacts','contacts.id','=','user_entry.entry_id')
                                                                                           ->leftjoin('users','users.id','=','contacts.user_id')
                                                                                            ->where([
                                                                                                              ['user_entry.user_id',$user->id],
                                                                                                              ['user_entry.entry','contact']
                                                                                                              ])
                                                                                            ->select('contacts.id as contactID','contacts.email as emailContactID','user_entry.id as userFileEntryID','users.id as userID','users.email as emailUserlD','contacts.*','user_entry.*')
                                                                                              ->orderby('contacts.created_at','DESC')->get();

      return view('custom.shopping-items.delivery-locations',compact('user','page_title','delivery_locations','contacts'));

    }

    public function getDeliveryOption(Request $request,$id){

      $user_id         = $request->user()->id;
      $delivery_option = DeliveryLocation::where([['id',$id],['user_id',$user_id]])->first();

      return $delivery_option;


    }

    public function shareDeliveryOption(Request $request){

      $user_id = $request->user()->id;
      $rules = [
                'id'=>'required',
                'email'=>'required',
      ];
      $msgs = [
                'id.required'=>'The Delivery Location is required!',
                'email.required'=>'Recipient of the Delivery Location is required!'
      ];

      $request->validate($rules,$msgs);

      extract($_POST);

      if(DeliveryLocation::where([['user_id',$user_id],['id',$id]])->exists())
      {
          if(User::where('email','=',trim($email))->exists()){

            $user = User::where('email','=',trim($email))->first();
            $delivery = DeliveryLocation::find($id);

            $delivery_option = DeliveryLocation::create([
                                                          'user_id'=>$user->id,
                                                          'name'=>$delivery->name,
                                                          'slug'=>unique_slug($delivery->name,'DeliveryLocation'),
                                                          'address'=>$delivery->address,
                                                          'suburb'=>$delivery->suburb,
                                                          'neighbourhood'=>$delivery->neighbourhood,
                                                          'city'=>$delivery->city,
                                                          'state'=>$delivery->state,
                                                          'country'=>$delivery->country,
                                                          'zip_code'=>$delivery->zip_code,
                                                          'instruction'=>$delivery->instruction ?? '',
                                                          'created_at'=>date('Y-m-d h:i:s'),
                                                          'updated_at'=>date('Y-m-d h:i:s')
                                                        ]);


                add_notification($user_id, $this->icons, 'Delivery Location Sharing Successful! : @'.date('Y-m-d h:i:s'), route('delivery-locations.index'), 0);
                return redirect()->back()->with('success','You successfully shared your Delivery Location!');
          }

        add_notification($user_id, $this->icons, 'Delivery Location Sharing Failed, User does not exist! : @'.date('Y-m-d h:i:s'), route('delivery-locations.index'), 0);
        return redirect()->back()->with('error','The user you are trying to share a Delivery Location with isn\'t a registered user!');

    }
    add_notification($user_id, $this->icons, 'Error Occured on attempt to Share Delivery Location! : @'.date('Y-m-d h:i:s'), route('delivery-locations.index'), 0);
    return redirect()->back()->with('error','Error Occured on attempt to Share Delivery Locatio!');


    }

    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        $rules = [
                  'name'=>'required',
                  'address'=>'required',
                  'suburb'=>'required',
                  'neighbourhood'=>'required',
                  'city'=>'required',
                  'state'=>'required',
                  'country'=>'required',
                  'zip_code'=>'required',
        ];

        $msgs = [

            'name.required'=>'The name of the Delivery Point is Required!',

        ];

        $request->validate($rules,$msgs);
        extract($_POST);



        $delivery_option = DeliveryLocation::create([
                                                      'user_id'=>$user_id,
                                                      'name'=>$name,
                                                      'slug'=>unique_slug($name,'DeliveryLocation'),
                                                      'address'=>$address,
                                                      'suburb'=>$suburb,
                                                      'neighbourhood'=>$neighbourhood,
                                                      'city'=>$city,
                                                      'state'=>$state,
                                                      'country'=>$country,
                                                      'zip_code'=>$zip_code,
                                                      'instruction'=>$message ?? '',
                                                      'created_at'=>date('Y-m-d h:i:s'),
                                                      'updated_at'=>date('Y-m-d h:i:s')
                                                    ]);
        add_notification($user_id, $this->icons, 'You have successfully added a new Delivery Location! : @'.date('Y-m-d h:i:s'), route('delivery-locations.index'), 0);

        return redirect()->back()->with('success','You have successfully added a new Delivery Location!');


    }



    public function update(Request $request)
    {
      $user_id = $request->user()->id;
      $rules = [
                'name'=>'required',
                'address'=>'required',
                'suburb'=>'required',
                'neighbourhood'=>'required',
                'city'=>'required',
                'state'=>'required',
                'country'=>'required',
                'zip_code'=>'required',
      ];

      $msgs = [

          'name.required'=>'The name of the Delivery Point is Required!',

      ];

      $request->validate($rules,$msgs);
      extract($_POST);


      $delivery_option = DeliveryLocation::find($id);

      if(DeliveryLocation::where([['user_id',$user_id],['id',$id]])->exists()){

      $delivery_option->update([
                                'user_id'=>$user_id,
                                'name'=>$name,
                                'slug'=>unique_slug($name,'DeliveryLocation'),
                                'address'=>$address,
                                'suburb'=>$suburb,
                                'neighbourhood'=>$neighbourhood,
                                'city'=>$city,
                                'state'=>$state,
                                'country'=>$country,
                                'zip_code'=>$zip_code,
                                'instruction'=>$message ?? '',
                                'created_at'=>date('Y-m-d h:i:s'),
                                'updated_at'=>date('Y-m-d h:i:s')
                                ]);
      add_notification($user_id, $this->icons, 'You have successfully updated Delivery Location! : @'.date('Y-m-d h:i:s'), route('delivery-locations.index'), 0);

      return redirect()->back()->with('success','You have successfully updated Delivery Location!');

      }

      add_notification($user_id, $this->icons, 'Error occurred on Attempt to update a Delivery Location! : @'.date('Y-m-d h:i:s'), route('delivery-locations.index'), 0);

      return redirect()->back()->with('error','Error occurred on Attempt to update a Delivery Location!');

    }


    public function destroy(Request $request)
    {
        $user_id = $request->user()->id;
        $rules = [
                  'id'=>'required',
        ];
        $msgs = [
                  'id.required'=>'The Delivery Location is required!'
        ];

        $request->validate($rules,$msgs);
        extract($_POST);

        if(DeliveryLocation::where([['user_id',$user_id],['id',$id]])->exists()){

          DeliveryLocation::where([['user_id',$user_id],['id',$id]])->delete();
          add_notification($user_id, $this->icons, 'You have successfully deleted Delivery Location! : @'.date('Y-m-d h:i:s'), route('delivery-locations.index'), 0);

          return redirect()->back()->with('success','You have successfully deleted Delivery Location!');

        }
        add_notification($user_id, $this->icons, 'Error occurred on Attempt to delete a Delivery Location! : @'.date('Y-m-d h:i:s'), route('delivery-locations.index'), 0);

        return redirect()->back()->with('error','Error occurred on Attempt to delete a Delivery Location!');
    }
}
