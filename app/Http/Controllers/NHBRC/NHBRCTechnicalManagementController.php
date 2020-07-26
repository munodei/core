<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\HighestEducationQualification;
use App\NHBRCTechnicalManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCTechnicalManagementController extends Controller
{
     public function __construct()
       {
           $this->middleware('auth');

       }

    public function index(Request $request)
    {
         
          $page_title    = 'NHBRC Application Registration | Technical Management';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $highest_education_qualifications = HighestEducationQualification::all();
          $technicals       = NHBRCTechnicalManagement::where('company_id',$company->id ?? 0)->paginate(15);

          return view('custom.nhbrc.technical-management', ['company'=> $company,'technicals'=>$technicals,'page_title'=>$page_title]);

    }

   public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Technical Management';
          $id            = $request->user()->id;
          $highest_education_qualifications = HighestEducationQualification::all();
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          return view('custom.nhbrc.technical-management-create', ['company'=> $company,'page_title'=>$page_title ,'highest_education_qualifications'=>$highest_education_qualifications]);
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
                    $in['user_id'] = $request->user()->id;
                   
                    $res = NHBRCTechnicalManagement::create($in);

                    if ($res) {
                        return redirect()->route('nhbrc-technical-management.index')->with('success', 'Technical Management Information has successfully been added!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Action!');
                    }

    }


    public function edit(Request $request,$id)
    {
          $page_title    = 'NHBRC Application Registration | Edit Technical Management';
          $user_id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $highest_education_qualifications = HighestEducationQualification::all();
          $tech_man     = NHBRCTechnicalManagement::where([['company_id',$company->id],['id',$id]])->first();
          return view('custom.nhbrc.technical-management-edit', ['company'=> $company,'tech_man'=>$tech_man,'page_title'=>$page_title ,'highest_education_qualifications'=>$highest_education_qualifications]);
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
            $res = NHBRCTechnicalManagement::find($id);
            $in['user_id'] = $request->user()->id;
            
            $res->update($in);

            if ($res) {
                return redirect()->route('nhbrc-technical-management.index')->with('success', 'Technical Management Information has successfully been updated!');
            } else {
                return back()->with('error', 'Problem Experienced with Action!');
            }
    }

    public function destroy($id)
    {
        //
    }

}
