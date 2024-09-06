<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        $favorites = Favorite::with('shop')
            ->where('user_id', $user->id)
            ->get();
        return view('mypage', compact('user', 'reservations', 'favorites'));
    }

    public function cancel($id)
    {
        $reservation = Reservation::find($id);
        
        if ($reservation && $reservation->user_id == Auth::id()) {
            $reservation->delete();
        }

        return redirect()->route('mypage');
    }
}
