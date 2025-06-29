<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Section;

class HomePage extends Component
{
    public $sections;
    public $selectedSection;

    public function mount()
    {
        $this->sections = Section::orderBy('name')->get();
    }

   public function rate()
{
    if ($this->selectedSection) {
        $section = Section::find($this->selectedSection);

        if ($section) {
            return redirect()->route('rate.section', ['section' => $section->slug]);
        }
    }
}

    public function render()
    {
        return view('livewire.home-page')->layout('layouts.app');
    }
}
