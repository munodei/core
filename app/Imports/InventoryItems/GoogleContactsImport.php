<?php
namespace App\Imports\Contacts;

use Mail;
use Excel;
use App\contact;
use App\User;
use App\UserEntry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class GoogleContactsImport implements ToModel, WithHeadingRow
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {

      if(!contact::where([
              ['firstname',$row['name'] ?? ''],
              ['lastname',$row['family_name'] ?? ''],
              ['additional',$row['additional_name'] ?? ''],
              ['suffix',$row['name_suffix'] ?? ''],
              ['email',$row['email'] ?? ''],
              ['mobilephone',$row['phone_1_value'] ?? ''],
              ['address',$row['location'] ?? ''],
              ['user_id',Auth::user()->id]
            ])->exists()){
      // Validator::make($row, [
      //        'name' => 'required',
      //    ])->validate();
      $contact = contact::create([

            'firstname'   => $row['name'] ?? '',
            'lastname'    => $row['family_name'] ?? '',
            'additional'  => $row['additional_name'] ?? '',
            'prefix'      => $row['name_prefix'] ?? '',
            'suffix'      => $row['name_suffix'] ?? '',
            'email'       => $row['email'] ?? '',
            'mobilephone' => trim($row['phone_1_value']) ?? '',
            'address'     => $row['location'] ?? '',
            'user_id'     =>Auth::user()->id,
        ]);

      UserEntry::create([
      					'user_id'    =>Auth::user()->id,
      					'contact_id' =>$contact->id,
      					'owner'      =>User::where('email',$contact->email)->exists()?0:1,
      					'created_at' =>date('Y-m-d h:i:s'),
      					'updated_at' =>date('Y-m-d h:i:s'),

      				]);

      if(isset($row['email'])){

      if(User::where('email',$contact->email)->exists()){

        $user = User::where('email',$contact->email)->first();

              UserEntry::create([
                'user_id'    =>$user->id,
                'contact_id' =>$contact->id,
                'owner'      =>1,
                'created_at' =>date('Y-m-d h:i:s'),
                'updated_at' =>date('Y-m-d h:i:s'),

              ]);

        $contact->update(['user_id'=>$user->id]);


      }

      if(!User::where('email',$contact->email)->exists()){

              $request = app(\Illuminate\Http\Request::class);
              $user    = $request->user();
              $email   = $contact->email;

              // Mail::send('emails.default.share.email-invite', ['user' => $user ,'email'=>$email], function ($m) use ($email) {

              //     $m->from('info@mypdz.com', 'Mypdz');
              //     $m->to($email, 'Mypdz Client' )->subject('Mypdz Client Has Added you to their Contact List!');

              // });

      }}

       return $contact;
     }
    
    }

}