<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Room;
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
        $room->roomtype_id = $request->roomtype_id;
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

        if ($room->file('image')) {
            $image = $room->file('image');
            @unlink($room->image);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(50, 50)->save('upload/roomimg', $imageName);
            $room->image = 'upload/rooming'.$imageName;
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
                $facility_count->room_id = $room->id;
                $facility_count->facility_name = $request->facility_name[$i];
                $facility_count->save();
            }
        }

        $room->save();
    }
}
