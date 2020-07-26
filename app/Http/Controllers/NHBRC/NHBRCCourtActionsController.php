<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\NHBRCCompanyDirector;
use App\NHBRCCourtAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCCourtActionsController extends Controller
{
    public function __construct()
   {

       $this->middleware('auth');

   }

    public function index(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Court Actions';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $directors     = NHBRCCourtAction::leftjoin('nhbrc_company_directors','nhbrc_court_actions.director_id','=','nhbrc_company_directors.id')
                                                                                                                                                    ->where('nhbrc_company_directors.company_id',$company->id ?? 0)
                                                                                                                                                    ->paginate(15);
          return view('custom.nhbrc.court-actions', ['company'=> $company,'directors'=>$directors,'page_title'=>$page_title]);
    }

    public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Court Action';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $companies      = NHBRCCompanyDetail::all();
          $directors     = NHBRCCompanyDirector::where('company_id',$company->id ?? 0)->get();
          return view('custom.nhbrc.court-action-create', ['company'=> $company,'companies'=> $companies,'directors'=>$directors,'page_title'=>$page_title]);
    }

    public function store(Request $request)
    {
               $rules = [
                    'director_id' =>'required',
                     ];

               $msg =['director_id.required'=>'The Director is Required!'];

               $request->validate($rules,$msg);
               $in = Input::except('_token');
               if($request->company_id !='')
               {    
                    $company = NHBRCCompanyDetail::find($request->company_id);
                    $in['company'] = $company->company_name;
                    $in['trading_name'] = $company->trading_name;
                    $in['company_reg_number'] = $company->company_reg_number;
                    $in['vat_reg_number'] = $request->status =$company->vat_reg_number;
                    $in['bargain_council_registration_number'] = $company->bargain_council_registration_number;
                    $in['email'] = $company->email_address;
                    $in['contact_number'] = $company->cell_number;

                }

                $res = NHBRCCourtAction::create($in);


                if ($res) {
                    return redirect()->route('nhbrc-court-actions.index')->with('success', 'A Director has successfully been added!');
                } else {
                    return back()->with('error', 'Problem Experienced with Action!');
                }
    }

     public function update(Request $request, $id)
    {
            $rules = [
            'director_id' =>'required',
             ];

            $msg =['director_id.required'=>'The Director is Required!'];

            $request->validate($rules,$msg);
            $in = Input::except('_token');
             $in['company_id'] = intval($request->company_id);
            if(NHBRCCompanyDetail::where('id',intval($request->company_id))->exists())
            {    
            $company = NHBRCCompanyDetail::find($request->company_id);
            $in['company'] = $company->company_name;
            $in['trading_name'] = $company->trading_name;
            $in['company_reg_number'] = $company->company_reg_number;
            $in['vat_reg_number'] = $request->status =$company->vat_reg_number;
            $in['bargain_council_registration_number'] = $company->bargain_council_registration_number;
            $in['email'] = $company->email_address;
            $in['contact_number'] = $company->cell_number;

            }


            $res = NHBRCCourtAction::find($id);
            $res->update($in);


            if ($res) {
            return redirect()->route('nhbrc-court-actions.index')->with('success', 'A Director has successfully been added!');
            } else {
            return back()->with('error', 'Problem Experienced with Action!');
            }
    }

    public function edit(Request $request,$id)
    {

          $page_title   = 'NHBRC Application Registration | Edit Court Action';
          $user_id      = $request->user()->id;
          $company      = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $companies    = NHBRCCompanyDetail::all();
          $directors    = NHBRCCompanyDirector::where('company_id',$company->id ?? 0)->get();
          $director     = NHBRCCourtAction::leftjoin('nhbrc_company_directors','nhbrc_court_actions.director_id','=','nhbrc_company_directors.id')->where([['nhbrc_company_directors.company_id',$company->id],['nhbrc_court_actions.id',$id]])->select()->first('nhbrc_court_actions.*');

          return view('custom.nhbrc.court-action-edit', ['company'=> $company,'companies'=> $companies,'director'=>$director,'directors'=>$directors,'page_title'=>$page_title]);

    }

    public function destroy($id)
    {
        //
    }
}
