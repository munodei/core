<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\NHBRCSupplierReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCSupplierReferenceController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');

   }

    public function index(Request $request)
    {
         
          $page_title    = 'NHBRC Application Registration | Supplier References';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $suppliers     = NHBRCSupplierReference::where('company_id',$company->id ?? 0)->paginate(15);

          return view('custom.nhbrc.supplier-references', ['company'=> $company,'suppliers'=>$suppliers,'page_title'=>$page_title]);

    }

   public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Supplier Reference';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          return view('custom.nhbrc.supplier-reference-create', ['company'=> $company,'page_title'=>$page_title]);
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
                    'email' =>'required',
                ];

        $request->validate($rules);
        $in = Input::except('_token');
        $in['user_id'] = $request->user()->id;
     
        $res = NHBRCSupplierReference::create($in);

        if ($res) {
            return redirect()->route('nhbrc-supplier-references.index')->with('success', 'Supplier Reference Information has successfully been added!');
        } else {
            return back()->with('error', 'Problem Experienced with Action!');
        }

    }


    public function edit(Request $request,$id)
    {
          $page_title    = 'NHBRC Application Registration | Edit Supplier Reference';
          $user_id       = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $supplier      = NHBRCSupplierReference::where([['company_id',$company->id],['id',$id]])->first();
          
          return view('custom.nhbrc.supplier-reference-edit', ['company'=> $company,'supplier'=>$supplier,'page_title'=>$page_title]);
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
                    'email' =>'required',
                        ];

            $request->validate($rules);
            $in = Input::except('_token');
            $res = NHBRCSupplierReference::find($id);
            $in['user_id'] = $request->user()->id;
         
            $res->update($in);

            if ($res) {
                return redirect()->route('nhbrc-supplier-references.index')->with('success', 'Supplier Reference Information has successfully been updated!');
            } else {
                return back()->with('error', 'Problem Experienced with Action!');
            }
    }

    public function destroy($id)
    {
        //
    }

}
