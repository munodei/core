<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\NHBRCProfessionalReference;
use App\HighestEducationQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCProfessionalReferencesController extends Controller
{
     public function __construct()
       {
           $this->middleware('auth');

       }

    public function index(Request $request)
    {
         
          $page_title    = 'NHBRC Application Registration | Professional References';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $professionals     = NHBRCProfessionalReference::where('company_id',$company->id ?? 0)->paginate(15);

          return view('custom.nhbrc.professional-references', ['company'=> $company,'professionals'=>$professionals,'page_title'=>$page_title]);

    }

   public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Professional Reference';
          $id            = $request->user()->id;
          $highest_education_qualifications = HighestEducationQualification::all();
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          return view('custom.nhbrc.professional-reference-create', ['company'=> $company,'page_title'=>$page_title,'highest_education_qualifications'=>$highest_education_qualifications]);
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
                    'highest_education_qualification'=>'required',
                    'physical_town' =>'required',
                    'qualification'=>'required',
                    'email' =>'required',
                ];

                    $request->validate($rules);
                    $in = Input::except('_token');

                    $in['user_id'] = $request->user()->id;
                 
                    $res = NHBRCProfessionalReference::create($in);

                    if ($res) {
                        return redirect()->route('nhbrc-professional-references.index')->with('success', 'Professional Reference Information has successfully been added!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Action!');
                    }

    }


    public function edit(Request $request,$id)
    {
          $page_title    = 'NHBRC Application Registration | Edit Professional Reference';
          $user_id       = $request->user()->id;
          $highest_education_qualifications = HighestEducationQualification::all();
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $professional      = NHBRCProfessionalReference::where([['company_id',$company->id],['id',$id]])->first();
          
          return view('custom.nhbrc.professional-reference-edit', ['company'=> $company,'professional'=>$professional,'page_title'=>$page_title,'highest_education_qualifications'=>$highest_education_qualifications]);
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
                    'highest_education_qualification'=>'required',
                    'physical_town' =>'required',
                    'qualification'=>'required',
                    'email' =>'required',
                        ];

            $request->validate($rules);
            $in = Input::except('_token');
            $res = NHBRCProfessionalReference::find($id);

            $in['user_id'] = $request->user()->id;           
            $res->update($in);

            if ($res) {
                return redirect()->route('nhbrc-professional-references.index')->with('success', 'Professional Reference Information has successfully been updated!');
            } else {
                return back()->with('error', 'Problem Experienced with Action!');
            }
    }

    public function destroy($id)
    {
        //
    }
}
