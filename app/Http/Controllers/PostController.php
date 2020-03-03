<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use File;

class PostController extends Controller
{
    public function category()
    {
        $data['page_title'] = 'Blog Category';
        $data['events'] = Category::latest()->get();
        return view('admin.post.post-category', $data);
    }
    public function UpdateCategory(Request $request)
    {
        $macCount = Category::where('name', $request->name)->where('id', '!=', $request->id)->count();
        if ($macCount > 0) {
            return back()->with('alert', 'This one Already Exist');
        }
        if ($request->id == 0) {
            $data['name'] = $request->name;
            $data['status'] = $request->status;
            $res = Category::create($data);
            if ($res) {
                return back()->with('success', 'Saved Successfully!');
            } else {
                return back()->with('alert', 'Problem With Adding New Category');
            }
        } else {
            $mac = Category::findOrFail($request->id);
            $mac['name'] = $request->name;
            $mac['status'] = $request->status;
            $res = $mac->save();

            if ($res) {
                return back()->with('success', ' Updated Successfully!');
            } else {
                return back()->with('alert', 'Problem With Updating Category');
            }
        }
    }

    public function index()
    {
        $data['page_title'] = "All Blogs";
        $data['posts'] = Post::latest()->paginate(12);
        return view('admin.post.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Add Blog';
        return view('admin.post.add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required | mimes:jpeg,jpg | max:1000'
        ],
            [
                'title.required' => 'Post Title Must not be empty',
            ]
        );

        $in = Input::except('_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'post_'.time().'.jpg';
            $location = 'assets/images/post/' . $filename;
            Image::make($image)->resize(910,498)->save($location);
            $in['image'] = $filename;
        }
        $in['status'] =  $request->status == 'on' ? '1' : '0';
        $res = Post::create($in);
        if ($res) {
            return back()->with('success', 'Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Plan');
        }

    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Blog';
        $data['post'] = Post::find($id);
        return view('admin.post.edit', $data);
    }
    public function updatePost(Request $request)
    {

        $data = Post::find($request->id);
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'nullable | mimes:jpeg,jpg | max:1000'
        ],
            [
                'title.required' => 'Post Title Must not be empty',
                'details.required' => 'Post Details  must not be empty',
            ]
        );


        $in = Input::except('_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'post_'.time().'.jpg';
            $location = 'assets/images/post/' . $filename;
            Image::make($image)->resize(910,498)->save($location);
            $path = './assets/images/post/';
            File::delete($path.$data->image);
            $in['image'] = $filename;
        }
        $in['status'] =  $request->status == 'on' ? '1' : '0';
        $res = $data->fill($in)->save();

        if ($res) {
            return back()->with('success', 'Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating Plan');
        }
        return $data;
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $data = Post::findOrFail($request->id);
        $path = './assets/images/post/';
        File::delete($path.$data->image);
        $res =  $data->delete();

        if ($res) {
            return back()->with('success', 'Post Delete Successfully!');
        } else {
            return back()->with('alert', 'Problem With Deleting Post');
        }
    }
}
