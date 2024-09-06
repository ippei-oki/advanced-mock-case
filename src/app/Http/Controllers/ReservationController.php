<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
{
    $reservation = new Reservation();
    $reservation->user_id = Auth::id();
    $reservation->shop_id = $request->input('shop_id');
    $reservation->date = $request->input('date');
    $reservation->time = $request->input('time');
    $reservation->number = $request->input('number');
    $reservation->save();

    return redirect()->route('reservations.done');
}
}
