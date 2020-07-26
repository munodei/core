<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCCompanyDetailsController  extends Controller
{

    public function __construct()
       {
           $this->middleware('auth');

       }


    public function index(Request $request)
    {
          $page_title   = 'NHBRC Application Registration | Company Details';
          $id           = $request->user()->id;
          $company     = NHBRCCompanyDetail::where('user_id',$id)->first();
          return view('custom.nhbrc.index', ['company'=> $company,'page_title'=>$page_title]);

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
       $rules = [
                    'user_id'=>'required',
                    'company_name'=>'required',
                    'trading_name'=>'required',
                    'postal_address'=>'required',
                    'physical_address'=>'required',
                    'postal_code'=>'required',
                    'town'=>'required',
                    'region'=>'required',
                    'telephone'=>'required',
                    'fax_number'=>'required',
                    'cell_number'=>'required',
                    'email_address'=>'required',
                    'year_started_trading'=>'required',
                    'number_of_employees'=>'required',
                    'year1'=>'required',
                    'number1'=>'required',
                    'year2'=>'required',
                    'number2'=>'required',
                    'year3'=>'required',
                    'number3'=>'required', 
                    'company_reg_number',
                    'vat_reg_number'=>'required',
                    'bargain_council_registration_number'=>'required',
                    'type_of_Legal_Institution'=>'required',
                    'main_business_area'=>'required',
                    'units_intended_this_year'=>'required',
                    'type_of_building_to_be_erected'=>'required',
                    'HDI_status'=>'required'
                ];

                    $request->validate($rules);
                    $in = Input::except('_token');
                    
                    if(!NHBRCCompanyDetail::where('user_id',$request->user()->id)->exists())
                    {   
                        $res = NHBRCCompanyDetail::create($in);
                    }
                     else
                    {
                        $res = NHBRCCompanyDetail::where('user_id',$request->user()->id)->first();
                        $res->update($in);
                    }

                    if ($res) {
                        return redirect()->route('nhbrc-company-details.index')->with('success', 'Your Comapny Details has been successfully Saved!');
                    } else {
                        return redirect()->route('nhbrc-company-details.index')->with('error', 'Problem Experienced with Saving Information!');
                    }

    }


    public function show(NHBRCCompanyDetail $nHBRCCompanyDetail)
    {
        //
    }


    public function edit(NHBRCCompanyDetail $nHBRCCompanyDetail)
    {
        //
    }

    public function update(Request $request, NHBRCCompanyDetail $nHBRCCompanyDetail)
    {
        //
    }

    public function destroy(NHBRCCompanyDetail $nHBRCCompanyDetail)
    {
        //
    }

}
