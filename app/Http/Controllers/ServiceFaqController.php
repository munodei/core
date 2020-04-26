<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
class ServiceFaqController extends Controller
{

    public function createFaqs()
    {

        $page_title = "Create New Faq";
        $services = Service::all();
        return view('admin.service-faqs.create',compact('page_title','services'));

    }

    public function storeFaqs(Request $request)
    {
        $request->validate([
            'service_id'=>'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        $in = Input::except('_method','_token');
        ServiceFaq::create($in);
        $notification = array('message' => 'Service FAQS Created Successfully.', 'alert-type' => 'success');
        return back()->with($notification);

    }

    public function allFaqs()
    {
        $data['page_title']  = "All Service faqs";
        $data['faqs1']       =  Service::all();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $data['faqs'] =$paginator = new LengthAwarePaginator(  $data['faqs1'], count(  $data['faqs1']), 1, $currentPage);
        return view('admin.service-faqs.index',$data);
    }

    public function editFaqs($id)
    {
        $data['page_title'] = "Edit Faqs";
        $data['faqs'] = ServiceFaq::findOrFail($id);
        return view('admin.service-faqs.edit',$data);
    }

    public function updateFaqs(Request $request, $id)
    {
        $faqs = ServiceFaq::findOrFail($id);
        $request->validate([
            'service_id'=>'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $in = Input::except('_method','_token');
        $faqs->fill($in)->save();

        $notification = array('message' => 'FAQS Updated Successfully.', 'alert-type' => 'success');
        return back()->with($notification);

    }

    public function deleteFaqs(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        Service::destroy($request->id);
        $notification = array('message' => 'FAQS Deleted Successfully.', 'alert-type' => 'success');
        return back()->with($notification);
    }

}
