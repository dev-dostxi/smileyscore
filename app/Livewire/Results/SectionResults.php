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
        if (!$this->startDate || !$this->endDate) {
            $now = now();
            $year = $now->year;

            if ($now->month <= 6) {
                $this->startDate = Carbon::create($year, 1, 1)->toDateString();
                $this->endDate = Carbon::create($year, 6, 30)->toDateString();
            } else {
                $this->startDate = Carbon::create($year, 7, 1)->toDateString();
                $this->endDate = Carbon::create($year, 12, 31)->toDateString();
            }
        }
    }

    public function getCurrentSectionProperty()
    {
        return $this->section
            ? auth()->user()->sections()->where('slug', $this->section)->first()
            : null;
    }

    public function getFormattedStartDateProperty()
    {
        return $this->startDate ? Carbon::parse($this->startDate)->format('F j, Y') : null;
    }

    public function getFormattedEndDateProperty()
    {
        return $this->endDate ? Carbon::parse($this->endDate)->format('F j, Y') : null;
    }

    public function applyFilters()
    {
        if ($this->startDate) {
            $this->startDate = Carbon::parse($this->startDate)->format('Y-m-d');
        }

        if ($this->endDate) {
            $this->endDate = Carbon::parse($this->endDate)->format('Y-m-d');
        }

        $this->resetPage();
    }

    public function resetFilters()
    {
        $now = now();
        $year = $now->year;

        if ($now->month <= 6) {
            $this->startDate = Carbon::create($year, 1, 1)->toDateString();
            $this->endDate = Carbon::create($year, 6, 30)->toDateString();
        } else {
            $this->startDate = Carbon::create($year, 7, 1)->toDateString();
            $this->endDate = Carbon::create($year, 12, 31)->toDateString();
        }

        $this->resetPage();
    }

    public function render()
    {
        $currentSection = $this->currentSection;
        $start = $this->startDate ? Carbon::parse($this->startDate)->startOfDay() : null;
        $end = $this->endDate ? Carbon::parse($this->endDate)->endOfDay() : null;

        if (!$currentSection) {
            abort(404, 'Section not found or not assigned to you.');
        }

        $ratings = $currentSection->ratings()
            ->when($start, fn ($q) => $q->where('created_at', '>=', $start))
            ->when($end, fn ($q) => $q->where('created_at', '<=', $end))
            ->latest()
            ->paginate(7);

        $averageRating = $currentSection->ratings()
            ->when($start, fn ($q) => $q->where('created_at', '>=', $start))
            ->when($end, fn ($q) => $q->where('created_at', '<=', $end))
            ->avg('rating') ?? 0;

        return view('livewire.results.section-results', [
            'section' => $currentSection,
            'ratings' => $ratings,
            'averageRating' => $averageRating,
        ]);
    }

}
