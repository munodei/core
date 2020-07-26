<?php

namespace App\Http\Controllers;

use App\Continent;
use App\Country;
use App\Faq;
use App\Menu;
use App\Post;
use App\Service;
use App\Subscriber;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class FrontendController extends Controller
{
    public function index()
    {
        $data['page_title'] = "International Convenience Online Remittance - Send ,Receive and Purchase Online";
        $data['testimonial'] = Testimonial::latest()->get();

        $data['country'] =  Country::whereStatus(1)->orderBy('name','asc')->get();
        $data['countryLatest'] =  Country::whereStatus(1)->orderBy('name','desc')->get();
        $data['continent'] =  Continent::with('countries')->whereStatus(1)->get();

        return view('front.home',$data);
    }

    public function sendSms()
    {


        $temp = \App\Etemplate::first();
        $appi =  $temp->smsapi;
        $text = urlencode('+27730884358');
        $appi = str_replace("{{number}}", '+27730884358', $appi);
        $appi = str_replace("{{message}}", $text, $appi);
        $result = file_get_contents($appi);
    }

    public function blog()
    {
        $data['page_title'] = "Blogs";
        $data['blogs'] =  Post::where('status',1)->paginate(9);
        return view('front.blog',$data);
    }

    public function details($id)
    {
         $post = Post::where('slug',$id)->first();
         if($post)
         {
             $data['page_title'] =  "Blog Details";
             $data['post'] =  $post;
             return view('front.details',$data);
         }
         abort(404);
    }

    public function outlets(Request $request)
    {
      $franchise = \App\Franchise::where('status',1)->paginate(20);

      if($request->has('franchise')){
        $franchise = \App\Franchise::where([['status',1],['franchise','LIKE','%'.$request->input('franchise').'%']])->paginate(20);
      }

      $page_title = 'Supported Franchises';
      return view('custom.franchises.index',compact('franchise','page_title'));
    }

    public function essentialServiceProviders(Request $request)
    {
      $franchise = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->paginate(20);

// var_dump($franchise);
// die();
      if($request->has('franchise')){
        $franchise = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->where([['service_provider_posts.status',1],['service_provider_posts.post_content','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_posts.post_title','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_users.display_name','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->distinct()
                                                                                                                                                                    ->paginate(20);
      }

      $page_title = 'Service Providers';
            $sqlSubcat = self::subCategories();

      $mainCategories = DB::table('tbl_main_category AS c')
            ->leftJoin('tbl_main_category_values AS cv', 'c.id', '=', 'cv.contentid')
            ->where([
                       ['c.isactive', '=', 'y'],
                       ['cv.fieldid', '=', '1'],
                    ])
            ->select('c.*','cv.*')
            ->get();

      $featuredCategories = DB::table('tbl_category')
            ->leftJoin('tbl_category_values', 'tbl_category.id', '=', 'tbl_category_values.contentid')
            ->where([
                       ['tbl_category.isactive', '=', 'y'],
                       ['tbl_category.show_on_home', '=', 'y'],
                       ['tbl_category_values.fieldid', '=', '1'],
                    ])
            ->select('tbl_category.*','tbl_category_values.*','tbl_category.slug as catSlug')
            ->get();
      $users = self::usersSlug();
      return view('custom.service-providers.index',compact('franchise','page_title','sqlSubcat','mainCategories','featuredCategories','users'));
    }

    public function mainCategoryServices($name,Request $request){

            $franchise = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->paginate(20);

// var_dump($franchise);
// die();
      if($request->has('franchise')){
        $franchise = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->where([['service_provider_posts.status',1],['service_provider_posts.post_content','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_posts.post_title','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_users.display_name','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->distinct()
                                                                                                                                                                    ->paginate(20);
      }

      $page_title = 'Category Services';
      
      $mainCategoryServices = DB::table('tbl_main_category')
        ->leftJoin('tbl_category', 'tbl_main_category.id', '=', 'tbl_category.ctype_id')
        ->leftJoin('tbl_category_values', 'tbl_category.id', '=', 'tbl_category_values.contentid')
            ->where([
                       ['tbl_main_category.pagename', 'LIKE', '%'.$name.'%'],
                       ['tbl_category_values.fieldid', '=', '1'],
                    ])
            ->select('tbl_main_category.*','tbl_category_values.*','tbl_category.*','tbl_category.slug as catSlug')
            ->get();

            $categorykeys = array();
            $x=0;
            foreach ($mainCategoryServices as $value) {

              $categorykeys[$x] = $value->id;
              $x++;

            }

            $categoriesAndSubCategories = DB::table('tbl_sub_category')
              ->leftJoin('tbl_sub_category_values', 'tbl_sub_category.id', '=', 'tbl_sub_category_values.contentid')
              ->leftJoin('tbl_category_values', 'tbl_sub_category.cat_id', '=', 'tbl_category_values.contentid')
              ->leftJoin('tbl_category', 'tbl_category.id', '=', 'tbl_category_values.contentid')
                  ->where([
                             ['tbl_sub_category.isactive', '=', 'y'],
                             ['tbl_sub_category_values.fieldid', '=', '1'],
                             ['tbl_category_values.fieldid', '=', '1'],
                          ])
                  ->whereIn('tbl_sub_category.cat_id', $categorykeys)
                  ->select('tbl_sub_category.*','tbl_sub_category_values.*','tbl_category_values.fieldvalue AS Category','tbl_category.slug as catSlug','tbl_sub_category.slug as subCatSlug')
                  ->orderBy('Category', 'asc')
                  ->get();

                  $categories= array();

                  foreach($categoriesAndSubCategories as $book)
                  {
                    $categories[$book->Category][] = $book;

                  }
          $sqlSubcat = self::subCategories();
          $mainCategories = self::mainCategoryInfo($name);
          $user = $request->user();
          $sqlSubcat = $sqlSubcat;

          return view('custom.service-providers.services',compact('page_title','franchise','mainCategoryServices','sqlSubcat','sqlSubcat','mainCategories','categories','user','name'));

    }

        public function categoryServices($name,Request $request){

            $franchise = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->paginate(20);

// var_dump($franchise);
// die();
      if($request->has('franchise')){
        $franchise = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->where([['service_provider_posts.status',1],['service_provider_posts.post_content','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_posts.post_title','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_users.display_name','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->distinct()
                                                                                                                                                                    ->paginate(20);
      }

      $page_title = 'Category Service Providers';
      
      $mainCategoryServices = DB::table('tbl_main_category')
        ->leftJoin('tbl_category', 'tbl_main_category.id', '=', 'tbl_category.ctype_id')
        ->leftJoin('tbl_category_values', 'tbl_category.id', '=', 'tbl_category_values.contentid')
            ->where([
                       ['tbl_category.slug', 'LIKE', '%'.$name.'%'],
                       ['tbl_category_values.fieldid', '=', '1'],
                    ])
            ->select('tbl_main_category.*','tbl_category_values.*','tbl_category.*','tbl_category.slug as catSlug')
            ->get();

            $categorykeys = array();
            $x=0;
            foreach ($mainCategoryServices as $value) {

              $categorykeys[$x] = $value->id;
              $x++;

            }

            $categoriesAndSubCategories = DB::table('tbl_sub_category')
              ->leftJoin('tbl_sub_category_values', 'tbl_sub_category.id', '=', 'tbl_sub_category_values.contentid')
              ->leftJoin('tbl_category_values', 'tbl_sub_category.cat_id', '=', 'tbl_category_values.contentid')
              ->leftJoin('tbl_category', 'tbl_category.id', '=', 'tbl_category_values.contentid')
                  ->where([
                             ['tbl_sub_category.isactive', '=', 'y'],
                             ['tbl_sub_category_values.fieldid', '=', '1'],
                             ['tbl_category_values.fieldid', '=', '1'],
                          ])
                  ->whereIn('tbl_sub_category.cat_id', $categorykeys)
                  ->select('tbl_sub_category.*','tbl_sub_category_values.*','tbl_category_values.fieldvalue AS Category','tbl_category.slug as catSlug','tbl_sub_category.slug as subCatSlug')
                  ->orderBy('Category', 'asc')
                  ->get();

                  $categories= array();

                  foreach($categoriesAndSubCategories as $book)
                  {
                    $categories[$book->Category][] = $book;

                  }
          $sqlSubcat = self::subCategories();
          $mainCategories = self::mainCategoryInfo($name);
          $user = $request->user();
          $sqlSubcat = $sqlSubcat;

          return view('custom.service-providers.category',compact('page_title','franchise','mainCategoryServices','sqlSubcat','sqlSubcat','mainCategories','categories','user','name'));

    }

    public function subCategoryServices($name,Request $request){

            $franchise = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->paginate(20);

// var_dump($franchise);
// die();
      if($request->has('franchise')){
        $franchise = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->where([['service_provider_posts.status',1],['service_provider_posts.post_content','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_posts.post_title','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_users.display_name','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->distinct()
                                                                                                                                                                    ->paginate(20);
      }

      $page_title = 'Category Service Providers';
      
      $mainCategoryServices = DB::table('tbl_main_category')
        ->leftJoin('tbl_category', 'tbl_main_category.id', '=', 'tbl_category.ctype_id')
        ->leftJoin('tbl_category_values', 'tbl_category.id', '=', 'tbl_category_values.contentid')
        ->leftJoin('tbl_sub_category', 'tbl_sub_category.cat_id', '=', 'tbl_category_values.contentid')
            ->where([
                       ['tbl_sub_category.slug', '=', $name],
                       ['tbl_category_values.fieldid', '=', '1'],
                    ])
            ->select('tbl_main_category.*','tbl_category_values.*','tbl_category.*','tbl_category.slug as catSlug')
            ->get();

            $categorykeys = array();
            $x=0;
            foreach ($mainCategoryServices as $value) {

              $categorykeys[$x] = $value->id;
              $x++;

            }

            $categoriesAndSubCategories = DB::table('tbl_sub_category')
              ->leftJoin('tbl_sub_category_values', 'tbl_sub_category.id', '=', 'tbl_sub_category_values.contentid')
              ->leftJoin('tbl_category_values', 'tbl_sub_category.cat_id', '=', 'tbl_category_values.contentid')
              ->leftJoin('tbl_category', 'tbl_category.id', '=', 'tbl_category_values.contentid')
                  ->where([
                             ['tbl_sub_category.isactive', '=', 'y'],
                             ['tbl_sub_category_values.fieldid', '=', '1'],
                             ['tbl_category_values.fieldid', '=', '1'],
                          ])
                  ->whereIn('tbl_sub_category.cat_id', $categorykeys)
                  ->select('tbl_sub_category.*','tbl_sub_category_values.*','tbl_category_values.fieldvalue AS Category','tbl_category.slug as catSlug','tbl_sub_category.slug as subCatSlug')
                  ->orderBy('Category', 'asc')
                  ->get();

                  $categories= array();

                  foreach($categoriesAndSubCategories as $book)
                  {
                    $categories[$book->Category][] = $book;

                  }
          $sqlSubcat = self::subCategories();
          $mainCategories = self::mainCategoryInfo($name);
          $user = $request->user();
          $sqlSubcat = $sqlSubcat;

          return view('custom.service-providers.service',compact('page_title','franchise','mainCategoryServices','sqlSubcat','sqlSubcat','mainCategories','categories','user','name'));

    }

    public function usersSlug(){
      $request = app(\Illuminate\Http\Request::class);
      $users = \App\ServiceProviderPost::leftjoin('service_provider_postmeta','service_provider_postmeta.service_provider_post_id','=','service_provider_posts.id')
                                                                                                                                                                    ->leftjoin('service_provider_users','service_provider_users.id','service_provider_posts.service_provider_user_id')
                                                                                                                                                                    ->leftjoin('service_provider_usermeta','service_provider_users.id','service_provider_usermeta.service_provider_user_id')
                                                                                                                                                                    ->where([
                                                                                                                                                                      ['service_provider_posts.post_status','publish'],
                                                                                                                                                                      ['service_provider_posts.status',1],
                                                                                                                                                                        ['service_provider_postmeta.meta_key','essb_cached_image'],
                                                                                                                                                                          ['service_provider_usermeta.meta_key','avatar'],
                                                                                                                                                                    ])
                                                                                                                                                                    ->select('service_provider_usermeta.meta_key as avatar','service_provider_postmeta.*','service_provider_posts.*')
                                                                                                                                                                    ->where([['service_provider_posts.status',1],['service_provider_posts.post_content','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_posts.post_title','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->orwhere([['service_provider_posts.status',1],['service_provider_users.display_name','LIKE','%'.$request->input('franchise').'%']])
                                                                                                                                                                    ->distinct()
                                                                                                                                                                    ->select(
                                                                                                                                                                      'service_provider_posts.id as desc',
                                                                                                                                                                      'service_provider_posts.post_name as slug',
                                                                                                                                                                      'service_provider_users.display_name as value')
                                                                                                                                                                    ->get();
       
      return json_encode($users);
    }

    public function subCategories(){
      $sqlSubcat = DB::table('tbl_sub_category AS s')
            ->leftJoin('tbl_sub_category_values AS sv', 's.id', '=', 'sv.contentid')
            // ->where([
            //           ['tbl_sub_category.isactive', '=', '1'],
            //           ['tbl_sub_category_values.langid', '=', '1'],
            //           ['tbl_sub_category_values.fieldid', '=', '1'],
            //         ])
            ->select('s.id as desc', 'sv.fieldvalue as value','s.slug as slug')
            ->get();
      return json_encode($sqlSubcat);
    }

    public function mainCategoryInfo($name){
      $mainCategories = DB::table('tbl_main_category AS c')
            ->leftJoin('tbl_main_category_values AS cv', 'c.id', '=', 'cv.contentid')
            ->where([
                       ['c.pagename', '=', $name],
                    ])
            ->select('c.*','cv.*')
            ->get();
            return $mainCategories;
    }
    public function serviceProvider($franchise)
    {
      $info =  \App\ServiceProviderPost::where('post_name',$franchise)->first();
      $data['page_title'] =  $info->post_title;
      $data['location'] =  \App\ServiceProviderPostmeta::where([['service_provider_post_id',$info->id],['meta_key','location_input']])->first();
      $data['photo'] = \App\ServiceProviderPostmeta::where([['service_provider_post_id',$info->id],['meta_key','essb_cached_image']])->first();
      $data['post'] =  $info;
      return view('custom.service-providers.details',$data);

    }

    public function franchisesInformation($franchise)
    {
      $info =  \App\Franchise::where('slug',$franchise)->first();
      $data['page_title'] =  $info->franchise;
      $data['post'] =  $info;
      return view('custom.franchises.details',$data);

    }

    public  function franchisesProducts(Request $request,$country,$franchise){

      $info =  \App\Franchise::where('slug',$franchise)->first();
      $data['page_title'] =  $info->franchise;
      $data['outlet'] =  $info;
      $data['products'] =  \App\Product::where('franchise_id',$info->id)->paginate(20);
      if($request->has('product')){
        $data['products']  = \App\Product::where([['franchise_id',$info->id],['product_name','LIKE','%'.$request->input('product').'%']])->paginate(20);
      }

      return view('custom.franchises.products',$data);

    }

    public function service($slug)
    {
      $service = Service::where([['status',1],['slug',$slug]])->first();
      if($service)
      {
        $page_title =  $service->service." Details";
        return view('front.service',compact('page_title','service'));
      }

    }

    public function faqs()
    {
        $data['page_title'] = "Faq";
        $data['faqs'] =  Faq::all();
        return view('front.faq',$data);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $macCount = Subscriber::where('email', $request->email)->count();
        if ($macCount > 0) {
            return back()->with('alert', 'This Email Already Exist !!');
        }else{
            Subscriber::create($request->all());
            return back()->with('success', ' Subscribe Successfully!');
        }
    }
    public function contactUs()
    {
        $data['page_title'] =  "Contact Us";
        return view('front.contact',$data);
    }
    public function contactSubmit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'subject' => 'required',
            'phone' => 'required',
        ]);
        $subject = $request->subject;
        $phone =  "<br><br>" ."Contact Number : ". $request->phone . "<br><br>";

        $txt = $request->message.$phone;

        send_contact($request->email, $request->name, $subject, $txt);
        return back()->with('success', ' Contact Message Send Successfully!');
    }

    public function about()
    {
        $data['page_title'] = "About Us";
        return view('front.about',$data);
    }

    public function menu($id)
    {
        $menu = Menu::find($id);
        if($menu)
        {
            $data['page_title'] =$menu->name;
            $data['menu'] = $menu;
            return view('front.menu',$data);
        }
        abort(404);

    }




}
