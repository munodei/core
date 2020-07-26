<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Functions;
use Mail;
class RequestsController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

    public function requests(Request $request){

      $user = $request->user();
      $quotes  = DB::table('tbl_users as u')
                                ->leftjoin('tbl_request as r','r.userid', '=', 'u.id')
                                ->leftjoin('tbl_request_quotes as q','q.requestid','=','r.id')
                                ->where([
                                      ['r.userid','=', $user->id],
                                      ['q.status','=',1],
                                ])
                                  ->select('u.*','q.*','r.id AS requestID','q.id AS quoteID' )
                                  ->orderBy('r.createddate', 'desc')
                                  ->get();

      $requests = DB::table('tbl_request AS r')
                          ->join('tbl_sub_category AS s','s.id','=','r.serviceid')
                          ->leftjoin('tbl_sub_category_values AS sub_cat_values','s.id', '=', 'sub_cat_values.contentid')
                          ->leftjoin('tbl_category AS cat','cat.id', '=', 's.cat_id')
                          ->leftjoin('tbl_category_values AS cat_values','cat.id', '=', 'cat_values.contentid')
                          ->where([
                                ['userid','=', $user->id], 
                                ['r.isActive','=','y'],
                                ['cat_values.fieldid','=',1],
                                ['sub_cat_values.fieldid','=',1],
                                ])
                            ->select('r.id AS requestID','r.*','cat_values.fieldvalue','sub_cat_values.fieldvalue AS sub_cat','s.*','cat.*')
                            ->orderBy('r.createddate', 'desc');
      $requests =  $requests->paginate(1);
      return view('requests',compact('user','requests','quotes'));

    }

    public function index(Request $request){

      $page_title = 'Request Service';
      $user       = $request->user();
      $requests   = DB::table('tbl_request')->where('userid', $user->id)->get();
      $sqlSubcat  = self::subCategories();

      return view('custom.service-providers.service-request',compact('user','requests','page_title','sqlSubcat'));

    }

        public function subCategories(){
      $sqlSubcat = DB::table('tbl_sub_category AS s')
            ->leftJoin('tbl_sub_category_values AS sv', 's.id', '=', 'sv.contentid')
            // ->where([
            //           ['tbl_sub_category.isactive', '=', '1'],
            //           ['tbl_sub_category_values.langid', '=', '1'],
            //           ['tbl_sub_category_values.fieldid', '=', '1'],
            //         ])
            ->select('s.id as desc', 'sv.fieldvalue as value','s.slug as slug')
            ->get();
      return json_encode($sqlSubcat);
    }

    // to add information of an existing request for an update or viewing the content submitted earlier
    public function Request(Request $request,$id){

      $user = $request->user();
      $user_request  = DB::table('tbl_request as r')
                                ->leftjoin('tbl_users as u','r.userid', '=', 'u.id')
                                ->join('tbl_sub_category AS s','s.id','=','r.serviceid')
                                ->join('tbl_sub_category_values AS sub_cat_values','s.id', '=', 'sub_cat_values.contentid')
                                ->where([
                                      ['r.userid','=', $user->id],
                                      ['r.id','=',$id],
                                      ['sub_cat_values.fieldid','=',1],
                                ])
                                  ->select('sub_cat_values.fieldvalue','r.*','r.id AS requestID')
                                  ->get();
      return view('service-requests',compact('user','user_request'));

    }

    public function store(Request $request){

        $this->validate($request,
                                [
                                  'service_title' => 'required',
                                  'service_description'=>'required',
                                  'budget'=>'required',
                                  'address'=>'required',
                                  'service_date'=>'required',
                                  'service_hour'=>'required',
                                  'pincode'=>'required',
                                  
                                ]);

        extract($_POST);
        $user                = $request->user();
        $id                  = isset($id) ? intval($id) : 0;
        $serviceId           = isset($serviceId) ? intval($serviceId) : 0;
        $service_title       = isset($service_title) ? $service_title :"";
        $service_description = isset($service_description) ? $service_description :"";
        $budget              = isset($budget) ? (float)$budget :0;
        $address             = isset($searchPincode1)?$searchPincode1:"";
        $service_date        = isset($service_date) ? date("Y-m-d",strtotime($service_date)) :"";
        $service_time        = isset($service_time) ? date("H:i:s",strtotime($service_time)) :"";
        $service_hour        = isset($service_hour) ? (float)$service_hour:"";
        $addressLat          = $latitude;
        $addressLng          = $longitude;
        $pincode             = isset($postal_code) ? $postal_code :"";

      if($serviceId > 0 && $pincode!="" && $service_title!="" && $addressLat!="" && $addressLng!=""){

                      if($id > 0)
                      {
                        // $id =$project_id;
                        DB::table('tbl_request')
                                    ->where('id','=', $id)
                                    ->update(array("service_title"=>$service_title, "service_description"=>$service_description,"address"=>$address,"addressLat"=>$addressLat,"addressLng"=>$addressLng,"pincode"=>$pincode,"service_date"=>$service_date,"service_time"=>$service_time,"service_hour"=>(string)$service_hour,"budget"=>(string)$budget,"ipaddress"=>self::get_ip_address()));
                        self::matchingAlgorithm($serviceId,$pincode,$addressLat,$addressLng,$id,1);

                        return back()->with('success','You have successfully made a Request!');

                      }
                      else
                      {
                          $project_id = DB::table('tbl_request')->insertGetId(
                          array("userid"=>$user->id,"serviceId"=>$serviceId,"service_title"=>$service_title,"service_description"=>$service_description,"address"=>$address,"addressLat"=>$addressLat,"addressLng"=>$addressLng,"pincode"=>$pincode,"service_date"=>$service_date,"service_time"=>$service_time,"service_hour"=>(string)$service_hour,"budget"=>(string)$budget,"ipaddress"=>self::get_ip_address())
                          );

                         if($project_id > 0)
                          {
                                self::matchingAlgorithm($serviceId,$pincode,$addressLat,$addressLng,$project_id,0);
                          }

                        return back()->with('success','You have successfully made a Request!');  

                      }

        }
        else
        {
          return back()->with('error','Error Occured!');
        }
          

    }
    public function matchingAlgorithm($serviceId,$pincode="",$lat="",$lng="",$project_id=0,$repeat=0){

      if($project_id > 0){
        if($repeat==1){
                $results = DB::select( DB::raw("
                SELECT u.name,
                u.id,
                u.email,
                r.service_title,
                r.address,
                r.service_date,
                r.service_time,
                r.service_hour,
                r.budget,
                (((acos(sin((:lat *pi()/180)) * sin((u.bus_addressLat*pi()/180))+cos((:lat1 *pi()/180)) * cos((u.bus_addressLat*pi()/180)) * cos(((:lng- u.bus_addressLng)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance
                FROM tbl_users as u
                INNER JOIN tbl_sub_category as s ON (FIND_IN_SET(s.id,(u.business_subcategory)) AND u.status = 1)
                INNER JOIN tbl_request as r ON (r.serviceid = s.id AND r.isActive = 'y')
                WHERE r.id =:project_id
                AND (u.bus_pincode = :pincode
                OR u.willing_to_travel > (((acos(sin((:lat2 *pi()/180)) * sin((u.bus_addressLat*pi()/180))+cos((:lat3 *pi()/180)) * cos((u.bus_addressLat*pi()/180)) * cos(((:lng2- u.bus_addressLng)*pi()/180))))*180/pi())*60*1.1515*1.609344))
                AND u.id NOT IN
                        (SELECT providerid
                        FROM tbl_service_notification
                        WHERE requestid = :project_id1)
                GROUP BY u.id"), array(
                ':lat' => $lat,
                ':lat1' => $lat,
                ':lat2' => $lat,
                ':lat3' => $lat,
                ':lng' => $lng,
                ':lng2' => $lng,
                ':project_id' => $project_id,
                ':project_id1' => $project_id,
                ':pincode'=>$pincode,
                ));
              }
              else{
                $results = DB::select( DB::raw("
                SELECT u.name,
                u.id,
                u.email,
                r.service_title,
                r.address,
                r.service_date,
                r.service_time,
                r.service_hour,
                r.budget,
                (((acos(sin((:lat4 *pi()/180)) * sin((u.bus_addressLat*pi()/180))+cos((:lat5 *pi()/180)) * cos((u.bus_addressLat*pi()/180)) * cos(((:lng3- u.bus_addressLng)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance
                FROM tbl_users as u
                INNER JOIN tbl_sub_category as s ON (FIND_IN_SET(s.id,(u.business_subcategory)) AND u.status = 1)
                INNER JOIN tbl_request as r ON (r.serviceid = s.id AND r.isActive = 'y')
                WHERE r.id =:project_id2
                AND (u.bus_pincode = :pincode1 OR u.willing_to_travel > (((acos(sin((:lat6 *pi()/180)) * sin((u.bus_addressLat*pi()/180))+cos((:lat7 *pi()/180)) * cos((u.bus_addressLat*pi()/180)) * cos(((:lng4- u.bus_addressLng)*pi()/180))))*180/pi())*60*1.1515*1.609344))
                GROUP BY u.id"), array(
                ':lat4' => $lat,
                ':lat5' => $lat,
                ':lat6' => $lat,
                ':lat7' => $lat,
                ':lng3' => $lng,
                ':lng4' => $lng,
                ':project_id2' => $project_id,
                ':pincode1'=>$pincode,
                ));

              }
              $subject = 'New service request notification ';

              foreach ($results as $users) {
                $NewServiceRequest = DB::table('tbl_service_notification')->insertGetId(["requestid"=>$project_id,"providerid"=>$users->id,"createddate"=>date("Y-m-d H:i:s")]);

                if($NewServiceRequest>0){

                    $title = "New Service Notification";
                    $service_title = $users->service_title;
                    $address = $users->address;
                    $budget = $users->budget;
                    $service_date = date('d M Y',strtotime($users->service_date));

                    Mail::send('emails.test', ['title' => $title, 'service_title' => $service_title,'address'=>$address,'budget'=>$budget,'service_date'=>$service_date,'project_id'=>$project_id], function ($message)
                    {
                      $message->from('terrencemunodei25@gmail.com', 'Terrence Munodei');
                      $message->to('terrencemunodei25@gmail.com');
                    });

                    $to = $users['email'];
                    $greetings = $users['name'];
                    $servicelink = '<a href="'.SITE_URL.'request-details/'.$project_id.'/" title="Click here to visit the details">Visit the service details.</a>';
                    $val = array($greetings,$users['service_title'],$users['address'],CURRENCY_SIGN.$users['budget'],date('d M Y',strtotime($users['service_date'])),$servicelink);
                    $message = generateEmailTemplate(5, $key, $val);
                    sendEmailAddress($to, $subject, $message);

                }
              }

}

     }
     function get_ip_address()

{

    foreach (array(

        'HTTP_CLIENT_IP',

        'HTTP_X_FORWARDED_FOR',

        'HTTP_X_FORWARDED',

        'HTTP_X_CLUSTER_CLIENT_IP',

        'HTTP_FORWARDED_FOR',

        'HTTP_FORWARDED',

        'REMOTE_ADDR'

    ) as $key) {

        if (array_key_exists($key, $_SERVER) === true) {

            foreach (explode(',', $_SERVER[$key]) as $ip) {

                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {

                    return $ip;

                }

            }

        }

    }

}
}
