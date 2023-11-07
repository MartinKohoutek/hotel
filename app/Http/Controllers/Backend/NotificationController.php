<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function MarkAsRead(Request $request, $notificationId) {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['count' => $user->unreadNotifications()->count()]);
    }

    public function MarkAllAsRead() {
        $user = Auth::user();
        $notifications = $user->unreadNotifications()->get();

        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }

        $notification = [
            'message' => 'All Notification Marked As Read!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
