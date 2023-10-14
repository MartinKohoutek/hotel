<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomBookedDate;
use App\Models\RoomImage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

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
        $rooms = Room::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.rooms.room_details', compact('room', 'images', 'facilities', 'rooms'));
    }

    public function BookingSearch(Request $request) {
        $request->flash();
        
        $date = explode(' - ', $request->date_booking);
        $check_in = str_replace('/', '-', $date[0]);
        $check_out = str_replace('/', '-', $date[1]);
        
        if ($check_in == $check_out) {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Use different Start and End Day!'
            ];
            return redirect()->back()->with($notification);
        }

        $start_date = date('Y-m-d', strtotime($check_in));
        $end_date = date('Y-m-d', strtotime($check_out));
        $alldate = Carbon::create($end_date)->subDay();
        $d_period = CarbonPeriod::create($start_date, $alldate);  

        $day_array = [];
        foreach ($d_period as $period) {
            array_push($day_array, date('Y-m-d', strtotime($period)));
        }


        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $day_array)->distinct()->pluck('booking_id')->toArray();
        $rooms = Room::withCount('room_numbers')->where('status', 1)->get();
        // $bookings = App\Models\Booking::withCount('assignRooms')->whereIn('id', $check_date_booking_ids)->where('rooms_id', $room->id)->get()->toArray();
        // dd($check_date_booking_ids, $rooms);

        return view('frontend.rooms.search_room', compact('rooms', 'check_date_booking_ids'));
    }
}
