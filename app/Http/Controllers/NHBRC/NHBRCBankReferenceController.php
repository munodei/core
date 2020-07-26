<?php namespace App\Http\Controllers\NHBRC;

use Illuminate\Http\Request;
use App\NHBRCBankReference;
use App\NHBRCCompanyDetail;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCBankReferenceController extends Controller
{

    public function __construct()
       {
           $this->middleware('auth');

       }

    public function index(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Bank References';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $banks     = NHBRCBankReference::where('company_id',$company->id ?? 0)->paginate(15);
          return view('custom.nhbrc.bank-references', ['company'=> $company,'banks'=>$banks,'page_title'=>$page_title]);

    }

     public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Bank Reference';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $directors     = NHBRCBankReference::where('company_id',$company->id ?? 0)->paginate(15);
          return view('custom.nhbrc.bank-reference-create', ['company'=> $company,'directors'=>$directors,'page_title'=>$page_title]);
    }

    public function store(Request $request)
    {
        $rules = [
                    'bank' =>'required',
                    'branch' =>'required',
                    'clearing_number' =>'required',
                    'swift_code' =>'required',
                    'account_number1' =>'required',
                    'account_type1' =>'required',
                    'account_manager' =>'required',
                    'tel_number' =>'required',
                    'fax_number' =>'required',
                    'email' =>'required',
                ];

                    $request->validate($rules);
                    $in = Input::except('_token');
                    
                    $res = NHBRCBankReference::create($in);

                    if ($res) {
                        return redirect()->route('nhbrc-bank-reference.index')->with('success', 'Bank Information has successfully been added!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Action!');
                    }

    }




    public function edit(Request $request,$id)
    {
          $page_title    = 'NHBRC Application Registration | Edit Bank Reference';
          $user_id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $bank     = NHBRCBankReference::where([['company_id',$company->id],['id',$id]])->first();
          return view('custom.nhbrc.bank-reference-edit', ['company'=> $company,'bank'=>$bank,'page_title'=>$page_title]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
                    'bank' =>'required',
                    'branch' =>'required',
                    'clearing_number' =>'required',
                    'swift_code' =>'required',
                    'account_number1' =>'required',
                    'account_type1' =>'required',
                    'account_manager' =>'required',
                    'tel_number' =>'required',
                    'fax_number' =>'required',
                    'email' =>'required',
                ];
                    $request->validate($rules);
                    $in = Input::except('_token');

                    $res = NHBRCBankReference::find($id);
                    
                    $res->update($in);

                    if ($res) {
                        return redirect()->route('nhbrc-bank-reference.index')->with('success', 'Bank Information has successfully been updated!');
                    } else {
                        return back()->with('error', 'Error Occured!');
                    }
    }
    public function destroy($id)
    {
        //
    }
}
