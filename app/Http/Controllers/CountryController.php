<?php

namespace App\Http\Controllers;

use App\Continent;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['country'] = Country::latest()->paginate(25);
        $data['page_title'] = "Manage Country";
        return view('admin.country.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['continent'] = Continent::whereStatus(1)->get();
        $data['page_title'] = "Manage Country";
        return view('admin.country.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'continent_id' => 'required',
            'code' => 'required',
            'charge' => 'required|min:0|numeric',
            'rate' => 'required|min:0|numeric',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000'
        ],
            [
                'name.required' => 'Country Name Must not be empty',
                'code.required' => 'Currency Code not be empty',
                'continent_id.required' => 'Continent Must be selected',
            ]
        );

        $in = Input::except('_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $request->name . '_' . time() . '.jpg';
            $location = 'assets/images/country/' . $filename;
            Image::make($image)->resize(32, 21)->save($location);
            $in['image'] = $filename;
        }
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $res = Country::create($in);
        if ($res) {
            return back()->with('success', 'Save Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Plan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['continent'] = Continent::whereStatus(1)->get();
        $data['country'] = Country::find($id);
        $data['page_title'] = "Edit Country";
        return view('admin.country.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Country::find($id);
        $request->validate([
            'name' => 'required',
            'continent_id' => 'required',
            'code' => 'required',
            'charge' => 'required|min:0|numeric',
            'rate' => 'required|min:0|numeric',
            'image' => 'mimes:jpeg,jpg,png|max:1000'
        ],
            [
                'name.required' => 'Country Name Must not be empty',
                'code.required' => 'Currency Code not be empty',
                'continent_id.required' => 'Continent Must be selected',
            ]
        );

        $in = Input::except('_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $request->name.'_' . time() . '.jpg';
            $location = 'assets/images/country/' . $filename;
            Image::make($image)->resize(32, 21)->save($location);
            $path = './assets/images/country/';
            File::delete($path . $data->image);
            $in['image'] = $filename;
        }
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $res = $data->fill($in)->save();

        if ($res) {
            return back()->with('success', 'Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Plan');
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
