<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function RoomTypeList() {
        $roomTypes = RoomType::orderBy('id', 'desc')->get();
        return view('backend.allroom.roomtype.view_roomtype', compact('roomTypes'));
    }

    public function AddRoomType() {
        return view('backend.allroom.roomtype.add_roomtype');
    }

    public function RoomTypeStore(Request $request) {
        $roomtype_id = RoomType::insertGetId([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        Room::insert([
            'roomtype_id' => $roomtype_id,
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Room Type Created Successfully!',
        ];

        return redirect()->route('room.type.list')->with($notification);
    }
}
