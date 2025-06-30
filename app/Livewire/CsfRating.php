<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Section;
use App\Models\Rating;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CsfRating extends Component
{
    public $sectionSlug;
    public $section;
    public $rating = null;
    public $nickname = '';
    public $comment = '';
    public $submitted = false;
    public $recaptchaToken;

    public function mount($section)
    {
        $this->sectionSlug = $section;
        $this->section = Section::where('slug', $section)->firstOrFail();

        if (method_exists($this->section, 'trashed') && $this->section->trashed()) {
            abort(404);
        }
    }

    public function rate($value)
    {
        $this->rating = $value;
        $this->dispatch('get-recaptcha-token');
    }

    public function setRecaptchaTokenAndSubmit($token)
    {
        $this->recaptchaToken = $token;
        $this->submitRating();
    }

    public function submitRating()
    {
        // no captcha
        //if (!$this->validateRecaptcha()) return;

        $ip = request()->ip();
        $key = 'rating:' . $this->section->id . ':' . $ip;

        if (RateLimiter::tooManyAttempts($key, 10)) {
            $this->addError('rating', 'Slow down. Please wait a while.');
            return;
        }

        RateLimiter::hit($key, 60);

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'nickname' => 'nullable|string|max:100',
            'comment' => 'nullable|string|max:1000',
        ]);

        Rating::create([
            'section_id' => $this->section->id,
            'rating' => $this->rating,
            'nickname' => $this->nickname,
            'comment' => $this->comment,
            'ip' => request()->ip(),
        ]);

        $this->submitted = true;
        $this->reset('rating', 'recaptchaToken');
    }

    protected function validateRecaptcha(): bool
    {
        if (!$this->recaptchaToken) {
            $this->addError('recaptcha', 'Captcha failed. Please try again.');
            return false;
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.nocaptcha.secret'),
            'response' => $this->recaptchaToken,
            'remoteip' => request()->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            $this->addError('recaptcha', 'Suspicious activity detected. Try again.');
            return false;
        }

        return true;
    }

    public function render()
    {
        return view('livewire.csf-rating');
    }
}
