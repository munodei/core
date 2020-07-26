<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\NHBRCCompanyDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCDirectorDetailsController extends Controller
{


    public function __construct()
   {

       $this->middleware('auth');


   }

    public function index(Request $request)
    {

          $page_title    = 'NHBRC Application Registration | Company Directors';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $directors     = NHBRCCompanyDirector::where('company_id',$company->id ?? 0)->paginate(15);
          return view('custom.nhbrc.company-directors', ['company'=> $company,'directors'=>$directors,'page_title'=>$page_title]);
    }

    public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Company Director';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $directors     = NHBRCCompanyDirector::where('company_id',$company->id ?? 0)->paginate(15);
          return view('custom.nhbrc.comapny-directors-create', ['company'=> $company,'directors'=>$directors,'page_title'=>$page_title]);
    }

    public function store(Request $request)
    {
        $rules = [
                    'status' =>'required',
                    'company_id' =>'required',
                    'intials' =>'required',
                    'surname' =>'required',
                    'shareholding' =>'required',
                    'id_number' =>'required',
                    'qualifications' =>'required',
                    'experience' =>'required',
                    'email' =>'required',
                    'contact_number' =>'required',
                    'address' =>'required'
                ];

                    $request->validate($rules);
                    $in = Input::except('_token');
                    
                    $res = NHBRCCompanyDirector::create($in);

                    if ($res) {
                        return redirect()->route('nhbrc-director-details.index')->with('success', 'A Director has successfully been added!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Action!');
                    }

    }




    public function edit(Request $request,$id)
    {
          $page_title    = 'NHBRC Application Registration | Edit Company Director';
          $user_id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $directors     = NHBRCCompanyDirector::where([['company_id',$company->id],['id',$id]])->first();
          return view('custom.nhbrc.company-directors-edit', ['company'=> $company,'directors'=>$directors,'page_title'=>$page_title]);
    }

    public function update(Request $request, $id)
    {
              $rules = [
                    'status' =>'required',
                    'company_id' =>'required',
                    'intials' =>'required',
                    'surname' =>'required',
                    'shareholding' =>'required',
                    'id_number' =>'required',
                    'qualifications' =>'required',
                    'experience' =>'required',
                    'email' =>'required',
                    'contact_number' =>'required',
                    'address' =>'required'
                ];

                    $request->validate($rules);
                    $in = Input::except('_token');

                    $res = NHBRCCompanyDirector::find($id);
                    
                    $res->update($in);

                    if ($res) {
                        return redirect()->route('nhbrc-director-details.index')->with('success', 'Director Information has successfully been updated!');
                    } else {
                        return back()->with('error', 'Error Occured!');
                    }
    }

    public function destroy($id)
    {
        //
    }
}
