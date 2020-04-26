<?php
namespace App\Http\Controllers;

use App\Continent;
use App\ProCat;
use App\ProSubCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class ProCatController extends Controller
{

    public function index()
    {
        $data['pro_cat'] = ProCat::where('pro_cat_id',0)->latest()->paginate(1);
        $data['page_title'] = "Manage Categories";
        return view('admin.pro-cats.index', $data);
    }


    public function create()
    {
        $data['pro_cat'] = ProCat::where('pro_cat_id',0)->get();
        $data['page_title'] = "Manage Product Categories";
        return view('admin.pro-cats.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pro_category_name' => 'required',
            'pro_description' => 'required',
        ],
            [
                'pro_cat_id.required' => 'Product Category Parent Must not be empty',
                'pro_category_name.required' => 'Product Category must not be empty',
                'pro_description.required' => 'Product Category Description Must be Added',
            ]
        );
        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->pro_category_name,'ProCat');
        $in['pro_cat_id']   = $request->pro_cat_id==''? 0 : $request->pro_cat_id;
        $res = ProCat::create($in);

        if ($res) {
            return redirect()->route('product-category.index')->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'Problem With Creating Suburb');
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $data['pro_cats'] = ProCat::where('pro_cat_id',0)->get();
        $data['pro_cat'] = ProCat::find($id);
        $data['page_title'] = "Edit Product Cateory";
        return view('admin.pro-cats.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = ProCat::find($id);

        $request->validate([
            'pro_category_name' => 'required',
            'pro_description' => 'required',
        ],
            [
                'pro_cat_id.required' => 'Product Category Parent Must not be empty',
                'pro_category_name.required' => 'Product Category must not be empty',
                'pro_description.required' => 'Product Category Description Must be Added',
            ]
        );

        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->city,'ProCat');
        $in['pro_cat_id'] = $request->pro_cat_id == '' ? 0 : $request->pro_cat_id;
        $res = $data->fill($in)->save();

        if ($res) {
            return back()->with('success', 'Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Product Category');
        }
        return $data;

    }


    public function destroy($id)
    {
        //
    }

}
