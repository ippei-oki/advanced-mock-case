<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

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

        $qrUrl = route('reservation.qr', ['id' => $reservation->id]);

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);

        $qrCodeSvg = $writer->writeString($qrUrl);

        return view('reservation.qr', compact('reservation', 'qrCodeSvg'));
    }

}
