<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    public function AllTestimonial() {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial', compact('testimonials'));
    }

    public function AddTestimonial() {
        return view('backend.testimonial.add_testimonial');
    }

    public function StoreTestimonial(Request $request) {
        $image = $request->file('image');
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(80, 80)->save('upload/testimonial/'.$imageName);
        $saveUrl = 'upload/testimonial/'.$imageName;
        
        Testimonial::insert([
            'name' => $request->name,
            'city' => $request->city,
            'message' => $request->message,
            'image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'New Testimonial Added Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.testimonial')->with($notification);
    }

    public function EditTestimonial($id) {
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit_testimonial', compact('testimonial'));
    }

    public function UpdateTestimonial(Request $request) {
        $testimonial = Testimonial::findOrFail($request->id);

        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink($testimonial->image);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(80, 80)->save('upload/testimonial/'.$imageName);
            $saveUrl = 'upload/testimonial/'.$imageName;
            $testimonial->update(['image' => $saveUrl]);
        }
        
        $testimonial->update([
            'name' => $request->name,
            'city' => $request->city,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Testimonial Updated Successfully!',
        ];

        return redirect()->route('all.testimonial')->with($notification);
    }
}
