<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomBookedDate;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class BookingController extends Controller
{
    public function Checkout()
    {
        if (Session::has('book_date')) {
            $book_data = Session::get('book_date');
            $room = Room::find($book_data['room_id']);
            $fromDate = Carbon::parse($book_data['check_in']);
            $toDate = Carbon::parse($book_data['check_out']);
            $nights = $toDate->diffInDays($fromDate);
            return view('frontend.checkout.checkout', compact('book_data', 'room', 'nights'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
            return redirect('/')->with($notification);
        }
        return view('frontend.checkout.checkout');
    }

    public function BookingStore(Request $request)
    {
        // dd($request->check_in);
        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'adults_booking' => 'required',
            'number_of_rooms' => 'required',
        ]);

        if ($request->abailable_rooms > $request->number_of_rooms) {
            $notification = [
                'message' => 'There is only' . $request->available_rooms . ' free rooms',
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

    public function CheckoutStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            // 'country' => 'required',
            // 'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ]);

        $book_data = Session::get('book_date');
        $fromDate = Carbon::parse($book_data['check_in']);
        $toDate = Carbon::parse($book_data['check_out']);
        $total_nights = $toDate->diffInDays($fromDate);

        $room = Room::find($book_data['room_id']);

        $subtotal = $room->price * $total_nights * $book_data['number_of_rooms'];
        $discount = ($room->discount/100) * $subtotal;
        $total_price = $subtotal - $discount;

        $code = rand(000000000, 999999999);

        if ($request->payment_method == 'Stripe') {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripe_pay = Stripe\Charge::create([
                'amount' => $total_price * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for Booking, Booking No. '.$code,
            ]);

            if ($stripe_pay['status'] == 'succeeded') {
                $payment_status = 1;
                $transaction_id = $stripe_pay->id;
            } else {
                $notification = [
                    'message' => 'Sorry, Payment method Failed!',
                    'alert-type' => 'success'
                ];
                return redirect()->back()->with($notification);
            }
        } else {
            $payment_status = 0;
            $transaction_id = '';
        }

        $data = new Booking();
        $data->rooms_id = $room->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d', strtotime($book_data['check_in']));
        $data->check_out = date('Y-m-d', strtotime($book_data['check_out']));
        $data->person = $book_data['adults_booking'];
        $data->number_of_rooms = $book_data['number_of_rooms'];
        $data->total_night = $total_nights;
        $data->actual_price = $room->price;
        $data->subtotal = $subtotal;
        $data->discount = $discount;
        $data->total_price = $total_price;
        $data->payment_method = $request->payment_method;
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

        $start_date = date('Y-m-d', strtotime($book_data['check_in']));
        $end_date = date('Y-m-d', strtotime($book_data['check_out']));
        $end_last_date = Carbon::create($end_date)->subDay();
        $d_period = CarbonPeriod::create($start_date, $end_last_date);
        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $data->rooms_id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        Session::forget('book_date');

        $notification = [
            'message' => 'Booking Stored Successfully!',
            'alert-type' => 'success'
        ];
        return redirect('/')->with($notification);
    }
}
