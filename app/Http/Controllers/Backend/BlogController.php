<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function BlogCategory() {
        $categories = BlogCategory::latest()->get();
        return view('backend.blog.blog_category', compact('categories'));
    }

    public function StoreBlogCategory(Request $request) {
        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = [
            'message' => 'Blog Category Inserted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }

    public function EditBlogCategory($id) {
        $category = BlogCategory::find($id);
        return response()->json($category);
    }

    public function UpdateBlogCategory(Request $request) {
        BlogCategory::find($request->cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = [
            'message' => 'Blog Category Updated Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }

    public function DeleteBlogCategory($id) {
        BlogCategory::find($id)->delete();

        $notification = [
            'message' => 'Blog Category Deleted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }

    public function BlogDetails($slug) {
        $post = BlogPost::where('post_slug', $slug)->first();
        $categories = BlogCategory::latest()->get();
        $recent_posts = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_details', compact('post', 'categories', 'recent_posts'));
    }
}
