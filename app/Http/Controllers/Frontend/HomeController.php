<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Rooms() {
        $rooms = Room::latest()->get();
        return view('frontend.rooms.rooms', compact('rooms'));
    }

    public function RoomDetails($id) {
        $room = Room::findOrFail($id);
        $images = RoomImage::where('rooms_id', $room->id)->get();
        $facilities = Facility::where('rooms_id', $room->id)->get();
        return view('frontend.rooms.room_details', compact('room', 'images', 'facilities'));
    }
}
