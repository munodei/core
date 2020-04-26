<?php

namespace App\Http\Controllers;
use Auth;
use File;
use App\User;
use App\Outlet;
use App\OutletCat;
use App\Suburb;
use App\Neighbourhood;
use App\City;
use App\State;
use App\Country;
use App\OutletCatOutlet;
use Carbon\Carbon;
use App\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class OutletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $data['page_title'] = "outlet List";
        $data['outlet'] = Outlet::where('status', 1)->latest()->paginate(50);
        return view('admin.outlet.index', $data);
    }

    public function create()
    {
        $data['page_title'] = " Add Outlet";
        $data['country'] = Country::where('status', 1)->get();
        $data['state'] = State::where('status', 1)->get();
        $data['city'] = City::where('status', 1)->get();
        $data['neighbourhood'] = Neighbourhood::where('status', 1)->get();
        $data['suburb'] = Suburb::where('status', 1)->get();
        $data['outlet_cat'] = OutletCat::where('status', 1)->get();

        return view('admin.outlet.create', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
                            'outlet'=>'required',
                            'outlet_desc'=>'required',
                            'outlet_photo'=>'required',
                            'outlet_cat_id'=>'required',
                            'outtlet_long'=>'required',
                            'outlet_lat'=>'required',
                            'neighbourhood_id'=>'required',
                            'suburb_id'=>'required',
                            'city_id'=>'required',
                            'state_id'=>'required',
                            'country_id'=>'required',
                            'status'=>'required'
        ]);

        $in = Input::except('_method', '_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->state,'Outlet');
        $res = Suburb::create($in);


        if ($res) {
          if(!OutletCatOutlet::where([['outlet_id',$res->id],['outlet_cat_id',$request->outlet_cat_id]])->exists())
          {
            OutletCatOutlet::create([
                                    'outlet_id'=>$res->id,
                                    'outlet_cat_id'=>$request->outlet_cat_id

            ]);

          }
            return back()->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'Problem With Creating Outlet');
        }
      }

      public function update(Request $request,$id)
      {
          $outlet = Outlet::find($id);
          // var_dump($id);
          // die();
          $request->validate([
                              'outlet'=>'required',
                              'outlet_desc'=>'required',
                              'outlet_photo'=>'required',
                              'outlet_cat_id'=>'required',
                              'outtlet_long'=>'required',
                              'outlet_lat'=>'required',
                              'neighbourhood_id'=>'required',
                              'suburb_id'=>'required',
                              'city_id'=>'required',
                              'state_id'=>'required',
                              'country_id'=>'required',
                              'status'=>'required'
          ]);

          $in = Input::except('_method', '_token');
          $in['status'] = $request->status == 'on' ? '1' : '0';
          $in['slug']   = unique_slug($request->outlet,'Outlet');
          $outlet->update($in);

          if(!OutletCatOutlet::where([['outlet_id',$id],['outlet_cat_id',$request->outlet_cat_id]])->exists())
          {
            OutletCatOutlet::create([
                                    'outlet_id'=>$id,
                                    'outlet_cat_id'=>$request->outlet_cat_id

            ]);

          }


          if ($outlet) {
              return back()->with('success', 'Updated Successfully!');
          } else {
              return back()->with('alert', 'Problem With Creating Outlet');
          }
        }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['page_title'] = "Outlet Edit";
        $data['outlet'] = Outlet::leftjoin('outlet_outlet_cat','outlets.id','=','outlet_outlet_cat.outlet_id')
                                                                                                              ->leftjoin('outlet_categories','outlet_categories.id','=','outlet_outlet_cat.outlet_cat_id')
                                                                                                              ->where('outlets.id',$id)
                                                                                                              ->select(
                                                                                                                  'outlets.*',
                                                                                                                  'outlet_outlet_cat.outlet_cat_id as outletCatId'
                                                                                                                )
                                                                                                              ->first();
        $data['outlet_cat'] = OutletCat::all();
        $data['suburb'] = Suburb::all();
        $data['neighbourhood'] = Neighbourhood::all();
        $data['city'] = City::all();
        $data['state'] = State::all();
        $data['country'] = Country::all();
        return view('admin.outlet.edit', $data);

    }




    public function destroy($id)
    {
        $outlet = Outlet::where('id',$id)->delete();
            return back()->with('alert', 'Deleted Successfully!');

    }
}
