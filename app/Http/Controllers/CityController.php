<?php

namespace App\Http\Controllers;

use App\Continent;
use App\Country;
use App\State;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class CityController extends Controller
{

    public function index()
    {
        $data['city'] = City::latest()->paginate(25);
        $data['page_title'] = "Manage City";
        return view('admin.city.index', $data);
    }


    public function create()
    {
        $data['state'] = State::whereStatus(1)->get();
        $data['page_title'] = "Manage City";
        return view('admin.city.create', $data);
    }

    public function store(Request $request)
    {
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
        $in['slug']   = unique_slug($request->state,'City');
        $res = City::create($in);

        if ($res) {
            return back()->with('success', 'Save Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating City');
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $data['state'] = State::whereStatus(1)->get();
        $data['city'] = City::find($id);
        $data['page_title'] = "Edit State";
        return view('admin.city.edit', $data);
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
