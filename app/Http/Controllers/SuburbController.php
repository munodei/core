<?php
namespace App\Http\Controllers;

use App\Continent;
use App\Country;
use App\State;
use App\City;
use App\Neighbourhood;
use App\Suburb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class SuburbController extends Controller
{

    public function index()
    {
        $data['suburb'] = Suburb::latest()->paginate(25);
        $data['page_title'] = "Manage Suburb";
        return view('admin.suburb.index', $data);
    }


    public function create()
    {
        $data['neighbourhood'] = Neighbourhood::whereStatus(1)->get();
        $data['page_title'] = "Manage Suburb";
        return view('admin.suburb.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'neighbourhood_id' => 'required',
            'suburb' => 'required',
            'suburb_description' => 'required',
        ],
            [
                'neighbourhood_id.required' => 'Neighbourhood Must not be empty',
                'suburb.required' => 'Suburb must not be empty',
                'suburb_description.required' => 'Suburb Description Must be Added',
            ]
        );

        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->state,'Suburb');
        $res = Suburb::create($in);

        if ($res) {
            return back()->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'Problem With Creating Suburb');
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $data['neighbourhood'] = Neighbourhood::whereStatus(1)->get();
        $data['suburb'] = Suburb::find($id);
        $data['page_title'] = "Edit Suburb";
        return view('admin.suburb.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = Suburb::find($id);

        $request->validate([
            'neighbourhood_id' => 'required',
            'suburb' => 'required',
            'suburb_description' => 'required',
        ],
            [
                'neighbourhood_id.required' => 'Neighbourhood Must not be empty',
                'suburb.required' => 'Suburb must not be empty',
                'suburb_description.required' => 'Suburb Description Must be Added',
            ]
        );
        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->city,'Suburb');

        $res = $data->fill($in)->save();

        if ($res) {
            return back()->with('success', 'Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Suburb');
        }
        return $data;

    }


    public function destroy($id)
    {
        //
    }

}
