<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\NHBRCClientReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCClientReferenceController extends Controller
{
    public function __construct()
       {
           $this->middleware('auth');

       }

    public function index(Request $request)
    {
         
          $page_title    = 'NHBRC Application Registration | Client References';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $clients       = NHBRCClientReference::where('company_id',$company->id ?? 0)->paginate(15);

          return view('custom.nhbrc.client-references', ['company'=> $company,'clients'=>$clients,'page_title'=>$page_title]);

    }

   public function create(Request $request)
    {
          $page_title    = 'NHBRC Application Registration | Add Client Reference';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          return view('custom.nhbrc.client-reference-create', ['company'=> $company,'page_title'=>$page_title]);
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
                    'date_completed' =>'required',
                    'price_of_contract' =>'required',
                    'email' =>'required',
                    'client_picture'=>'required'
                ];

                    $request->validate($rules);
                    $in = Input::except('_token');

                    $array_files =  array(0=>'contract',1=>'client_picture',2=>'client_id');
                    $in['user_id'] = $request->user()->id;
                    $in['date_completed'] = date('Y-m-d',strtotime($request->status));
                    foreach ($array_files as $uploaded_file) {

                    if($request->hasFile($uploaded_file)){

                        $filenameWithExt = $request->file($uploaded_file)->getClientOriginalName();
                        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension       = $request->file($uploaded_file)->getClientOriginalExtension();
                        $filenameToStore = $filename.'_'.time().'.'.$extension;
                        $location = '/assets/drivers/documents/' . $filenameToStore;
                        $request->file($uploaded_file)->move( base_path() . $location);
                        $in[$uploaded_file] = $location;
                      }

                    }

                    
                    $res = NHBRCClientReference::create($in);

                    if ($res) {
                        return redirect()->route('nhbrc-clients-references.index')->with('success', 'Client Reference Information has successfully been added!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Action!');
                    }

    }


    public function edit(Request $request,$id)
    {
          $page_title    = 'NHBRC Application Registration | Edit Client Reference';
          $user_id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$user_id)->first();
          $client     = NHBRCClientReference::where([['company_id',$company->id],['id',$id]])->first();
          return view('custom.nhbrc.client-reference-edit', ['company'=> $company,'client'=>$client,'page_title'=>$page_title]);
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
                            'date_completed' =>'required',
                            'price_of_contract' =>'required',
                            'email' =>'required',
                            'client_picture'=>'required'
                        ];

            $request->validate($rules);
            $in = Input::except('_token');
            $res = NHBRCClientReference::find($id);
            $array_files =  array(0=>'contract',1=>'client_picture',2=>'client_id');
            $in['user_id'] = $request->user()->id;
            $in['date_completed'] = date('Y-m-d',strtotime($request->status));
            foreach ($array_files as $uploaded_file) {

            if($request->hasFile($uploaded_file)){

                $filenameWithExt = $request->file($uploaded_file)->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $request->file($uploaded_file)->getClientOriginalExtension();
                $filenameToStore = $filename.'_'.time().'.'.$extension;
                $location        = '/assets/drivers/documents/'. $filenameToStore;
                $request->file($uploaded_file)->move( base_path() . $location);
                $in[$uploaded_file] = $location;
              }

            }

            
            $res->update($in);

            if ($res) {
                return redirect()->route('nhbrc-clients-references.index')->with('success', 'Client Reference Information has successfully been updated!');
            } else {
                return back()->with('error', 'Problem Experienced with Action!');
            }
    }
    public function destroy($id)
    {
        //
    }
}
