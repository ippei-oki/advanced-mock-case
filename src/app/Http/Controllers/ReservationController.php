<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Encoding\Encoding;
use App\Mail\ReservationReminder;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
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

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('edit', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'number' => 'required|integer|min:1|max:10',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
        $reservation->save();

        return redirect()->route('mypage')->with('success', '予約が変更されました');
    }

    public function showQrCode($id)
    {
        $reservation = Reservation::findOrFail($id);

        $qrUrl = route('reservation.cont', ['id' => $reservation->id]);

        $qrCode = Builder::create()
            ->writer(new SvgWriter())
            ->data($qrUrl)
            ->encoding(new Encoding('UTF-8'))
            ->size(300)
            ->margin(10)
            ->build();

        $qrCodeSvg = $qrCode->getString();

        Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation, $qrCodeSvg));

        return view('reservation.qr', compact('reservation', 'qrCodeSvg'));
    }

    public function showQrPage($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservation.qr', compact('reservation'));
    }

}
