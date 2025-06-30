<?php

namespace App\Livewire\Results;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class SectionResults extends Component
{
    use WithPagination;

    public $section;
    public $startDate;
    public $endDate;

    protected $queryString = ['section', 'startDate', 'endDate'];

    public function mount()
    {
        // Optional default dates
        $this->startDate ??= now()->subMonth()->toDateString(); // 1 month ago
        $this->endDate ??= now()->toDateString();              // today
    }

    public function getCurrentSectionProperty()
    {
        return $this->section
            ? auth()->user()->sections()->where('slug', $this->section)->first()
            : null;
    }

    public function getFormattedStartDateProperty()
    {
        return $this->startDate ? Carbon::parse($this->startDate)->format('Y-m-d') : null;
    }

    public function getFormattedEndDateProperty()
    {
        return $this->endDate ? Carbon::parse($this->endDate)->format('Y-m-d') : null;
    }

    public function updatedStartDate()
    {
        $this->resetPage();
    }

    public function updatedEndDate()
    {
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function render()
    {
        $currentSection = $this->currentSection;

        if (!$currentSection) {
            abort(404, 'Section not found or not assigned to you.');
        }

        $ratings = $currentSection->ratings()
            ->when($this->startDate, fn ($q) => $q->whereDate('created_at', '>=', $this->startDate))
            ->when($this->endDate, fn ($q) => $q->whereDate('created_at', '<=', $this->endDate))
            ->latest()
            ->paginate(7);

        return view('livewire.results.section-results', [
            'section' => $currentSection,
            'ratings' => $ratings,
        ]);
    }
}
