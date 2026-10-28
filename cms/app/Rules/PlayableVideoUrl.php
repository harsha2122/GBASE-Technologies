<?php

namespace App\Rules;

use App\Support\VideoUrl;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PlayableVideoUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || VideoUrl::player($value) === null) {
            $fail('Enter a YouTube, Vimeo, or direct MP4/WebM video URL.');
        }
    }
}
