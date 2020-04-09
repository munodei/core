<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Imports\ShoppingItems\ShoppingItems;
use App\Imports\Contacts\GoogleContactsImport;
use App\Imports\Contacts\OrdinaryContactsImport;
use App\Imports\Contacts\OutlookContactsImport;


class ImportsController extends Controller
{
      public function importGoogleCSVContacts(Request $request)
    {

        if($request->hasFile('google_contacts')){

        $headings        = (new HeadingRowImport)->toArray($request->file('google_contacts'));
        $requiredHeaders = array('name', 'given_name','family_name','additional_name', 'name_prefix', 'email', 'phone_1_value','location');
        $x = 0;

        foreach ($headings[0][0] as $heading) {

            foreach ($requiredHeaders as $requiredHeader) {

                    if($heading == $requiredHeader){
                        $x++;
                    }

                }
            }



        if($x < 5 ){

            return redirect()->back()->with('error','Unfortunately all the headers are not present, please use a file with all the headers namely \'Name\', \'Family Name\',\'Additional Name\', \'Name Prefix\', \'Email\', \'Phone\',\'Location\'');

        }

        Excel::import(new GoogleContactsImport, $request->file('google_contacts'));





        }
        elseif ($request->hasFile('outlook_contacts'))
        {

        $headings        = (new HeadingRowImport)->toArray($request->file('outlook_contacts'));
        $requiredHeaders = array('first_name', 'last_name','middle_name', 'suffix', 'e_mail_address', 'mobile_phone','home_phone','home_address','home_city','company','job_title');
        $x = 0;

        foreach ($headings[0][0] as $heading) {

            foreach ($requiredHeaders as $requiredHeader) {

                    if($heading == $requiredHeader){
                        $x++;
                    }

                }
            }


        if($x < 4 ){

            return redirect()->back()->with('error','Unfortunately all the headers are not present in your OutLook Contacts CSV, please use a file with all the headers namely \'First Name\', \'Last Name\',\'Middle Name\', \'Suffix\', \'E-mail Address\',\'Mobile Phone\'');

        }

        Excel::import(new OutlookContactsImport, $request->file('outlook_contacts'));

        }
        elseif ($request->hasFile('ordinary_contacts'))
        {

        $headings        = (new HeadingRowImport)->toArray($request->file('ordinary_contacts'));
        $requiredHeaders = array('first_name', 'last_name','middle_name', 'suffix', 'email', 'mobile');
        $x = 0;

        foreach ($headings[0][0] as $heading) {

            foreach ($requiredHeaders as $requiredHeader) {

                    if($heading == $requiredHeader){
                        $x++;
                    }

                }
            }

        if($x < 4 ){

            return redirect()->back()->with('error','Unfortunately all the headers are not present in your Ordinary Contacts CSV, please use a file with all the headers namely \'First Name\', \'Last Name\',\'Middle Name\', \'Suffix\', \'Email\', \'Mobile\'');

        }

        Excel::import(new OrdinaryContactsImport, $request->file('ordinary_contacts'));


        }
        else
        {

            return redirect()->back()->with('error','Attach the File to use this feature!');
        }


        return redirect()->back()->with('success', 'Contacts Uploaded!');

    }

          public function importShoppingItemsCSV(Request $request)
    {

        if($request->hasFile('shopping_items')){

        $headings        = (new HeadingRowImport)->toArray($request->file('shopping_items'));
        $requiredHeaders = array('shopping_item_name', 'shopping_item_description','shopping_item_outlets','shopping_item_quantity', 'shopping_item_price', 'shopping_item_brand');
        $x = 0;

        foreach ($headings[0][0] as $heading) {

            foreach ($requiredHeaders as $requiredHeader) {

                    if($heading == $requiredHeader){
                        $x++;
                    }

                }
            }



        if($x < 5 ){

            return redirect()->back()->with('error','Unfortunately all the headers are not present, please use a file with all the headers namely \'Shopping Item Name\', \'Shopping Item Description\',\'Shopping Item Outlets\', \'Shopping Item Quantity\', \'Shopping Item Price\', \'Shopping item Brand\',\' Photo Link \'');

        }

                Excel::import(new ShoppingItems, $request->file('shopping_items'));

        }

        else
        {

            return redirect()->back()->with('error','Attach the File to use this feature!');
        }


        return redirect()->back()->with('success', 'Shopping Items Imported!');

    }



}
