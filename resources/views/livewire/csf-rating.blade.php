<div style="
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 2rem;
  max-width: 1200px;
  width: 100%;
  margin: 2rem auto;
  text-align: center;
  box-sizing: border-box;
  overflow-wrap: break-word;
  word-break: break-word;
  overflow: hidden;
  border-radius: 1rem;
  border: 1px solid #e5e7eb;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  background-color: #fff;
  min-height: 80vh;">
    <div style="display: flex; justify-content: center;  align-items: center; flex-wrap: wrap; gap: 2rem; width: 100%; max-width: 100vw; text-align: center;">
       
        @if ($submitted)
            <div 
                x-data="{ count: 5 }" 
                x-init="
                    let countdown = setInterval(() => {
                        count--;
                        if (count === 0) {
                            clearInterval(countdown);
                            window.location.href = '/{{ $section->slug ?? $section->name }}/csf';
                        }
                    }, 1000);"
                style="color: green; font-weight: bold; margin-top: 20px;">
                <h1><i>Thank you for rating the {{ strtoupper($section->name) }} section!</i></h1>
                <p style="color: gray";>Redirecting back to CSF page in <span x-text="count"></span></p>
                <a href="/{{ $section->slug ?? $section->name }}/csf" 
                style="margin-top: 1rem; display: inline-block; padding: 0.5rem 1rem; background-color: #2563eb; color: white; border-radius: 0.375rem; text-decoration: none;">
                    Go Back Now
                </a>
            </div>
        @else
            <h1>We’d love to hear your thoughts about your experience.</h1>
            <div style="display: flex; justify-content: center;  align-items: center; flex-wrap: wrap; gap: 2rem; width: 100%; max-width: 100vw; text-align: center;">
                <h2>How would you rate the {{ strtoupper($section->name) }} section?</h2>
            </div>
            <div wire:loading>
                Submitting...
            </div>
            <form wire:submit.prevent="submitRating">
                <input type="hidden" wire:model="recaptchaToken">
                <div style="display: flex; justify-content: center; gap: 2rem; width: 100%; max-width: 100vw;">
                    @for ($i = 1; $i <= 5; $i++)
                        <label style="cursor: pointer; font-size: user-select: none;" wire:click="rate({{ $i }})">
                            <input type="radio" wire:model="rating" value="{{ $i }}" style="display: none;" />
                            <span class="emoji-label" style="{{ $rating == $i ? 'color: #facc15;' : 'color: #999;' }}">
                                @switch($i)
                                    @case(1) 😞 @break
                                    @case(2) ☹️ @break
                                    @case(3) 😐 @break
                                    @case(4) 🙂 @break
                                    @case(5) 🥰 @break
                                @endswitch
                            </span>
                            <span>
                                @switch($i)
                                    @case(1) Disappointed @break
                                    @case(2) Unsatisfied @break
                                    @case(3) Neutral @break
                                    @case(4) Satisfied @break
                                    @case(5) Delighted @break
                                @endswitch
                            </span>
                            <span style="{{ $rating == $i ? 'color: #facc15;' : 'color: #999;' }}; font-style: italic;">
                                @switch($i)
                                    @case(1) / Nadismaya @break
                                    @case(2) / Dili kontento @break
                                    @case(3) / Sakto ra @break
                                    @case(4) / Kontento @break
                                    @case(5) / Nalipay kaayo @break
                                @endswitch
                            </span>
                        </label>
                    @endfor
                </div>
            </form>

            @error('rating')
                <div style="color: red;">{{ $message }}</div>
            @enderror

            @error('recaptcha')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        @endif

        <style>
            @media (max-width: 480px) {
            .emoji-label {
                font-size: 2rem; /* for phones */
            }
            }

            @media (min-width: 481px) and (max-width: 1024px) {
            .emoji-label {
                font-size: 10vw; /* tablets and small laptops */
            }
            }

            @media (min-width: 1025px) {
            .emoji-label {
                font-size: 8rem; /* desktops */
            }
            }
        </style>
        
    @push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.nocaptcha.sitekey') }}"></script>
    <script>
        let recaptchaToken = null;

        grecaptcha.ready(function () {
            grecaptcha.execute('{{ config('services.nocaptcha.sitekey') }}', { action: 'rating' })
                .then(function (token) {
                    recaptchaToken = token;
                });
        });

        Livewire.on('get-recaptcha-token', function () {
            if (recaptchaToken) {
                Livewire.find(@this.__instance.id).call('setRecaptchaTokenAndSubmit', recaptchaToken);
            } else {
                grecaptcha.execute('{{ config('services.nocaptcha.sitekey') }}', { action: 'rating' })
                    .then(function (token) {
                        Livewire.find(@this.__instance.id).call('setRecaptchaTokenAndSubmit', token);
                    });
            }
        });

    </script>
    @endpush

    </div>
</div>

