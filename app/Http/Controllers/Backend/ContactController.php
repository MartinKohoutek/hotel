<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function ContactUs() {
        $settings = SiteSetting::find(1);
        return view('frontend.contact.contact_us', compact('settings'));
    }

    public function ContactStore(Request $request) {
        Contact::insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Your Message Send Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function AllContactMessage() {
        $messages = Contact::latest()->get();
        return view('backend.contact.contact_all', compact('messages'));
    }
}
