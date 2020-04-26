<?php

namespace App\Http\Controllers;

use App\Continent;
use App\Country;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class StateController extends Controller
{

    public function index()
    {
        $data['country'] = State::latest()->paginate(25);
        $data['page_title'] = "Manage State";
        return view('admin.state.index', $data);
    }


    public function create()
    {
        $data['continent'] = Country::whereStatus(1)->get();
        $data['page_title'] = "Manage State";
        return view('admin.state.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'state' => 'required',
            'state_description' => 'required',
        ],
            [
                'country_id.required' => 'Country Must not be empty',
                'state.required' => 'State not be empty',
                'state_description.required' => 'State Description Must be Added',
            ]
        );

        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->state,'State');
        $res = State::create($in);

        if ($res) {
            return back()->with('success', 'Save Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Plan');
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $data['country'] = Country::whereStatus(1)->get();
        $data['state'] = State::find($id);
        $data['page_title'] = "Edit State";
        return view('admin.state.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = State::find($id);
        $request->validate([
            'country_id' => 'required',
            'state' => 'required',
            'state_description' => 'required',
        ],
            [
                'country_id.required' => 'Country Must not be empty',
                'state.required' => 'State not be empty',
                'state_description.required' => 'State Description Must be Added',
            ]
        );

        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->state,'State');

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
