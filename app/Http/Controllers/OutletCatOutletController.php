<?php

namespace App\Http\Controllers;

use App\Outlet;
use App\OutletCat;
use App\OutletCatOutlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class OutletCatOutletController extends Controller
{

    public function index()
    {
        $data['outlet'] = Outlet::latest()->paginate(25);
        $data['page_title'] = "Manage Outlet Category Relationships";
        return view('admin.outlet-cat-outlet.index', $data);
    }


    public function create($id)
    {
        $data['outlet'] = Outlet::find($id);
        $data['outlet_cat'] = OutletCat::whereStatus(1)->get();
        $data['page_title'] = "Manage Outlet Category Relationship";
        return view('admin.outlet-cat-outlet.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required',
            'outlet_cat_id' => 'required',
        ]
        );

        $in = Input::except('_token');
        $res = OutletCatOutlet::create($in);

        if ($res) {
            return redirect()->route('outlet-cat-outlet.index')->with('success', 'Save Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating City');
        }
    }


    public function show($id)
    {

    }

    public function edit($outlet_id,$outlet_cat_id)
    {
        $res =  OutletCatOutlet::where([['outlet_id',$outlet_id],['outlet_cat_id',$outlet_cat_id]])->delete();
        if ($res) {
            return redirect()->route('outlet-cat-outlet.index')->with('error', 'Save Deleted!');
        } else {
            return back()->with('alert', 'Problem With Updating City');
        }
    }


    public function update(Request $request, $id)
    {
        $data = City::find($id);

        $request->validate([
            'state_id' => 'required',
            'city' => 'required',
            'city_description' => 'required',
        ],
            [
                'state_id.required' => 'State Must not be empty',
                'city.required' => 'City not be empty',
                'city_description.required' => 'City Description Must be Added',
            ]
        );

        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->city,'City');

        $res = $data->fill($in)->save();

        if ($res) {
            return back()->with('success', 'Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Plan');
        }
        return $data;

    }


    public function destroy($id)
    {
        //
    }

}
