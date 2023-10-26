<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function BlogCategory() {
        $categories = BlogCategory::latest()->get();
        return view('backend.blog.blog_category', compact('categories'));
    }
}
