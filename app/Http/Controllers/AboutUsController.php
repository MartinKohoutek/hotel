<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AboutUsController extends Controller
{
    public function AboutUsUpdate() {
        $data = BookArea::find(1);
        return view('backend.about.about_us', compact('data'));
    }

    public function AboutUsStore(Request $request) {
        $data = BookArea::findOrFail($request->id);

        if ($request->file('small_image')) {
            $image = $request->file('small_image');
            @unlink($data->small_image);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600, 830)->save('upload/about/'.$imageName);
            $saveUrl = 'upload/about/'.$imageName;
            $data->update(['small_image' => $saveUrl]);
        }

        if ($request->file('big_image')) {
            $image = $request->file('big_image');
            @unlink($data->big_image);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600, 750)->save('upload/about/'.$imageName);
            $saveUrl = 'upload/about/'.$imageName;
            $data->update(['big_image' => $saveUrl]);
        }
        
        $data->update([
            'short_title' => $request->short_title,
            'main_title' => $request->main_title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'author' => $request->author,
            'link_url' => $request->link_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'About Us Section Updated Successfully!',
        ];

        return back()->with($notification);
    }
}
