<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class GallerySetting extends Controller
{
    public function AllGallerySetting() {
        $gallery = Gallery::latest()->get();
        return view('backend.gallery.all_gallery', compact('gallery'));
    }

    public function AddGallerySetting() {
        return view('backend.gallery.add_gallery');
    }

    public function StoreGallerySetting(Request $request) {
        $images = $request->file('photo');
        foreach ($images as $image) {
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save('upload/gallery/'.$imageName);
            $saveUrl = 'upload/gallery/'.$imageName;
            Gallery::insert([
                'photo' => $saveUrl,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = [
            'alert-type' => 'success',
            'message' => 'Gallery Images Inserted Successfully!',
        ];

        return redirect()->route('all.gallery.setting')->with($notification);
    }

    public function EditGallerySetting($id) {
        $gallery = Gallery::find($id);
        return view('backend.gallery.edit_gallery', compact('gallery'));
    }

    public function UpdateGallerySetting(Request $request) {
        $gallery = Gallery::find($request->id);
        if ($request->file('photo')) {
            $image = $request->file('photo');
            @unlink($gallery->photo);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save('upload/gallery/'.$imageName);
            $saveUrl = 'upload/gallery/'.$imageName;
            $gallery->update([
                'photo' => $saveUrl,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = [
            'alert-type' => 'success',
            'message' => 'Gallery Image Updated Successfully!',
        ];

        return redirect()->route('all.gallery.setting')->with($notification);
    }

    public function DeleteGallerySetting($id) {
        $gallery = Gallery::find($id);
        unlink($gallery->photo);
        $gallery->delete();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Gallery Image Deleted Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

}
