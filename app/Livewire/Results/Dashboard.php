<?php

namespace App\Livewire\Results;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.results.dashboard')->layout('layouts.dashboard');
    }
}
