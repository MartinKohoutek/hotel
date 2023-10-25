<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    public function AllTestimonial() {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial', compact('testimonials'));
    }
}
