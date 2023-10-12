<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;

use function PHPUnit\Framework\fileExists;

class RoomController extends Controller
{
    public function EditRoom($id) {
        $room = Room::findOrFail($id);
        $basic_facility = Facility::where('rooms_id', $id)->get();
        $multiImgs = RoomImage::where('rooms_id', $id)->get();
        $allRoomNumbers = RoomNumber::where('rooms_id', $id)->get();
        return view('backend.allroom.rooms.edit_room', compact('room', 'basic_facility', 'multiImgs', 'allRoomNumbers'));
    }

    public function UpdateRoom(Request $request, $id) {
        $room = Room::findOrFail($id);
        $room->roomtype_id = $room->roomtype_id;
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
            Image::make($image)->resize(1600, 1000)->save('upload/roomimg/'.$imageName);
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

    public function MultiImageDelete($id) {
        $deleteData = RoomImage::where('id', $id)->first();
        if ($deleteData) {
            $imagePath = 'upload/roomimg/multi_img/'.$deleteData->room_img;
            if (fileExists($imagePath)) {
                unlink($imagePath);
                // echo "Image Unlinked Successfully";
            } else {
                // echo "Image does not exist";
            }
            RoomImage::where('id', $id)->delete();
        }

        $notification = [
            'alert-type' => 'success',
            'message' => 'Image Deleted Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function StoreRoomNumber(Request $request, $id) {
        $data = new RoomNumber();
        $data->rooms_id = $id;
        $data->roomtype_id = $request->roomtype_id;
        $data->room_number = $request->room_number;
        $data->status = $request->status;
        $data->save();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Room Number Added Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function EditRoomNumber($id) {
        $room = RoomNumber::findOrFail($id);
        return view('backend.allroom.rooms.edit_room_number', compact('room'));
    }

    public function UpdateRoomNumber(Request $request, $id) {
        $room = RoomNumber::findOrFail($id)->update([
            'room_number' => $request->room_number,
            'status' => $request->status,
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Room Number Updated Successfully!',
        ];

        return redirect()->route('room.type.list')->with($notification);
    }

    public function DeleteRoomNumber($id) {
        RoomNumber::findOrFail($id)->delete();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Room Number Deleted Successfully!',
        ];

        return redirect()->route('room.type.list')->with($notification);
    }

    public function DeleteRoom(Request $request, $id) {
        $room = Room::findOrFail($id);

        if (fileExists('upload/roomimg/'.$room->image) and !empty($room->image)) {
            unlink('upload/roomimg/'.$room->image);
        }

        $subImages = RoomImage::where('rooms_id', $room->id)->get()->toArray();
        if (!empty($subImages)) {
            foreach ($subImages as $item) {
                if (!empty($item)) {
                    unlink('upload/roomimg/multi_img/'.$item['room_img']);
                }
            }
        }

        RoomType::where('id', $room->roomtype_id)->delete();
        RoomImage::where('rooms_id', $room->id)->delete();
        Facility::where('rooms_id', $room->id)->delete();
        RoomNumber::where('rooms_id', $room->id)->delete();
        $room->delete();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Room Deleted Successfully!',
        ];

        return redirect()->back()->with($notification);
    }
}
