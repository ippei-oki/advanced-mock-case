<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shop;
use Carbon\Carbon;

class ReservationForm extends Component
{
    public $shop;
    public $date;
    public $time;
    public $number = 1;

    public function mount(Shop $shop)
    {
        $this->shop = $shop;
        $this->date = Carbon::today()->format('Y-m-d');
        $current = Carbon::now();
        $this->time = $current->copy()->addMinutes(30 - ($current->minute % 30))->format('H:i');
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}
