<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\NHBRCCompanyDirector;
use App\OwnershipLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCOwnershipLinks extends Controller
{
    public function __construct()
   {

       $this->middleware('auth');

   }

    public function index(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Ownership Links';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $directors     = OwnershipLink::leftjoin('nhbrc_company_directors','ownership_links.director_id','=','nhbrc_company_directors.id')->where('nhbrc_company_directors.company_id',$company->id ?? 0)->paginate(15);
          return view('custom.nhbrc.ownership-links', ['company'=> $company,'directors'=>$directors,'page_title'=>$page_title]);
    }


    public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Ownership Link';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $companies      = NHBRCCompanyDetail::all();
          $directors     = NHBRCCompanyDirector::where('company_id',$company->id ?? 0)->get();
          return view('custom.nhbrc.ownership-link-create', ['company'=> $company,'companies'=> $companies,'directors'=>$directors,'page_title'=>$page_title]);
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

                $res = OwnershipLink::create($in);


                if ($res) {
                    return redirect()->route('nhbrc-ownership-links.index')->with('success', 'A Director has successfully been added!');
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


            $res = OwnershipLink::find($id);
            $res->update($in);


            if ($res) {
            return redirect()->route('nhbrc-ownership-links.index')->with('success', 'A Director has successfully been added!');
            } else {
            return back()->with('error', 'Problem Experienced with Action!');
            }
    }

    public function edit(Request $request,$id)
    {

          $page_title    = 'NHBRC Application Registration | Edit  Ownership Link';
          $user_id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $companies      = NHBRCCompanyDetail::all();
           $directors     = NHBRCCompanyDirector::where('company_id',$company->id ?? 0)->get();
          $director     = OwnershipLink::leftjoin('nhbrc_company_directors','ownership_links.director_id','=','nhbrc_company_directors.id')->where([['nhbrc_company_directors.company_id',$company->id],['ownership_links.id',$id]])->select()->first('ownership_links.*');

          return view('custom.nhbrc.ownership-link-edit', ['company'=> $company,'companies'=> $companies,'director'=>$director,'directors'=>$directors,'page_title'=>$page_title]);

    }


    public function destroy($id)
    {
        //
    }

}
