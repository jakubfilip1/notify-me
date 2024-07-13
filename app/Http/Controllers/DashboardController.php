<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->get();

        return view('dashboard.dashboard', ['notifications' => $notifications]);
    }

    public function add(Request $request)
    {
        $title = $request->input('notificationTitle');
        $content = $request->input('notificationContent');
        $date = $request->input('notificationDate');
        $fileName = "";

        if($request->hasFile('notificationFile'))
        {
            $fileName = time() . '_' . $request->file('notificationFile')->getClientOriginalName();
            $request->file('notificationFile')->storeAs('notifications/' . Auth::id(), $fileName, 'public');
        }

        $notification = new Notification();
        $notification->user_id = Auth::id();
        $notification->title = $title;
        $notification->content = $content;
        $notification->scheduled_at = $date;
        $notification->file = $fileName;
        $notification->save();

        return redirect()->route('dashboard');
    }
}
