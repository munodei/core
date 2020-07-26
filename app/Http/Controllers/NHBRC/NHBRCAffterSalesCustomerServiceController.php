<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\HighestEducationQualification;
use App\NHBRCAfterSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCAffterSalesCustomerServiceController extends Controller
{
    public function __construct()
       {
           $this->middleware('auth');

       }

    public function index(Request $request)
    {
         
          $page_title    = 'NHBRC Application Registration | After Sales Customer Service';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $sales         = NHBRCAfterSales::where('company_id',$company->id ?? 0)->paginate(15);

          return view('custom.nhbrc.after-sales', ['company'=> $company,'sales'=>$sales,'page_title'=>$page_title]);

    }

   public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add After Sales Customer Service';
          $id            = $request->user()->id;
          $highest_education_qualifications = HighestEducationQualification::all();
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          return view('custom.nhbrc.after-sales-create', ['company'=> $company,'page_title'=>$page_title ,'highest_education_qualifications'=>$highest_education_qualifications]);
    }

    public function store(Request $request)
    {
        $rules = [
                    'company_id' =>'required',
                    'title' =>'required',
                    'initials' =>'required',
                    'surname' =>'required',
                    'mobile_number' =>'required',
                    'physical_address' =>'required',
                    'physical_town' =>'required',
                    'highest_education_qualification'=>'required',
                    'qualification'=>'required',
                    'experience'=>'required',
                    'email' =>'required',
                ];

                    $request->validate($rules);
                    $in = Input::except('_token');

                    $array_files =  array(0=>'contract',1=>'client_picture',2=>'client_id');
                    $in['user_id'] = $request->user()->id;
                   
                    $res = NHBRCAfterSales::create($in);

                    if ($res) {
                        return redirect()->route('nhbrc-after-sales.index')->with('success', 'After Sales Customer Service Information has successfully been added!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Action!');
                    }

    }


    public function edit(Request $request,$id)
    {
          $page_title    = 'NHBRC Application Registration | Edit Client Reference';
          $user_id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $highest_education_qualifications = HighestEducationQualification::all();
          $sale     = NHBRCAfterSales::where([['company_id',$company->id],['id',$id]])->first();

          return view('custom.nhbrc.after-sales-edit', ['company'=> $company,'sale'=>$sale,'page_title'=>$page_title ,'highest_education_qualifications'=>$highest_education_qualifications]);

    }

    public function update(Request $request, $id)
    {
        $rules = [
                    'company_id' =>'required',
                    'title' =>'required',
                    'initials' =>'required',
                    'surname' =>'required',
                    'mobile_number' =>'required',
                    'physical_address' =>'required',
                    'physical_town' =>'required',
                    'highest_education_qualification'=>'required',
                    'qualification'=>'required',
                    'experience'=>'required',
                    'email' =>'required',
                        ];

            $request->validate($rules);
            $in = Input::except('_token');
            $res = NHBRCAfterSales::find($id);
            $in['user_id'] = $request->user()->id;
       
            $res->update($in);

            if ($res) {
                return redirect()->route('nhbrc-after-sales.index')->with('success', 'After Sales Customer Service Information has successfully been updated!');
            } else {
                return back()->with('error', 'Problem Experienced with Action!');
            }
    }
    public function destroy($id)
    {
        //
    }
}
