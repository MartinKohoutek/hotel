<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function EditRoom($id) {
        $room = Room::findOrFail($id);
        return view('backend.allroom.rooms.edit_room', compact('room'));
    }
}
