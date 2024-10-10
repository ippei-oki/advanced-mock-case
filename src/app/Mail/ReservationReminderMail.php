<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $qrCodeSvg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, $qrCodeSvg)
    {
        $this->reservation = $reservation;
        $this->qrCodeSvg = $qrCodeSvg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reservation_reminder')
                    ->subject('予約のリマインダー')
                    ->with([
                        'reservation' => $this->reservation,
                        'qrCodeSvg' => $this->qrCodeSvg
                    ]);
    }
}
