<?php namespace App\Http\Controllers\NHBRC;

use App\NHBRCCompanyDetail;
use App\NHBRCCustomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class NHBRCGuaranteesController extends Controller
{
        public function __construct()
       {
           $this->middleware('auth');

       }

    public function index(Request $request)
    {
         
          $page_title    = 'NHBRC Application Registration | Company Guarantees';
          $id            = $request->user()->id;
          $company       = NHBRCCompanyDetail::where('user_id',$id)->first();
          $sales         = NHBRCCustomeService::where('company_id',$company->id ?? 0)->paginate(15);

          return view('custom.nhbrc.guarantees', ['company'=> $company,'sales'=>$sales,'page_title'=>$page_title]);

    }
}
