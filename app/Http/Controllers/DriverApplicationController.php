<?php

namespace App\Http\Controllers;
use App\DriverApplication;
use App\HighestEducationQualification;
use App\IndustrySector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class DriverApplicationController extends Controller
{

    public function __construct(){

      $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $data['cities'] = \App\City::all();
        $data['neighbourhoods']= \App\Neighbourhood::all();
        $data['suburbs']= \App\Suburb::all();
        $data['page_title'] = 'Driver Application';
        return view('custom.driver-application.index',$data);
    }

    public function mallrunner(Request $request)
    {
        $data['cities'] = \App\City::all();
        $data['neighbourhoods']= \App\Neighbourhood::all();
        $data['suburbs']= \App\Suburb::all();
        $data['page_title'] = 'Mall or Shop Runner Application';
        return view('custom.driver-application.mall-runner',$data);
    }

    public function create()
    {
      $data = DriverApplication::where('email',$request->email)->first();
      $rules = [
                'fname'=>'required',
                'lname'=>'required',
                'email'=>'required|max:50|unique:driver_applications,email',
                'phone'=>'required|max:20',
                'resume_doc'=>'required',
                'cover_letter_doc'=>'required',
                'suburb_id'=>'required',
                'neighbourhood_id'=>'required',
                'city_id'=>'required',
                'country_id'=>'required',
                'race'=>'required',
                'gender'=>'required',
                'id_number'=>'required',
                'Id_doc'=>'required',
                'criminal_record'=>'required',
                'mobile_phone'=>'required|max:20'
                                     ];
      $msgs  = [      'fname.required'=>'Applicant First Name is required!',
                      'lname.required'=>'Applicant Last Name required!',
                      'email.required'=>'Applicant Email is required!',
                      'phone.required'=>'Applicant phone number is Required!',
                      'resume_doc.required'=>'Applicant Resume Document is required!',
                      'cover_letter_doc.required'=>'Applicant Cover Letter is required!',
                      'suburb_id.required'=>'Applicant Suburb is Required',
                      'neighbourhood_id.required'=>'Applicant preferred Neighbourhood of Service is required!',
                      'city_id.required'=>'Applicant preferred City of Service is required!',
                      'country_id.required'=>'Applicant Country required!',
                      'race.required'=>'Applicant Race is required!',
                      'gender.required'=>'Applicant Gender is required!',
                      'id_number.required'=>'Applicant Identification Number/ Passport Number is Required!',
                      'Id_doc.required'=>'Applicant Identification/ Passport  Document is Required',
                      'criminal_record.required'=>'Applicant Criminal Record is required!',
                      'mobile_phone.required'=>'Applicant Mobile Phone is required'
                    ];

                    $request->validate($rules,$msgs);


                    $in = Input::except('_token','resume_doc','cover_letter_doc','Id_doc');
                    $array_files =  array(0=>'resume_doc',1=>'cover_letter_doc',2=>'Id_doc' );
                    $in['status'] = $request->status ?? '1';
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


                    $in['mall_runner'] = 1;
                    $res = DriverApplication::create($in);

                    if ($res) {
                        return back()->with('success', 'Your Application has been successfully sent!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Application!');
                    }
    }

    public function store(Request $request)
    {
      
      $rules = [
                'fname'=>'required',
                'lname'=>'required',
                'email'=>'required|max:50|unique:driver_applications,email',
                'phone'=>'required|max:20',
                'resume_doc'=>'required',
                'cover_letter_doc'=>'required',
                'suburb_id'=>'required',
                'neighbourhood_id'=>'required',
                'city_id'=>'required',
                'country_id'=>'required',
                'race'=>'required',
                'gender'=>'required',
                'id_number'=>'required',
                'Id_doc'=>'required',
                'driver_license'=>'required',
                'driver_license_doc'=>'required',
                'criminal_record'=>'required',
                'mobile_phone'=>'required|max:20'
                                     ];
      $msgs  = [      'fname.required'=>'Applicant First Name is required!',
                      'lname.required'=>'Applicant Last Name required!',
                      'email.required'=>'Applicant Email is required!',
                      'phone.required'=>'Applicant phone number is Required!',
                      'resume_doc.required'=>'Applicant Resume Document is required!',
                      'cover_letter_doc.required'=>'Applicant Cover Letter is required!',
                      'suburb_id.required'=>'Applicant Suburb is Required',
                      'neighbourhood_id.required'=>'Applicant preferred Neighbourhood of Service is required!',
                      'city_id.required'=>'Applicant preferred City of Service is required!',
                      'country_id.required'=>'Applicant Country required!',
                      'race.required'=>'Applicant Race is required!',
                      'gender.required'=>'Applicant Gender is required!',
                      'id_number.required'=>'Applicant Identification Number/ Passport Number is Required!',
                      'Id_doc.required'=>'Applicant Identification/ Passport  Document is Required',
                      'driver_license.required'=>'Applicant Driver License Number is Required',
                      'driver_license_doc.required'=>'Applicant Driver License Document is Required',
                      'criminal_record.required'=>'Applicant Criminal Record is required!',
                      'mobile_phone.required'=>'Applicant Mobile Phone is required'
                    ];

                    $request->validate($rules,$msgs);


                    $in = Input::except('_token','resume_doc','cover_letter_doc','driver_license_doc','Id_doc');
                    $array_files =  array(0=>'resume_doc',1=>'cover_letter_doc',2=>'driver_license_doc',3=>'Id_doc' );
                    $in['status'] = $request->status ?? '1';
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



                    $res = DriverApplication::create($in);

                    if ($res) {
                        return back()->with('success', 'Your Application has been successfully sent!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Application!');
                    }


    }

    public function jobSeeker()
    {
        $data['cities'] = \App\City::all();
        $data['neighbourhoods']= \App\Neighbourhood::all();
        $data['suburbs']= \App\Suburb::all();
        $data['highest_education_qualifications']= HighestEducationQualification::all();
        $data['industry_sectors']= IndustrySector::all();
        $data['page_title'] = 'Job Seeker Application';
        return view('custom.job-seeker-application.index',$data);
    }

    public function jobSeekerStore(Request $request)
    {
              $rules = [
                'fname'=>'required',
                'lname'=>'required',
                'email'=>'required|max:50|unique:driver_applications,email',
                'phone'=>'required|max:20',
                'resume_doc'=>'required',
                'cover_letter_doc'=>'required',
                'suburb_id'=>'required',
                'neighbourhood_id'=>'required',
                'city_id'=>'required',
                'country_id'=>'required',
                'race'=>'required',
                'gender'=>'required',
                'id_number'=>'required',
                'Id_doc'=>'required',
                'criminal_record'=>'required',
                'clear_image_of_yourself'=>'required',
                'mobile_phone'=>'required|max:20'
                                     ];
      $msgs  = [      'fname.required'=>'Applicant First Name is required!',
                      'lname.required'=>'Applicant Last Name required!',
                      'email.required'=>'Applicant Email is required!',
                      'phone.required'=>'Applicant phone number is Required!',
                      'resume_doc.required'=>'Applicant Resume Document is required!',
                      'cover_letter_doc.required'=>'Applicant Cover Letter is required!',
                      'suburb_id.required'=>'Applicant Suburb is Required',
                      'neighbourhood_id.required'=>'Applicant preferred Neighbourhood of Service is required!',
                      'city_id.required'=>'Applicant preferred City of Service is required!',
                      'country_id.required'=>'Applicant Country required!',
                      'race.required'=>'Applicant Race is required!',
                      'gender.required'=>'Applicant Gender is required!',
                      'id_number.required'=>'Applicant Identification Number/ Passport Number is Required!',
                      'Id_doc.required'=>'Applicant Identification/ Passport  Document is Required',
                      'criminal_record.required'=>'Applicant Criminal Record is required!',
                      'mobile_phone.required'=>'Applicant Mobile Phone is required'
                    ];

                    $request->validate($rules,$msgs);


                    $in = Input::except('_token','resume_doc','cover_letter_doc','driver_license_doc','Id_doc');
                    $array_files =  array(0=>'resume_doc',1=>'cover_letter_doc',2=>'driver_license_doc',3=>'Id_doc',4=>'clear_image_of_yourself' );
                    $in['status'] = $request->status ?? '1';
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



                    $res = DriverApplication::create($in);

                    if ($res) {
                        return back()->with('success', 'Your Application has been successfully sent!');
                    } else {
                        return back()->with('error', 'Problem Experienced with Application!');
                    }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
