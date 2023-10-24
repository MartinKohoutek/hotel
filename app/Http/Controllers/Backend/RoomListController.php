<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomBookedDate;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class RoomListController extends Controller
{
    public function RoomListView()
    {
        $room_number_list = RoomNumber::with('room_type', 'last_booking.booking:id,check_in,check_out,status,code,name,phone')
            ->orderBy('roomtype_id', 'asc')
            ->leftJoin('room_types', 'room_types.id', 'room_numbers.roomtype_id')
            ->leftJoin('booking_room_lists', 'booking_room_lists.room_number_id', 'room_numbers.id')
            ->leftJoin('bookings', 'bookings.id', 'booking_room_lists.booking_id')
            ->select(
                'room_numbers.*',
                'room_numbers.id as id',
                'room_types.name',
                'bookings.id as booking_id',
                'bookings.check_in',
                'bookings.check_out',
                'bookings.name as customer_name',
                'bookings.phone as customer_phone',
                'bookings.status as booking_status',
                'bookings.code as booking_number'
            )
            ->orderBy('room_types.id', 'asc')
            ->orderBy('bookings.id', 'desc')
            ->get();

        return view('backend.allroom.roomlist.view_room_list', compact('room_number_list'));
    }

    public function AddRoomList()
    {
        $roomtypes = RoomType::all();
        return view('backend.allroom.roomlist.add_room_list', compact('roomtypes'));
    }

    public function StoreRoomList(Request $request)
    {
        if ($request->check_in == $request->check_out) {
            $request->flash();

            $notification = [
                'message' => 'You Enter Same Date!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        if ($request->available_rooms < $request->number_of_rooms) {
            $request->flash();

            $notification = [
                'message' => 'You Enter Maximum Number of Rooms!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        $room = Room::find($request->room_id);
        if ($room->room_capacity < $request->number_of_guests) {
            $request->flash();

            $notification = [
                'message' => 'You Enter Maximum Number of Guests!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        $fromDate = Carbon::parse($request->check_in);
        $toDate = Carbon::parse($request->check_out);
        $total_nights = $toDate->diffInDays($fromDate);
        
        $subtotal = $room->price * $total_nights * $request->number_of_rooms;
        $discount = ($room->discount / 100) * $subtotal;
        $total_price = $subtotal - $discount;
        // dd($fromDate, $toDate, $total_nights, $subtotal, $discount, $total_price);

        $code = rand(000000000, 999999999);

        $payment_status = 0;
        $transaction_id = '';

        $data = new Booking();
        $data->rooms_id = $room->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d', strtotime($request->check_in));
        $data->check_out = date('Y-m-d', strtotime($request['check_out']));
        $data->person = $request['number_of_guests'];
        $data->number_of_rooms = $request['number_of_rooms'];
        $data->total_night = $total_nights;
        $data->actual_price = $room->price;
        $data->subtotal = $subtotal;
        $data->discount = $discount;
        $data->total_price = $total_price;
        $data->payment_method = 'COD';
        $data->transaction_id = $transaction_id;
        $data->payment_status = $payment_status;

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->zip_code = $request->zip_code;
        $data->address = $request->address;
        $data->code = $code;
        $data->status = 0;
        $data->created_at = Carbon::now();

        $data->save();

        $start_date = date('Y-m-d', strtotime($request['check_in']));
        $end_date = date('Y-m-d', strtotime($request['check_out']));
        $end_last_date = Carbon::create($end_date)->subDay();
        $d_period = CarbonPeriod::create($start_date, $end_last_date);
        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $data->rooms_id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        $notification = [
            'message' => 'Booking Stored Successfully!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
