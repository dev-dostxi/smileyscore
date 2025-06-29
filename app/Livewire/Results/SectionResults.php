<?php

namespace App\Livewire\Results;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class SectionResults extends Component
{
    use WithPagination;

    public $section;
    public $startDate ="2000-04-05";
    public $endDate ="2000-04-07";

    protected $queryString = ['section', 'startDate', 'endDate'];

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
        $this->resetPage(); // In case you're on page > 1
    }

    public function render()
    {
        $currentSection = $this->currentSection;

        if (!$currentSection) {
            abort(404, 'Section not found or not assigned to you.');
        }

        $query = $currentSection->ratings()->latest();

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        logger()->info('Start Date: ' . $this->startDate);
        logger()->info('End Date: ' . $this->endDate);

        $ratings = $query->paginate(7, ['*'], 'page');

        return view('livewire.results.section-results', [
            'section' => $currentSection,
            'ratings' => $ratings,
        ])->layout('layouts.dashboard');
    }
}
