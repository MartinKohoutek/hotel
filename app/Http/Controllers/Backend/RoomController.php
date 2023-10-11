<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;

class RoomController extends Controller
{
    public function EditRoom($id) {
        $room = Room::findOrFail($id);
        $basic_facility = Facility::where('rooms_id', $id)->get();
        return view('backend.allroom.rooms.edit_room', compact('room', 'basic_facility'));
    }

    public function UpdateRoom(Request $request, $id) {
        $room = Room::findOrFail($id);
        $room->roomtype_id = $id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->price;

        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style;
        $room->discount = $request->discount;

        $room->short_description = $request->short_description;
        $room->description = $request->description;
        $room->save();

        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink($room->image);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(500, 500)->save('upload/roomimg/'.$imageName);
            $room->image = $imageName;
        }

        if ($request->facility_name == NULL) {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Sorry, No Facility Selected!',
            ];

            return redirect()->back()->with($notification);
        } else {
            Facility::where('rooms_id', $id)->delete();
            $facilities = Count($request->facility_name);
            for ($i = 0; $i < $facilities; $i++) {
                $facility_count = new Facility();
                $facility_count->rooms_id = $room->id;
                $facility_count->facility_name = $request->facility_name[$i];
                $facility_count->save();
            }
        }

        if ($room->save()) {
            $files = $request->multi_image;
            if (!empty($files)) {
                $subImage = RoomImage::where('rooms_id', $id)->get()->toArray();
                // dd($subImage);
                $images = RoomImage::where('rooms_id', $id)->delete();
                foreach ($subImage as $item) {
                    @unlink('upload/roomimg/multi_img/'.$item['room_img']);
                }
            }

            if (!empty($files)) {
                foreach($files as $file) {
                    $imgName = date('YmdHi').$file->getClientOriginalName();
                    $file->move('upload/roomimg/multi_img', $imgName);
                    $subImage['room_img'] = $imgName;

                    $subImage = new RoomImage();
                    $subImage->rooms_id = $room->id;
                    $subImage->room_img = $imgName;
                    
                    $subImage->save();
                }
            }

            $notification = [
                'alert-type' => 'success',
                'message' => 'Room Updated Successfully!',
            ];

            return redirect()->back()->with($notification);
        }

      
    }
}
