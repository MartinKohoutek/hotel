<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

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
}
