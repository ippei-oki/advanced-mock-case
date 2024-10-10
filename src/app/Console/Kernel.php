<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ReservationReminderMail;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Encoding\Encoding;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $reservations = \App\Models\Reservation::whereDate('date', Carbon::today())->get();
            
            foreach ($reservations as $reservation) {
                try {
                    $reservationDate = Carbon::parse($reservation->date);
                } catch (\Exception $e) {
                    \Log::error('無効な日付フォーマット: ' . $reservation->date);
                    continue;
                }

                $qrUrl = route('reservation.cont', ['id' => $reservation->id]);
                $qrCode = Builder::create()
                    ->writer(new SvgWriter())
                    ->data($qrUrl)
                    ->encoding(new Encoding('UTF-8'))
                    ->size(300)
                    ->margin(10)
                    ->build();

                $qrCodeSvg = $qrCode->getString();

                if ($reservation->user && $reservation->user->email) {
                    Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation, $qrCodeSvg));
                } else {
                    \Log::error('ユーザーまたはメールが存在しません: ' . $reservation->id);
                }
            }
        })->dailyAt('07:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
