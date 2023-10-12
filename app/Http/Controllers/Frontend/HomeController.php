<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Rooms() {
        $rooms = Room::latest()->get();
        return view('frontend.rooms.rooms', compact('rooms'));
    }
}
