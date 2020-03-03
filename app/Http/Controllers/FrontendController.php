<?php

namespace App\Http\Controllers;

use App\Continent;
use App\Country;
use App\Faq;
use App\Menu;
use App\Post;
use App\Subscriber;
use App\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Home";
        $data['testimonial'] = Testimonial::latest()->get();

        $data['country'] =  Country::whereStatus(1)->orderBy('name','asc')->get();
        $data['countryLatest'] =  Country::whereStatus(1)->orderBy('name','desc')->get();
        $data['continent'] =  Continent::with('countries')->whereStatus(1)->get();

        return view('front.home',$data);
    }

    public function blog()
    {
        $data['page_title'] = "Blogs";
        $data['blogs'] =  Post::where('status',1)->paginate(9);
        return view('front.blog',$data);
    }

    public function details($id)
    {
         $post = Post::find($id);
         if($post)
         {
             $data['page_title'] =  "Blog Details";
             $data['post'] =  $post;
             return view('front.details',$data);
         }
         abort(404);
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
