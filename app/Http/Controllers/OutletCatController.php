<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\OutletCat;
use Auth;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class OutletCatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $data['page_title'] = "Outlet Category List";
        $data['outlet_cat'] = OutletCat::where('status', 1)->latest()->paginate(15);
        return view('admin.outlet-cat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = " Add Outlet Category";
        return view('admin.outlet-cat.create', $data);
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
            'outlet_cat' => 'required|string|max:255',
            'outlet_cat_des' => 'required|string|max:255',
        ]
      );

        $in = Input::except('_method', '_token');
        
        $user = OutletCat::create($in);

        $notification = array('message' => 'Outlet Category Created Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['page_title'] = "Outlet Category Edit";
        $data['outlet_cat'] = OutletCat::find($id);
        return view('admin.outlet-cat.edit', $data);
    }


    public function update(Request $request, $id)
    {
      $outlet_cat = OutletCat::find($id);
      $request->validate([
          'outlet_cat' => 'required|string|max:255',
          'outlet_cat_des' => 'required|string|max:255',
      ]
    );

      $in = Input::except('_method', '_token');
      $outlet_cat->update($in);

      $notification = array('message' => 'Outlet Category Updated Successfully', 'alert-type' => 'success');
      return back()->with($notification);
    }


    public function destroy($id)
    {
        //
    }
}
