<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use App\Models\User;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.notifications.index', compact('users'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:191',
            'message' => 'required|string',
            'recipients' => 'required|string',
        ]);

        if ($request->recipients === 'all') {
            $users = User::all();
        }
        
        else if ($request->recipients === 'specific' && $request->has('selected_users')) {
            $users = User::whereIn('id', $request->selected_users)->get();
        } else {
            return redirect()->route('admin.notifications.index')->with('error', '送信先が選択されていません。');
        }

        foreach ($users as $user) {
            Mail::to($user->email)->send(new UserNotification($request->subject, $request->message));
        }

        return redirect()->route('admin.notifications.index')->with('success', 'お知らせメールを送信しました。');
    }
}
