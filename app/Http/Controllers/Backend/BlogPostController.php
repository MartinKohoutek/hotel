<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class BlogPostController extends Controller
{
    public function AllBlogPost() {
        $posts = BlogPost::latest()->get();
        return view('backend.blog.all_post', compact('posts'));
    }

    public function AddBlogPost() {
        $categories = BlogCategory::latest()->get();
        return view('backend.blog.add_post', compact('categories'));
    }

    public function StoreBlogPost(Request $request) {
        $image = $request->file('post_image');
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800, 533)->save('upload/blog/'.$imageName);
        $saveUrl = 'upload/blog/'.$imageName;
        
        BlogPost::insert([
            'blog_category_id' => $request->blog_category_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_image' => $saveUrl,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'New Blog Post Added Successfully!',
        ];

        return redirect()->route('all.blog.post')->with($notification);
    }
}
