<?php namespace App\Http\Controllers\Common;

use Mail;
use App;
use Excel;
use Storage;
use App\User;
use App\Outlet;
use App\OutletCat;
use App\Product;
use App\ProCat;
use App\Franchise;
use App\FranchiseOutletCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;


class OutletsController extends Controller
{

  public function __construct()
   {
       $this->middleware('auth');
       $this->icons      = '<i class="material-icons">shopping_cart</i>';

   }

   public function index(Request $request,$type)
   {

     $franchises = Franchise::all();
     $outlet_cats = OutletCat::all();
//       foreach ($franchises as $franchise) {
//         foreach ($outlet_cats as $outlet_cat) {
//
//
//           FranchiseOutletCat::create([
//                                   'franchise_id'=>$franchise->id,
//                                   'outlet_cat_id'=>$outlet_cat->id
//           ]);
//           // code...
//         }
// }
       $outlet_cat         = OutletCat::where('outlet_cat',$type)->first();
       $outlets            = Franchise::leftjoin('franchise_outlet_cats','franchise_outlet_cats.franchise_id','=','franchises.id')->where('franchise_outlet_cats.outlet_cat_id',$outlet_cat->id)->paginate(20);
       $page_title         = $outlet_cat->outlet_cat_des;



     return view('custom.outlets.index',compact('outlets','outlet_cat','page_title','type'));


   }

   public function outletDepartments(Request $request,$outletr,$type)
   {
         $user               = $request->user();
         $outlet             = Franchise::where('slug',$outletr)->first();
         $outlet_cat         = OutletCat::where('outlet_cat',$type)->first();
         $sub_cats           = Product::leftjoin('franchises','franchises.id','=','products.franchise_id')
                                                                                                          ->leftjoin('franchise_outlet_cats','franchise_outlet_cats.franchise_id','=','franchises.id')
                                                                                                          ->leftjoin('pro_categories','pro_categories.outlet_cat_id','=','franchise_outlet_cats.outlet_cat_id')
                                                                                                          ->where([['franchise_outlet_cats.outlet_cat_id',$outlet_cat->id]
                                                                                                            ,['franchises.id',$outlet->id]
                                                                                                          ,['pro_categories.outlet_cat_id',$outlet_cat->id]
                                                                                                        ])
                                                                                                          ->distinct()->pluck('products.pro_cat_id')
                                                                                                          ->toArray();
         $cats               = ProCat::find($sub_cats)->where('outlet_cat_id',$outlet_cat->id)->sortBy('pro_category_name');
         $page_title         = $outlet->outlet.' Departments';

         return view('custom.outlets.departments',compact('user','outlet','cats','type','page_title'));
    }

    public function outletProducts(Request $request,$outletr,$type,$departmentr)
    {
        $user               = $request->user();
        $outlet             = Franchise::where('slug',$outletr)->first();
        $cat                = ProCat::where('slug',$departmentr)->first();


        //$products           = Product::where([['pro_cat_id',$cat->id],['product_outlet_id',$outlet->id]])->paginate(20);
        $products           = Product::where([['products.pro_cat_id',$cat->id],['products.franchise_id',$outlet->id]])
                                                                                                              ->distinct()
                                                                                                              ->paginate(20);
        $page_title         = $cat->pro_category_name.' Products';

        return view('custom.outlets.products',compact('user','outlet','cat','type','departmentr','products','page_title'));
    }

}
