<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\NHBRCFinancialRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCFinancialController extends Controller
{
    public function __construct()
     {
         $this->middleware('auth');

     }

    public function index(Request $request)
    {
         
          $page_title    = 'NHBRC Application Registration | Company Financial Records';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $financies     = NHBRCFinancialRecord::where('company_id',$company->id ?? 0)->paginate(15);

          return view('custom.nhbrc.financial', ['company'=> $company,'financies'=>$financies,'page_title'=>$page_title]);

    }

     public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Financial Record';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          return view('custom.nhbrc.financial-create', ['company'=> $company,'page_title'=>$page_title]);
    }

    public function store(Request $request)
    {
        $rules = [
                    'company_id' =>'required',
                    'year'=>'required',
                    'expected_turn_over' =>'required',
                    'expected_profit' =>'required',
                    'expected_profit_or_loss' =>'required',
                ];

                    $request->validate($rules);
                    $in = Input::except('_token');

                    $in['user_id'] = $request->user()->id;
                    $in['year'] = date("Y",strtotime($request->year));
                 
                    $res = NHBRCFinancialRecord::create($in);

                    if ($res) {
                        return redirect()->route('nhbrc-financial.index')->with('success', 'Financial Records Information has successfully been added!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Action!');
                    }

    }


    public function edit(Request $request,$id)
    {
          $page_title    = 'NHBRC Application Registration | Edit Financial Records';
          $user_id       = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $record   = NHBRCFinancialRecord::where([['company_id',$company->id],['id',$id]])->first();
          
          return view('custom.nhbrc.financial-edit', ['company'=> $company,'record'=>$record,'page_title'=>$page_title]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
                    'company_id' =>'required',
                    'year'=>'required',
                    'expected_turn_over' =>'required',
                    'expected_profit' =>'required',
                    'expected_profit_or_loss' =>'required',
                 ];

            $request->validate($rules);
            $in = Input::except('_token');
            $res = NHBRCFinancialRecord::find($id);

            $in['user_id'] = $request->user()->id;
            $in['year'] = date("Y",strtotime($request->year));
                          
            $res->update($in);

            if ($res) {
                return redirect()->route('nhbrc-financial.index')->with('success', 'Financial Records Information has successfully been updated!');
            } else {
                return back()->with('error', 'Problem Experienced with Action!');
            }
    }

    public function destroy($id)
    {
        //
    }

  
}
