<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Menu2 extends Component
{
    public $isOpen = false;

    public function render()
    {
        $user = Auth::user();
        return view('livewire.menu2', compact('user'));
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
