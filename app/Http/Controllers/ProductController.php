<?php

namespace App\Http\Controllers;


use File;
use Image;
use App\Outlet;
use App\ProCat;
use App\Product;
use App\ProSubCat;
use App\Franchise;
use App\OutletProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class ProductController extends Controller
{

    public function index()
    {
        $data['product'] = Product::latest()->paginate(25);
        $data['page_title'] = "Manage Products";
        return view('admin.product.index', $data);
    }


    public function create()
    {
        $data['pro_cat'] = ProCat::whereStatus(1)->get();
        $data['page_title'] = "Manage Products";
        return view('admin.product.create', $data);
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


    public function assign($id)
    {
      $data['outlet'] = Outlet::where('status',1)->get();
      $data['page_title'] = "Assign Product to Outlet";
      $data['product_id'] = $id;
      $data['product'] = Product::all();
      $outlets = Outlet::all();

      // foreach ($data['product']  as $product) {
      //
      //     foreach ($outlets as $outlet) {
      //         OutletProduct::create([
      //             'product_id'=>$product->id,
      //             'outlet_id'=>$outlet->id
      //         ]);
      //     }
      //
      // }

      return view('admin.product.assign', $data);

    }

    public function createAssignment(Request $request)
    {

      $request->validate([
          'product_id' => 'required',
          'outlet_id' => 'required',
      ]);

      $in = Input::except('_token');
      if(!OutletProduct::where([['product_id',$in['product_id']],['outlet_id',$in['outlet_id']]])->exists()){
      $res = OutletProduct::create($in);

      if ($res) {
          return back()->with('success', 'Assignment Successfully!');
      }
    }
      return back()->with('alert', 'Problem With Product Outlet Assigment');

      return $data;
    }

    public function edit($id)
    {
        $data['pro_cat'] = ProCat::whereStatus(1)->get();
        $data['product'] = Product::find($id);
        $data['page_title'] = "Edit Product";
        return view('admin.product.edit', $data);
    }

    public function previewProduct(Request $request,$slug)
    {

      $data['product'] = Product::where('slug',$slug)->first();
      $data['pro_cat'] = ProSubCat::where('id',  $data['product']->pro_cat_id)->first();
      $data['franchise'] = Franchise::where('id',  $data['product']->franchise_id)->first();
      $data['page_title'] = $data['product']->product_name;
      return view('custom.products.details', $data);

    }

    public function update(Request $request, $id)
    {
        $data = Product::find($id);

        $request->validate([
                              'product_name'=>'required',
                              'product_description'=>'required',
                              'product_quantity'=>'required',
                              'product_price'=>'required',
                              'product_brand'=>'required',
                              'photo'=>'required',
                              'pro_cat_id'=>'required',
                              'url'=>'required',
                            ]
        );

        $in = Input::except('_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['slug']   = unique_slug($request->product_name,'Product');

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
