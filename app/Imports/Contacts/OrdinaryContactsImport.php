<?php
namespace App\Imports\Contacts;

use Mail;
use Excel;
use App\contact;
use App\User;
use App\UserEntry;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class OrdinaryContactsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

          use Importable, SkipsFailures;

          if(!contact::where([
              ['firstname',$row['first_name'] ?? ''],
              ['lastname',$row['last_name'] ?? ''],
              ['additional',$row['middle_name'] ?? ''],
              ['suffix',$row['suffix'] ?? ''],
              ['email',$row['email'] ?? ''],
              ['mobilephone',$row['mobile'] ?? ''],
              ['workphone',$row['work'] ?? ''],
              ['user_id',Auth::user()->id]
            ])->exists()){



                $contact = contact::create([
                                            'firstname'   => $row['first_name'],
                                            'lastname'    => $row['last_name'],
                                            'additional'  => $row['middle_name'],
                                            'suffix'      => $row['suffix'],
                                            'email'       => $row['email'],
                                            'mobilephone' => $row['mobile'],
                                            'workphone'   => $row['work'],
                                            'user_id'     => Auth::user()->id,
                                        ]);
                UserEntry::create([
                					'user_id'    =>Auth::user()->id,
                          'entry_id' =>$contact->id,
                					'entry'=>'contact',
                					'owner'      =>User::where('email',$contact->email)->exists()?0:1,
                					'created_at' =>date('Y-m-d h:i:s'),
                					'updated_at' =>date('Y-m-d h:i:s'),

                				]);

          if(isset($row['e_mail_address'])){
          if(User::where('email',$contact->email)->exists()){

            $user = User::where('email',$contact->email)->first();

            UserEntry::create([
              'user_id'    =>$user->id,
              'entry'=>'contact',
              'entry_id' =>$contact->id,
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

          }

            return $contact;
          }


    }
    }
}
