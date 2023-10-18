<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function Checkout() {
        return view('frontend.checkout.checkout');
    }

    public function BookingStore(Request $request) {
        // dd($request->check_in);
        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'adults_booking' => 'required',
            'number_of_rooms' => 'required',
        ]);

        if ($request->abailable_rooms > $request->number_of_rooms) {
            $notification = [
                'message' => 'There is only'.$request->available_rooms.' free rooms',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }

        Session::forget('book_date');

        $data = array();
        $data['number_of_rooms'] = $request->number_of_rooms;
        $data['available_rooms'] = $request->available_rooms;
        $data['adults_booking'] = $request->adults_booking;
        $data['check_in'] = date('Y-m-d', strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d', strtotime($request->check_out));
        $data['room_id'] = $request->room_id;

        Session::put('book_date', $data);

        return redirect()->route('checkout');
    }
}
