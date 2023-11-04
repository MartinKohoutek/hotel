<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function AllBlogPost() {
        $posts = BlogPost::latest()->get();
        return view('backend.blog.all_post', compact('posts'));
    }
}
