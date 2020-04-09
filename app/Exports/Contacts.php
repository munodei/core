<?php

namespace App\Exports;

use App\User;
use App\UserEntry;
use App\Contact;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class Contacts implements FromArray
{
     use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function array() : array
    {

        $contacts  = UserEntry::leftjoin('contacts','contacts.id','=','user_entry.entry_id')
                                                                                           ->leftjoin('users','users.id','=','contacts.user_id')
                                                                                          ->where([
                                                                                                  ['user_entry.user_id',$this->id],
                                                                                                  ['user_entry.entry','contact']
                                                                                                  ])
                                                                                            ->select(
                                                                                              'contacts.firstname',
                                                                                              'contacts.lastname',
                                                                                              'contacts.additional',
                                                                                              'contacts.prefix',
                                                                                              'contacts.suffix',
                                                                                              'contacts.email',
                                                                                              'contacts.mobilephone',
                                                                                              'contacts.workphone',
                                                                                              )
                                                                                              ->orderby('contacts.created_at','DESC')
                                                                                              ->get()
                                                                                              ->toArray();

	return $contacts;

    }

}
