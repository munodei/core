<?php

namespace App\Http\Controllers;

use App\Continent;
use App\Country;
use App\State;
use App\City;
use App\Neighbourhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class NeighbourhoodController extends Controller
{

    public function index()
    {
        $data['neighbourhood'] = Neighbourhood::latest()->paginate(25);
        $data['page_title'] = "Manage Neighbourhood";
        return view('admin.neighbourhood.index', $data);
    }


    public function create()
    {
        $data['city'] = City::whereStatus(1)->get();
        $data['page_title'] = "Manage Neighbourhood";
        return view('admin.neighbourhood.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_id' => 'required',
            'neighbourhood' => 'required',
            'neighbourhood_description' => 'required',
        ],
            [
                'city_id.required' => 'City Must not be empty',
                'neighbourhood.required' => 'Neighbourhood not be empty',
                'neighbourhood_description.required' => 'Neighbourhood Description Must be Added',
            ]
        );

        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->state,'Neighbourhood');
        $res = Neighbourhood::create($in);

        if ($res) {
            return back()->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Neighbourhood');
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $data['city'] = City::whereStatus(1)->get();
        $data['neighbourhood'] = Neighbourhood::find($id);
        $data['page_title'] = "Edit Neighbourhood";
        return view('admin.neighbourhood.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = Neighbourhood::find($id);

        $request->validate([
            'city_id' => 'required',
            'neighbourhood' => 'required',
            'neighbourhood_description' => 'required',
        ],
            [
                'city_id.required' => 'City Must not be empty',
                'neighbourhood.required' => 'Neighbourhood not be empty',
                'neighbourhood_description.required' => 'Neighbourhood Description Must be Added',
            ]
        );

        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->city,'Neighbourhood');

        $res = $data->fill($in)->save();

        if ($res) {
            return back()->with('success', 'Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Neighbourhood');
        }
        return $data;

    }


    public function destroy($id)
    {
        //
    }

}
